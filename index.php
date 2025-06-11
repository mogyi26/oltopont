<?php
session_start();
require_once 'config/menu.php';

$page = 'home';
if (isset($_GET['page']) && file_exists("pages/{$_GET['page']}.php")) {
    $page = $_GET['page'];
}
include "templates/header.php";
include "pages/$page.php";
include "templates/footer.php";
