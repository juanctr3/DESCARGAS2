<?php
// cron/send_expiry_reminders.php

set_time_limit(600);
require_once __DIR__ . '/../includes/config.php';

// --- VERIFICACIÓN DE SEGURIDAD ---
if (!isset($_GET['secret']) || $_GET['secret'] !== CRON_SECRET_KEY) {
    http_response_code(403);
    die('Acceso no autorizado.');
}

echo "--- Iniciando script de recordatorios de expiración de licencias --- \n";

// --- Buscamos licencias que expiran exactamente en 5 días o que expiran hoy ---
$query = "
    SELECT 
        lk.id as license_id,
        lk.license_key,
        lk.expires_at,
        u.name as user_name,
        u.email as user_email,
        u.whatsapp_number,
        p.title as plugin_title
    FROM 
        license_keys lk
    JOIN 
        users u ON lk.user_id = u.id
    JOIN
        plugins p ON lk.plugin_id = p.id
    WHERE 
        lk.status = 'active'
        AND lk.expiration_reminder_sent = 0
        AND lk.expires_at IS NOT NULL
        AND (
            lk.expires_at = CURDATE() + INTERVAL 5 DAY 
            OR lk.expires_at = CURDATE()
        )
";

$licenses_to_notify = $mysqli->query($query)->fetch_all(MYSQLI_ASSOC);

if (empty($licenses_to_notify)) {
    echo "No hay recordatorios de expiración para enviar hoy. \n";
    exit();
}

echo "Se encontraron " . count($licenses_to_notify) . " licencias para notificar.\n\n";
$sent_count = 0;

foreach ($licenses_to_notify as $license) {
    $today = new DateTime();
    $expiry_date = new DateTime($license['expires_at']);
    $diff = $today->diff($expiry_date)->days;
    $is_expiring_today = ($expiry_date->format('Y-m-d') === $today->format('Y-m-d'));

    $user_name = $license['user_name'];
    $plugin_title = $license['plugin_title'];
    $renewal_url = SITE_URL . '/my-licenses.php'; // Enlace para que el usuario gestione su licencia

    $wa_message = '';
    $email_subject = '';
    $email_body = '';

    if ($is_expiring_today) {
        // Mensajes para el día del vencimiento
        $wa_message = "🔴 ¡Atención, {$user_name}!\n\nTu licencia para el plugin *{$plugin_title}* vence *HOY*. Para continuar recibiendo actualizaciones y soporte, por favor renuévala desde tu cuenta:\n\n{$renewal_url}";
        $email_subject = "Tu licencia para {$plugin_title} vence hoy";
        $email_body = "Hola {$user_name},<br><br>Te informamos que tu licencia para el plugin <strong>{$plugin_title}</strong> expira hoy. Para no perder el acceso a futuras actualizaciones y al soporte, te recomendamos renovarla lo antes posible.<br><br><a href='{$renewal_url}'>Gestionar mis licencias</a>";
    } else {
        // Mensajes para el pre-aviso de 5 días
        $wa_message = "🟠 ¡Hola, {$user_name}!\n\nTu licencia para el plugin *{$plugin_title}* está a punto de vencer en 5 días. Asegúrate de renovarla para no perder acceso a futuras actualizaciones y soporte.\n\nPuedes gestionarla desde tu cuenta:\n{$renewal_url}";
        $email_subject = "Tu licencia para {$plugin_title} vencerá pronto";
        $email_body = "Hola {$user_name},<br><br>Este es un recordatorio amigable de que tu licencia para el plugin <strong>{$plugin_title}</strong> expirará en 5 días. Para asegurar un servicio ininterrumpido, puedes renovarla desde tu panel de usuario.<br><br><a href='{$renewal_url}'>Gestionar mis licencias</a>";
    }

    // Enviar notificaciones
    if (!empty($license['whatsapp_number'])) {
        sendWhatsAppNotification($license['whatsapp_number'], $wa_message, $app_settings);
    }
    if (!empty($license['user_email'])) {
        sendSMTPMail($license['user_email'], $user_name, $email_subject, $email_body, $app_settings);
    }

    // Marcar como notificado
    $mysqli->query("UPDATE license_keys SET expiration_reminder_sent = 1 WHERE id = {$license['license_id']}");
    
    // Si vence hoy, cambiar el estado de la licencia a 'expired'
    if ($is_expiring_today) {
        $mysqli->query("UPDATE license_keys SET status = 'expired' WHERE id = {$license['license_id']}");
    }
    
    $sent_count++;
    echo "Notificación enviada para la licencia #{$license['license_id']}\n";
}

echo "\n--- Proceso completado. Se enviaron recordatorios para {$sent_count} licencias. ---\n";
?>