<?php
/** Landingpage für Social-Media-Ads, mit Hauptmenü. Überschrift je Anzeige: /buchen?anlass=geburtstag */
require __DIR__ . '/inc/bootstrap.php';

$key = $_GET['anlass'] ?? 'default';
$occ = (is_string($key) && isset($C['occasions'][$key])) ? $C['occasions'][$key] : $C['occasions']['default'];
$P = $C['prices'];

page_start([
    'title' => $occ['title'] . ' – WhirlStudio Hamburg',
    'description' => 'Übernachtung mit eigenem Whirlpool mitten in Hamburg. ' . eur($P['cards'][0]['amount']) . ' pro Nacht für 2, inkl. MwSt. und Touristensteuer. Freie Termine direkt online ansehen.',
    'path' => '/buchen',
    'landing' => true,
    'solid' => true,
    'view' => 'Buchungsseite',
]);
?>

<section class="sec sec--alt book-top">
  <div class="wrap">
    <header class="shead shead--c">
      <p class="eyebrow">Freie Termine · <?= e($C['claim']) ?></p>
      <h1 class="h2"><?= e($occ['title']) ?></h1>
      <p class="lead"><?= e($occ['lead']) ?></p>
    </header>
    <?php part('smoobu', ['url' => $C['smoobu']['all'], 'id' => 'apartmentIframeAll']); ?>
  </div>
</section>

<section class="sec sec--tight">
  <div class="wrap">
    <ul class="usp">
      <li><strong>Eigener Whirlpool</strong><span>Für jeden Gast desinfiziert und frisch befüllt</span></li>
      <li><strong>Nur für euch</strong><span>Ferienwohnung statt Hotel, <?= e($C['capacity']['label']) ?></span></li>
      <li><strong>Mitten in Hamburg</strong><span><?= e($C['address']['street']) ?>, Hohenfelde</span></li>
    </ul>
  </div>
</section>

<section class="sec sec--sun">
  <div class="wrap">
    <?php part('head', ['title' => 'Preise', 'center' => true]); ?>
    <?php part('prices', ['book' => '#kalender']); ?>
  </div>
</section>

<section class="sec sec--tight">
  <div class="wrap">
    <div class="pick">
      <?php foreach ($C['studios'] as $s): ?>
        <figure class="pick__i">
          <?= img($s['card'], 'Studio ' . $s['name'], '(min-width: 900px) 50vw, 100vw') ?>
          <figcaption><strong><?= e($s['name']) ?></strong> <?= e($s['tagline']) ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
    <div class="center"><?php part('review', ['r' => $C['studios']['pretty']['review'], 'studio' => 'PRETTY']); ?></div>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <?php part('head', ['title' => 'So geht es weiter', 'text' => 'Nach der Buchung']); ?>
    <?php part('steps'); ?>
  </div>
</section>

<section class="sec sec--lilac">
  <div class="wrap split">
    <?php part('head', ['title' => 'FAQ', 'text' => 'Kurz beantwortet']); ?>
    <?php part('faq', ['keys' => ['personen', 'zahlung', 'ankunft', 'fruehstueck', 'storno']]); ?>
  </div>
</section>

<?php page_end(['landing' => true]); ?>
