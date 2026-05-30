<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$loggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | Magazin Saci</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="container header__inner">
        <a href="/index.php" class="header__logo">
            <img src="imagini/Logo.svg" alt="Logo Magazin Saci" class="logo-image">
        </a>
        <div class="header__actions">
            <?php if ($loggedIn): ?>
                <a href="dashboard.php" class="btn btn-primary">Dashboard</a>
                <a href="logout.php" class="btn btn-outline">Ieșire</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary">Log in</a>
                <a href="register.php" class="btn btn-primary">Înregistrare</a>
            <?php endif; ?>
        </div>

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

<main>
    
</main>

<footer class="footer">
    
</footer>
</body>
</html>