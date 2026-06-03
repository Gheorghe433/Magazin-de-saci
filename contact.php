<?php
$pageTitle = 'Contact';
$hideAuthButtons = true;
$showContactButton = true;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$messagesFile = __DIR__ . '/data/messages.json';

if (!is_dir(dirname($messagesFile))) {
    mkdir(dirname($messagesFile), 0755, true);
}

if (!file_exists($messagesFile)) {
    file_put_contents($messagesFile, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function loadMessages(string $file): array
{
    $data = @file_get_contents($file);
    if ($data === false) {
        return [];
    }

    return json_decode($data, true) ?? [];
}

function saveMessages(string $file, array $messages): bool
{
    $json = json_encode($messages, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        return false;
    }

    $res = @file_put_contents($file, $json, LOCK_EX);
    return $res !== false;
}

$error = '';
$success = '';
$nume = '';
$email = '';
$telefon = '';
$subiect = '';
$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = trim($_POST['nume'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefon = trim($_POST['telefon'] ?? '');
    $subiect = trim($_POST['subiect'] ?? '');
    $mesaj = trim($_POST['mesaj'] ?? '');

    if (empty($nume)) {
        $error = 'Introduceti numele.';
    } elseif (empty($email)) {
        $error = 'Introduceti adresa de email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresa de email nu este valida.';
    } elseif (empty($subiect)) {
        $error = 'Introduceti subiectul.';
    } elseif (empty($mesaj)) {
        $error = 'Introduceti mesajul.';
    } else {
        $messages = loadMessages($messagesFile);

        $messages[] = [
            'id'        => count($messages) + 1,
            'nume'      => $nume,
            'email'     => $email,
            'telefon'   => $telefon,
            'subiect'   => $subiect,
            'mesaj'     => $mesaj,
            'timestamp' => date('c'),
            'user_id'   => $_SESSION['user_id'] ?? null,
        ];

        if (saveMessages($messagesFile, $messages)) {
            $success = 'Multumim! Mesajul tau a fost trimis cu succes.';
            $nume = '';
            $email = '';
            $telefon = '';
            $subiect = '';
            $mesaj = '';
        } else {
            $error = 'A aparut o eroare la trimiterea mesajului. Incearca din nou.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main class="container">
    <h1>Contacteaza-ne</h1>

    <section class="card">
        <p>Suntem aici sa iti ajutam cu orice intrebari sau sugestii.</p>

        <?php if ($error): ?>
            <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert--success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <form method="POST" class="auth-form" novalidate>
            <div class="form-group">
                <label for="nume">Nume complet</label>
                <input id="nume" type="text" name="nume" value="<?= htmlspecialchars($nume) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
            </div>

            <div class="form-group">
                <label for="telefon">Telefon (optional)</label>
                <input id="telefon" type="tel" name="telefon" value="<?= htmlspecialchars($telefon) ?>">
            </div>

            <div class="form-group">
                <label for="subiect">Subiect</label>
                <input id="subiect" type="text" name="subiect" value="<?= htmlspecialchars($subiect) ?>" required>
            </div>

            <div class="form-group">
                <label for="mesaj">Mesaj</label>
                <textarea id="mesaj" name="mesaj" rows="6" required><?= htmlspecialchars($mesaj) ?></textarea>
            </div>

            <button type="submit" class="btn-full">Trimite mesajul</button>
        </form>
    </section>

    <section class="card">
        <h2>Informatii de contact</h2>
        <ul>
            <li><strong>Telefon:</strong> <a href="tel:069149730">069 149 730</a></li>
            <li><strong>Locatie:</strong> <a href="https://maps.app.goo.gl/GAWu84AruE7GSy628" target="_blank">Chișinău, Moldova</a></li>
        </ul>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
