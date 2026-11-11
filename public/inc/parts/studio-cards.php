<?php /** $exclude? = Slug, der nicht gezeigt wird (Querverweis auf Studio-Seite) */ ?>
<div class="cards<?= !empty($exclude) ? ' cards--one' : '' ?>">
<?php foreach ($C['studios'] as $s): if (!empty($exclude) && $s['slug'] === $exclude) continue; ?>
  <a class="card" href="/<?= e($s['slug']) ?>">
    <div class="card__img"><?= !empty($exclude) ? img($s['hero'], 'Studio ' . $s['name'], '100vw') : img($s['card'], 'Studio ' . $s['name'], '(min-width: 760px) 50vw, 100vw') ?></div>
    <div class="card__body<?= !empty($exclude) ? ' wrap' : '' ?>">
      <p class="eyebrow"><?= !empty($exclude) ? 'Oder lieber' : 'Studio' ?></p>
      <h3 class="card__t"><?= e($s['name']) ?></h3>
      <p class="card__tag"><?= e($s['tagline']) ?></p>
      <span class="link">Studio ansehen <?= icon('arrow') ?></span>
    </div>
  </a>
<?php endforeach; ?>
</div>
