<?php
/**
 * EINZIGE Quelle für Texte, Preise, Zeiten, Kontakt, FAQ, Studios.
 * Herkunft: whirlstudio.de (Stand 11/2026), jb-wellness-suite.de (Ausstattung), Booking.com (Bewertung),
 * Kundenfeedback 05.11.2026 (bis 8 Personen, Zielgruppen, Deko, keine Getränkepauschale, kein Zeitdruck).
 * TODO-Kommentare = vom Kunden zu bestätigen. Nichts erfinden.
 */

return [
    'brand' => 'WhirlStudio',
    'claim' => 'Private Spa · Hamburg',

    'contact' => [
        // Website/Impressum nutzen 0170, AGB § 1 nennt 0162 9675564. TODO: Kunde bestätigt.
        'phone_display' => '0170 93 18 982',
        'phone_tel'     => '+491709318982',
        'email'         => '', // TODO: Impressum braucht eine E-Mail-Adresse (§ 5 DDG)
    ],

    'address' => [
        'street' => 'Mühlendamm 47',
        'zip'    => '22087',
        'city'   => 'Hamburg',
        'district' => 'Hohenfelde',
        'note'   => 'Beide Studios im Souterrain',
        'maps'   => 'https://www.google.com/maps/search/?api=1&query=M%C3%BChlendamm+47%2C+22087+Hamburg',
    ],

    'times' => [
        'checkin'  => '17–22 Uhr',
        'checkout' => 'bis 10 Uhr',
        // Kurzform für den Zeitstempel im Design „fotoautomat“ (Check-in ab 17, Check-out bis 10)
        'stamp'    => '17:00 → 10:00',
    ],

    // Kundenfeedback 05.11.2026: "bis zu 8 Personen buchbar".
    // TODO: Preis ab der 3. Person? Schlafplätze für 8? Gilt das für beide Studios?
    'capacity' => [
        'max'   => 8,
        'label' => 'bis zu 8 Personen',
        // Bis der Aufpreis geklärt ist: ehrlich auf Anfrage verweisen. TODO: Kunde nennt Preis ab der 3. Person.
        'extra_note' => 'Preis ab der 3. Person bitte telefonisch anfragen',
    ],

    // TODO: Preise bestätigen (Meta-Beschreibung der alten Preisseite nennt "ab € 379.-")
    'prices' => [
        'from' => 289,
        'note' => 'für 2 Personen inkl. 7 % MwSt. und HH-Touristensteuer',
        'cards' => [
            ['amount' => 289, 'label' => 'für 1 Übernachtung', 'days' => 'So–Mo, Mo–Di, Di–Mi, Mi–Do oder Do–Fr', 'tag' => 'Unter der Woche'],
            ['amount' => 778, 'label' => 'für 2 Übernachtungen', 'days' => 'Fr–So', 'tag' => 'Wochenende'],
        ],
    ],

    'smoobu' => [
        'script' => 'https://login.smoobu.com/js/Settings/BookingToolIframe.js',
        'base'   => 'https://login.smoobu.com',
        'all'    => 'https://login.smoobu.com/de/booking-tool/iframe/1116243',
        // TODO: Einzel-Codes je Studio aus dem Smoobu-Konto. Bis dahin der Kalender für alle Unterkünfte.
        'pretty' => null,
        'vibe'   => null,
    ],

    'tracking' => [
        'meta_pixel_id' => '1159790469712035', // Datensatz „WhirlStudio Website“ (Business-Portfolio Whirlstudio.Hamburg), angelegt 05.11.2026. Leer = Pixel lädt nicht.
    ],

    // Trust-Element im Footer: verweist auf die Booking.com-Bewertung von PRETTY (studios.pretty.review)
    'trust' => [
        'title' => 'Auch auf Booking.com',
    ],

    // Hero-Fakten (Start- und Zielgruppenseiten): die drei Unterschiede zu Private Spas im Stundentakt.
    // Fakten aus perks/facts/studios. TODO: Kunde gibt Formulierung frei.
    'hero_facts' => ['Die ganze Nacht, Check-out bis 10 Uhr', 'Über 100 qm nur für euch', 'Eigene Getränke & Deko erlaubt'],

    'hero' => [
        'eyebrow' => 'Private Spa · Hamburg',
        'title'   => 'Studios mit Whirlpool in Hamburg',
        'script'  => 'Zeit für euch',
        // Vom Kunden/Agentur geliefert 11.11.2026
        'lead'    => 'Für romantische Auszeiten zu zweit, unvergessliche Mädelsabende und gemeinsame Momente mit Freunden – mit privatem Whirlpool und Übernachtung.',
    ],

    'intro' => [
        'eyebrow' => 'Noch kein Geschenk?',
        'title'   => 'Euer privates Spa – mitten in Hamburg',
        // Absätze vom Kunden/Agentur geliefert 11.11.2026
        'paras'   => [
            'Erlebt eine besondere Auszeit mitten in Hamburg – ob für eine Nacht oder einen längeren Aufenthalt. Mit den beiden liebevoll ausgestatteten Apartments PRETTY und VIBE erwartet euch euer ganz persönlicher Rückzugsort mit eigenem Whirlpool.',
            'Ob als Geburtstagsüberraschung, zum Jahrestag, für einen romantischen Antrag oder einen unvergesslichen Mädelsabend – hier findet ihr den perfekten Ort für besondere Momente und entspannte Stunden fernab vom Alltag.',
        ],
    ],

    // Zielgruppen: Abschnitte auf der Startseite + Unterseiten /paare und /gruppen.
    // TODO: Kunde gibt Texte frei. Fakten stammen aus Ausstattung, FAQ und Feedback.
    'audiences' => [
        'paare' => [
            'slug'    => 'paare',
            'nav'     => 'Für Pärchen',
            'eyebrow' => 'Für Pärchen',
            'title'   => 'Zeit zu zweit – mit eigenem Whirlpool',
            'lead'    => 'Überrasche deinen Lieblingsmenschen: ein romantisches Refugium für Zweisamkeit und Entspannung, mitten in Hamburg.',
            'image'   => 'pretty-6',
            'image_alt' => 'Gedeckter Esstisch mit roten Rosen im Studio PRETTY',
            'hero'    => 'ws-01',
            'hero_m'  => 'ws-01',
            'occasions' => ['Geburtstag', 'Jahrestag', 'Kinderauszeit', 'Antrag'],
            // „Warum WhirlStudio“ auf /paare: die Liste 'auszeit', diese Punkte zuerst (groß)
            'first'   => ['Entspannt übernachten', 'Euer privater Rückzugsort', 'Euer eigener Whirlpool', 'Dekoration nach euren Wünschen'],
            'landing' => 'jahrestag',
            'faq'     => ['ankunft', 'inklusive', 'fruehstueck', 'storno'],
        ],
        'gruppen' => [
            'slug'    => 'gruppen',
            'nav'     => 'Mädelsabend & Gruppen',
            'eyebrow' => 'Mädelsabend & Gruppen',
            'title'   => 'Mädelsabend im eigenen Private Spa',
            'lead'    => 'Mit bis zu 8 Personen: Whirlpool, XXL-Couch, große TVs und eine eigene Küche – und niemand sonst.',
            // Nur für den Hero von /gruppen (Startseite nutzt weiter 'lead'). Vom Kunden/Agentur geliefert 11.11.2026
            'hero_lead' => 'Whirlpool, XXL-Couch, große TVs und eine eigene Küche. Alles für einen unvergesslichen Abend mit bis zu 8 Personen',
            'image'   => 'ws-17',
            'image_alt' => 'Wohnbereich mit weißer XXL-Couch, Hängesessel und Whirlpool im Studio VIBE',
            'hero'    => 'ws-17',
            'hero_m'  => 'ws-04',
            // „Junggesellinnenabschied“ ausgeblendet, bis der Kunde ihn bestätigt (FAQ: keine Partylocation). TODO: Anlässe bestätigen
            'occasions' => ['Mädelsabend', 'Geburtstag', 'Freundinnen-Wochenende'],
            // „Warum WhirlStudio“ auf /gruppen: die Liste 'auszeit', diese Punkte zuerst (groß)
            'first'   => ['Platz für bis zu 8 Personen', 'Getränke nach eurem Geschmack', 'Dekoration nach euren Wünschen', 'Entspannt übernachten'],
            'landing' => 'maedelsabend',
            'faq'     => ['personen', 'party', 'inklusive', 'ankunft'],
        ],
    ],

    // Vom Kunden/Agentur geliefert 11.11.2026 (zwei Absätze, auf der Seite als ein Absatz unter der Überschrift)
    'studios_intro' => [
        'eyebrow' => 'PRETTY & VIBE',
        'title'   => 'Zwei Apartments, zwei besondere Erlebnisse',
        'text'    => 'Jedes Apartment hat seinen eigenen Charakter und Charme. Ihr habt die Wahl zwischen PRETTY und VIBE – beide bieten euch auf über 100 m² viel Raum zum Wohlfühlen und Entspannen. Freut euch auf euer eigenes Wellness-Erlebnis mit privatem Whirlpool und genießt eine Auszeit ganz nach euren Vorstellungen.',
    ],

    // Bilder: Dateinummern aus Downloads/Whirl Studio/Fotos → public/img/ws-XX-*.webp
    // gallery: [Bild, Alt-Text, Bildunterschrift (Raum)]
    'studios' => [
        'pretty' => [
            'slug'    => 'pretty',
            'name'    => 'PRETTY',
            'tagline' => '… für alle, die es klassisch mögen',
            'size'    => 'über 100 qm', // TODO: Portale nennen 100 m²
            'hero'    => 'pretty-3',
            'hero_m'  => 'pretty-1',
            'card'    => 'pretty-1',
            // Fotos von der alten Website (max. 1587 px). TODO: Originale von PRETTY in voller Auflösung anfragen.
            'gallery' => [
                ['pretty-1', 'Whirlpool im Studio PRETTY mit Sekt und Gläsern am Beckenrand', 'Whirlpool'],
                ['pretty-2', 'Großer Whirlpool mit blauer Beleuchtung im Studio PRETTY', 'Whirlpool'],
                ['pretty-3', 'Blick auf den beleuchteten Whirlpool im Studio PRETTY', 'Whirlpool'],
                ['pretty-4', 'Wohnbereich mit dunkler Couch und Whirlpool im Studio PRETTY', 'Wohnzimmer'],
                ['pretty-7', 'Wohnbereich mit Couch, Pflanzen und Whirlpool', 'Wohnzimmer'],
                ['pretty-5', 'Esszimmer mit weißen Stühlen, Kronleuchter und TV', 'Esszimmer'],
                ['pretty-6', 'Gedeckter Esstisch mit roten Rosen im Studio PRETTY', 'Esszimmer'],
                ['pretty-8', 'Eingangsbereich mit Orchideen und Garderobe', 'Eingang'],
            ],
            // [Raum, Detail]
            'features' => [
                ['Wohnzimmer', 'XXL-Couch und 65″ TV'],
                ['Whirlpool', 'groß, mit 75″ TV'],
                ['Schlafzimmer', 'Boxspringbett und 65″ TV'],
                ['Küche', 'mit Ofen & Herd'],
                ['Esszimmer', 'großer Esstisch'],
                ['Duschbad & WC', ''],
                ['Licht', 'individuelle LED-Beleuchtung, 40 LED-Kerzen'],
                ['WLAN', ''],
            ],
            // TODO: url führt nur auf die Bezirksseite Hohenfelde, nicht auf PRETTY. Direkten Booking.com-Link der Unterkunft vom Kunden holen.
            'review' => ['score' => '9,6', 'label' => 'Exceptional', 'count' => 12, 'source' => 'Booking.com', 'url' => 'https://www.booking.com/district/de/hamburg/hohenfelde.de.html', 'date' => '02.11.2026'],
        ],
        'vibe' => [
            'slug'    => 'vibe',
            'name'    => 'VIBE',
            'tagline' => '… für alle, die es anders mögen',
            'size'    => 'über 100 qm', // TODO: Portale nennen 110 m²
            'hero'    => 'ws-13',
            'hero_m'  => 'ws-07',
            'card'    => 'ws-15',
            'gallery' => [
                ['ws-13', 'Whirlpool mit blauer Beleuchtung im Studio VIBE', 'Whirlpool'],
                ['ws-15', 'Whirlpool mit Stufen in einem Raum mit Spiegelwand', 'Whirlpool'],
                ['ws-01', 'Sekt und Gläser auf dem Tablett am Whirlpool', 'Whirlpool'],
                ['ws-17', 'Wohnbereich mit weißer XXL-Couch, Hängesessel und Whirlpool', 'Wohnzimmer'],
                ['ws-04', 'Hängesessel und Couch vor grauer Wand', 'Wohnzimmer'],
                ['ws-20', 'Wohnzimmer mit Ecksofa und Couchtisch', 'Wohnzimmer'],
                ['ws-28', 'Schlafzimmer mit Kronleuchter und blauem Licht', 'Schlafzimmer'],
                ['ws-35', 'Boxspringbett mit weißer Bettwäsche im Studio VIBE', 'Schlafzimmer'],
                ['ws-24', 'Schwarze Küche mit LED-Beleuchtung und Bartisch', 'Küche'],
                ['ws-39', 'Kaffeemaschine mit frischem Espresso', 'Küche'],
                ['ws-21', 'Duschbad mit Glasdusche und blauem Licht', 'Bad'],
                ['ws-29', 'Flur mit Pop-Art-Bild und Blick in die Räume', 'Flur'],
            ],
            'features' => [
                ['Wohnzimmer', 'XXL-Couch und 65″ TV'],
                ['Whirlpool', 'groß, mit 65″ TV'],
                ['Schlafzimmer', 'Boxspringbett und 65″ TV'],
                ['Küche', 'mit Herd (kein Ofen)'],
                ['Duschbad & WC', ''],
                ['Licht', 'individuelle LED-Beleuchtung, 40 LED-Kerzen'],
                ['WLAN', ''],
            ],
            'review' => null, // TODO: Booking 5,3 (3) vs. Airbnb 5,0/5 (6) – Kunde entscheidet
        ],
    ],

    // Gilt für beide Studios, wird an die Ausstattung angehängt
    'features_all' => [
        ['Handtücher & Bettwäsche', 'alles da'],
        ['Kaffee & Tee', 'kostenfrei'],
    ],

    // „Alles für eure Auszeit“ (Startseite, Reihenfolge wie hier, die ersten drei groß) und „Warum WhirlStudio“ (/paare, /gruppen, sortiert nach audiences[...]['first']).
    // Vom Kunden/Agentur geliefert 11.11.2026. Die Studioseiten nutzen weiter 'perks'.
    'auszeit' => [
        'title' => 'Alles für eure Auszeit',
        'text'  => 'Ein Apartment ganz für euch allein – mit eigenem Whirlpool, viel Privatsphäre und allem, was ihr für eine entspannte Auszeit braucht.',
        'items' => [
            ['title' => 'Entspannt übernachten', 'text' => 'Kein Stundentakt und kein Zeitdruck. Genießt eure gemeinsame Auszeit über Nacht bis zum Check-out am nächsten Morgen.'],
            ['title' => 'Euer privater Rückzugsort', 'text' => 'Keine anderen Gäste, kein Hotelbetrieb – das gesamte Apartment gehört ganz euch.'],
            ['title' => 'Platz für bis zu 8 Personen', 'text' => 'Ob romantische Auszeit zu zweit, Mädelsabend oder gemeinsamer Kurztrip mit Freunden – hier ist Platz für eure Lieblingsmenschen.'],
            ['title' => 'Getränke nach eurem Geschmack', 'text' => 'Bringt eure Lieblingsgetränke einfach selbst mit. Ganz ohne Getränkepauschale oder zusätzliche Kosten.'],
            ['title' => 'Euer eigener Whirlpool', 'text' => 'Genießt wohltuendes Whirlpool-Wasser bei ca. 37 °C. Für jeden Aufenthalt frisch befüllt und hygienisch aufbereitet.'],
            ['title' => 'Stilvolle Details', 'text' => 'Liebevoll ausgewählte Dekoration und hochwertige Wohnaccessoires sorgen für ein besonderes Ambiente.'],
            ['title' => 'Dekoration nach euren Wünschen', 'text' => 'Ob romantische Rosen, festliche Ballons oder Girlanden – gestaltet den Raum ganz nach eurem Geschmack. Bitte haltet lediglich das Whirlpool-Wasser frei von Dekoration.'],
            ['title' => 'Voll ausgestattete Küche', 'text' => 'Gläser, Geschirr und Kaffeemaschine stehen bereit. Kaffee und Tee sind für euch inklusive.'],
            ['title' => 'Alles für eine angenehme Nacht', 'text' => 'Frische Handtücher und Bettwäsche liegen für euch bereit. Auch die reguläre Endreinigung ist bereits im Preis enthalten.'],
            ['title' => 'Persönlicher Check-in', 'text' => 'Die Schlüsselübergabe erfolgt zwischen 17 und 22 Uhr persönlich vor Ort – inklusive einer kurzen Einweisung.'],
            ['title' => 'Mitten in Hamburg-Hohenfelde', 'text' => 'Ihr findet uns am Mühlendamm 47. Restaurants, Cafés und weitere Möglichkeiten sind bequem zu Fuß erreichbar.'],
        ],
    ],

    // "Alles, was ihr für eure Auszeit braucht" – Kundenfeedback 05.11.2026
    'perks' => [
        ['title' => 'Platz für bis zu 8 Personen', 'text' => 'Ob romantische Auszeit zu zweit, Mädelsabend oder Kurztrip mit Freunden – hier könnt ihr eure gemeinsame Zeit genießen.'],
        // Texte Deko/Getränke vom Kunden/Agentur geliefert 11.11.2026.
        ['title' => 'Getränke ganz nach eurem Geschmack', 'text' => 'Bringt eure Lieblingsgetränke einfach selbst mit – ganz ohne Getränkepauschale oder zusätzliche Kosten.'],
        ['title' => 'Eine ganze Nacht für euch', 'text' => 'Keine stundenweise Buchung, kein Zeitdruck. Genießt euren Aufenthalt ganz entspannt bis zum Check-out am nächsten Morgen.'],
        ['title' => 'Mit Liebe zum Detail', 'text' => 'Sorgfältig ausgewählte Dekoration und hochwertige Markenaccessoires.'],
        ['title' => 'Eure Deko, euer Stil', 'text' => 'Von romantischen Rosen bis hin zu festlichen Ballons – dekoriert ganz nach euren Vorstellungen. Nur das Whirlpool-Wasser bleibt frei von Dekoration.'],
    ],

    'facts' => [
        ['title' => 'Eigener Whirlpool',  'text' => 'Ca. 37 °C, für jeden Gast desinfiziert und mit Frischwasser befüllt.'],
        ['title' => 'Nur für euch',       'text' => 'Ferienwohnung statt Hotel – kein Empfang, keine anderen Gäste. Buchbar für bis zu 8 Personen.'],
        ['title' => 'Check-in 17–22 Uhr', 'text' => 'Persönliche Schlüsselübergabe mit kurzer Einweisung vor Ort.'],
        ['title' => 'Voll ausgestattete Küche', 'text' => 'Gläser, Geschirr, Kaffeemaschine. Kaffee und Tee sind kostenfrei.'],
        ['title' => 'Handtücher & Bettwäsche', 'text' => 'Alles da. Die normale Endreinigung ist im Preis inbegriffen.'],
        ['title' => 'Hamburg-Hohenfelde', 'text' => 'Mühlendamm 47. Restaurants und Cafés sind fußläufig erreichbar.'],
    ],

    'steps' => [
        ['title' => 'Online buchen', 'text' => 'Wunschtermin und Studio im Kalender wählen und das Formular vollständig ausfüllen.'],
        ['title' => 'Bezahlen', 'text' => 'Nach der Buchung kommen Bestätigung und Rechnung per E-Mail. Barzahlung ist nicht möglich.'], // TODO: Zahlungsarten klären (PayPal/Rechnung vs. Überweisung)
        ['title' => 'Ankunftszeit mitteilen', 'text' => 'Bitte teilt uns einen Tag vor Anreise eure geplante Ankunftszeit per SMS mit.'],
        ['title' => 'Ankommen & genießen', 'text' => 'Schlüsselübergabe und Einweisung erfolgen vor Ort durch einen Mitarbeiter von WhirlStudio.'],
    ],

    'faq' => [
        'personen'    => ['q' => 'Für wie viele Personen kann ich buchen?', 'a' => 'Die Studios sind für bis zu 8 Personen buchbar. Die angegebenen Preise gelten für 2 Personen.'], // TODO: Aufpreis ab der 3. Person
        'fruehstueck' => ['q' => 'Ist Frühstück inklusive?', 'a' => 'Nein. Im Übernachtungspreis ist kein Frühstück inbegriffen, und es kann auch nicht extra gebucht werden. In fußläufiger Umgebung gibt es Restaurants und Cafés – euer Gästebetreuer berät euch gerne.'],
        'ankunft'     => ['q' => 'Wie läuft die Ankunft?', 'a' => 'Check-in ist von 17 bis 22 Uhr, Check-out bis 10 Uhr am Folgetag. An- und Abreisetag gelten als ein Tag. Bitte teilt uns einen Tag vorher eure Ankunftszeit per SMS mit. Kommt es am Anreisetag zu Verzögerungen, gebt uns bitte ebenfalls kurz Bescheid. Beim Check-in legen alle Gäste gemeinsam ihren Personalausweis vor. Danach gibt es eine kurze Einweisung und den Schlüssel.'],
        'zahlung'     => ['q' => 'Wie bezahle ich?', 'a' => 'Nach der Buchung erhaltet ihr innerhalb von 24 Stunden eine Buchungsbestätigung und die Rechnung per E-Mail. Die Rechnung ist kurzfristig zu begleichen. Barzahlungen werden nicht akzeptiert.'], // TODO: Zahlungsarten
        'storno'      => ['q' => 'Kann ich stornieren?', 'a' => 'Buchungen sind nicht kostenfrei stornierbar (AGB § 3).'],
        'inklusive'   => ['q' => 'Was ist im Preis inklusive?', 'a' => 'Die Nutzung des Whirlpools, Handtücher und Bettwäsche, Kaffee und Tee sowie die normale Endreinigung. Die Preise gelten für 2 Personen inkl. 7 % MwSt. und Hamburger Touristensteuer.'],
        'getraenke'   => ['q' => 'Dürfen wir eigene Getränke mitbringen?', 'a' => 'Ja. Es gibt keine Getränkekarte und keine Getränkepauschale. Gläser, Geschirr und eine Kaffeemaschine sind vorhanden.'],
        'deko'        => ['q' => 'Dürfen wir dekorieren?', 'a' => 'Ja, dekoriert gern nach euren Wünschen. Bitte gebt nichts ins Whirlpool-Wasser – also auch keine Rosenblätter.'],
        'reinigung'   => ['q' => 'Was gilt bei der Endreinigung?', 'a' => 'Die normale Endreinigung ist im Übernachtungspreis inbegriffen. Bitte hinterlasst insbesondere die Küche und den Whirlpool in einem ordentlichen Zustand. Bei Verschmutzungen über das normale Maß hinaus berechnen wir pro Reinigungsstunde 50 € sowie die anfallenden Kosten externer Dienstleister. Entstehende Mietausfälle stellen wir zu 100 % in Rechnung, zuzüglich der Kosten einer externen Unterbringung der Folgegäste sowie aller weiteren Kosten. Zusätzlich erheben wir eine Bearbeitungspauschale von 100 €. Mehr dazu in den AGB.'],
        'hygiene'     => ['q' => 'Wie sauber ist der Whirlpool?', 'a' => 'Für jede neue Buchung wird der Whirlpool aufwendig desinfiziert und neu mit Frischwasser befüllt. Bitte vor der Nutzung duschen und keine Zusätze wie Shampoo, Badezusätze oder Rosenblätter ins Wasser geben.'],
        'hunde'       => ['q' => 'Dürfen Hunde mit?', 'a' => 'Nein. Das Mitbringen von Hunden oder anderen Haustieren ist nicht gestattet.'],
        'party'       => ['q' => 'Dürfen wir Besuch haben oder feiern?', 'a' => 'Nein. Die Studios sind Ferienwohnungen und keine Partylocations. Nur die in der Buchung angegebenen Gäste dürfen die Studios betreten. Die Ruhezeiten sind einzuhalten. Bei Verstoß erfolgt ein sofortiges Hausverbot.'], // TODO: Formulierung passt nicht ganz zu "Mädelsabend" – Kunde prüft
        'alter'       => ['q' => 'Ab welchem Alter kann ich buchen?', 'a' => 'Wir akzeptieren Gäste ab 18 Jahren.'],
        // TODO: 'parken' => Kunde liefert Infos zu Parken und ÖPNV
    ],

    // Landingpage: Überschrift je Anzeige über ?anlass=… TODO: Kunde gibt Texte frei.
    'occasions' => [
        'default'      => ['title' => 'Eure Nacht mit eigenem Whirlpool', 'lead' => 'Übernachtung in einem Private Spa – mitten in Hamburg.'],
        'geburtstag'   => ['title' => 'Das perfekte Geschenk zum Birthday', 'lead' => 'Überrasche deinen Lieblingsmenschen mit einer Nacht mit eigenem Whirlpool.'],
        'jahrestag'    => ['title' => 'Euer Jahrestag mit eigenem Whirlpool', 'lead' => 'Zweisamkeit und Entspannung – mitten in Hamburg.'],
        'antrag'       => ['title' => 'Ein Antrag, den ihr nie vergesst', 'lead' => 'Ein romantisches Refugium mit eigenem Whirlpool – mitten in Hamburg.'],
        'auszeit'      => ['title' => 'Eine Nacht nur für euch zwei', 'lead' => 'Die spontane Kinderauszeit mit eigenem Whirlpool – mitten in Hamburg.'],
        'maedelsabend' => ['title' => 'Euer Mädelsabend mit eigenem Whirlpool', 'lead' => 'Bis zu 8 Personen, ein Private Spa nur für euch – mitten in Hamburg.'],
    ],

    // Abschluss der Startseite. Zielgruppen- und Studioseiten nutzen die passende Überschrift aus 'occasions'.
    // TODO: Kunde gibt Texte frei (Feedback Kritik 11.11.2026: „Birthday“ / „Wellness-Übernachtungs-Abenteuer“ wirken holprig).
    'closing' => [
        'eyebrow' => 'Das perfekte Geschenk zum Birthday',
        'title'   => 'Buche dein Wellness-Übernachtungs-Abenteuer',
    ],

    // Footer-Satz unter dem Logo. TODO: Kunde gibt Text frei.
    'footer_tagline' => 'Erlebe Hamburg – buche dein Wellness-Übernachtungs-Abenteuer.',

    // Kurzfassung der Hausregeln unter dem Kalender (aus FAQ party/hygiene/hunde/alter, Details in den AGB)
    'house_rules' => ['Nur die gebuchten Gäste', 'Ruhezeiten einhalten', 'Nichts ins Whirlpool-Wasser', 'Keine Haustiere', 'Ab 18 Jahren'],

    // Volle Fassung (FAQ „party“). Unter dem Kalender steht stattdessen die Kurzfassung 'house_rules'.
    'house_note' => 'Unsere Studios sind Ferienwohnungen und keine Partylocations. Bei Verstoß erfolgt ein sofortiges Hausverbot.',
];
