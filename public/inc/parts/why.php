<?php
/** „Warum WhirlStudio“ als EIN Abschnitt (Nutzer 18.11.2026, ersetzt Kacheln + Fakten-Liste auf /paare und /gruppen).
 *  Links: Überschrift, Anlässe als Kapseln, mitlaufendes Foto. Rechts: alle Punkte einheitlich mit farbiger Nummer.
 *  $items = [['title','text'], ...] (Reihenfolge = Wichtigkeit), $title, $occasions = [..], $image, $image_alt */
?>
<div class="why">
  <div class="why__side">
    <div class="why__head">
      <h2 class="h2"><?= hl($title) ?></h2>
      <?php if (!empty($occasions)): ?>
      <ul class="chips"><?php foreach ($occasions as $o): ?><li><?= e($o) ?></li><?php endforeach; ?></ul>
      <?php endif; ?>
    </div>
    <?php if (!empty($image)): ?>
    <div class="why__media"><?= img($image, $image_alt ?? '', '(min-width: 900px) 40vw, 100vw') ?></div>
    <?php endif; ?>
  </div>
  <ol class="why__list">
  <?php foreach (array_values($items) as $i => $it): ?>
    <li class="why__item">
      <span class="why__n" aria-hidden="true"><?= $i + 1 ?></span>
      <div>
        <h3 class="h3"><?= e($it['title']) ?></h3>
        <p><?= e($it['text']) ?></p>
      </div>
    </li>
  <?php endforeach; ?>
  </ol>
</div>
