<?php
/** Rahmen für Rechtsseiten: $title, $path, $body (Datei oder HTML) */
page_start(['title' => $title . ' – WhirlStudio Hamburg', 'description' => $title . ' von WhirlStudio Hamburg.', 'path' => $path, 'solid' => true]);
?>
<section class="sec legal">
  <div class="wrap wrap--narrow">
    <h1 class="h2"><?= e($title) ?></h1>
    <?= $body ?>
  </div>
</section>
<?php page_end(); ?>
