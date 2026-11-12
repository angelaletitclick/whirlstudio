<?php /** $image?, $book?, $eyebrow?, $title? (Standard: $C['closing'], Startseite) */ ?>
<section class="closing">
  <div class="closing__bg"><?= img($image ?? 'ws-35', '', '100vw') ?></div>
  <div class="wrap closing__in">
    <p class="eyebrow"><?= e($eyebrow ?? $C['closing']['eyebrow']) ?></p>
    <h2 class="h2"><?= e($title ?? $C['closing']['title']) ?></h2>
    <div class="btns btns--c">
      <?= book_btn('Abschluss', $book ?? '/buchen#kalender') ?>
      <?= tel_link('Abschluss Telefon', icon('phone') . ' Frage? Ruf uns an', 'btn btn--ghost') ?>
    </div>
  </div>
</section>
