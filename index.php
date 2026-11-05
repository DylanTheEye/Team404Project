<?php
require 'config.php';

$query = "SELECT * FROM `post` inner join `Gerecht_catigorie` on `Categorie_id` = Gerecht_catigorie.id 
    inner join `users` on `id` = users.id";


$stmt =$conn->prepare($query);
$stmt->execute();

//Fetch all the result in een array
$result = $stmt->fetchAll();
//
//var_dump($result);

// counts the rows
$amountRow = count($result);

include __DIR__ . "/php/views/recepten.php";

