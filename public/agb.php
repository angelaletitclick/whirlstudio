<?php
require __DIR__ . '/inc/bootstrap.php';
$title = 'Allgemeine Geschäftsbedingungen';
$path = '/agb';
// TODO Kunde: finale Fassung. Interne Verweise prüfen (§ 13 → § 18, § 16 fehlt, Telefon § 1).
$body = file_get_contents(__DIR__ . '/inc/legal/agb.html');
require __DIR__ . '/inc/layout/legal.php';
