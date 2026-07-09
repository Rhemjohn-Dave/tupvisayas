/**
<<<<<<< HEAD
 * Admin UI: toast for flash messages, disclosure cleanup, sidebar groups.
=======
 * Admin UI: theme persistence, toast for flash messages, disclosure cleanup.
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
 */
(function () {
    "use strict";

<<<<<<< HEAD
=======
    var THEME_KEY = "adminTheme";

    function applyTheme(theme) {
        if (!document.body.classList.contains("admin")) return;
        if (theme === "dark") {
            document.body.setAttribute("data-theme", "dark");
        } else {
            document.body.setAttribute("data-theme", "light");
        }
    }

    function initTheme() {
        var stored = localStorage.getItem(THEME_KEY);
        if (stored === "dark" || stored === "light") {
            applyTheme(stored);
            return;
        }
        if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
            applyTheme("dark");
        } else {
            applyTheme("light");
        }
    }

    function toggleTheme() {
        var next =
            document.body.getAttribute("data-theme") === "dark" ? "light" : "dark";
        localStorage.setItem(THEME_KEY, next);
        applyTheme(next);
    }

>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    function flashToToast() {
        var el = document.querySelector("[data-admin-flash]");
        if (!el) return;
        var text = el.textContent.trim();
        if (!text) return;

        var toast = document.createElement("div");
        toast.className = "admin-toast";
        toast.setAttribute("role", "status");
        toast.textContent = text;
        document.body.appendChild(toast);

        el.setAttribute("hidden", "hidden");
        el.setAttribute("aria-hidden", "true");

        setTimeout(function () {
            toast.style.opacity = "0";
            toast.style.transition = "opacity 0.25s ease";
            setTimeout(function () {
                toast.remove();
            }, 260);
        }, 4200);
    }

    function closeDetailsOnOutsideClick() {
        document.addEventListener("click", function (e) {
            if (e.target.closest(".admin-disclosure")) return;
            document.querySelectorAll(".admin-disclosure[open]").forEach(function (d) {
                d.removeAttribute("open");
            });
        });
    }

    /**
     * Collapsible sidebar sections: chevron + aria + inert on panel when collapsed.
     */
    function initSidebarCollapsibleGroups() {
        if (!document.body.classList.contains("admin")) return;

        document.querySelectorAll("[data-sidebar-group]").forEach(function (group) {
            var btn = group.querySelector(".admin-sidebar__group-toggle");
            var inner = group.querySelector("[data-sidebar-group-panel-inner]");
            if (!btn || !inner) return;

            btn.addEventListener("click", function (e) {
                e.preventDefault();
                var expanded = !group.classList.contains("is-expanded");
                group.classList.toggle("is-expanded", expanded);
                btn.setAttribute("aria-expanded", expanded ? "true" : "false");
                if (expanded) {
                    inner.removeAttribute("inert");
                } else {
                    inner.setAttribute("inert", "");
                }
            });
        });
    }

    document.addEventListener("DOMContentLoaded", function () {
<<<<<<< HEAD
        if (document.body.classList.contains("admin")) {
            document.body.removeAttribute("data-theme");
            localStorage.removeItem("adminTheme");
=======
        initTheme();

        var themeBtn = document.getElementById("adminThemeToggle");
        if (themeBtn) {
            themeBtn.addEventListener("click", function () {
                toggleTheme();
            });
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        }

        flashToToast();
        closeDetailsOnOutsideClick();
        initSidebarCollapsibleGroups();
    });
})();
