<?php
require __DIR__ . '/inc/bootstrap.php';
$title = 'Datenschutzerklärung';
$path = '/datenschutz';
// TODO vor Livegang: vollständige Datenschutzerklärung (Hosting IONOS, Meta Pixel mit Einwilligung,
// Smoobu-Buchungskalender, Google-Maps-Link, Server-Logfiles). Rechtliche Prüfung durch den Kunden.
ob_start(); ?>
<p class="notice">Die Datenschutzerklärung wird vor dem Livegang ergänzt.</p>
<h2>Cookie-Einstellungen</h2>
<p>Du kannst deine Einwilligung zum Meta Pixel jederzeit ändern oder widerrufen.</p>
<p><button type="button" class="btn btn--line" data-consent-open>Cookie-Einstellungen öffnen</button></p>
<?php $body = ob_get_clean();
require __DIR__ . '/inc/layout/legal.php';
