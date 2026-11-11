<?php
/** Zielgruppen-Seite: bedient /paare und /gruppen (siehe .htaccess und tools/router.php) */
require __DIR__ . '/inc/bootstrap.php';

$slug = $_GET['z'] ?? '';
if (!is_string($slug) || !isset($C['audiences'][$slug])) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}
$au = $C['audiences'][$slug];
$bookHref = '/buchen?anlass=' . $au['landing'] . '#kalender';

// "Warum WhirlStudio": zuerst die Punkte der Zielgruppe, dann die allgemeinen Vorteile und Fakten.
// Punkte mit gleichem Titel erscheinen nur einmal.
$seen = array_column($au['points'], 'title');
$perks = $au['points'];
foreach ($C['perks'] as $p) {
    if (!in_array($p['title'], $seen, true)) { $perks[] = $p; $seen[] = $p['title']; }
}
$facts = array_values(array_filter($C['facts'], fn($f) => !in_array($f['title'], $seen, true)));

page_start([
    'title' => $au['title'] . ' | WhirlStudio Hamburg',
    'description' => $au['lead'] . ' Ab ' . $C['prices']['from'] . ' € pro Nacht, Check-in ' . $C['times']['checkin'] . '.',
    'path' => '/' . $slug,
    'view' => $au['eyebrow'],
    'og' => $IMG[$au['hero']][1][2],
]);
?>

<section class="hero hero--studio">
  <div class="hero__bg"><?= img($au['hero'], $au['image_alt'], '100vw', ['eager' => true, 'mobile' => $au['hero_m']]) ?></div>
  <div class="wrap hero__in">
    <p class="eyebrow"><?= e($au['eyebrow']) ?> · <?= e($C['claim']) ?></p>
    <h1 class="h1"><?= e($au['title']) ?></h1>
    <p class="hero__lead"><?= e($au['lead']) ?></p>
    <div class="btns">
      <?= book_btn('Freie Termine ansehen', 'Zielgruppe Hero ' . $au['eyebrow'], $bookHref) ?>
      <a class="btn btn--ghost" href="#studios">Studios ansehen</a>
    </div>
    <ul class="hero__facts">
      <li>ab <?= e(eur($C['prices']['from'])) ?> pro Nacht für 2</li>
      <li><?= e($C['capacity']['label']) ?></li>
      <li>Check-in <?= e($C['times']['checkin']) ?></li>
    </ul>
  </div>
</section>

<?php
// Test: alternative Darstellungen der Liste (Umschalter rechts, $liste aus bootstrap.php)
$GLOBALS['switch_groups'][] = 'liste';
?>
<?php if ($liste !== 'o'): ?>
<section class="sec<?= $liste === 'c' ? ' sec--flush' : '' ?>" id="warum">
  <div class="wrap">
    <?php part('reasons', [
        'variant' => $liste, 'items' => array_merge($perks, $facts), 'top' => count($au['points']),
        'image' => $au['image'], 'title' => 'Warum WhirlStudio', 'text' => implode(' · ', $au['occasions']),
    ]); ?>
  </div>
</section>
<?php else: ?>
<section class="sec" id="warum">
  <div class="wrap">
    <?php part('head', ['title' => 'Warum WhirlStudio', 'text' => implode(' · ', $au['occasions'])]); ?>
    <?php part('perks', ['items' => $perks]); ?>
    <?php part('facts', ['items' => $facts]); ?>
  </div>
</section>
<?php endif; ?>

<section class="sec sec--dark" id="studios">
  <div class="wrap">
    <?php part('head', ['title' => $C['studios_intro']['title'], 'text' => $C['studios_intro']['text'], 'center' => true]); ?>
    <?php part('studio-cards'); ?>
    <div class="center"><?php part('review', ['r' => $C['studios']['pretty']['review'], 'studio' => 'PRETTY']); ?></div>
  </div>
</section>

<section class="sec sec--sun">
  <div class="wrap">
    <?php part('head', ['title' => 'Preise', 'center' => true]); ?>
    <?php part('prices', ['book' => $bookHref]); ?>
  </div>
</section>

<section class="sec">
  <div class="wrap split">
    <?php part('head', ['title' => 'FAQ', 'text' => 'Kurz beantwortet']); ?>
    <?php part('faq', ['keys' => $au['faq']]); ?>
  </div>
</section>

<?php part('closing', ['image' => $au['image'], 'book' => $bookHref]); ?>

<?php page_end(); ?>
