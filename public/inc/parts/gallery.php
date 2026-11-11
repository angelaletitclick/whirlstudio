<?php /** Vollbild-Slider. $items = [[bild, alt, raum], ...], $studio? = Name für die Beschriftung */ global $IMG;
$items = array_values(array_filter($items, fn($it) => isset($IMG[$it[0]])));
$n = count($items);
?>
<div class="slider" data-slider data-gallery aria-roledescription="Karussell" aria-label="Bilder<?= !empty($studio) ? ' Studio ' . e($studio) : '' ?>">
  <div class="slider__track" data-slider-track tabindex="0">
  <?php foreach ($items as $i => [$name, $alt, $room]): $set = $IMG[$name]; $big = $set[count($set) - 1]; ?>
    <figure class="slide" aria-roledescription="Bild" aria-label="<?= $i + 1 ?> von <?= $n ?>: <?= e($room) ?>">
      <a href="/img/<?= e($big[2]) ?>" data-lb data-caption="<?= e($room) ?>" aria-label="Bild vergrößern: <?= e($alt) ?>">
        <?= img($name, $alt, '100vw', ['lazy' => $i > 0]) ?>
      </a>
      <figcaption class="slide__cap"><?= e($room) ?><?php if (!empty($studio)): ?> <span>· <?= e($studio) ?></span><?php endif; ?></figcaption>
    </figure>
  <?php endforeach; ?>
  </div>
  <div class="slider__ui">
    <button type="button" class="slider__btn" data-slider-prev aria-label="Vorheriges Bild"><?= icon('prev') ?></button>
    <span class="slider__count" aria-live="polite"><span data-slider-cur>1</span> / <?= $n ?></span>
    <button type="button" class="slider__btn" data-slider-next aria-label="Nächstes Bild"><?= icon('next') ?></button>
  </div>
</div>
