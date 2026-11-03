<?php

$host = 'localhost';
$dbname = 'home_db';
$user = 'db_stars';
$password = 'DonoTbreaK';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {
    exit('Verbinding met de database mislukt.');
}