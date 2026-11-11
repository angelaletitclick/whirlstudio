<?php $a = $C['address']; ?>
<section class="sec sec--alt" id="anfahrt">
  <div class="wrap split">
    <?php part('head', ['eyebrow' => 'Anfahrt', 'title' => 'Mitten in Hamburg-' . $a['district']]); ?>
    <div class="loc">
      <p class="loc__addr"><?= icon('pin') ?><span>WhirlStudio Hamburg<br><?= e($a['street']) ?><br><?= e($a['zip'] . ' ' . $a['city']) ?></span></p>
      <p class="muted"><?= e($a['note']) ?>. Restaurants und Cafés sind fußläufig erreichbar.</p>
      <?php /* TODO: Parken & ÖPNV vom Kunden */ ?>
      <p><a class="btn btn--line" href="<?= e($a['maps']) ?>" target="_blank" rel="noopener">In Google Maps öffnen</a></p>
    </div>
  </div>
</section>
