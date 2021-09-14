// Useful scripts
// written in Vanilla JS


// 1. change on scroll
//    ultra-light alternative to wow.js and AOS
//    src: https://webdesign.tutsplus.com/tutorials/animate-on-scroll-with-javascript--cms-36671
const scrollElements = document.querySelectorAll(".-scroll");

const elementInView = (el, dividend = 1)   => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop <=
    (window.innerHeight || document.documentElement.clientHeight) / dividend
  );
};

const elementOutofView = (el) => {
  const elementTop = el.getBoundingClientRect().top;

  return (
    elementTop > (window.innerHeight || document.documentElement.clientHeight)
  );
};

const displayScrollElement = (element) => {
  element.classList.add("scrolled");
};

const hideScrollElement = (element) => {
  element.classList.remove("scrolled");
};

const handleScrollAnimation = () => {
  scrollElements.forEach((el) => {
    if (elementInView(el, 1.25)) {
      displayScrollElement(el);
    } else if (elementOutofView(el)) {
      hideScrollElement(el)
    }
  })
}

window.addEventListener("scroll", () => {
  handleScrollAnimation();
});



// 2. smoothscroll on clicking .-scroll-a
const links = document.querySelectorAll(".-scroll-a");

for (const link of links) { link.addEventListener("click", clickHandler); }

function clickHandler(e) {
  e.preventDefault();

  var href = this.getAttribute("href").split("#");

  const offsetTop = document.querySelector("#" + href[1]).offsetTop;

  scroll({
    top: offsetTop,
    behavior: "smooth"
  });

  const nextState = { additionalInformation: 'Updated Location with Javascript' };
  const nextTitle = href[1].charAt(0).toUpperCase() + href[1].slice(1);
  const nextURL = this.getAttribute("href");

  window.history.pushState(nextState, nextTitle, nextURL);
}
