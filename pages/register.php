<?php
require_once 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $firstname = sanitize($_POST['firstname'] ?? '');
    $lastname = sanitize($_POST['lastname'] ?? '');

    if (!empty($username) && !empty($password)) {
        $stmt = $dbh->prepare('INSERT INTO users (username, password, firstname, lastname) VALUES (?, ?, ?, ?)');
        try {
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $firstname, $lastname]);
            echo '<p>Sikeres regisztráció! Jelentkezzen be.</p>';
        } catch (PDOException $e) {
            echo '<p>Hiba: A felhasználónév már létezik.</p>';
        }
    }
}
?>
<h2>Regisztráció</h2>

<form method="post">
    <div class="form-row">
        <label for="lastname">Vezetéknév:</label>
        <input type="text" name="lastname" id="lastname" required>
    </div>
    <div class="form-row">
        <label for="firstname">Keresztnév:</label>
        <input type="text" name="firstname" id="firstname" required>
    </div>
    <div class="form-row">
        <label for="username">Felhasználónév:</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div class="form-row">
        <label for="password">Jelszó:</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit">Regisztráció</button>
</form>

