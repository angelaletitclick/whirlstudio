<?php
/** @var array $meta  title, description, path, landing(bool), view(string|null) */
$landing = !empty($meta['landing']);
$canonical = SITE_URL . ($meta['path'] ?? '/');
?><!doctype html>
<html lang="de">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($meta['title']) ?></title>
<meta name="description" content="<?= e($meta['description']) ?>">
<?php if (STAGING): ?><meta name="robots" content="noindex, nofollow"><?php endif; ?>
<link rel="canonical" href="<?= e($canonical) ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($meta['title']) ?>">
<meta property="og:description" content="<?= e($meta['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e(SITE_URL . '/img/' . ($meta['og'] ?? 'ws-13-1400.webp')) ?>">
<meta property="og:locale" content="de_DE">
<?php // Browserleiste in der Hauptfarbe des Designs
$tc = ['flamingo' => '#c7085a', 'lagune' => '#173f4c', 'showa' => '#3d2c26', 'bordeaux' => '#66192c', 'rosasee' => '#84c1d9', 'impeccable' => '#14172b', 'fotoautomat' => '#c42d52'][$design] ?? '#8e1b5f'; ?>
<meta name="theme-color" content="<?= e($tc) ?>">
<link rel="icon" href="/assets/favicon.svg" type="image/svg+xml">
<?php $ed = in_array($design, DESIGNS_ED, true); ?>
<?php $pre = ['flamingo' => 'figtree-v9-latin-regular.woff2', 'lagune' => 'schibsted-grotesk-v7-latin-regular.woff2', 'showa' => 'karla-v33-latin-regular.woff2', 'bordeaux' => 'hanken-grotesk-v12-latin-regular.woff2', 'rosasee' => 'outfit-v15-latin-regular.woff2', 'impeccable' => 'hanken-grotesk-v12-latin-regular.woff2', 'fotoautomat' => 'figtree-v9-latin-regular.woff2'][$design] ?? ($ed ? 'albert-sans-v4-latin-regular.woff2' : 'dm-sans-latin-var.woff2'); ?>
<link rel="preload" href="/assets/fonts/<?= e($pre) ?>" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="<?= e(asset('assets/css/base.css')) ?>">
<?php if ($ed): ?><link rel="stylesheet" href="<?= e(asset('assets/css/layout-ed.css')) ?>">
<?php endif; ?>
<link rel="stylesheet" href="<?= e(asset('assets/css/theme-' . $design . '.css')) ?>">
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'LodgingBusiness',
    'name' => 'WhirlStudio Hamburg',
    'url' => SITE_URL,
    'telephone' => $C['contact']['phone_tel'],
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => $C['address']['street'],
        'postalCode' => $C['address']['zip'],
        'addressLocality' => $C['address']['city'],
        'addressCountry' => 'DE',
    ],
    'checkinTime' => '17:00',
    'checkoutTime' => '10:00',
    'priceRange' => 'ab ' . $C['prices']['from'] . ' € pro Nacht',
    'petsAllowed' => false,
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
</head>
<body class="d-<?= e($design) ?><?= $ed ? ' ed' : '' ?><?= $landing ? ' is-landing' : '' ?>"
      data-pixel="<?= e($C['tracking']['meta_pixel_id']) ?>"
      <?php if (!empty($meta['view'])): ?>data-view="<?= e($meta['view']) ?>"<?php endif; ?>>
<a class="skip" href="#main">Zum Inhalt springen</a>

<header class="site-header<?= !empty($meta['solid']) ? ' is-solid' : '' ?>" data-header>
  <div class="wrap site-header__in">
    <a class="logo" href="/" aria-label="WhirlStudio Hamburg – Startseite">
      <span class="logo__mark" aria-hidden="true"></span>
    </a>
    <?php
    $path = $meta['path'] ?? '';
    $bookHref = $landing ? '#kalender' : '/buchen#kalender';
    $cur = fn(string $p) => $path === $p ? ' aria-current="page"' : '';
    ?>
    <nav class="nav" id="nav" aria-label="Hauptmenü">
      <ul>
        <li class="nav__m"><a href="/"<?= $cur('/') ?>>Startseite</a></li>
        <?php foreach ($C['audiences'] as $au): ?>
        <li><a href="/<?= e($au['slug']) ?>"<?= $cur('/' . $au['slug']) ?>><?= e($au['nav']) ?></a></li>
        <?php endforeach; ?>
        <?php foreach ($C['studios'] as $st): ?>
        <li><a href="/<?= e($st['slug']) ?>"<?= $cur('/' . $st['slug']) ?>>Studio <?= e($st['name']) ?></a></li>
        <?php endforeach; ?>
        <li class="nav__m"><a href="<?= e($bookHref) ?>" data-track="InitiateCheckout" data-label="Menü"<?= $cur('/buchen') ?>><?= e($C['book_label']) ?></a></li>
        <li class="nav__m"><?= tel_link('Menü Telefon', 'Anrufen: ' . e($C['contact']['phone_display'])) ?></li>
      </ul>
    </nav>
    <div class="site-header__cta">
      <?= book_btn('Header', $bookHref, 'btn--sm') ?>
      <button class="burger" type="button" aria-controls="nav" aria-expanded="false" aria-label="Menü öffnen" data-burger><?= icon('menu') ?></button>
    </div>
  </div>
</header>
<main id="main">
