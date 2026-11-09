<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="./includes/navigatiebalk/navigatiebalk.js"></script>
    <link rel="stylesheet" href="/ontkooking/Team404Project/css/recepten.css">
    <link rel="stylesheet" href="/ontkooking/Team404Project/includes/navigatiebalk/nav.css">

    <title>Recepten</title>
</head>
<body>
<div class="cntr_main grid_parent">

    <!-- 1. Navigatie -->
    <section class="grid_child">
        <header class="site_nav">
            <nav class="site_nav__bar" id="siteNavBar" aria-label="Hoofdnavigatie">

                <a class="site_nav__link site_nav__home" href="index.php">Home</a>

                <div class="site_nav__dropdown">
                    <button class="site_nav__link site_nav__drop_trigger" type="button"
                            aria-haspopup="true" aria-expanded="false">
                        Meer <span class="site_nav__arrow" aria-hidden="true"></span>
                    </button>
                    <div class="site_nav__drop_content">
                        <a href="./index.php">Recepten</a>
                        <a href="/ontkooking/Team404Project/php/views/toevoeg.html">Toevoegen</a>
                    </div>
                </div>

                <form class="site_nav__search" id="searchForm" role="search">
                    <span class="site_nav__search_icon" aria-hidden="true">⌕</span>
                    <input class="site_nav__search_input" type="search" id="searchInput"
                           placeholder="Zoek recepten" aria-label="Zoek recepten">
                    <button class="site_nav__filter" id="filterButton" type="button" aria-label="Filter recepten">
                        ☷<span class="site_nav__filter_text"> Filteren</span>
                        <span class="site_nav__arrow" aria-hidden="true"></span>
                    </button>
                </form>

                <div class="site_nav__account">
                    <?php if (isset($_SESSION['user_id'])): ?>

                        <span>
            Welkom, <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
        </span>

                        <a href="logout.php">Uitloggen</a>

                    <?php else: ?>

                        <a href="login.php">Inloggen</a>
                        <a href="register.php">Account aanmaken</a>

                    <?php endif; ?>
                </div>

                <!-- hamburger button (only visible on tablet/mobile) -->
                <button class="site_nav__toggle" id="siteNavToggle" type="button"
                        aria-expanded="false" aria-label="Menu openen">
                    <span class="site_nav__burger" aria-hidden="true"></span>
                </button>

            </nav>
            <p class="site_nav__message" id="message" role="status"></p>
        </header>
    </section>

    <!-- 2. Filter -->
    <section class="grid_child">
        <span class="section_label">Filter</span>
        <div class="filter_buttons">
            <button type="button">alles</button>
            <button type="button">vlees</button>
            <button type="button">groenten</button>
            <button type="button">veganistisch</button>
            <button type="button">zeevruchten</button>
            <button type="button">varkensvlees</button>
            <button type="button">dessert</button>
            <button type="button">glutenvrij</button>
            <button type="button">zuivelvrij</button>
            <button type="button">ei-vrij</button>
        </div>
    </section>

    <!-- 3. Kaartengrid -->
    <main class="grid_child">
        <span class="section_label"> </span>
        <?php if ($amountRow > 0) { ?>
            <div class="cards">
                <?php foreach ($result as $row) { ?>
                    <article class="card">
                        <div class="card_img">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Gerecht_img']); ?>" alt="<?= htmlspecialchars($row['Gerecht_naam']) ?>">
                        </div>
                        <div class="card_body">
                            <span class="card_tag"><?= htmlspecialchars ($row['Categorie_naam']) ?></span>
                            <a href="./pages/detail.php?id=<?= $row['Gerecht _id'] ?>"><h3><?= htmlspecialchars($row['Gerecht_naam'] )?></h3></a>
                            <p><?= $row['Gerecht_uitleg'] ?></p>
                        </div>
                    </article>
                <?php } ?>
            </div>
        <?php } ?>
    </main>

    <!-- Footer -->
    <footer class="grid_child">
        <div class="footer_content">
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