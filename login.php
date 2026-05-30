<?php
$pageTitle = 'Autentificare';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$dataFile = __DIR__ . '/data/users.json';

if (!is_dir(dirname($dataFile))) {
    mkdir(dirname($dataFile), 0755, true);
}

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function loadUsers(string $file): array
{
    $data = @file_get_contents($file);
    if ($data === false) {
        return [];
    }

    return json_decode($data, true) ?? [];
}

$users = loadUsers($dataFile);
$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email  = trim($_POST['email'] ?? '');
    $parola = $_POST['parola'] ?? '';

    if (empty($email) || empty($parola)) {
        $error = 'Completează toate câmpurile.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresa de email nu este validă.';
    } else {
        $foundUser = null;
        foreach ($users as $user) {
            if (strcasecmp($user['email'], $email) === 0) {
                $foundUser = $user;
                break;
            }
        }

        if (!$foundUser || !password_verify($parola, $foundUser['parola'])) {
            $error = 'Email sau parolă incorectă.';
        } else {
            $_SESSION['user_id']   = $foundUser['id'];
            $_SESSION['user_name'] = $foundUser['nume'];
            header('Location: dashboard.php');
            exit;
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main class="auth-page">
    <div class="auth-card">
        <h1>Autentificare</h1>

        <?php if ($error): ?>
            <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" class="auth-form" novalidate>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= htmlspecialchars($email) ?>" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="parola">Parolă</label>
                <input id="parola" type="password" name="parola" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-full">Log in</button>
        </form>

        <p>Nu ai cont? <a href="register.php">Înregistrează-te</a></p>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>