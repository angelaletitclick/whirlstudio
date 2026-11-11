<?php /** Ausstattung als Kacheln. $items = [[raum, detail], ...] */ ?>
<ul class="features">
<?php foreach ($items as [$t, $d]): ?>
  <li class="feature"><?= icon('check') ?><span><strong><?= e($t) ?></strong><?php if ($d !== ''): ?> <?= e($d) ?><?php endif; ?></span></li>
<?php endforeach; ?>
</ul>
