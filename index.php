<?php

$categorii = [
    [
        'id'      => 'big-bags',
        'titlu'   => 'Big bags',
        'imagine' => 'imagini/big-bag.jpg',
        'preview' => 'SACI BIG BAGS 75X110X240',
        'produse' => [
            ['nume' => 'SACI BIG BAGS 75X110X240', 'slug' => 'saci-big-bags-75x110x240'],
            ['nume' => 'SACI BIG BAGS 90X90X110',  'slug' => 'saci-big-bags-90x90x110'],
            ['nume' => 'SACI BIG BAGS 90X90X160',  'slug' => 'saci-big-bags-90x90x160'],
            ['nume' => 'SACI BIG BAGS 90X90X90',   'slug' => 'saci-big-bags-90x90x90'],
        ],
    ],
    [
        'id'      => 'plasa-tubulara',
        'titlu'   => 'Plasă tubulară si stretch',
        'imagine' => 'imagini/plasa-tubulara.jpg',
        'preview' => 'Plasă tubulară',
        'produse' => [
            ['nume' => 'Plasă tubulară', 'slug' => 'plasa-tubulara'],
            ['nume' => 'Stretch',        'slug' => 'stretch'],
        ],
    ],
    [
        'id'      => 'plasa',
        'titlu'   => 'Plasă',
        'imagine' => 'imagini/plasa.jpg',
        'preview' => 'Saci Plasă 30x34',
        'produse' => [
            ['nume' => 'Saci Plasă 30x34', 'slug' => 'saci-plasa-30x34'],
            ['nume' => 'Saci Plasă 40x58', 'slug' => 'saci-plasa-40x58'],
            ['nume' => 'Saci Plasă 52x72', 'slug' => 'saci-plasa-52x72'],
        ],
    ],
    [
        'id'      => 'polietilena',
        'titlu'   => 'Polietilenă',
        'imagine' => 'imagini/polietilena.jpg',
        'preview' => 'Saci Polietilenă 32x62',
        'produse' => [
            ['nume' => 'Saci Polietilenă 32x62',      'slug' => 'saci-polietilena-32x62'],
            ['nume' => 'Saci Polietilenă 35x65',      'slug' => 'saci-polietilena-35x65'],
            ['nume' => 'Saci Polietilenă 38x68',      'slug' => 'saci-polietilena-38x68'],
            ['nume' => 'Saci Polietilenă 43x70',      'slug' => 'saci-polietilena-43x70'],
            ['nume' => 'Saci Polietilenă 50x80 120mk','slug' => 'saci-polietilena-50x80-120mk'],
            ['nume' => 'Saci Polietilenă 50x80 80mk', 'slug' => 'saci-polietilena-50x80-80mk'],
            ['nume' => 'Saci Polietilenă 50x92',      'slug' => 'saci-polietilena-50x92'],
        ],
    ],
    [
        'id'      => 'polipropilena',
        'titlu'   => 'Polipropilenă',
        'imagine' => 'imagini/polipropilena.jpg',
        'preview' => 'Sac Polipropilenă 100x150',
        'produse' => [
            ['nume' => 'Sac Polipropilenă 100x150', 'slug' => 'sac-polipropilena-100x150'],
            ['nume' => 'Sac Polipropilenă 35x65',   'slug' => 'sac-polipropilena-35x65'],
            ['nume' => 'Sac Polipropilenă 50x100',  'slug' => 'sac-polipropilena-50x100'],
            ['nume' => 'Sac Polipropilenă 50x80',   'slug' => 'sac-polipropilena-50x80'],
            ['nume' => 'Sac Polipropilenă 50x90',   'slug' => 'sac-polipropilena-50x90'],
            ['nume' => 'Sac Polipropilenă 55x100',  'slug' => 'sac-polipropilena-55x100'],
            ['nume' => 'Sac Polipropilenă 55x105',  'slug' => 'sac-polipropilena-55x105'],
            ['nume' => 'Sac Polipropilenă 60x110',  'slug' => 'sac-polipropilena-60x110'],
        ],
    ],
];
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Saci albi din polipropilenă pentru cereale, mărfuri industriale și polietilenă pentru gunoi. Big bags, plasă, stretch film. Chișinău, Moldova.">
    <meta name="keywords" content="saci, saci albi, saci pentru zahar, saci pentru cereale, polipropilenă, polietilenă, big bags, plasa, stretch, Moldova, Chișinău">
    <title>Magazin Saci - Saci din polipropilenă și polietilenă</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>


<header class="header">
    <div class="container header__inner">
        <a href="index.php" class="header__logo">
            
            <span class="logo-text">🛍️ MagazinSaci</span>
        </a>
        <div class="header__contact">
            <a href="https://maps.app.goo.gl/GAWu84AruE7GSy628" target="_blank" class="header__address">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                Chișinău, Moldova
            </a>
            <a href="tel:069149730" class="header__phone">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.5 1.18a2 2 0 011.98-2h3a2 2 0 012 1.72 13 13 0 00.7 2.81 2 2 0 01-.45 2.11L6.91 6.91a16 16 0 006.18 6.18l1.27-1.27a2 2 0 012.11-.45 13 13 0 002.81.7 2 2 0 011.72 2.03z"/></svg>
                069 149 730
            </a>
        </div>
    </div>
</header>


<section class="hero">
    <div class="container hero__inner">
        <div class="hero__text">
            <h1 class="hero__title">Saci din polipropilenă<br>și polietilenă</h1>
            <p class="hero__subtitle">Pentru cereale, construcții și uz gospodăresc</p>
            <a href="#categories-nav" class="hero__btn">
                Vezi produsele
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
            </a>
        </div>
        <div class="hero__image">
            
            <div class="hero__image-placeholder">
                <span>📦</span>
            </div>
        </div>
    </div>
</section>


<nav class="categories-nav" id="categories-nav">
    <div class="categories-nav__track">
        <?php foreach ($categorii as $cat): ?>
        <a href="#<?= htmlspecialchars($cat['id']) ?>" class="categories-nav__item">
            <div class="categories-nav__img">
                <?php if (file_exists($cat['imagine'])): ?>
                    <img src="<?= htmlspecialchars($cat['imagine']) ?>" alt="<?= htmlspecialchars($cat['titlu']) ?>">
                <?php else: ?>
                    <span>📦</span>
                <?php endif; ?>
            </div>
            <span class="categories-nav__label"><?= htmlspecialchars($cat['titlu']) ?></span>
        </a>
        <?php endforeach; ?>
    </div>
</nav>


<main class="main">
    <div class="container">
        <?php foreach ($categorii as $cat): ?>
        <section class="category-section" id="<?= htmlspecialchars($cat['id']) ?>">
            <h2 class="category-section__title"><?= htmlspecialchars($cat['titlu']) ?></h2>
            <div class="products-grid">
                <?php foreach ($cat['produse'] as $produs): ?>
                <a href="produs.php?slug=<?= urlencode($produs['slug']) ?>" class="product-card">
                    <div class="product-card__img">
                        <?php
                        $img_path = 'imagini/' . $produs['slug'] . '.jpg';
                        if (file_exists($img_path)): ?>
                            <img src="<?= htmlspecialchars($img_path) ?>" alt="<?= htmlspecialchars($produs['nume']) ?>">
                        <?php else: ?>
                            <span>📦</span>
                        <?php endif; ?>
                    </div>
                    <div class="product-card__body">
                        <p class="product-card__name"><?= htmlspecialchars($produs['nume']) ?></p>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </div>
</main>


<footer class="footer">
    <div class="container footer__inner">
        <div class="footer__map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5438.021915084793!2d28.869098814242484!3d47.04001579043234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xde26909136657ead!2sSIM+CONSTRUCT+GRUP+SRL!5e0!3m2!1sen!2s!4v1499956783787"
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
        <div class="footer__info">
            <div class="footer__logo">
                <span class="logo-text">🛍️ MagazinSaci</span>
            </div>
            <div class="footer__contacts">
                <a href="tel:069149730" class="footer__phone">📞 069 149 730</a>
                <a href="https://maps.app.goo.gl/GAWu84AruE7GSy628" target="_blank" class="footer__addr">📍 Chișinău, Moldova</a>
                <a href="contact.php" class="footer__contact-link">✉️ Contactează-ne</a>
            </div>
            <p class="footer__copy">© <?= date('Y') ?> Magazin Saci. Toate drepturile rezervate.</p>
        </div>
    </div>
</footer>

<script src="script.js"></script>
</body>
</html>