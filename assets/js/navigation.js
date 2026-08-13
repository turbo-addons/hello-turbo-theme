/**
 * Turbo Theme Frontend Navigation.
 *
 * Mobile menu toggle, submenus, sticky header, off-canvas support.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        initMobileMenu();
        initSubMenus();
        initStickyHeader();
        initSearchToggle();
    });

    /**
     * Mobile menu toggle.
     */
    function initMobileMenu() {
        var toggle = document.querySelector('.turbo-menu-toggle');
        var nav = document.querySelector('.turbo-main-navigation');
        var menu = document.querySelector('#primary-menu');

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function () {
            var expanded = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!expanded));
            nav.classList.toggle('is-open');
            document.body.classList.toggle('turbo-mobile-menu-open');

            // Trap focus inside mobile menu when open.
            if (!expanded && menu) {
                var firstLink = menu.querySelector('a');
                if (firstLink) firstLink.focus();
            }
        });

        // Close on Escape.
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && nav.classList.contains('is-open')) {
                toggle.setAttribute('aria-expanded', 'false');
                nav.classList.remove('is-open');
                document.body.classList.remove('turbo-mobile-menu-open');
                toggle.focus();
            }
        });

        // Close when clicking outside.
        document.addEventListener('click', function (e) {
            if (nav.classList.contains('is-open') &&
                !nav.contains(e.target) &&
                !toggle.contains(e.target)) {
                toggle.setAttribute('aria-expanded', 'false');
                nav.classList.remove('is-open');
                document.body.classList.remove('turbo-mobile-menu-open');
            }
        });
    }

    /**
     * Submenu dropdown handling (keyboard + touch).
     */
    function initSubMenus() {
        var menuItems = document.querySelectorAll('.turbo-nav-menu .menu-item-has-children');

        menuItems.forEach(function (item) {
            var link = item.querySelector(':scope > a');
            var submenu = item.querySelector(':scope > .sub-menu');

            if (!link || !submenu) return;

            // Add dropdown arrow.
            var arrow = document.createElement('button');
            arrow.className = 'turbo-submenu-toggle';
            arrow.setAttribute('aria-expanded', 'false');
            arrow.setAttribute('aria-label', 'Toggle submenu');
            arrow.innerHTML = '<svg width="10" height="10" viewBox="0 0 10 10"><path d="M2 3.5L5 6.5L8 3.5" stroke="currentColor" stroke-width="1.5" fill="none"/></svg>';
            link.parentNode.insertBefore(arrow, submenu);

            // Toggle submenu on arrow click.
            arrow.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var isOpen = arrow.getAttribute('aria-expanded') === 'true';
                closeAllSubmenus(item.closest('.turbo-nav-menu'), item);
                arrow.setAttribute('aria-expanded', String(!isOpen));
                item.classList.toggle('submenu-open');
            });

            // Keyboard: open on Enter/Space on the arrow.
            arrow.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    arrow.click();
                }
            });

            // Desktop hover (only above mobile breakpoint).
            item.addEventListener('mouseenter', function () {
                if (window.innerWidth > getMobileBreakpoint()) {
                    item.classList.add('submenu-open');
                    arrow.setAttribute('aria-expanded', 'true');
                }
            });

            item.addEventListener('mouseleave', function () {
                if (window.innerWidth > getMobileBreakpoint()) {
                    item.classList.remove('submenu-open');
                    arrow.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }

    function closeAllSubmenus(menu, except) {
        if (!menu) return;
        menu.querySelectorAll('.submenu-open').forEach(function (item) {
            if (item !== except) {
                item.classList.remove('submenu-open');
                var btn = item.querySelector('.turbo-submenu-toggle');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    function getMobileBreakpoint() {
        var style = getComputedStyle(document.documentElement);
        var bp = style.getPropertyValue('--turbo-mobile-break');
        return bp ? parseInt(bp, 10) : 992;
    }

    /**
     * Sticky header.
     */
    function initStickyHeader() {
        var header = document.querySelector('.turbo-header');
        if (!header || !header.classList.contains('turbo-sticky')) return;

        var headerHeight = header.offsetHeight;
        var scrollThreshold = headerHeight;

        window.addEventListener('scroll', function () {
            if (window.scrollY > scrollThreshold) {
                header.classList.add('is-stuck');
                document.body.style.paddingTop = headerHeight + 'px';
            } else {
                header.classList.remove('is-stuck');
                document.body.style.paddingTop = '0';
            }
        }, { passive: true });
    }

    /**
     * Search icon toggle.
     */
    function initSearchToggle() {
        var searchToggle = document.querySelector('.turbo-search-toggle');
        var searchForm = document.querySelector('.turbo-header-search-form');

        if (!searchToggle || !searchForm) return;

        searchToggle.addEventListener('click', function () {
            searchForm.classList.toggle('is-visible');
            var input = searchForm.querySelector('input[type="search"]');
            if (input && searchForm.classList.contains('is-visible')) {
                input.focus();
            }
        });
    }

})();
