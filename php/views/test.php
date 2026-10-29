<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/recepten.css">
    <title>Recepten</title>
</head>
<body>
<div class="cntr_main grid_parent">

    <!-- 1. Navigatie (leeg: navbar komt hier) -->
    <header class="grid_child">
        <span class="section_label">Navigatie</span>
    </header>

    <!-- 2. Filter -->
    <section class="grid_child">
        <span class="section_label">Filter</span>
        <div class="filter_buttons">
            <button type="button" data-filter="alles">alles</button>
            <button type="button" data-filter="vlees">vlees</button>
            <button type="button" data-filter="groenten">groenten</button>
            <button type="button" data-filter="veganistisch">veganistisch</button>
            <button type="button" data-filter="zeevruchten">zeevruchten</button>
            <button type="button" data-filter="varkensvlees">varkensvlees</button>
            <button type="button" data-filter="dessert">dessert</button>
            <button type="button" data-filter="glutenvrij">glutenvrij</button>
            <button type="button" data-filter="zuivelvrij">zuivelvrij</button>
            <button type="button" data-filter="ei-vrij">ei-vrij</button>
        </div>
    </section>

    <!-- 3. Kaartengrid -->
    <main class="grid_child">
        <span class="section_label"> </span>
        <div class="cards">
            
            <article class="card" data-tag="vlees">
                <div class="card_img"><img src="#" alt="Card Image"></div>
                <div class="card_body">
                    <span class="card_tag">vlees</span>
                    <h3>Naam van recept</h3>
                    <p>Korte omschrijving van het gerecht in één of twee zinnen.</p>
                </div>
            </article>

        </div>
    </main>

    <!-- 4. Footer -->
    <footer class="grid_child">
        <span class="section_label">Footer</span>
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