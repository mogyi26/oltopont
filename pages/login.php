<?php
require_once 'includes/db.php';
$errors = [];
$username = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: home');
        exit;
    } else {
        $errors[] = 'Hibás felhasználónév vagy jelszó.';
    }
}
?>

<h2>Bejelentkezés</h2>
<form method="post">
    <div class="form-row">
        <label for="username">Felhasználónév:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>" required>
    </div>
    <div class="form-row">
        <label for="password">Jelszó:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Belépés</button>
</form>

<?php if (!empty($errors)): ?>
<ul style="color:red;">
    <?php foreach ($errors as $e): ?>
        <li><?= $e ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
