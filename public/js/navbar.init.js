/**
 * Materialize inits for legacy pages (carousels, modals, etc.).
 * Public navigation uses site-nav.js instead of Materialize dropdowns.
 */
document.addEventListener("DOMContentLoaded", function () {
    var triggers = document.querySelectorAll(".dropdown-trigger");
    if (triggers.length && typeof M !== "undefined" && M.Dropdown) {
        M.Dropdown.init(triggers, {
            coverTrigger: false,
            constrainWidth: false,
            alignment: "left",
            hover: false,
        });
    }

    var sidenavs = document.querySelectorAll(".sidenav");
    if (sidenavs.length && typeof M !== "undefined" && M.Sidenav) {
        M.Sidenav.init(sidenavs, { edge: "left", draggable: true });
    }

    function closeSidenavDesktop() {
        if (window.innerWidth >= 992) {
            var el = document.getElementById("mobile-nav") || document.getElementById("mobile-sidenav");
            if (el && typeof M !== "undefined" && M.Sidenav) {
                var instance = M.Sidenav.getInstance(el);
                if (instance) instance.close();
            }
            var overlay = document.querySelector(".sidenav-overlay");
            if (overlay) overlay.remove();
            document.body.style.overflow = "";
        }
    }
    closeSidenavDesktop();
    window.addEventListener("resize", closeSidenavDesktop);
});
