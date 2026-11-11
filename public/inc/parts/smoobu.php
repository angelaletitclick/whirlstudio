<?php /** $url = Smoobu-Iframe-URL, $id = Container-ID */
$sm = $C['smoobu']; ?>
<div class="booking" id="kalender">
  <div class="booking__info">
    <p><span class="eyebrow">Anreise</span><?= e($C['times']['checkin']) ?></p>
    <p><span class="eyebrow">Abreise</span><?= e($C['times']['checkout']) ?></p>
    <p><span class="eyebrow">Adresse</span><?= e($C['address']['street'] . ', ' . $C['address']['zip'] . ' ' . $C['address']['city']) ?></p>
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
  <p class="booking__note"><?= e($C['house_note']) ?></p>
</div>
