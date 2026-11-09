<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header class="site_nav">
    <nav class="site_nav__bar" id="siteNavBar" aria-label="Hoofdnavigatie">

        <a class="site_nav__link site_nav__home"
           href="/ontkooking/Team404Project/index.php">Home</a>

        <div class="site_nav__dropdown">
            <button class="site_nav__link site_nav__drop_trigger"
                    type="button"
                    aria-haspopup="true"
                    aria-expanded="false">
                Meer <span class="site_nav__arrow" aria-hidden="true"></span>
            </button>

            <div class="site_nav__drop_content">
                <a href="/ontkooking/Team404Project/php/views/recepten.php">Recepten</a>
                <a href="/ontkooking/Team404Project/php/views/toevoeg.html">Toevoegen</a>
            </div>
        </div>

        <div class="site_nav__account">
            <?php if (isset($_SESSION['user_id'])): ?>

                <span>
                    Welkom,
                    <?= htmlspecialchars($_SESSION['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                </span>

                <a href="/ontkooking/Team404Project/logout.php">Uitloggen</a>

            <?php else: ?>

                <a href="/ontkooking/Team404Project/login.php">Inloggen</a>
                <a href="/ontkooking/Team404Project/register.php">Account aanmaken</a>

            <?php endif; ?>
        </div>

        <button class="site_nav__toggle"
                id="siteNavToggle"
                type="button"
                aria-expanded="false"
                aria-label="Menu openen">
            <span class="site_nav__burger" aria-hidden="true"></span>
        </button>

    </nav>

    <p class="site_nav__message" id="message" role="status"></p>
</header>
