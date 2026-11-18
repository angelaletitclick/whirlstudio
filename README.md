# WhirlStudio Hamburg – neue Website

Seiten: Startseite, `/pretty`, `/vibe`, `/buchen` (Landingpage für Ads), Impressum, Datenschutz, AGB.

## Lokal ansehen
```
php -S localhost:8000 -t public tools/router.php
```
Seit dem Feedback vom 05.11.2026 gibt es nur noch das Design `bunt` (seit 18.11.2026 Barlow Condensed + DM Sans). Testdesigns und Umschalter sind entfernt.

## Auf IONOS hochladen
1. Den **Inhalt** von `public/` per SFTP in das Verzeichnis des IONOS-Projekts laden (inkl. `.htaccess`).
2. Im IONOS-Projekt PHP 8.2 oder neuer einstellen.
3. Testphase: Subdomain mit SSL anlegen, dazu Passwortschutz (IONOS „Geschützte Verzeichnisse“). `STAGING = true` setzt `noindex`.

## Vor dem Livegang
- `public/inc/bootstrap.php`: `STAGING = false`.
- Ggf. `marble.webp` löschen (alte Themes und Schriften sind seit 18.11.2026 entfernt).
- Alle `TODO` in `public/inc/content.php`, `impressum.php`, `datenschutz.php`, `agb.php` erledigen.
- Meta-Pixel-ID eintragen. Im Events Manager mit „Test-Events“ prüfen: PageView, ViewContent, InitiateCheckout, Contact.
- Nach dem Domain-Umzug und erfolgreichem SSL: HSTS-Zeile in `.htaccess` aktivieren.
- Weiterleitungen der alten Jimdo-Adressen stehen schon in `.htaccess`.

## Landingpage-Varianten für Anzeigen
`/buchen?anlass=geburtstag` · `jahrestag` · `antrag` · `auszeit`. Ohne Parameter erscheint die Standard-Überschrift. Die Texte stehen in `content.php` → `occasions`.
