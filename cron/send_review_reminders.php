<?php
// cron/send_review_reminders.php

// Aumentamos el tiempo de ejecución
set_time_limit(600); 

// Incluimos la configuración principal
require_once __DIR__ . '/../includes/config.php';

// --- VERIFICACIÓN DE SEGURIDAD ---
if (!isset($_GET['secret']) || $_GET['secret'] !== CRON_SECRET_KEY) {
    http_response_code(403);
    die('Acceso no autorizado.');
}
// --- FIN DE LA VERIFICACIÓN ---

echo "--- Iniciando el script de recordatorios de reseña --- \n";

$reminder_days = (int)($app_settings['review_reminder_days'] ?? 7);
echo "Periodo de espera configurado: {$reminder_days} días.\n";

// 2. Buscamos todas las descargas que cumplen los requisitos:
//    - Ocurrieron hace 'X' días o más.
//    - Todavía no se les ha enviado un recordatorio.
//    - ¡YA NO SE FILTRA POR opt_in_notifications!
$query = "
    SELECT 
        d.id as download_id,
        d.user_name,
        d.user_email,
        d.phone_number,
        d.plugin_id,
        d.user_id,
        p.title as plugin_title,
        p.slug as plugin_slug
    FROM 
        downloads d
    JOIN 
        plugins p ON d.plugin_id = p.id
    WHERE 
        d.downloaded_at <= NOW() - INTERVAL ? DAY
        AND d.review_reminder_sent = 0
";

$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $reminder_days);
$stmt->execute();
$downloads_to_notify = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if (empty($downloads_to_notify)) {
    echo "No hay recordatorios para enviar hoy. \n";
    exit();
}

echo "Se encontraron " . count($downloads_to_notify) . " usuarios para notificar.\n\n";
$sent_count = 0;

foreach ($downloads_to_notify as $download) {
    
    // 3. Verificamos si el usuario YA ha dejado una reseña para ese plugin
    $has_reviewed = false;
    if ($download['user_id']) {
        $review_check_stmt = $mysqli->prepare("SELECT id FROM plugin_reviews WHERE user_id = ? AND plugin_id = ? LIMIT 1");
        $review_check_stmt->bind_param('ii', $download['user_id'], $download['plugin_id']);
    } else {
        $review_check_stmt = $mysqli->prepare("SELECT id FROM plugin_reviews WHERE phone_number = ? AND plugin_id = ? LIMIT 1");
        $review_check_stmt->bind_param('si', $download['phone_number'], $download['plugin_id']);
    }
    $review_check_stmt->execute();
    if ($review_check_stmt->get_result()->num_rows > 0) {
        $has_reviewed = true;
    }
    $review_check_stmt->close();

    // 4. Si NO ha dejado reseña, procedemos a enviar la notificación
    if (!$has_reviewed) {
        echo "Procesando descarga ID: {$download['download_id']}...\n";
        
        // Si no tenemos un nombre de la base de datos (descarga anónima), usamos un genérico.
        $user_name = !empty($download['user_name']) ? $download['user_name'] : 'usuario';
        $review_url = SITE_URL . '/reviews.php?slug=' . $download['plugin_slug'];
        
        // Enviar por WhatsApp si tenemos el número
        if (!empty($download['phone_number'])) {
            $wa_message = "👋 ¡Hola, {$user_name}!\n\nHace unos días descargaste el plugin *'{$download['plugin_title']}'*.\n\n¿Qué te ha parecido? Tu opinión es muy importante para nosotros y para otros usuarios. ¿Podrías dejarnos una reseña?\n\n¡Solo te tomará un minuto!\n{$review_url}";
            sendWhatsAppNotification($download['phone_number'], $wa_message, $app_settings);
            echo "- Notificación de WhatsApp enviada a {$download['phone_number']}\n";
        }

        // Enviar por Email si tenemos el correo
        if (!empty($download['user_email'])) {
            $email_subject = "Tu opinión sobre el plugin '{$download['plugin_title']}'";
            $email_body = "Hola {$user_name},<br><br>Hace unos días descargaste nuestro plugin <strong>'{$download['plugin_title']}'</strong> y nos encantaría saber qué te ha parecido.<br><br>Las reseñas nos ayudan a mejorar y a que otros usuarios puedan tomar mejores decisiones. ¿Te animas a dejarnos la tuya?<br><br><a href='{$review_url}' style='padding:10px 15px; background-color:#0d6efd; color:white; text-decoration:none; border-radius:5px;'>Dejar una Reseña</a><br><br>¡Muchas gracias por tu tiempo!";
            sendSMTPMail($download['user_email'], $user_name, $email_subject, $email_body, $app_settings);
            echo "- Notificación por email enviada a {$download['user_email']}\n";
        }
        
        // 5. Marcamos la descarga como notificada
        $mysqli->query("UPDATE downloads SET review_reminder_sent = 1 WHERE id = {$download['download_id']}");
        $sent_count++;
        echo "--------------------------\n";
    } else {
        $mysqli->query("UPDATE downloads SET review_reminder_sent = 1 WHERE id = {$download['download_id']}");
        echo "El usuario de la descarga ID: {$download['download_id']} ya dejó una reseña. Omitiendo y marcando.\n";
        echo "--------------------------\n";
    }
}

echo "\n--- Proceso completado. Se enviaron recordatorios a {$sent_count} usuarios. ---\n";
?>