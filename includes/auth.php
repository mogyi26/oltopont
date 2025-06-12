<?php
require_once 'db.php';

function login($username, $password) {
    global $dbh;
    $stmt = $dbh->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'username' => $user['username'],
            'fullname' => $user['lastname'] . ' ' . $user['firstname']
        ];
        return true;
    }
    return false;
}

function logout() {
    unset($_SESSION['user']);
    session_destroy();
}

function is_logged_in() {
    return isset($_SESSION['user']);
}
?>