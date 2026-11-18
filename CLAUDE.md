# WhirlStudio Hamburg – Website

PHP-Website ohne Framework und ohne Build-Schritt. Hosting: IONOS-Webspace (Apache). Der Ordner `public/` ist der Webroot.

## Regeln
- Keine Texte, Zahlen, Bewertungen oder Ausstattung erfinden. Einzige Quelle ist `public/inc/content.php`. Offenes steht dort als `TODO`.
- Preise, Zeiten und Telefonnummer nie direkt in Templates schreiben.
- Jede Ausgabe läuft über `e()` (htmlspecialchars).
- Jeder Button mit Buchungsziel läuft über `book_btn($trackLabel, $href)` (setzt `data-track="InitiateCheckout"`, `data-label`, Klasse `btn--book`). Text überall gleich aus `$C['book_label']` („Termin buchen“), Farbe überall gleich (`--book`, Standard `--accent`). In keinem Design umfärben. `btn--book` ist der einzige gefüllte Button; alle anderen sind `btn--line`/`btn--ghost` (Umriss in Schriftfarbe), damit Buchen heraussticht (Nutzer 12.11.2026).
- Telefon-Links bekommen `data-track="Contact"`, am einfachsten über `tel_link()`. Kein WhatsApp (Kundenwunsch 05.11.2026).
- Der Meta Pixel lädt nur nach Einwilligung (`assets/js/main.js`). Keine weiteren Tracker ohne Consent.
- Keine externen Fonts oder CDNs. Die Schriften liegen unter `public/assets/fonts`.
- Genau zwei Schriften (Barlow Condensed für Überschriften, wie im Logo; DM Sans für Text; seit 18.11.2026) und fünf Größen (`--fs-1` … `--fs-3`, `--fs-0`, `--fs-s` in `base.css`). Keine neuen Größen einführen.
- Keine Zugangsdaten im Repo.

## Struktur
- `public/inc/bootstrap.php`: Konfiguration (`STAGING`, `DESIGN_SWITCH`), Helfer `e()`, `hl()`, `hero_lead()`, `img()`, `book_btn()`, `tel_link()`, `part()`
- `public/inc/content.php`: alle Inhalte
- `public/inc/images.php`: wird automatisch erzeugt (siehe unten)
- `public/inc/parts/*`: Bausteine; `public/inc/layout/*`: Kopf, Fuß, Rechtsseiten
- Seiten: `index.php`, `studio.php` (bedient `/pretty` und `/vibe`), `zielgruppe.php` (bedient `/paare` und `/gruppen`), `buchen.php` (Landingpage, `?anlass=`), Rechtsseiten
- Design: nur noch `bunt` (`assets/css/theme-bunt.css` für Farben, auf Basis von `base.css`). Alle Testdesigns (editorial, flamingo, lagune, showa, bordeaux, rosasee, impeccable, fotoautomat, bunt-poliert, salon, atelier, nocturne) und ihre Schriften wurden am 18.11.2026 auf Nutzerwunsch gelöscht; sie liegen in der Git-Historie. `DESIGN_SWITCH = false`.
- Bewegung „flippig“ (Nutzer 18.11.2026): federnde Einblendungen, Hero-Überschrift Wort für Wort, wackelnder Buchungs-Button; Block am Ende von `base.css`, Logik in `main.js`. Nur bei `prefers-reduced-motion: no-preference`.
- Schlüsselwörter (Whirlpool, Private Spa, privates Spa …) werden über `hl()` hervorgehoben: auf Fotos/Dunkel Sonnengelb, auf Hell gelber Marker. Für Überschriften, Hero-Zeilen und Abschnittstitel `hl()` statt `e()` verwenden (escapt selbst).
- Hero-Untertitel höchstens zwei Zeilen: `hero_lead($lang, $kurz)`; bis 820 px Breite erscheint die Kurzfassung (`lead_short` / `hero_lead_short` in `content.php`), sonst verkleinert `main.js` die Schrift.
- Titelbilder: Startseite `hero-party`, /paare `paare-hero`, /gruppen `maedelsabend`, PRETTY `pretty-titel` (je mit `-m` Hochformat fürs Handy). Alle Heros haben einen leichten schwarzen Verlauf + Vignette (`.hero .hero__bg::after` am Ende von `base.css`).

## Befehle
- Lokal starten: `php -S localhost:8000 -t public tools/router.php`
- Bilder neu erzeugen: `python -I tools/build_images.py "<Fotoordner>" public/img`, danach `python -I tools/build_manifest.py public/img public/inc/images.php`
- Ohne Python: Fotos lassen sich auch mit PHP-GD umwandeln (`php -d extension=gd`), WebP in 800/1400/2200 px plus Hochformat `-m` fürs Handy; Einträge danach von Hand in `public/inc/images.php`. Originale nie in den Chat ziehen (36-MB-Fotos haben am 18.11.2026 die Sitzung abstürzen lassen), sondern den Ordnerpfad nennen.
