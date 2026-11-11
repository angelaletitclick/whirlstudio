<?php
require __DIR__ . '/inc/bootstrap.php';
$title = 'Impressum';
$path = '/impressum';
// Angaben von whirlstudio.de/impressum übernommen.
// TODO Kunde/Rechtsprüfung: E-Mail-Adresse fehlt (§ 5 DDG). Alter Verweis "§ 10 Abs. 3 MDStV" ist veraltet → ersetzen.
ob_start(); ?>
<p><strong>WhirlStudio</strong><br>Tim Beuermann<br>Alstertwiete 1a<br>20099 Hamburg</p>
<p>Mobil: <a href="tel:<?= e($C['contact']['phone_tel']) ?>"><?= e($C['contact']['phone_display']) ?></a><?php if ($C['contact']['email']): ?><br>E-Mail: <a href="mailto:<?= e($C['contact']['email']) ?>"><?= e($C['contact']['email']) ?></a><?php endif; ?></p>
<p>Wirtschafts-Identifikationsnummer: DE250776034</p>
<p>Inhaltlich verantwortlich: Tim Beuermann (Anschrift wie oben).</p>
<h2>Haftungshinweis</h2>
<p>Trotz sorgfältiger inhaltlicher Kontrolle übernehme ich keine Haftung für die Inhalte externer Links. Für den Inhalt der verlinkten Seiten sind ausschließlich deren Betreiber verantwortlich.</p>
<p>Die Rechte an sämtlichen Bildern, Videos sowie anderen Inhalten dieser Internetpräsenz liegen bei Tim Beuermann. Inhalte und Werke Dritter sind als solche gekennzeichnet.</p>
<?php $body = ob_get_clean();
require __DIR__ . '/inc/layout/legal.php';
