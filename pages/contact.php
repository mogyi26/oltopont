<?php
require_once 'includes/db.php';
$errors = [];
$name = '';
$email = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (empty($name)) $errors[] = 'Név megadása kötelező.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Érvénytelen e-mail cím.';
    if (empty($message)) $errors[] = 'Üzenet megadása kötelező.';

    if (empty($errors)) {
        $sender = isset($_SESSION['user']) ? $_SESSION['user']['fullname'] : 'Vendég';
        $stmt = $dbh->prepare('INSERT INTO messages (name, email, message, sender) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $email, $message, $sender]);
        echo '<p>Üzenet elküldve!</p>';
        $name = $email = $message = '';
    }
}
?>



<h2>Kapcsolatfelvétel</h2>
<form method="post" onsubmit="return validateForm();">
    <div class="form-row">
        <label for="name">Név:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>
    </div>
    <div class="form-row">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>
    </div>
    <div class="form-row">
        <label for="message">Üzenet:</label>
        <textarea name="message" id="message" rows="7" required><?= htmlspecialchars($message) ?></textarea>
    </div>
    <button type="submit">Küldés</button>
</form>


<?php if (!empty($errors)): ?>
<ul style="color:red;"><?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?></ul>
<?php endif; ?>
<script src="/js/validate.js"></script>
