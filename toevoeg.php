<?php
require "config.php";

$result = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_FILES['afbeelding']) ||
        $_FILES['afbeelding']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Image upload failed.");
    }

    $Gerecht_naam = $_POST['Gerecht_naam'];
    $Gerecht_uitleg = $_POST['Gerecht_uitleg'];
    $Ingredienten_lijst = $_POST['Ingredienten_lijst'];
    $Stappen = implode("\n", $_POST['stappen']);
    $Categorie_id = $_POST['Categorie_id'];


    try{
        $query = "INSERT INTO post (Gerecht_img, Gerecht_naam, Gerecht_uitleg, Categorie_id, Ingredienten_lijst, Stappen
                            VALUES(:afbeelding, :name, :uitleg :categorie, :ingredienten, :stappen)";


        $stmt = $conn->prepare($query);

        $stmt->execute([
            ':afbeelding' => $Gerecht_img,
            ':naam' => $Gerecht_naam,
            ':uitleg' => $Gerecht_uitleg,
            ':categorie' => $Categorie_id,
            ':ingredienten' => $Ingredienten_lijst,
            ':stappen' => $Stappen
        ]);


        if($stmt->rowCount()){
            $result = "{$Gerecht_naam} was added successfully </br>";
        } else{
            $result = "Something went wrong </br>";
        }

        header('Location: ./index.php');
        exit;

    } catch (PDOException $e) {
        echo"Database connection went wrong</br>";
        echo "Error:" .$e->getMessage();
    }



} else{
    echo "The form was not sent correctly. <br/>";
}


include "./index.php";