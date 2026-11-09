<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/config.php';

$query = "
    SELECT *
    FROM `post`
    INNER JOIN `Gerecht_catigorie`
        ON `Categorie_id` = `Gerecht_catigorie`.`id`
";

$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$amountRow = count($result);

include __DIR__ . '/php/views/recepten.php';
?>