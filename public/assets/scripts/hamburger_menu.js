const hamburgerMenu = document.querySelector(".hamburger-menu");
const hamburgerMenuItems = document.querySelectorAll(".hamburger-menu_item");
const hamburger = document.querySelector(".hamburger");
const closeIcon = document.querySelector(".close-icon");
const burgerIcon = document.querySelector(".burger-icon");
const toTheTop = document.querySelector(".to-the-top");

//Hamburger Menu

function toggleHamburgerMenu() {
    if (hamburgerMenu.classList.contains("showHamburgerMenu")) {
        hamburgerMenu.classList.remove("showHamburgerMenu");
        closeIcon.style.display = "none";
        toTheTop.style.display = "none";
        burgerIcon.style.display = "block";
    } else {
        hamburgerMenu.classList.add("showHamburgerMenu");
        closeIcon.style.display = "block";
        toTheTop.style.display = "block";
        burgerIcon.style.display = "none";
    }
}

hamburger.addEventListener("click", toggleHamburgerMenu);

hamburgerMenuItems.forEach(function (hamburgerMenuItem) {
    hamburgerMenuItem.addEventListener("click", toggleHamburgerMenu);
});

//To the top function

toTheTop.addEventListener("click", goToTheTop);

function goToTheTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
