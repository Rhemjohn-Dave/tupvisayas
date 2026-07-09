/**
 * Accessible primary navigation: desktop submenus + mobile drawer.
 */
(function () {
    "use strict";

    const drawer = document.getElementById("site-drawer");
    const overlay = document.getElementById("site-drawer-overlay");
    const toggleOpen = document.getElementById("site-nav-open");
    const toggleClose = document.getElementById("site-nav-close");
    const triggers = document.querySelectorAll("[data-site-submenu]");

    let openPanel = null;
    let lastFocus = null;
    let hoverCloseTimer = null;

    function isDesktop() {
        return window.innerWidth > 1080;
    }

    function setDrawerOpen(open) {
        if (!drawer || !overlay || !toggleOpen) return;
        drawer.classList.toggle("is-open", open);
        overlay.classList.toggle("is-open", open);
        toggleOpen.setAttribute("aria-expanded", open ? "true" : "false");
        overlay.setAttribute("aria-hidden", open ? "false" : "true");
        document.body.style.overflow = open ? "hidden" : "";
        if (open) {
            lastFocus = document.activeElement;
            const focusTarget = drawer.querySelector("a, button");
            if (focusTarget) focusTarget.focus();
        } else if (lastFocus && typeof lastFocus.focus === "function") {
            lastFocus.focus();
        }
    }

    function closeAllSubmenus() {
        clearTimeout(hoverCloseTimer);
        triggers.forEach(function (btn) {
            const id = btn.getAttribute("aria-controls");
            if (!id) return;
            const panel = document.getElementById(id);
            btn.setAttribute("aria-expanded", "false");
            if (panel) panel.hidden = true;
        });
        openPanel = null;
    }

    function openSubmenu(btn) {
        const id = btn.getAttribute("aria-controls");
        if (!id) return;
        const panel = document.getElementById(id);
        closeAllSubmenus();
        btn.setAttribute("aria-expanded", "true");
        if (panel) {
            panel.hidden = false;
            openPanel = panel;
        }
    }

    if (toggleOpen && drawer) {
        toggleOpen.addEventListener("click", function () {
            const open = !drawer.classList.contains("is-open");
            setDrawerOpen(open);
        });
    }

    if (toggleClose) {
        toggleClose.addEventListener("click", function () {
            setDrawerOpen(false);
        });
    }

    if (overlay) {
        overlay.addEventListener("click", function () {
            setDrawerOpen(false);
        });
    }

    triggers.forEach(function (btn) {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            const id = btn.getAttribute("aria-controls");
            const panel = id ? document.getElementById(id) : null;
            const isOpen = btn.getAttribute("aria-expanded") === "true";
            if (isOpen) {
                btn.setAttribute("aria-expanded", "false");
                if (panel) panel.hidden = true;
                openPanel = null;
            } else {
                openSubmenu(btn);
            }
        });

        const item = btn.closest(".site-nav__item");
        if (!item) return;

        item.addEventListener("mouseenter", function () {
            if (!isDesktop()) return;
            clearTimeout(hoverCloseTimer);
            openSubmenu(btn);
        });

        item.addEventListener("mouseleave", function () {
            if (!isDesktop()) return;
            hoverCloseTimer = setTimeout(closeAllSubmenus, 120);
        });
    });

    document.querySelectorAll(".site-nav__panel, .site-nav__mega").forEach(function (panel) {
        panel.addEventListener("mouseenter", function () {
            if (!isDesktop()) return;
            clearTimeout(hoverCloseTimer);
        });

        panel.addEventListener("mouseleave", function () {
            if (!isDesktop()) return;
            hoverCloseTimer = setTimeout(closeAllSubmenus, 120);
        });
    });

    document.addEventListener("click", function (e) {
        if (!openPanel) return;
        const t = e.target;
        if (
            t.closest("[data-site-submenu]") ||
            t.closest(".site-nav__panel") ||
            t.closest(".site-nav__mega")
        ) {
            return;
        }
        closeAllSubmenus();
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeAllSubmenus();
            if (drawer && drawer.classList.contains("is-open")) {
                setDrawerOpen(false);
            }
        }
    });

    window.addEventListener("resize", function () {
        if (isDesktop()) {
            setDrawerOpen(false);
        } else {
            closeAllSubmenus();
        }
    });

    if (drawer) {
        drawer.querySelectorAll("a[href]").forEach(function (link) {
            link.addEventListener("click", function () {
                setDrawerOpen(false);
            });
        });
    }
})();
