<?php /** $url = Smoobu-Iframe-URL, $id = Container-ID */
$sm = $C['smoobu']; ?>
<div class="booking" id="kalender">
  <?php /* Übersicht direkt am Kalender: Preis, Zeiten, Storno, Kontakt (alles aus content.php) */ ?>
  <div class="booking__info">
    <p><span class="eyebrow">Preis</span><strong>ab <?= e(eur($C['prices']['from'])) ?> pro Nacht für 2</strong>inkl. MwSt. &amp; Touristensteuer</p>
    <p><span class="eyebrow">Ankunft &amp; Abreise</span><strong>Check-in <?= e($C['times']['checkin']) ?></strong>Check-out <?= e($C['times']['checkout']) ?></p>
    <p><span class="eyebrow">Nach der Buchung</span><strong>Bestätigung in 24 Std.</strong>Nicht kostenfrei stornierbar</p>
    <p><span class="eyebrow">Fragen?</span><strong><?= tel_link('Kalender Telefon') ?></strong><?= e($C['capacity']['extra_note']) ?></p>
  </div>
  <div class="booking__frame" data-smoobu
       data-script="<?= e($sm['script']) ?>" data-base="<?= e($sm['base']) ?>"
       data-url="<?= e($url) ?>" data-target="<?= e($id) ?>">
    <div id="<?= e($id) ?>" class="booking__iframe"></div>
    <div class="booking__loading" data-smoobu-loading>Kalender wird geladen …</div>
    <div class="booking__fallback" hidden data-smoobu-fallback>
      <p>Der Buchungskalender konnte nicht geladen werden – vielleicht blockiert ein Werbeblocker ihn.</p>
      <a class="btn btn--primary" href="<?= e($url) ?>" target="_blank" rel="noopener" data-track="InitiateCheckout" data-label="Smoobu Fallback">Buchungskalender öffnen</a>
    </div>
  </div>
  <div class="rules">
    <p class="eyebrow">Hausregeln</p>
    <ul><?php foreach ($C['house_rules'] as $r): ?><li><?= e($r) ?></li><?php endforeach; ?></ul>
  </div>
</div>
