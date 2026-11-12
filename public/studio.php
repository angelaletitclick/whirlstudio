<?php
require __DIR__ . '/inc/bootstrap.php';

$slug = $_GET['s'] ?? '';
if (!is_string($slug) || !isset($C['studios'][$slug])) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}
$s = $C['studios'][$slug];
$other = $slug === 'pretty' ? 'vibe' : 'pretty';
$smoobuUrl = $C['smoobu'][$slug] ?? $C['smoobu']['all'];

page_start([
    'title' => 'Studio ' . $s['name'] . ' – Apartment mit Whirlpool in Hamburg | WhirlStudio',
    'description' => 'Studio ' . $s['name'] . ' ' . $s['tagline'] . ': eigener Whirlpool, ' . $s['size'] . ', mitten in Hamburg-Hohenfelde. Ab ' . $C['prices']['from'] . ' € pro Nacht für 2.',
    'path' => '/' . $slug,
    'view' => 'Studio ' . $s['name'],
    'og' => $IMG[$s['hero']][1][2],
]);
?>

<section class="hero hero--studio">
  <div class="hero__bg"><?= img($s['hero'], 'Whirlpool im Studio ' . $s['name'], '100vw', ['eager' => true, 'mobile' => $s['hero_m']]) ?></div>
  <div class="wrap hero__in">
    <p class="eyebrow">Studio mit Whirlpool · Hamburg</p>
    <h1 class="h1 h1--name"><?= e($s['name']) ?></h1>
    <p class="hero__lead"><?= e($s['tagline']) ?></p>
    <div class="btns">
      <?= book_btn('Studio Hero ' . $s['name'], '#kalender') ?>
    </div>
    <ul class="hero__facts">
      <li>ab <?= e(eur($C['prices']['from'])) ?> pro Nacht für 2</li>
      <li><?= e($s['size']) ?></li>
      <li><?= e($C['capacity']['label']) ?></li>
      <li>Check-in <?= e($C['times']['checkin']) ?></li>
    </ul>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <div class="split">
      <div>
        <?php part('head', ['title' => 'Ausstattung', 'text' => 'Alles, was ihr für eure Auszeit braucht']); ?>
        <?php part('review', ['r' => $s['review']]); ?>
      </div>
      <?php part('features', ['items' => array_merge($s['features'], $C['features_all'])]); ?>
    </div>
    <?php part('perks'); ?>
  </div>
</section>

<?php $GLOBALS['switch_groups'][] = 'galerie'; $gv = $GLOBALS['variant']['galerie']; ?>
<?php if ($gv !== 'o'): /* Test: Galerie-Varianten, siehe inc/parts/gallery-alt.php */ ?>
<section class="sec gal-sec" id="bilder" aria-label="Bilder">
  <?php part('gallery-alt', ['items' => $s['gallery'], 'studio' => $s['name'], 'variant' => $gv]); ?>
</section>
<?php else: ?>
<section class="slider-sec" id="bilder" aria-label="Bilder">
  <?php part('gallery', ['items' => $s['gallery'], 'studio' => $s['name']]); ?>
</section>
<?php endif; ?>

<section class="sec sec--alt">
  <div class="wrap">
    <?php part('head', ['title' => 'Freie Termine', 'text' => 'Studio ' . $s['name'] . ' buchen', 'center' => true]); ?>
    <?php part('smoobu', ['url' => $smoobuUrl, 'id' => 'apartmentIframe' . ucfirst($slug)]); ?>
  </div>
</section>

<section class="sec sec--sun">
  <div class="wrap">
    <?php part('head', ['title' => 'Preise', 'center' => true]); ?>
    <?php part('prices', ['book' => '#kalender']); ?>
  </div>
</section>

<section class="sec">
  <div class="wrap split">
    <?php part('head', ['title' => 'FAQ', 'text' => 'Kurz beantwortet']); ?>
    <?php part('faq', ['keys' => ['personen', 'ankunft', 'inklusive', 'getraenke', 'fruehstueck', 'storno']]); ?>
  </div>
</section>

<section class="other" aria-label="Das andere Studio">
  <?php part('studio-cards', ['exclude' => $slug]); ?>
</section>

<?php part('closing', ['image' => $s['gallery'][2][0] ?? 'ws-35', 'book' => '#kalender', 'eyebrow' => 'Studio ' . $s['name'], 'title' => $C['occasions']['default']['title']]); ?>

<?php page_end(['path' => '/' . $slug]); ?>
