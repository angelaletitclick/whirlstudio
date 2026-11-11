<?php
declare(strict_types=1);

/* ---------- Konfiguration ---------- */
const SITE_URL = 'https://www.whirlstudio.de';
// Testphase: noindex. Vor Livegang auf false.
const STAGING = true;
// Seit Feedback 05.11.2026 ist „bunt“ das Design (DM Serif Display + DM Sans).
// Die alten Varianten salon/atelier/nocturne sind nicht mehr angepasst und deshalb abgeschaltet.
// Test 10.11.2026: weitere Designs nach den internen Design-Richtlinien, nur per ?design=<name>.
// Sie teilen sich das Layout assets/css/layout-ed.css und unterscheiden sich in Farben/Headline-Schrift.
// Vor Livegang: DESIGN_SWITCH auf false (dann gilt immer DEFAULT_DESIGN).
const DESIGN_SWITCH = true;
const DESIGNS = [
    'bunt'      => 'Bunt – fröhlich & hell',
    'editorial' => 'Editorial – neutral: Papier, Tinte, Beere',
    'flamingo'  => 'Flamingo – poppig: Rubin, Blush, Sonnengelb, Indigo',
    'lagune'    => 'Lagune – frisch: Mint, Petrol, Koralle',
    'showa'     => 'Showa – retro: Kraftpapier, Moosgrün, Ziegelrot',
    'bordeaux'  => 'Bordeaux – elegant: Weinrot, Altrosa, Gold',
    'rosasee'   => 'Rosasee – Flächen Blau/Creme/Weiß, Akzent Rot/Pink',
    'impeccable' => 'Impeccable – heller Private-Spa-Standard, Boutique-Hotel-Niveau (11.11.2026)',
    'fotoautomat' => 'Fotoautomat – Vorhang-Koralle, Fotos als Abzüge, Fotostreifen (11.11.2026)',
    'bunt-poliert' => 'Bunt poliert – bunt ohne Vorlagen-Merkmale (11.11.2026)',
];
// Designs auf Basis von layout-ed.css
const DESIGNS_ED = ['editorial', 'flamingo', 'lagune', 'showa', 'bordeaux', 'rosasee'];
const DEFAULT_DESIGN = 'bunt';

$C   = require __DIR__ . '/content.php';
$IMG = require __DIR__ . '/images.php';

/* ---------- Design-Variante (nur Test) ---------- */
$design = DEFAULT_DESIGN;
if (DESIGN_SWITCH) {
    $req = $_GET['design'] ?? $_COOKIE['ws_design'] ?? '';
    if (is_string($req) && isset(DESIGNS[$req])) {
        $design = $req;
        if (($_GET['design'] ?? null) === $req) {
            setcookie('ws_design', $req, ['expires' => time() + 86400 * 30, 'path' => '/', 'samesite' => 'Lax']);
        }
    }
}

/* ---------- Test: Darstellungsvarianten (nur solange DESIGN_SWITCH an ist) ----------
   liste:   „Warum WhirlStudio“ (/paare, /gruppen) und „Alles für eure Auszeit“ (Startseite)
   galerie: Bilder auf den Studio-Seiten (/pretty, /vibe)
   Die Seite meldet über $GLOBALS['switch_groups'][] = 'liste', welche Gruppen der Umschalter zeigt. */
const TEST_VARIANTS = [
    'liste'   => ['label' => 'Liste',   'anchor' => 'warum',   'opts' => ['o' => 'Original', 'a' => 'A Raster', 'b' => 'B Datenblatt', 'c' => 'C Bild', 'd' => 'D Groß/klein', 'e' => 'E Aufklappen']],
    'galerie' => ['label' => 'Galerie', 'anchor' => 'bilder',  'opts' => ['o' => 'Original', 'a' => 'A Filmstreifen', 'b' => 'B Raster', 'c' => 'C Collage', 'd' => 'D Bühne']],
];
$variant = [];
foreach (TEST_VARIANTS as $key => $cfg) {
    $variant[$key] = 'o';
    if (!DESIGN_SWITCH) continue;
    $req = $_GET[$key] ?? $_COOKIE['ws_' . $key] ?? '';
    if (is_string($req) && isset($cfg['opts'][$req])) {
        $variant[$key] = $req;
        if (($_GET[$key] ?? null) === $req) {
            setcookie('ws_' . $key, $req, ['expires' => time() + 86400 * 30, 'path' => '/', 'samesite' => 'Lax']);
        }
    }
}
$liste = $variant['liste'];
$GLOBALS['switch_groups'] = [];

/* ---------- Helfer ---------- */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function eur(int $n): string
{
    return number_format($n, 0, ',', '.') . ' €';
}

function asset(string $path): string
{
    $file = __DIR__ . '/../' . ltrim($path, '/');
    $v = is_file($file) ? (string) filemtime($file) : '1';
    return '/' . ltrim($path, '/') . '?v=' . $v;
}

/** Responsives Bild aus dem Manifest. $mobile = optionales Hochformat für schmale Screens. */
function img(string $name, string $alt, string $sizes = '100vw', array $o = []): string
{
    global $IMG;
    if (!isset($IMG[$name])) {
        return '<!-- Bild fehlt: ' . e($name) . ' -->';
    }
    $set = $IMG[$name];
    $srcset = implode(', ', array_map(fn($v) => '/img/' . $v[2] . ' ' . $v[0] . 'w', $set));
    $mid = $set[min(1, count($set) - 1)];
    $attrs = sprintf(
        'src="/img/%s" srcset="%s" sizes="%s" width="%d" height="%d" alt="%s" decoding="async"%s%s',
        e($mid[2]), e($srcset), e($sizes), $mid[0], $mid[1], e($alt),
        !empty($o['eager']) ? ' fetchpriority="high"' : (($o['lazy'] ?? true) ? ' loading="lazy"' : ''),
        !empty($o['class']) ? ' class="' . e($o['class']) . '"' : ''
    );
    if (!empty($o['mobile']) && isset($IMG[$o['mobile']])) {
        $m = $IMG[$o['mobile']];
        $msrc = implode(', ', array_map(fn($v) => '/img/' . $v[2] . ' ' . $v[0] . 'w', $m));
        return '<picture><source media="(max-width: 700px) and (orientation: portrait)" srcset="' . e($msrc) . '" sizes="100vw"><img ' . $attrs . '></picture>';
    }
    return '<img ' . $attrs . '>';
}

/** Telefon-Link mit Tracking. $label = Tracking-Label, $text = sichtbarer Text (Standard: Nummer). */
function tel_link(string $label, ?string $text = null, string $class = ''): string
{
    global $C;
    return sprintf(
        '<a%s href="tel:%s" data-track="Contact" data-label="%s">%s</a>',
        $class !== '' ? ' class="' . e($class) . '"' : '',
        e($C['contact']['phone_tel']), e($label), $text ?? e($C['contact']['phone_display'])
    );
}

/** Buchen-Link mit Tracking-Attributen. $href = Ziel (Anker oder Seite). */
function book_btn(string $label, string $trackLabel, string $href = '/buchen#kalender', string $class = 'btn btn--primary'): string
{
    return sprintf(
        '<a class="%s" href="%s" data-track="InitiateCheckout" data-label="%s">%s</a>',
        e($class), e($href), e($trackLabel), e($label)
    );
}

function icon(string $name): string
{
    $p = [
        'phone' => '<path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.2 11.4 11.4 0 0 0 3.6.6 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.3.2 2.5.6 3.6a1 1 0 0 1-.3 1Z" fill="none" stroke="currentColor" stroke-width="1.4"/>',
        'pin'   => '<path d="M12 21s-7-6.2-7-11.5a7 7 0 0 1 14 0C19 14.8 12 21 12 21Z" fill="none" stroke="currentColor" stroke-width="1.4"/><circle cx="12" cy="9.5" r="2.5" fill="none" stroke="currentColor" stroke-width="1.4"/>',
        'arrow' => '<path d="M4 12h15m-5-5 5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.4"/>',
        'star'  => '<path d="m12 3 2.6 5.6 6.1.6-4.6 4.1 1.3 6-5.4-3.1-5.4 3.1 1.3-6L3.3 9.2l6.1-.6Z" fill="currentColor"/>',
        'plus'  => '<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.4"/>',
        'close' => '<path d="m6 6 12 12M18 6 6 18" stroke="currentColor" stroke-width="1.4"/>',
        'check' => '<path d="m5 12.5 4.5 4.5L19 7.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
        'prev'  => '<path d="m15 5-7 7 7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
        'next'  => '<path d="m9 5 7 7-7 7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>',
        'menu'  => '<path d="M4 8h16M4 16h16" stroke="currentColor" stroke-width="1.4"/>',
    ];
    return '<svg class="i" viewBox="0 0 24 24" aria-hidden="true" focusable="false">' . ($p[$name] ?? '') . '</svg>';
}

/** Seitenrahmen */
function page_start(array $meta): void
{
    global $C, $design;
    require __DIR__ . '/layout/head.php';
}

function page_end(array $meta = []): void
{
    global $C, $design;
    require __DIR__ . '/layout/foot.php';
}

function part(string $name, array $vars = []): void
{
    global $C;
    extract($vars, EXTR_SKIP);
    require __DIR__ . '/parts/' . $name . '.php';
}
