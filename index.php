<?php
session_start();
require_once 'config/menu.php';
require_once 'includes/functions.php';
require_once 'includes/auth.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_parts = explode('/', trim($uri, '/'));
$page = $uri_parts[1] ?? 'home'; // 0 = 'oltopont', 1 = 'home', 'contact', stb.

if (!file_exists("pages/$page.php")) {
    $page = 'home';
}
include 'templates/header.php';
include "pages/$page.php";
include 'templates/footer.php';