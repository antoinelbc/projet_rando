
const mainNav = document.querySelector(".bar_container");

window.addEventListener("scroll", function() {
    mainNav.classList.toggle("sticky", window.scrollY > 128)
});

