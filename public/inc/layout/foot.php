<?php
$landing = !empty($meta['landing']);
$a = $C['address'];
?>
</main>

<footer class="site-footer" id="kontakt">
  <div class="wrap">
    <?php $tr = $C['studios']['pretty']['review']; ?>
    <?php if (!$landing): ?>
    <div class="site-footer__grid">
      <div>
        <p class="logo logo--footer" role="img" aria-label="WhirlStudio Hamburg"><span class="logo__mark"></span></p>
        <p class="muted"><?= e($C['footer_tagline']) ?></p>
      </div>
      <div>
        <p class="eyebrow">Adresse</p>
        <p><?= e($a['street']) ?><br><?= e($a['zip'] . ' ' . $a['city'] . '-' . $a['district']) ?></p>
        <p><a class="link" href="<?= e($a['maps']) ?>" target="_blank" rel="noopener">In Google Maps öffnen</a></p>
      </div>
      <div>
        <p class="eyebrow">Kontakt</p>
        <p><?= tel_link('Footer Telefon') ?></p>
      </div>
      <div>
        <p class="eyebrow">Entdecken</p>
        <p>
          <?php foreach ($C['audiences'] as $au): ?><a href="/<?= e($au['slug']) ?>"><?= e($au['nav']) ?></a><br><?php endforeach; ?>
          <?php foreach ($C['studios'] as $st): ?><a href="/<?= e($st['slug']) ?>">Studio <?= e($st['name']) ?></a><br><?php endforeach; ?>
          <a href="/buchen" data-track="InitiateCheckout" data-label="Footer"><?= e($C['book_label']) ?></a>
        </p>
      </div>
    </div>
    <?php endif; ?>
    <?php /* Bewertung gilt nur für PRETTY – nicht auf der VIBE-Seite zeigen */ ?>
    <?php if ($tr && ($meta['path'] ?? '') !== '/vibe'): ?>
    <a class="trust" href="<?= e($tr['url']) ?>" target="_blank" rel="noopener">
      <span class="trust__logo" aria-hidden="true">Booking<span>.com</span></span>
      <span class="trust__score"><?= e($tr['score']) ?></span>
      <span class="trust__txt"><strong><?= e($C['trust']['title']) ?>: <?= e($tr['label']) ?></strong>
        <span><?= (int) $tr['count'] ?> Bewertungen · Studio PRETTY · Stand <?= e($tr['date']) ?></span></span>
    </a>
    <?php endif; ?>
    <div class="site-footer__legal">
      <span>© <?= date('Y') ?> WhirlStudio Hamburg</span>
      <nav aria-label="Rechtliches">
        <a href="/impressum">Impressum</a>
        <a href="/datenschutz">Datenschutz</a>
        <a href="/agb">AGB</a>
        <button type="button" class="linklike" data-consent-open>Cookie-Einstellungen</button>
      </nav>
    </div>
  </div>
</footer>

<div class="mbar" data-mbar>
  <a class="mbar__book" href="<?= $landing ? '#kalender' : '/buchen#kalender' ?>" data-track="InitiateCheckout" data-label="Mobile Leiste">
    <span>ab <?= e(eur($C['prices']['from'])) ?></span><strong><?= e($C['book_label']) ?></strong>
  </a>
  <?= tel_link('Mobile Telefon', icon('phone') . '<span class="sr">Anrufen</span>', 'mbar__tel') ?>
</div>

<div class="consent" role="dialog" aria-modal="false" aria-labelledby="consent-t" hidden data-consent>
  <p class="consent__t" id="consent-t">Darf’s ein Cookie sein?</p>
  <p>Wir nutzen den Meta Pixel, um zu messen, ob unsere Anzeigen auf Instagram und Facebook funktionieren. Er lädt nur mit deiner Einwilligung. Mehr in der <a href="/datenschutz">Datenschutzerklärung</a>.</p>
  <div class="consent__btns">
    <button type="button" class="btn btn--ghost" data-consent-set="0">Nur notwendige</button>
    <button type="button" class="btn btn--ghost" data-consent-set="1">Alle akzeptieren</button>
  </div>
</div>

<div class="lightbox" hidden data-lightbox>
  <button type="button" class="lightbox__x" aria-label="Schließen" data-lb-close><?= icon('close') ?></button>
  <button type="button" class="lightbox__nav lightbox__prev" aria-label="Vorheriges Bild" data-lb-prev>‹</button>
  <img alt="" data-lb-img>
  <p class="lightbox__cap" data-lb-cap></p>
  <button type="button" class="lightbox__nav lightbox__next" aria-label="Nächstes Bild" data-lb-next>›</button>
</div>

<?php if (DESIGN_SWITCH): ?>
<div class="dswitch" aria-label="Design-Varianten (nur Testphase)">
  <span>Design</span>
  <?php foreach (DESIGNS as $k => $label): ?>
    <a href="?design=<?= e($k) ?>" class="<?= $k === $design ? 'on' : '' ?>" title="<?= e($label) ?>"><?= e(ucfirst($k)) ?></a>
  <?php endforeach; ?>
  <?php foreach (array_unique($GLOBALS['switch_groups']) as $g): $cfg = TEST_VARIANTS[$g]; ?>
    <span><?= e($cfg['label']) ?></span>
    <?php foreach ($cfg['opts'] as $k => $label): ?>
      <a href="?<?= e($g) ?>=<?= e($k) ?>#<?= e($cfg['anchor']) ?>" class="<?= $k === $GLOBALS['variant'][$g] ? 'on' : '' ?>" title="<?= e($label) ?>"><?= e($label) ?></a>
    <?php endforeach; ?>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<script src="<?= e(asset('assets/js/main.js')) ?>" defer></script>
</body>
</html>
