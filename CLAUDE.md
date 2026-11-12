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
- Genau zwei Schriften (DM Serif Display, DM Sans) und fünf Größen (`--fs-1` … `--fs-3`, `--fs-0`, `--fs-s` in `base.css`). Keine neuen Größen einführen.
- Keine Zugangsdaten im Repo.

## Struktur
- `public/inc/bootstrap.php`: Konfiguration (`STAGING`, `DESIGN_SWITCH`), Helfer `e()`, `img()`, `book_btn()`, `tel_link()`, `part()`
- `public/inc/content.php`: alle Inhalte
- `public/inc/images.php`: wird automatisch erzeugt (siehe unten)
- `public/inc/parts/*`: Bausteine; `public/inc/layout/*`: Kopf, Fuß, Rechtsseiten
- Seiten: `index.php`, `studio.php` (bedient `/pretty` und `/vibe`), `zielgruppe.php` (bedient `/paare` und `/gruppen`), `buchen.php` (Landingpage, `?anlass=`), Rechtsseiten
- Design: `assets/css/theme-bunt.css` (Farben) auf Basis von `base.css`. Standard und Live-Design.
- Testdesigns (10.11.2026, nach den internen „nicht nach KI aussehen“-Richtlinien): `editorial`, `flamingo`, `lagune`, `showa`, `bordeaux`, `rosasee`, nur über `?design=<name>`, solange `DESIGN_SWITCH = true`. Gemeinsames Layout in `assets/css/layout-ed.css` (Body-Klasse `ed`), Farben und Headline-Schrift je in `theme-<name>.css` über Variablen (`--block-*`, `--scrim`, `--num`, `--head-w`, `--head-ls`). Ausnahme von der Schriftregel nur dort, alle lokal unter `assets/fonts`: Brygada 1918, Albert Sans, Azeret Mono (Standard in `layout-ed.css`, genutzt von editorial), Bricolage Grotesque + Figtree (flamingo), Schibsted Grotesk (lagune), Young Serif + Karla (showa), Newsreader + Hanken Grotesk (bordeaux), Bodoni Moda + Outfit (rosasee). Vor Livegang `DESIGN_SWITCH` wieder auf `false`. Am 12.11.2026 mit impeccable poliert (nur `layout-ed.css`, Identität je Design unverändert): keine Überzeilen über Überschriften, Mono nur für Zahlen. Gleichzeitig zu häufige Schriften ersetzt (Instrument → Brygada 1918/Albert Sans, Fraunces → Young Serif) und editorial auf die Farben von insidertour-hamburg.com umgestellt (Pflaume, Petrol, Lavendel, Hellrosa; Details in `theme-editorial.css`). fotoautomat und rosasee nutzen je eine Kombination aus Sanzo Wada, „A Dictionary of Color Combinations“ (Nr. 265, 194); showa nutzt seit 12.11.2026 eine eigene Palette des Nutzers (Weinrot, Pinkrot, Magenta, Orchidee, Violett; vorher Wada Nr. 262), lagune nutzt Nr. 178 mit Werten von wada.ask2a.com, weißen Hintergründen und Orange #fa9442 als Buchungs-Button (Schrift darauf dunkles Green Blue, weil Weiß nur 2,2:1 hätte; davor kurz Nr. 139); Nr. 263 für lagune und Nr. 275 für bordeaux getestet und verworfen. rosasee ist die eigene Palette des Nutzers, keine Kundenvorgabe, Farben am Buchdruck gemessen, Schriftfarben auf mindestens 4,6:1 abgedunkelt (Nummer und Werte im Kopf der jeweiligen Theme-Datei).
- Testdesign `impeccable` (11.11.2026, mit dem impeccable-Skill gebaut): heller Private-Spa-Standard auf Boutique-Hotel-Niveau, nur `?design=impeccable`. Eine Datei `assets/css/theme-impeccable.css` auf `base.css` (ohne `layout-ed.css`), Body-Klasse `d-impeccable`. Schriften Bodoni Moda + Hanken Grotesk. Die Regeln oben zu Schriften und Größen gelten für dieses Design nicht (Nutzer 11.11.2026). System dokumentiert in `DESIGN.md`, Richtung in `.impeccable/surfaces/`, Produkt in `PRODUCT.md`.
- Testdesign `fotoautomat` (11.11.2026, Alternative aus derselben impeccable-Richtungsrunde): `assets/css/theme-fotoautomat.css` auf `base.css`, Body-Klasse `d-fotoautomat`. Bricolage Grotesque + Figtree, Vorhang in Old Rose, Fotos als Abzüge. Richtungsvertrag in `.impeccable/surfaces/public-assets-css-theme-fotoautomat-css.md`. (Testdesign `glaswand` am 11.11.2026 auf Nutzerwunsch entfernt.)
- Testdesign `bunt-poliert` (11.11.2026): das Live-Design bunt mit gleichen Farben, Schriften und Inhalten, aber ohne Vorlagen-Merkmale (keine Überzeilen, Blob, Farbpunkte, Verläufe; Petrol = Pärchen, Flieder = Gruppen). Eine Datei `assets/css/theme-bunt-poliert.css` auf `base.css`. Kandidat, um bunt abzulösen. Schriftregeln gelten hier ebenfalls nicht. Die alten Varianten `theme-{salon,atelier,nocturne}.css` sind abgeschaltet und nicht mehr gepflegt.

## Befehle
- Lokal starten: `php -S localhost:8000 -t public tools/router.php`
- Bilder neu erzeugen: `python -I tools/build_images.py "<Fotoordner>" public/img`, danach `python -I tools/build_manifest.py public/img public/inc/images.php`
- Marmor-Textur (Atelier) neu erzeugen: `python -I tools/build_marble.py public/img/marble.webp`
