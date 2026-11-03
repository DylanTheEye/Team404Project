document.addEventListener('DOMContentLoaded', function () {
    var bar = document.getElementById('siteNavBar');
    var toggle = document.getElementById('siteNavToggle');
    if (!bar || !toggle) {
        console.warn('nav.js: #siteNavBar or #siteNavToggle not found - is the new navbar markup on this page?');
        return;
    }

    var dropdown = bar.querySelector('.site_nav__dropdown');
    var dropTrigger = bar.querySelector('.site_nav__drop_trigger');
    var MOBILE = window.matchMedia('(max-width: 900px)');

    function setMenu(open) {
        bar.classList.toggle('is_open', open);
        toggle.setAttribute('aria-expanded', String(open));
        toggle.setAttribute('aria-label', open ? 'Menu sluiten' : 'Menu openen');
    }

    function setDropdown(open) {
        if (!dropdown || !dropTrigger) return;
        dropdown.classList.toggle('is_open', open);
        dropTrigger.setAttribute('aria-expanded', String(open));
    }

    toggle.addEventListener('click', function () {
        setMenu(!bar.classList.contains('is_open'));
    });

    if (dropTrigger) {
        dropTrigger.addEventListener('click', function () {
            setDropdown(!dropdown.classList.contains('is_open'));
        });
    }

    // click outside closes the dropdown (desktop only)
    document.addEventListener('click', function (e) {
        if (dropdown && !MOBILE.matches && !dropdown.contains(e.target)) setDropdown(false);
    });

    document.addEventListener('keydown', function (e) {
        if (e.key !== 'Escape') return;
        setDropdown(false);
        if (MOBILE.matches) setMenu(false);
    });

    // switching between desktop and mobile layout: reset
    MOBILE.addEventListener('change', function () {
        setMenu(false);
        setDropdown(false);
    });
});