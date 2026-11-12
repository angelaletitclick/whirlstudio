<?php /** $book? = Ziel der Buttons */ $P = $C['prices']; ?>
<div class="prices">
<?php foreach ($P['cards'] as $i => $p): ?>
  <div class="price">
    <p class="eyebrow"><?= e($p['tag']) ?></p>
    <p class="price__amount"><?= e(eur($p['amount'])) ?></p>
    <p class="price__label"><?= e($p['label']) ?></p>
    <p class="price__days"><?= e($p['days']) ?></p>
    <?= book_btn('Preiskarte ' . ($i + 1), $book ?? '/buchen#kalender') ?>
  </div>
<?php endforeach; ?>
</div>
<p class="prices__note">Preise <?= e($P['note']) ?>. Buchbar für <?= e($C['capacity']['label']) ?> – <?= e($C['capacity']['extra_note']) ?>: <?= tel_link('Preise Telefon', null, 'link-u') ?>. Kein Frühstück.</p>
