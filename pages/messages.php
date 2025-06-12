<?php
if (!isset($_SESSION['user'])) {
    echo '<p>Az üzenetek megtekintéséhez jelentkezzen be.</p>';
    return;
}
require_once 'includes/db.php';

$stmt = $dbh->query('SELECT * FROM messages ORDER BY created_at DESC');
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Kapcsolatfelvételi üzenetek</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Dátum</th>
        <th>Név</th>
        <th>Email</th>
        <th>Feladó</th>
        <th>Üzenet</th>
    </tr>
    <?php foreach ($messages as $msg): ?>
        <tr>
            <td><?= htmlspecialchars($msg['created_at']) ?></td>
            <td><?= htmlspecialchars($msg['name']) ?></td>
            <td><?= htmlspecialchars($msg['email']) ?></td>
            <td><?= htmlspecialchars($msg['sender']) ?></td>
            <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
