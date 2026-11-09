<?php
require_once __DIR__ . '/../config.php';

// Haal het recept-ID uit de URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Ongeldig recept-ID.');
}

// Zoek het recept in de database
$query = "SELECT * FROM post WHERE `Gerecht _id` = :id";

$stmt = $conn->prepare($query);
$stmt->execute(['id' => $id]);

$recept = $stmt->fetch();

if (!$recept) {
    http_response_code(404);
    exit('Recept niet gevonden.');
}

// Haal de bereidingsstappen uit de database
$stappen = preg_split('/\r\n|\r|\n/', $recept['Stappen']);

// Verwijder lege regels en overbodige spaties
$stappen = array_values(array_filter(
        array_map('trim', $stappen),
        fn($stap) => $stap !== ''
));
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="../css/detail.css">
</head>
<body>
<header></header>

<main>
    <div class="sections">
        <div class="left-section">
            <div class="white-boxy"></div>
            <h2 class="section-title">Materialen</h2>
            <div class="materials">
                <ul class="material-list">
                    <li>Pan</li>
                    <li>Snijplank</li>
                    <li>Mes</li>
                    <li>Houten lepel</li>

                </ul>
            </div>

            <hr>

            <div class="ingridients">
                <h2 class="section-title">Ingrediënten</h2>
                <ul class="ingridient-list">
                    <?php
                    $ingredienten = preg_split('/\r\n|\r|\n/', $recept['Ingredienten_lijst']);

                    foreach ($ingredienten as $ingredient) {
                        $ingredient = trim($ingredient);

                        if ($ingredient !== '') {
                            echo '<li>' . htmlspecialchars($ingredient) . '</li>';
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>

        <div class="right-section">

            <div class="recipe-overview">
                <div class="mainImage">
                    <img src="data:image/jpeg;base64,<?= base64_encode($recept['Gerecht_img']) ?>"
                         alt="<?= htmlspecialchars($recept['Gerecht_naam']) ?>"
                    >
                </div>

                <div class="recipe-info">
                    <h1 class="dish-name">
                        <?= htmlspecialchars($recept['Gerecht_naam']) ?>
                    </h1>

                    <div class="tags">

                        <div class="tinyIcon">
                            <img src="../assets/icons/clock.png" alt="">
                            <p>30 minuten</p>
                        </div>


                        <p class="difficulty">Makkelijk</p>

                        <div class="tinyIcon">
                            <img src="../assets/icons/people.png" alt="">
                            <p>2</p>
                        </div>

                        <div class="eyeIcon">
                            <img src="../assets/icons/eye.png" alt="">
                            <p>102</p>
                        </div>

                    </div>

                    <p class="description">
                        <?= nl2br(htmlspecialchars($recept['Gerecht_uitleg'])) ?>
                    </p>

                    <p class="light-text">dit recept is geüpload door:</p>
                    <div class="userCard">
                        <div class="userImage">
                            <img src="../assets/icons/pfp.jpg"
                                 alt="">
                        </div>
                        <p>Henk Jansen</p>
                    </div>

                    <div class="moreFromUser">
                        <p>Meer recepten van Henk Jansen:</p>
                        <div class="userRecipes">

                            <div class="userRecipeCard">
                                <div class="userRecipeImage">
                                    <img src="../assets/img/pasta.jpg" alt="">
                                </div>
                                <p>Spinazie pasta</p>
                            </div>

                            <div class="userRecipeCard">
                                <div class="userRecipeImage">
                                    <img src="../assets/img/pasta.jpg" alt="">
                                </div>
                                <p>Spinazie pasta</p>
                            </div>

                            <div class="userRecipeCard">
                                <div class="userRecipeImage">
                                    <img src="../assets/img/pasta.jpg" alt="">
                                </div>
                                <p>Spinazie pasta</p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <hr>

            <div class="bottom-section">
                <button class="save-button" aria-label="Recept bewaren">
                    <img src="../assets/icons/heart.png" alt="">
                </button>

                <button class="start-button">Start met koken</button>
            </div>

<!--            <div class="moreLikeThis">-->
<!--                <h2>Meer zoals dit</h2>-->
<!--                <div class="moreRecipes">-->
<!---->
<!--                    <div class="moreRecipeCard">-->
<!--                        <div class="moreRecipeImage">-->
<!--                            <img src="../assets/img/pasta.jpg" alt="">-->
<!--                        </div>-->
<!--                        <p>Spinazie pasta</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="moreRecipeCard">-->
<!--                        <div class="moreRecipeImage">-->
<!--                            <img src="../assets/img/pasta.jpg" alt="">-->
<!--                        </div>-->
<!--                        <p>Spinazie pasta</p>-->
<!--                    </div>-->
<!---->
<!--                    <div class="moreRecipeCard">-->
<!--                        <div class="moreRecipeImage">-->
<!--                            <img src="../assets/img/pasta.jpg" alt="">-->
<!--                        </div>-->
<!--                        <p>Spinazie pasta</p>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->

        </div>




    </div>

</main>
</body>
</html>