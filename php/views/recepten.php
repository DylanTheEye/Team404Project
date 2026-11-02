<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/recepten.css">
    <link rel="stylesheet" href="./includes/navigatiebalk/navigatiebalk.css">
    <title>Recepten</title>
</head>
<body>
<div class="cntr_main grid_parent">

    <!-- Navigatie -->
    <header class="grid_child">
        <header>
            <nav class="menu" aria-label="Hoofdnavigatie">
                <a href="recepten.html">Recepten</a>
<!--                <a href="meer.html">-->
<!--                    Meer <span class="arrow" aria-hidden="true"></span>-->
<!--                </a>-->
                <div class="dropdown">
                    
                </div>
            </nav>

            <form class="search" id="searchForm" role="search">
                <span class="search-icon" aria-hidden="true">⌕</span>

                <input type="search" id="searchInput" placeholder="Waar ben je naar op zoek?" aria-label="Zoek recepten">

                <button class="filter" id="filterButton" type="button" aria-label="Filter recepten">
                    ☷ Filteren
                    <span class="arrow" aria-hidden="true"></span>
                </button>
            </form>

            <div class="account">
                <a href="inloggen.html">Inloggen</a>
                <a href="registreren.html">Account aanmaken</a>
            </div>
        </header>

        <div class="message" id="message" aria-live="polite"></div>

        <script src="navigatiebalk.js"></script>
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
                <p><strong>E-mail</strong><br> 103608@glr.nl </p>
                <p><strong>Adres</strong><br> Heer Bokelweg 255,<br> 3032 AD Rotterdam </p>
                <p><strong>Telefoon</strong><br>06 123 45 67</p>
            </address>
        </div>
    </footer>

</div>
</body>
</html>