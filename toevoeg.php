<?php
require "config.php";

$result = "";

//////////////////////////////////////////

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $Gerecht_id = $_POST['Gerecht_id'];
  $Gerecht_img = $_POST['Gerecht_img'];
  $Gerecht_naam = $_POST['Gerecht_naam'];
  $Gerecht_uitleg = $_POST['Gerecht_uitleg'];
  $Ingredienten_lijst = $_POST['Ingredienten_lijst'];
  $Stappen = $_POST['Stappen'];
  $Categorie_id = $_POST['Categorie_id'];


  try{
      $query = "INSERT INTO post (afbeelding, naam, uitleg, categorie, ingredienten, stappen[]
                VALUES(:Gerecht_img, :Gerecht_naam, :Gerecht_uitleg :Ingredienten_lijst, :Categorie_id, :Stappen)";


      $stmt = $conn->prepare($query);

      $stmt->execute([
          'Gerecht_img' => $Gerecht_img,
          'Gerecht_naam' => $Gerecht_naam,
          'Gerecht_uitleg' => $Gerecht_uitleg,
          'Ingredienten_lijst' => $Ingredienten_lijst,
          'Categorie_id' => $Categorie_id,
          'Stappen' => $Stappen
      ]);

      if($stmt->rowCount() > 0){
          $result = "{$Gerecht_naam} was added succesfully </br>";
      } else{
          $result = "Error </br>";
      }


  } catch (PDOException $e) {
      echo"Something went wrong</br>";
      echo "Error:" .$e->getMessage();
  }



} else{
    echo "The form was not sent correctly. <br/>";
}

include "php/views/toevoeg.html";