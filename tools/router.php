<?php
/**
 * Lokaler Entwicklungs-Router (bildet die .htaccess-Regeln nach).
 * Start:  php -S localhost:8000 -t public tools/router.php
 */
$root = realpath(__DIR__ . '/../public');
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');

if (str_starts_with($path, '/inc/')) { http_response_code(403); exit('403'); }

if (preg_match('#^/(pretty|vibe)/?$#', $path, $m)) {
    $_GET['s'] = $m[1];
    require $root . '/studio.php';
    return true;
}
if (preg_match('#^/(paare|gruppen)/?$#', $path, $m)) {
    $_GET['z'] = $m[1];
    require $root . '/zielgruppe.php';
    return true;
}
if ($path !== '/' && is_file($root . $path)) {
    return false; // statische Datei
}
$name = trim($path, '/');
if ($name === '') { require $root . '/index.php'; return true; }
if (preg_match('/^[a-z0-9-]+$/', $name) && is_file("$root/$name.php")) {
    require "$root/$name.php";
    return true;
}
require $root . '/404.php';
return true;
