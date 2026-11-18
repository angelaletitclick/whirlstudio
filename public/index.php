<?php
require __DIR__ . '/inc/bootstrap.php';
$h = $C['hero'];
$i = $C['intro'];

page_start([
    'title' => 'WhirlStudio Hamburg – Übernachtung mit eigenem Whirlpool',
    'description' => 'Zwei Studios mit eigenem Whirlpool mitten in Hamburg: PRETTY & VIBE. Für Pärchen, Mädelsabende und Gruppen, ' . $C['capacity']['label'] . '. Ab ' . $C['prices']['from'] . ' € pro Nacht. Check-in ' . $C['times']['checkin'] . '.',
    'path' => '/',
]);
?>

<section class="hero hero--home">
  <?php /* Ein festes Titelbild (Nutzer 18.11.2026) statt Wechsel VIBE/PRETTY mit „Im Bild“-Hinweis */ ?>
  <div class="hero__bg">
    <?= img($h['image'], $h['image_alt'], '100vw', ['eager' => true, 'lazy' => false, 'mobile' => $h['image_m']]) ?>
  </div>
  <div class="wrap hero__in">
    <p class="eyebrow"><?= hl($h['eyebrow']) ?></p>
    <h1 class="h1"><?= hl($h['title']) ?></h1>
    <?= hero_lead($h['lead'], $h['lead_short'] ?? null) ?>
    <div class="btns">
      <?= book_btn('Hero') ?>
      <a class="btn btn--ghost" href="#studios">Studios ansehen</a>
    </div>
    <ul class="hero__facts">
      <li>ab <?= e(eur($C['prices']['from'])) ?> pro Nacht für 2</li>
      <?php foreach ($C['hero_facts'] as $f): ?><li><?= e($f) ?></li><?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="sec intro">
  <div class="wrap intro__grid">
    <div class="intro__text">
      <p class="eyebrow"><?= e($i['eyebrow']) ?></p>
      <h2 class="h2"><?= hl($i['title']) ?></h2>
      <?php foreach ($i['paras'] as $p): ?><p><?= e($p) ?></p><?php endforeach; ?>
    </div>
    <div class="intro__media">
      <div class="intro__img1"><?= img('romantik-hochkant', 'Erdbeeren, Sektgläser und Kerzen vor dem Whirlpool', '(min-width: 900px) 30vw, 70vw') ?></div>
      <div class="intro__img2"><?= img('rosenbett', 'Bett mit einem Herz aus Rosenblättern', '(min-width: 900px) 25vw, 60vw') ?></div>
    </div>
  </div>
</section>

<?php part('audiences'); ?>

<section class="sec sec--dark" id="studios">
  <div class="wrap">
    <?php part('head', ['eyebrow' => $C['studios_intro']['eyebrow'], 'title' => $C['studios_intro']['title'], 'text' => $C['studios_intro']['text'], 'center' => true]); ?>
    <?php part('studio-cards'); ?>
    <div class="center"><?php part('review', ['r' => $C['studios']['pretty']['review'], 'studio' => 'PRETTY']); ?></div>
  </div>
</section>

<?php $GLOBALS['switch_groups'][] = 'liste';
  // Feste Liste aus content.php ('auszeit'), die ersten drei groß
  $A = $C['auszeit'];
  // Standard ('o'): 3 große Punkte + „Außerdem“ (Variante D). Andere Varianten weiter über ?liste= testbar.
  $lv = $liste === 'o' ? 'd' : $liste;
?>
<section class="sec sec--alt<?= $lv === 'c' ? ' sec--flush' : '' ?>" id="infos">
  <span id="warum"></span>
  <div class="wrap">
    <?php part('reasons', [
        'variant' => $lv, 'items' => $A['items'], 'top' => 3, 'image' => 'ws-17',
        'title' => $A['title'], 'text' => $A['text'],
    ]); ?>
  </div>
</section>

<div class="strip" data-stamp="<?= e($C['times']['stamp'] . ' · WhirlStudio Hamburg') ?>">
  <?php foreach ([['ws-17', 'Wohnzimmer', 'VIBE'], ['pretty-5', 'Esszimmer', 'PRETTY'], ['ws-28', 'Schlafzimmer', 'VIBE'], ['ws-24', 'Küche', 'VIBE']] as [$im, $room, $st]): ?>
    <figure><?= img($im, $room . ' im Studio ' . $st, '(min-width: 640px) 25vw, 50vw') ?><figcaption class="slide__cap"><?= e($room) ?> <span>· <?= e($st) ?></span></figcaption></figure>
  <?php endforeach; ?>
</div>

<section class="sec sec--sun" id="preise">
  <div class="wrap">
    <?php part('head', ['title' => 'Preise', 'text' => 'Eure Auszeit im Private Spa', 'center' => true]); ?>
    <?php part('prices'); ?>
  </div>
</section>

<section class="sec">
  <div class="wrap">
    <?php part('head', ['title' => 'So einfach geht’s', 'text' => 'Von der Buchung bis zum Whirlpool']); ?>
    <?php part('steps'); ?>
  </div>
</section>

<section class="sec sec--alt" id="faq">
  <div class="wrap split">
    <div>
      <?php part('head', ['title' => 'FAQ', 'text' => 'Gut zu wissen']); ?>
      <p class="muted">Noch eine Frage offen? Ruf uns einfach an: <?= tel_link('FAQ Telefon', null, 'link-u') ?></p>
    </div>
    <?php part('faq', ['keys' => ['personen', 'inklusive', 'getraenke', 'deko', 'ankunft', 'zahlung', 'storno', 'fruehstueck', 'hygiene', 'party', 'hunde', 'alter']]); ?>
  </div>
</section>

<?php part('location'); ?>
<?php part('closing'); ?>

<?php page_end(); ?>
