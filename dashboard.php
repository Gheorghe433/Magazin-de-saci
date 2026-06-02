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

$users = loadUsers($dataFile);
$currentUser = null;
foreach ($users as $u) {
    if (isset($u['id']) && $u['id'] == $_SESSION['user_id']) {
        $currentUser = $u;
        break;
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
            <ul>
                <li><strong>Nume:</strong> <?= htmlspecialchars($currentUser['nume']) ?></li>
                <li><strong>Email:</strong> <?= htmlspecialchars($currentUser['email']) ?></li>
                <li><strong>Creat:</strong> <?= htmlspecialchars($currentUser['created'] ?? '') ?></li>
            </ul>
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
