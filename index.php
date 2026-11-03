<?php

require 'config.php';

$query = "SELECT *
          FROM `post`
          INNER JOIN `Gerecht_categorie`
          ON `post`.`Categorie_id` = `Gerecht_categorie`.`id`";

$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll();

$amountRow = count($result);

include __DIR__ . "/php/views/recepten.php";