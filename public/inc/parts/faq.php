<?php /** $keys? = Auswahl an FAQ-Schlüsseln */
$items = !empty($keys) ? array_filter(array_map(fn($k) => $C['faq'][$k] ?? null, $keys)) : $C['faq'];
?>
<div class="faq">
<?php foreach ($items as $f): ?>
  <details class="faq__item">
    <summary><span><?= e($f['q']) ?></span><?= icon('plus') ?></summary>
    <div class="faq__a"><p><?= e($f['a']) ?></p></div>
  </details>
<?php endforeach; ?>
</div>
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org', '@type' => 'FAQPage',
    'mainEntity' => array_values(array_map(fn($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], $items)),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
