<?php /** Abschnittskopf: $title (groß), $text? (klein darunter), $eyebrow? (Überzeile), $center? */ ?>
<header class="shead<?= !empty($center) ? ' shead--c' : '' ?>">
  <?php if (!empty($eyebrow)): ?><p class="eyebrow"><?= e($eyebrow) ?></p><?php endif; ?>
  <h2 class="h2"><?= e($title) ?></h2>
  <?php if (!empty($text)): ?><p class="lead"><?= e($text) ?></p><?php endif; ?>
</header>
