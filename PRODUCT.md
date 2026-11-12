# Product

<!-- impeccable:product-schema 1 -->

## Platform

web

## Users

Zwei gleich wichtige Gruppen, beide buchen eine Übernachtung zu einem Anlass:

- **Pärchen:** Geburtstag, Jahrestag, Antrag, spontane Kinderauszeit. Häufig bucht eine Person als Überraschung oder Geschenk für den „Lieblingsmenschen“.
- **Gruppen bis 8 Personen:** Mädelsabend, Geburtstag, Freundinnen-Wochenende, Junggesellinnenabschied (seit 12.11.2026 auf der Seite).

Gäste müssen mindestens 18 Jahre alt sein. Angesprochen wird mit „ihr/euch“, in Geschenk-Kontexten auch mit „du“.

## Product Purpose

WhirlStudio Hamburg vermietet zwei Ferienwohnungen mit eigenem Whirlpool (Private Spa) in Hamburg-Hohenfelde. Die Website soll Besucher zu einer Buchung führen. Gebucht wird über den eingebetteten Smoobu-Kalender, alternativ telefonisch. Erfolg heißt: Buchungen über die Seite, messbar per Meta Pixel (InitiateCheckout, Contact), aber erst nach Einwilligung.

## Positioning

Was andere Private Spas in Hamburg nicht ohne Weiteres behaupten können (vom Kunden bestätigt):

1. **Ganze Nacht statt Stundentakt.** Die Gäste bleiben über Nacht bis zum Check-out am Morgen, es gibt keinen Zeitslot.
2. **Eine ganze Wohnung für bis zu 8 Personen.** Über 100 qm mit Wohnzimmer, Schlafzimmer, Küche und Bad, nicht nur ein Spa-Raum. Kein Empfang und keine anderen Gäste.
3. **Freiheit vor Ort.** Eigene Getränke mitbringen ohne Getränkekarte oder Pauschale, selbst dekorieren.

Zwei Studios mit eigenem Charakter: PRETTY („für alle, die es klassisch mögen“) und VIBE („für alle, die es anders mögen“).

## Operating Context

- Die Besucher kommen über gemischte Kanäle, eine Hauptquelle ist nicht bekannt. Dazu gehören Meta-Anzeigen auf die Landingpage `/buchen?anlass=…` (geburtstag, jahrestag, antrag, auszeit, maedelsabend), die Google-Suche und Booking.com. Mobil und Desktop müssen beide voll funktionieren.
- Ablauf: online buchen (Smoobu) → Bestätigung und Rechnung per E-Mail innerhalb von 24 h, keine Barzahlung → einen Tag vorher die Ankunftszeit per SMS mitteilen → Check-in 17–22 Uhr mit Ausweis, Einweisung und Schlüsselübergabe vor Ort → Check-out bis 10 Uhr.
- Hausregeln: keine Party-Location, nur gebuchte Gäste, Ruhezeiten, keine Haustiere, nichts ins Whirlpool-Wasser geben. Nicht kostenfrei stornierbar.

## Capabilities and Constraints

- PHP ohne Framework und ohne Build-Schritt, Hosting auf IONOS-Webspace (Apache), Webroot ist `public/`. Die Regeln dazu stehen in `CLAUDE.md`.
- Einzige Quelle für Texte, Preise, Zeiten und Kontaktdaten ist `public/inc/content.php`. Nichts erfinden, offene Punkte stehen dort als `TODO`.
- Buchung über ein Smoobu-iframe. Die Einzel-Codes je Studio fehlen noch, bis dahin gibt es einen gemeinsamen Kalender.
- Kontakt nur per Telefon (`tel_link()`), kein WhatsApp (Kundenwunsch vom 05.11.2026).
- Meta Pixel lädt nur nach Einwilligung. Keine weiteren Tracker ohne Consent, keine externen Fonts oder CDNs.
- Seiten: Start, `/pretty`, `/vibe`, `/paare`, `/gruppen`, `/buchen` sowie Impressum, Datenschutz und AGB.
- Offen beim Kunden (nicht erfinden): Preis ab der 3. Person, Schlafplätze für 8, Zahlungsarten, Infos zu Parken und ÖPNV, E-Mail-Adresse fürs Impressum, welche Telefonnummer gilt, Bewertung für VIBE, Freigabe der Texte, genaue Deko-Marken.

## Brand Commitments

- Name „WhirlStudio“, Claim „Private Spa · Hamburg“, Studionamen in Versalien: PRETTY und VIBE.
- Ton: warm, direkt, per „ihr“, ohne Floskeln. Anlassbezogen (Birthday, Jahrestag, Antrag, Mädelsabend).

## Evidence on Hand

- Fotos beider Studios unter `public/img/`. Die PRETTY-Fotos stammen von der alten Website (max. 1587 px), die Originale sind angefragt.
- Bewertung PRETTY: Booking.com 9,6 „Exceptional“ aus 12 Bewertungen (Stand 02.11.2026). Für VIBE ist noch keine Bewertung freigegeben.
- Es gibt keine Testimonials, Presseberichte oder Gästezahlen. Nichts davon erfinden.

## Product Principles

1. **Buchen ist das Ziel.** Jede Seite führt zum Kalender oder zum Anruf, ohne Umwege.
2. **Die Unterschiede zeigen, nicht behaupten.** Ganze Nacht, ganze Wohnung und eigene Regeln sind die Argumente. Sie stehen konkret da, nicht als Werbefloskel.
3. **Beide Zielgruppen gleichwertig.** Pärchen und Gruppen finden jeweils ihren Anlass, ohne dass die eine Gruppe die andere verdrängt.
4. **Ehrlich bei Regeln und Preisen.** Was gilt (Storno, Hausregeln, Preis für 2 Personen), steht klar da. Offenes bleibt offen, statt geschönt zu werden.
5. **Datenschutz vor Tracking.** Erst die Einwilligung, dann der Pixel.
