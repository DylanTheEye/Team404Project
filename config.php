<?php
//Foutmelding zichtbaar maken
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "dbstars";
$password = "Do_noTBre@k21";
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
}