document.addEventListener("DOMContentLoaded", function () {
    // Dropdowns: open below, not covering trigger, keep own width
    const dds = document.querySelectorAll(".dropdown-trigger");
    M.Dropdown.init(dds, {
        coverTrigger: false,
        constrainWidth: false,
        alignment: "left",
        hover: false,
    });

    // Sidenav for mobile only
    const sidenavs = document.querySelectorAll(".sidenav");
    M.Sidenav.init(sidenavs, { edge: "left", draggable: true });

    // On resize to desktop, force-close sidenav & remove overlay if present
    function closeSidenavDesktop() {
        if (window.innerWidth >= 992) {
            const instance =
                M.Sidenav.getInstance(document.getElementById("mobile-nav")) ||
                M.Sidenav.getInstance(
                    document.getElementById("mobile-sidenav")
                );
            if (instance) instance.close();
            const overlay = document.querySelector(".sidenav-overlay");
            if (overlay) overlay.remove();
            document.body.style.overflow = "";
        }
    }
    closeSidenavDesktop();
    window.addEventListener("resize", closeSidenavDesktop);

    // Mobile UX: only close sidenav on real navigation, not when toggling dropdowns
    var mobileId = document.getElementById("mobile-nav")
        ? "#mobile-nav"
        : "#mobile-sidenav";

    // Prevent sidenav from closing when tapping dropdown triggers inside it
    document
        .querySelectorAll(mobileId + " .dropdown-trigger")
        .forEach(function (trigger) {
            trigger.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                // Toggle dropdown programmatically to avoid default link behavior
                var inst = M.Dropdown.getInstance(this);
                if (!inst)
                    inst = M.Dropdown.init(this, {
                        coverTrigger: false,
                        constrainWidth: false,
                        alignment: "left",
                        hover: false,
                    });
                // Materialize doesn't expose isOpen; rely on open/close based on active class
                if (this.classList.contains("active")) {
                    inst.close();
                } else {
                    inst.open();
                }
            });
        });

    // Close sidenav when non-dropdown links are clicked
    document
        .querySelectorAll(mobileId + " a:not(.dropdown-trigger)")
        .forEach(function (a) {
            a.addEventListener("click", function () {
                const instance = M.Sidenav.getInstance(
                    document.querySelector(mobileId)
                );
                if (instance) instance.close();
            });
        });
});
