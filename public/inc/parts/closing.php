<?php /** $image?, $book? */ ?>
<section class="closing">
  <div class="closing__bg"><?= img($image ?? 'ws-35', '', '100vw') ?></div>
  <div class="wrap closing__in">
    <p class="eyebrow"><?= e($C['closing']['eyebrow']) ?></p>
    <h2 class="h2"><?= e($C['closing']['title']) ?></h2>
    <div class="btns btns--c">
      <?= book_btn('Freie Termine ansehen', 'Abschluss', $book ?? '/buchen#kalender') ?>
      <?= tel_link('Abschluss Telefon', icon('phone') . ' Frage? Ruf uns an', 'btn btn--ghost') ?>
    </div>
  </div>
</section>
