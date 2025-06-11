<?php include_once 'config/menu.php'; ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Oltópont</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<header><h1>Oltópont</h1></header>
<nav>
    <ul>
    <?php foreach ($menu as $key => $value): ?>
        <li><a href="/<?= $key ?>"><?= $value ?></a></li>
    <?php endforeach; ?>
    </ul>
</nav>
<main>
