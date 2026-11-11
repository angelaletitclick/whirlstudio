<ol class="steps">
<?php foreach ($C['steps'] as $i => $s): ?>
  <li class="step">
    <span class="step__n"><?= $i + 1 ?></span>
    <h3 class="h3"><?= e($s['title']) ?></h3>
    <p><?= e($s['text']) ?></p>
  </li>
<?php endforeach; ?>
</ol>
