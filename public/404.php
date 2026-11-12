<?php
require_once __DIR__ . '/inc/bootstrap.php';
http_response_code(404);
$title = 'Seite nicht gefunden';
$path = '/404';
ob_start(); ?>
<p>Diese Seite gibt es nicht (mehr). Hier geht’s weiter:</p>
<p class="btns"><a class="btn btn--line" href="/">Zur Startseite</a> <?= book_btn('404') ?></p>
<?php $body = ob_get_clean();
require __DIR__ . '/inc/layout/legal.php';
