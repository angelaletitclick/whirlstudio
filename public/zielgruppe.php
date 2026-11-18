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

// "Warum WhirlStudio": die Liste 'auszeit' aus content.php, die Punkte der Zielgruppe ('first') vorn und groß
$rank = fn(array $it) => ($i = array_search($it['title'], $au['first'], true)) === false ? 99 : $i;
$items = $C['auszeit']['items'];
usort($items, fn($x, $y) => $rank($x) <=> $rank($y));

page_start([
    'title' => $au['title'] . ' | WhirlStudio Hamburg',
    'description' => $au['lead'] . ' Ab ' . $C['prices']['from'] . ' € pro Nacht, Check-in ' . $C['times']['checkin'] . '.',
    'path' => '/' . $slug,
    'view' => $au['eyebrow'],
    'og' => $IMG[$au['hero']][1][2],
]);
?>

<section class="hero hero--studio hero--<?= e($au['slug']) ?>">
  <div class="hero__bg"><?= img($au['hero'], $au['hero_alt'] ?? $au['image_alt'], '100vw', ['eager' => true, 'mobile' => $au['hero_m']]) ?></div>
  <div class="wrap hero__in">
    <p class="eyebrow"><?= e($au['eyebrow']) ?> · <?= hl($C['claim']) ?></p>
    <h1 class="h1"><?= hl($au['title']) ?></h1>
    <?= hero_lead($au['hero_lead'] ?? $au['lead'], $au['hero_lead_short'] ?? null) ?>
    <div class="btns">
      <?= book_btn('Zielgruppe Hero ' . $au['eyebrow'], $bookHref) ?>
      <a class="btn btn--ghost" href="#studios">Studios ansehen</a>
    </div>
    <ul class="hero__facts">
      <li>ab <?= e(eur($C['prices']['from'])) ?> pro Nacht für 2</li>
      <?php foreach ($C['hero_facts'] as $f): ?><li><?= e($f) ?></li><?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="sec" id="warum">
  <div class="wrap">
    <?php part('why', [
        'title' => 'Warum WhirlStudio', 'occasions' => $au['occasions'], 'items' => $items,
        'image' => $au['why_image'] ?? $au['image'], 'image_alt' => $au['why_image_alt'] ?? $au['image_alt'],
    ]); ?>
  </div>
</section>

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

<?php $occ = $C['occasions'][$au['landing']] ?? $C['occasions']['default']; ?>
<?php part('closing', ['image' => $au['image'], 'book' => $bookHref, 'eyebrow' => $au['eyebrow'], 'title' => $occ['title']]); ?>

<?php page_end(); ?>
