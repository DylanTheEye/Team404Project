<?php
require 'config.php';

$query = "SELECT * FROM `post`";

$stmt =$conn->prepare($query);
$stmt->execute();

//Fetch all the result in een array
$result = $stmt->fetchAll();
//
//var_dump($result);

// counts the rows
$amountRow = count($result);

include __DIR__ . '/php/views/toevoegview.php';

