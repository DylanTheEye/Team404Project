<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "db_stars";
$password = "DonoTbreaK";
$database = "home_db";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$database;charset=utf8mb4",
        $username,
        $password,
        $options
    );

} catch (PDOException $e) {
    die("Databaseverbinding mislukt: " . $e->getMessage());
}