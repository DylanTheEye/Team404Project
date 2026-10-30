<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/recepten.css">
    <title>Recepten</title>
</head>
<body>
<div class="cntr_main grid_parent">

    <!-- Navigatie -->
    <header class="grid_child">
        <span class="section_label">Navigatie</span>
    </header>

    <!-- Filter -->
    <section class="grid_child">
        <span class="section_label">Filter</span>
        <div class="filter_buttons">
            <button type="button"> alles</button>
            <button type="button"> vlees</button>
            <button type="button" >groenten</button>
            <button type="button" >veganistisch</button>
            <button type="button" >zeevruchten</button>
            <button type="button" >varkensvlees</button>
            <button type="button" >dessert</button>
            <button type="button" >glutenvrij</button>
            <button type="button" >zuivelvrij</button>
            <button type="button" >ei-vrij</button>
        </div>
    </section>

    <!-- Card Grid  -->
    <main class="grid_child">
        <h2 class="section_label"> </h2>

<?php
  if ($amountRow > 0) { ?>
        <div class="cards">
            <?php foreach ($result as $row) { ?>
            <article class="card" <!--data-tag="vlees"-->
                <div class="card_img"> <img src="data:image/jpeg;base64, <?php echo base64_encode($row['Gerecht_img'])?>" alt="Card Image" id="card_img"></div>
                <div class="card_body">
                    <span class="card_tag"> <?= $row['Categorie_naam'] ?></span>
                    <a href="#"> <h3> <?= $row['Gerecht_naam'] ?> </h3> </a>
                    <p> <?= $row['Gerecht_uitleg'] ?> </p>
                    <p> </p>
                </div>
            </article>

            <?php } ?>
        </div>

<?php
  }
?>
    </main>

    <!-- Footer -->
    <footer class="grid_child">
        <h2 class="section_label">Footer</h2>
        <div class="footer_content">
<!--            <div class="footer_logo">Logo</div>-->
            <address class="footer_contact">
                <p><strong>E-mail</strong><br>info@voorbeeld.nl</p>
                <p><strong>Adres</strong><br>Voorbeeldstraat 12<br>1234 AB Plaatsnaam</p>
                <p><strong>Telefoon</strong><br>010 123 45 67</p>
            </address>
        </div>
    </footer>

</div>
</body>
</html>