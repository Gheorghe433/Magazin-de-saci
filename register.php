<?php
$pageTitle = 'Înregistrare';

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

function saveUsers(string $file, array $users): void
{
    file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

$users   = loadUsers($dataFile);
$eroare  = '';
$success = '';
$nume    = '';
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume    = trim($_POST['nume'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $parola  = $_POST['parola'] ?? '';
    $parola2 = $_POST['parola2'] ?? '';

    if (empty($nume) || empty($email) || empty($parola) || empty($parola2)) {
        $eroare = 'Completează toate câmpurile.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $eroare = 'Adresa de email nu este validă.';
    } elseif (strlen($parola) < 6) {
        $eroare = 'Parola trebuie să aibă minim 6 caractere.';
    } elseif ($parola !== $parola2) {
        $eroare = 'Parolele nu coincid.';
    } else {
        $exists = false;
        foreach ($users as $user) {
            if (strcasecmp($user['email'], $email) === 0) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            $eroare = 'Acest email este deja înregistrat.';
        } else {
            $users[] = [
                'id'      => count($users) + 1,
                'nume'    => $nume,
                'email'   => $email,
                'parola'  => password_hash($parola, PASSWORD_DEFAULT),
                'created' => date('c'),
            ];

            saveUsers($dataFile, $users);

            $success = 'Cont creat cu succes! Te poți autentifica acum.';
            $nume = '';
            $email = '';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main class="auth-page">
    <div class="auth-card">
        <h1>Înregistrare</h1>

        <?php if ($eroare): ?>
            <div class="alert alert--error"><?= htmlspecialchars($eroare) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert--success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" class="auth-form" novalidate>
            <div class="form-group">
                <label for="nume">Nume complet</label>
                <input id="nume" type="text" name="nume" value="<?= htmlspecialchars($nume) ?>" required autocomplete="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= htmlspecialchars($email) ?>" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="parola">Parolă</label>
                <input id="parola" type="password" name="parola" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="parola2">Confirmă parola</label>
                <input id="parola2" type="password" name="parola2" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn-full">Înregistrează-te</button>
        </form>

        <p>Ai deja cont? <a href="login.php">Autentifică-te</a></p>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>