<?php global $menu; ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Oltópont</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Szentesi Rendelőintézet - Oltópont tájékoztatás </h1>
		<?php if (isset($_SESSION['user'])): ?>
			<p style="color:white; text-align:center;">
			Bejelentkezett: <?= htmlspecialchars($_SESSION['user']['username']) ?>
			</p>
		<?php endif; ?>

</header>
<nav>
    <ul>
        <?php foreach ($menu as $key => $value):
            if ($key === 'login' && isset($_SESSION['user'])) continue;
            if ($key === 'register' && isset($_SESSION['user'])) continue;
            if ($key === 'logout' && !isset($_SESSION['user'])) continue;
            if (in_array($key, ['messages', 'pictures']) && !isset($_SESSION['user'])) continue;
        ?>
            <li><a href="<?= $key ?>"><?= $value ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<main>