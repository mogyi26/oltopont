<?php
try {
    $dbh = new PDO('mysql:host=localhost;dbname=demoserv_oltopont', 'mzperx', 'mzperx756',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
} catch (PDOException $e) {
    die('Adatbázis kapcsolat hiba: ' . $e->getMessage());
}
?>