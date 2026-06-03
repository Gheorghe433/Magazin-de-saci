<?php
$pageTitle = 'Dashboard';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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

function saveUsers(string $file, array $users): bool
{
    $json = json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    if ($json === false) {
        return false;
    }

    $res = @file_put_contents($file, $json, LOCK_EX);
    return $res !== false;
}

$users = loadUsers($dataFile);
$error = '';
$success = '';
$currentUser = null;
foreach ($users as $u) {
    if (isset($u['id']) && $u['id'] == $_SESSION['user_id']) {
        $currentUser = $u;
        break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['nume'] ?? ($currentUser['nume'] ?? ''));
    $currentPassword = $_POST['parola_curenta'] ?? '';
    $newPassword = $_POST['parola_noua'] ?? '';
    $newPassword2 = $_POST['parola_noua2'] ?? '';

    if (!$currentUser) {
        $error = 'Utilizatorul nu a fost găsit.';
    } elseif ($name === '') {
        $error = 'Numele nu poate fi gol.';
    } elseif ($currentPassword === '') {
        $error = 'Introdu parola curentă pentru a confirma modificările.';
    } elseif (!password_verify($currentPassword, $currentUser['parola'])) {
        $error = 'Parola curentă este incorectă.';
    } elseif ($newPassword !== '' && strlen($newPassword) < 6) {
        $error = 'Parola nouă trebuie să aibă minim 6 caractere.';
    } elseif ($newPassword !== $newPassword2) {
        $error = 'Noile parole nu coincid.';
    } else {
        foreach ($users as &$u) {
            if (isset($u['id']) && $u['id'] == $currentUser['id']) {
                $u['nume'] = $name;
                if ($newPassword !== '') {
                    $u['parola'] = password_hash($newPassword, PASSWORD_DEFAULT);
                }
                break;
            }
        }
        unset($u);

        if (saveUsers($dataFile, $users)) {
            $success = 'Profilul a fost actualizat cu succes.';
            $_SESSION['user_name'] = $name;
            foreach ($users as $u) {
                if (isset($u['id']) && $u['id'] == $_SESSION['user_id']) {
                    $currentUser = $u;
                    break;
                }
            }
        } else {
            $error = 'A apărut o eroare la salvarea modificărilor.';
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main class="container">
    <h1>Bine ai venit, <?= htmlspecialchars($_SESSION['user_name'] ?? ($currentUser['nume'] ?? 'Utilizator')) ?></h1>

    <p><a href="logout.php" class="btn btn-outline">Deconectare</a></p>

    <?php if ($currentUser): ?>
        <section class="card">
            <h2>Profilul tău</h2>

            <?php if ($success): ?>
                <div class="alert alert--success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert--error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <ul>
                <li><strong>Nume:</strong> <?= htmlspecialchars($currentUser['nume']) ?></li>
                <li><strong>Email:</strong> <?= htmlspecialchars($currentUser['email']) ?></li>
                <li><strong>Creat:</strong> <?= htmlspecialchars($currentUser['created'] ?? '') ?></li>
            </ul>

            <form method="POST" class="auth-form" novalidate>
                <h3>Actualizează profilul</h3>

                <div class="form-group">
                    <label for="nume">Nume complet</label>
                    <input id="nume" type="text" name="nume" value="<?= htmlspecialchars($currentUser['nume']) ?>" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="parola_curenta">Parola curentă</label>
                    <input id="parola_curenta" type="password" name="parola_curenta" required autocomplete="current-password">
                </div>

                <div class="form-group">
                    <label for="parola_noua">Parolă nouă</label>
                    <input id="parola_noua" type="password" name="parola_noua" autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="parola_noua2">Confirmă parola nouă</label>
                    <input id="parola_noua2" type="password" name="parola_noua2" autocomplete="new-password">
                </div>

                <button type="submit" class="btn-full btn-outline">Salvează modificările</button>
            </form>
        </section>
    <?php endif; ?>

    <section class="card">
        <h2>Lista utilizatorilor</h2>
        <?php if (empty($users)): ?>
            <p>Nu există utilizatori în sistem.</p>
        <?php else: ?>
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Creat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['id'] ?? '') ?></td>
                            <td><?= htmlspecialchars($u['nume'] ?? '') ?></td>
                            <td><?= htmlspecialchars($u['email'] ?? '') ?></td>
                            <td><?= htmlspecialchars($u['created'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
