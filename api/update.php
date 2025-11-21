<?php
// api/update.php

header('Content-Type: application/json');
require_once '../includes/config.php';

// --- VALIDACIONES INICIALES ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); exit();
}

$action = $_POST['action'] ?? '';
$update_identifier = trim($_POST['update_identifier'] ?? '');
$current_version = $_POST['version'] ?? '';
$license_key = $_POST['license_key'] ?? '';

if (empty($update_identifier)) {
    // No hacer nada si el identificador no está presente
    exit();
}

// --- BUSCAR EL PLUGIN POR SU IDENTIFICADOR ÚNICO ---
$stmt_plugin = $mysqli->prepare("SELECT * FROM plugins WHERE update_identifier = ? AND status = 'active'");
$stmt_plugin->bind_param('s', $update_identifier);
$stmt_plugin->execute();
$plugin_data_result = $stmt_plugin->get_result();

if ($plugin_data_result->num_rows === 0) {
    $stmt_plugin->close();
    exit(); // Plugin no encontrado, no devolver nada
}

$plugin_data = $plugin_data_result->fetch_assoc();
$stmt_plugin->close();

// --- LÓGICA PRINCIPAL ---
$is_new_version_available = version_compare($plugin_data['version'], $current_version, '>');

if (!$is_new_version_available) {
    exit(); // No hay versión nueva, no se devuelve nada.
}

// --- VALIDACIÓN DE LICENCIA ---
if ($plugin_data['requires_license']) {
    if (empty($license_key)) { exit(); }

    $stmt_license = $mysqli->prepare("SELECT status, expires_at FROM license_keys WHERE license_key = ? AND plugin_id = ?");
    $stmt_license->bind_param('si', $license_key, $plugin_data['id']);
    $stmt_license->execute();
    $license_data = $stmt_license->get_result()->fetch_assoc();
    $stmt_license->close();

    $is_license_valid = ($license_data && $license_data['status'] === 'active' && (!$license_data['expires_at'] || new DateTime() <= new DateTime($license_data['expires_at'])));

    if (!$is_license_valid) {
        // Si la licencia no es válida, se puede enviar una respuesta con un aviso, pero es opcional.
        // Por simplicidad, salimos para no ofrecer la actualización.
        exit();
    }
}

$download_link = SITE_URL . '/download.php?uid=' . $plugin_data['update_identifier'] . '&license=' . urlencode($license_key);

// --- CONSTRUIR LA RESPUESTA PARA WORDPRESS ---
$response = new stdClass(); // Usar un objeto estándar es la mejor práctica

// Información crucial para la actualización
$response->slug         = $plugin_data['slug'];
$response->plugin      = 'woowapp-2/woowapp.php'; // Ruta base del plugin: carpeta/archivo_principal.php
$response->new_version  = $plugin_data['version'];
$response->package      = $download_link;

// Información para la ventana "Ver detalles"
$response->name         = $plugin_data['title'];
$response->info = $plugin_data['slug']; // Indica a WordPress el slug para pedir "Ver detalles"
$response->url  = SITE_URL . '/plugin/' . $plugin_data['slug'] . '/'; // La URL de tu página del plugin
$response->tested       = $plugin_data['tested'] ?? null;
$response->requires     = $plugin_data['requires'] ?? null;
$response->requires_php = $plugin_data['requires_php'] ?? null;
$response->author       = !empty($plugin_data['author']) ? $plugin_data['author'] : ($app_settings['site_name'] ?? 'Autor Desconocido');
$response->last_updated = date('Y-m-d H:i:s', strtotime($plugin_data['last_updated']));

// Formatear el changelog para que se vea bien en HTML (convierte saltos de línea en <br>)
$changelog_html = !empty($plugin_data['changelog']) ? nl2br(htmlspecialchars($plugin_data['changelog'])) : '<p>No hay cambios detallados para esta versión.</p>';

$response->sections = [
    'description' => $plugin_data['short_description'] ?? 'Descripción no disponible.',
    'changelog'   => $changelog_html,
];

// (Opcional) Añadir banners si los tienes en la base de datos
if (!empty($plugin_data['banner_low']) || !empty($plugin_data['banner_high'])) {
    $response->banners = [
        'low'  => $plugin_data['banner_low'] ?? '',
        'high' => $plugin_data['banner_high'] ?? '',
    ];
}

// (Opcional) Añadir icono si lo tienes
if (!empty($plugin_data['icon'])) {
    $response->icons = ['1x' => $plugin_data['icon']];
}

echo json_encode($response);
?>