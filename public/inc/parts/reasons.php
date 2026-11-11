<?php
/** „Warum WhirlStudio“ als eine zusammenhängende Liste (Test, ?liste=a|b|c|d|e).
 *  $items = [['title','text'], ...], $variant = a|b|c|d|e, $top = Anzahl hervorgehobener Punkte (Variante d),
 *  $image = Bildname (Variante c), $title, $text = Abschnittskopf */
$items = array_values($items);
$top = $top ?? 4;
?>
<?php if ($variant === 'a'): /* A: Raster mit Nummern, 3 Spalten */ ?>
  <?php part('head', ['title' => $title, 'text' => $text]); ?>
  <ol class="rs rs--grid">
  <?php foreach ($items as $i => $it): ?>
    <li><span class="rs__n"><?= $i + 1 ?>.</span><h3 class="h3"><?= e($it['title']) ?></h3><p><?= e($it['text']) ?></p></li>
  <?php endforeach; ?>
  </ol>

<?php elseif ($variant === 'b'): /* B: Datenblatt – Kopf links, Zeilen rechts (Titel | Text) */ ?>
  <div class="rs-split">
    <div class="rs-split__head"><?php part('head', ['title' => $title, 'text' => $text]); ?></div>
    <dl class="rs rs--rows">
    <?php foreach ($items as $it): ?>
      <div><dt class="h3"><?= e($it['title']) ?></dt><dd><?= e($it['text']) ?></dd></div>
    <?php endforeach; ?>
    </dl>
  </div>

<?php elseif ($variant === 'c'): /* C: Bild randabfallend links (mitlaufend), nummerierte Liste rechts */ ?>
  <div class="rs-img">
    <div class="rs-img__media"><?= img($image, '', '(min-width: 900px) 45vw, 100vw') ?></div>
    <div class="rs-img__list">
      <?php part('head', ['title' => $title, 'text' => $text]); ?>
      <ol class="rs rs--list">
      <?php foreach ($items as $i => $it): ?>
        <li><span class="rs__n"><?= $i + 1 ?>.</span><div><h3 class="h3"><?= e($it['title']) ?></h3><p><?= e($it['text']) ?></p></div></li>
      <?php endforeach; ?>
      </ol>
    </div>
  </div>

<?php elseif ($variant === 'e'): /* E: Erste Punkte sichtbar, Rest per „Alle anzeigen“ aufklappen */
  $show = 6; ?>
  <?php part('head', ['title' => $title, 'text' => $text]); ?>
  <ol class="rs rs--grid">
  <?php foreach (array_slice($items, 0, $show) as $i => $it): ?>
    <li><span class="rs__n"><?= $i + 1 ?>.</span><h3 class="h3"><?= e($it['title']) ?></h3><p><?= e($it['text']) ?></p></li>
  <?php endforeach; ?>
  </ol>
  <?php if (count($items) > $show): ?>
  <details class="rs-more">
    <summary class="btn btn--line"><span class="rs-more__open">Alle <?= count($items) ?> Punkte anzeigen</span><span class="rs-more__close">Weniger anzeigen</span></summary>
    <ol class="rs rs--grid" start="<?= $show + 1 ?>">
    <?php foreach (array_slice($items, $show) as $i => $it): ?>
      <li><span class="rs__n"><?= $show + $i + 1 ?>.</span><h3 class="h3"><?= e($it['title']) ?></h3><p><?= e($it['text']) ?></p></li>
    <?php endforeach; ?>
    </ol>
  </details>
  <?php endif; ?>

<?php else: /* D: Die wichtigsten Punkte groß, der Rest als kompakte Liste */ ?>
  <?php part('head', ['title' => $title, 'text' => $text]); ?>
  <ol class="rs rs--top">
  <?php foreach (array_slice($items, 0, $top) as $i => $it): ?>
    <li><span class="rs__n"><?= $i + 1 ?>.</span><h3 class="h2"><?= e($it['title']) ?></h3><p><?= e($it['text']) ?></p></li>
  <?php endforeach; ?>
  </ol>
  <p class="eyebrow rs__more">Außerdem</p>
  <ul class="rs rs--small">
  <?php foreach (array_slice($items, $top) as $it): ?>
    <li><strong><?= e($it['title']) ?></strong> <span><?= e($it['text']) ?></span></li>
  <?php endforeach; ?>
  </ul>
<?php endif; ?>
