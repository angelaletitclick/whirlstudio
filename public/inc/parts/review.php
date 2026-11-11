<?php /** $r = Bewertungs-Array, $studio? = Name */ if (empty($r)) return; ?>
<a class="review" href="<?= e($r['url']) ?>" target="_blank" rel="noopener">
  <span class="review__score"><?= e($r['score']) ?></span>
  <span class="review__txt">
    <span class="review__stars"><?= str_repeat(icon('star'), 5) ?></span>
    <span><strong><?= e($r['label']) ?></strong> auf <?= e($r['source']) ?> · <?= (int) $r['count'] ?> Bewertungen<?= !empty($studio) ? ' · Studio ' . e($studio) : '' ?> · Stand <?= e($r['date']) ?></span>
  </span>
</a>
