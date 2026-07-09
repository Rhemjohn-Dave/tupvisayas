/**
 * Homepage hero image rotation (when multiple carousel images exist).
 */
(function () {
    "use strict";

    const root = document.querySelector("[data-home-hero]");
    if (!root) return;

    const slides = root.querySelectorAll("[data-home-hero-slide]");
    const dots = root.querySelectorAll("[data-home-hero-dot]");
    const prevBtn = root.querySelector("[data-home-hero-prev]");
    const nextBtn = root.querySelector("[data-home-hero-next]");
    if (slides.length <= 1) return;

    let index = 0;
    let timer = null;
    const interval = 6000;

    function go(i) {
        index = (i + slides.length) % slides.length;
        slides.forEach(function (el, j) {
            el.classList.toggle("is-active", j === index);
        });
        dots.forEach(function (d, j) {
            d.setAttribute("aria-current", j === index ? "true" : "false");
        });
    }

    function next() {
        go(index + 1);
    }

    function prev() {
        go(index - 1);
    }

    function start() {
        stop();
        timer = setInterval(next, interval);
    }

    function stop() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    dots.forEach(function (dot, j) {
        dot.addEventListener("click", function () {
            go(j);
            start();
        });
    });

    if (prevBtn) {
        prevBtn.addEventListener("click", function () {
            prev();
            start();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", function () {
            next();
            start();
        });
    }

    root.addEventListener("mouseenter", stop);
    root.addEventListener("mouseleave", start);
    start();
})();
