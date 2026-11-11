<?php
/** Galerie-Varianten (Test, Umschalter „Galerie“). $items = [[bild, alt, raum], ...], $studio, $variant = a|b|c|d
 *  Alle Varianten öffnen beim Klick die vorhandene Lightbox (data-gallery / data-lb). */
global $IMG;
$items = array_values(array_filter($items, fn($it) => isset($IMG[$it[0]])));
$n = count($items);
$big = fn(string $name) => '/img/' . $IMG[$name][count($IMG[$name]) - 1][2];
$cap = fn(array $it) => $it[2] . (!empty($studio) ? ' · ' . $studio : '');
?>
<?php if ($variant === 'a'): /* A: Filmstreifen – mehrere Bilder nebeneinander, seitlich scrollen */ ?>
<div class="gal gal--strip" data-gallery data-strip>
  <div class="wrap gal__head">
    <?php part('head', ['title' => 'Einblicke', 'text' => $n . ' Bilder aus dem Studio ' . $studio]); ?>
    <div class="gal__nav">
      <button type="button" class="slider__btn" data-strip-prev aria-label="Zurück"><?= icon('prev') ?></button>
      <button type="button" class="slider__btn" data-strip-next aria-label="Weiter"><?= icon('next') ?></button>
    </div>
  </div>
  <div class="gal__track" data-strip-track tabindex="0">
  <?php foreach ($items as $i => [$name, $alt, $room]): ?>
    <figure>
      <a href="<?= e($big($name)) ?>" data-lb data-caption="<?= e($cap([$name, $alt, $room])) ?>" aria-label="Bild vergrößern: <?= e($alt) ?>"><?= img($name, $alt, '(min-width: 900px) 40vw, 80vw') ?></a>
      <figcaption><?= e($room) ?></figcaption>
    </figure>
  <?php endforeach; ?>
  </div>
</div>

<?php elseif ($variant === 'b'): /* B: Raster – alle Bilder auf einen Blick */ ?>
<div class="wrap gal gal--grid" data-gallery>
  <?php part('head', ['title' => 'Einblicke', 'text' => $n . ' Bilder aus dem Studio ' . $studio . ' – zum Vergrößern antippen']); ?>
  <div class="gal__grid">
  <?php foreach ($items as $i => [$name, $alt, $room]): ?>
    <a href="<?= e($big($name)) ?>" data-lb data-caption="<?= e($cap([$name, $alt, $room])) ?>" aria-label="Bild vergrößern: <?= e($alt) ?>">
      <?= img($name, $alt, '(min-width: 1000px) 25vw, (min-width: 640px) 33vw, 50vw') ?><span><?= e($room) ?></span>
    </a>
  <?php endforeach; ?>
  </div>
</div>

<?php elseif ($variant === 'c'): /* C: Collage – 5 Bilder asymmetrisch, Rest über „Alle Bilder“ */ ?>
<div class="wrap gal gal--bento" data-gallery>
  <div class="gal__head">
    <?php part('head', ['title' => 'Einblicke', 'text' => 'Studio ' . $studio]); ?>
    <button type="button" class="btn btn--line" data-lb-all>Alle <?= $n ?> Bilder ansehen</button>
  </div>
  <div class="gal__bento">
  <?php foreach ($items as $i => [$name, $alt, $room]): ?>
    <a href="<?= e($big($name)) ?>" data-lb data-caption="<?= e($cap([$name, $alt, $room])) ?>" aria-label="Bild vergrößern: <?= e($alt) ?>"<?= $i >= 5 ? ' hidden' : '' ?>>
      <?php if ($i < 5): ?><?= img($name, $alt, $i === 0 ? '(min-width: 900px) 50vw, 100vw' : '(min-width: 900px) 25vw, 50vw') ?><span><?= e($room) ?></span><?php endif; ?>
    </a>
  <?php endforeach; ?>
  </div>
</div>

<?php else: /* D: Bühne – ein großes Bild, darunter alle Vorschaubilder */ ?>
<div class="wrap gal gal--stage" data-gallery data-stage>
  <?php part('head', ['title' => 'Einblicke', 'text' => $n . ' Bilder aus dem Studio ' . $studio]); ?>
  <div class="gal__main">
    <a href="<?= e($big($items[0][0])) ?>" data-stage-main aria-label="Bild vergrößern"><?= img($items[0][0], $items[0][1], '(min-width: 1240px) 1160px, 100vw', ['lazy' => false]) ?></a>
    <p class="gal__cap" data-stage-cap><?= e($items[0][2]) ?></p>
  </div>
  <div class="gal__thumbs">
  <?php foreach ($items as $i => [$name, $alt, $room]): $set = $IMG[$name]; ?>
    <button type="button" class="<?= $i === 0 ? 'on' : '' ?>" data-stage-thumb="<?= $i ?>"
      data-src="/img/<?= e($set[min(1, count($set) - 1)][2]) ?>" data-big="<?= e($big($name)) ?>" data-alt="<?= e($alt) ?>" data-room="<?= e($room) ?>" aria-label="Bild <?= $i + 1 ?>: <?= e($room) ?>">
      <?= img($name, '', '160px') ?>
    </button>
  <?php endforeach; ?>
  </div>
  <?php /* Liste für die Lightbox */ foreach ($items as [$name, $alt, $room]): ?>
    <a href="<?= e($big($name)) ?>" data-lb data-caption="<?= e($cap([$name, $alt, $room])) ?>" hidden aria-label="<?= e($alt) ?>"></a>
  <?php endforeach; ?>
</div>
<?php endif; ?>
