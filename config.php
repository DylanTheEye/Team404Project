<<<<<<< HEAD
<?php
//Foutmelding zichtbaar maken
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "db_stars";
$password = "DonoTbreaK";
$database = "home_db";

// PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Fouten gooien als utizonderingen
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Fetch Modus
    PDO::ATTR_EMULATE_PREPARES => false, // Echte prepared statements
];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
=======
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
>>>>>>> 43a2b59d74941185d75f25b08b38077395908ed1
}