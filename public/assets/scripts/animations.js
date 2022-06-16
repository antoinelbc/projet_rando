// Slide-left on scroll

const scrollOffset = 200;
const scrollElement = document.querySelector(".js-scroll");
 
const elementInView = (el, offset = 0) => {
  const elementTop = el.getBoundingClientRect().top;
 
  return (
    elementTop <= ((window.innerHeight || document.documentElement.clientHeight) - offset)
  );
};
 
const displayScrollElement = () => {
  scrollElement.classList.add('scrolled');
}
 
const handleScrollAnimation = () => {
  if (elementInView(scrollElement, scrollOffset)) {
      displayScrollElement();
  } 
}
 
window.addEventListener('scroll', () => {
  handleScrollAnimation();
})

// Fade-in on load

const homeTitle = document.querySelector(".home-title_container");
const homeSlogan = document.querySelector(".home-slogan_container");
const pricesCards = document.querySelector(".prices-card_container");

const fadeIn = () => {
    homeTitle.classList.add('visible');
    homeSlogan.classList.add('visible');
}


window.addEventListener('DOMContentLoaded', function () {
    fadeIn();
})
