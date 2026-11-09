
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once __DIR__ . '/config.php';

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("ERROR: Form was not submitted using POST.");
}

$required = ['naam', 'uitleg', 'categorie', 'ingredienten', 'stappen'];

foreach ($required as $field) {
    if (!isset($_POST[$field])) {
        die("ERROR: Missing field: " . $field);
    }
}

$destination = null;

try {

    // Get form data
    $naam = trim($_POST['naam']);
    $uitleg = trim($_POST['uitleg']);
    $categorie = $_POST['categorie'];
    $ingredienten = trim($_POST['ingredienten']);

    // Combine recipe steps
    if (!is_array($_POST['stappen'])) {
        throw new Exception("Invalid steps format.");
    }

    $stappen = implode("\n", array_filter(
        $_POST['stappen'],
        fn($stap) => is_string($stap) && trim($stap) !== ''
    ));

    // Check image
    if (!isset($_FILES['afbeelding'])) {
        throw new Exception("No image received.");
    }

    $image = $_FILES['afbeelding'];

    if ($image['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Image upload error: " . $image['error']);
    }

    if ($image['size'] > 5 * 1024 * 1024) {
        throw new Exception("Image is too large. Maximum 5 MB.");
    }

    // Validate image
    $imageInfo = getimagesize($image['tmp_name']);

    if ($imageInfo === false) {
        throw new Exception("Invalid image.");
    }

    $types = [
        IMAGETYPE_JPEG => 'jpg',
        IMAGETYPE_PNG => 'png',
        IMAGETYPE_WEBP => 'webp'
    ];



    if (!isset($types[$imageInfo[2]])) {
        throw new Exception("Unsupported image type.");
    }

//    Image to blob
    $blob_image = file_get_contents($image['tmp_name']);


    // Insert recipe into database
    $query = "INSERT INTO post
    (
        Gerecht_img,
        Gerecht_naam,
        Gerecht_uitleg,
        Categorie_id,
        Ingredienten_lijst,
        Stappen
    )
    VALUES
    (
        :afbeelding,
        :naam,
        :uitleg,
        :categorie,
        :ingredienten,
        :stappen
    )";

    $stmt = $conn->prepare($query);

    $stmt->execute([
        ':afbeelding' => $blob_image,
        ':naam' => $naam,
        ':uitleg' => $uitleg,
        ':categorie' => $categorie,
        ':ingredienten' => $ingredienten,
        ':stappen' => $stappen
    ]);


    header('Location: ./index.php');
    exit;


} catch (PDOException $e) {

    if ($destination !== null && file_exists($destination)) {
        unlink($destination);
    }

    echo "<h2>DATABASE ERROR:</h2>";
    echo htmlspecialchars($e->getMessage());

} catch (Throwable $e) {

    if ($destination !== null && file_exists($destination)) {
        unlink($destination);
    }

    echo "<h2>ERROR:</h2>";
    echo htmlspecialchars($e->getMessage());
}

