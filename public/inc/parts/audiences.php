<?php /** Zielgruppen-Abschnitte (Startseite): Pärchen + Mädelsabend/Gruppen */ ?>
<?php $k = 0; foreach ($C['audiences'] as $au): ?>
<section class="sec aud aud--<?= e($au['slug']) ?>" id="<?= e($au['slug']) ?>">
  <div class="wrap aud__grid<?= $k++ % 2 ? ' aud__grid--rev' : '' ?>">
    <div class="aud__media"><?= img($au['image'], $au['image_alt'], '(min-width: 900px) 50vw, 100vw') ?></div>
    <div class="aud__text">
      <p class="eyebrow"><?= e($au['eyebrow']) ?></p>
      <h2 class="h2"><?= e($au['title']) ?></h2>
      <p><?= e($au['lead']) ?></p>
      <ul class="chips" aria-label="Anlässe">
        <?php foreach ($au['occasions'] as $o): ?><li><?= e($o) ?></li><?php endforeach; ?>
      </ul>
      <div class="btns">
        <a class="btn btn--line" href="/<?= e($au['slug']) ?>">Mehr erfahren</a>
        <?= book_btn('Zielgruppe ' . $au['eyebrow'], '/buchen?anlass=' . $au['landing'] . '#kalender') ?>
      </div>
    </div>
  </div>
</section>
<?php endforeach; ?>
