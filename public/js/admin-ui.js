/**
 * Admin UI: toast for flash messages, disclosure cleanup, sidebar groups.
 */
(function () {
    "use strict";

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
        if (document.body.classList.contains("admin")) {
            document.body.removeAttribute("data-theme");
            localStorage.removeItem("adminTheme");
        }

        flashToToast();
        closeDetailsOnOutsideClick();
        initSidebarCollapsibleGroups();
    });
})();
