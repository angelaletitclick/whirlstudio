<?php /** Vorteile als farbige Kacheln. $items? = [['title','text'], ...] (Standard: $C['perks']) */ ?>
<ul class="perks">
<?php foreach ($items ?? $C['perks'] as $p): ?>
  <li class="perk">
    <h3 class="h3"><?= e($p['title']) ?></h3>
    <p><?= e($p['text']) ?></p>
  </li>
<?php endforeach; ?>
</ul>
