<?php /** Fakten-Liste. $items? = [['title','text'], ...] (Standard: $C['facts']) */ ?>
<ul class="facts">
<?php foreach ($items ?? $C['facts'] as $f): ?>
  <li class="fact">
    <h3 class="h3"><?= e($f['title']) ?></h3>
    <p><?= e($f['text']) ?></p>
  </li>
<?php endforeach; ?>
</ul>
