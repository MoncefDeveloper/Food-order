<?php

@session_start();


$dsn = "mysql:host=localhost;dbname=food-order";
$user = "root";
$pass = "";
$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
];

try {
    $db = new  PDO($dsn, $user, $pass, $options);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

$GLOBALS["base_URL"] = "http://localhost/food-order";
