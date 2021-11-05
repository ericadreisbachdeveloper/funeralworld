// Vanilla Javascript
// minified with https://javascript-minifier.com/
// pasted to js/scripts.min.js
// which injects directly into footer.php

// custom scripts that require jQuery should be loaded
// via functions.php with cloudjquery as a dependency


// 1. Toggle nav
navtoggle = document.getElementById('navbar-toggle');
navmenu = document.getElementById('navmenu');

navtoggle.addEventListener('click', function(e){

  // the hamburger
  if (navmenu.classList.contains('show')) {
      navmenu.classList.remove('show');
      navmenu.setAttribute('aria-expanded', 'false');
    navtoggle.setAttribute('aria-expanded', 'false');
    navtoggle.classList.add('user-collapsed');
  }

  // the x
  else {
    navmenu.classList.add('show');
    navmenu.setAttribute('aria-expanded', 'true');
  navtoggle.setAttribute('aria-expanded', 'true');
  navtoggle.classList.remove('user-collapsed');
  }

});



// 2. Open and close mobile submenus by clicking .open-submenu-a carets
document.querySelectorAll('.open-submenu-a').forEach(item => {
  item.addEventListener('click', event => {

    if( item.classList.contains('mobile-show-submenu')) {
      item.classList.remove('mobile-show-submenu');
    }
    else {
      item.classList.add('mobile-show-submenu');
    }

  })
});



// 3. If viewing a child page
//    show its containing submenu on mobile by default
if (document.querySelector('.current-menu-item') ) {

  // a. get current page element - li
  var currentparent = document.querySelector('.current-menu-item').parentElement;
  var currentggparent = currentparent.parentElement.parentElement;
  var currentggggparent = currentggparent.parentElement.parentElement;

  // b. if current page is a top level menu element
  //    show subnav
  if ( currentparent.classList.contains('navbar-nav') ) {
    document.querySelector('.current-menu-item .open-submenu-a').classList.add('mobile-show-submenu');
  }

  // c. else if secondary menu element
  //    target parent li and show subnav
  else if ( currentggparent.classList.contains('navbar-nav')) {
    document.querySelector('.current-menu-ancestor .open-submenu-a').classList.add('mobile-show-submenu');
  }

  // d. else if tertiary menu element
  //    target grandparent li and show subnav
  else if ( currentggggparent.classList.contains('navbar-nav')) {
    document.querySelector('.current-menu-ancestor .open-submenu-a').classList.add('mobile-show-submenu');
  }

}




// 4.  Toggle search form on desktop
//     upon clicking magnifying glass icon in header
var displaysearch = document.querySelector('[href="#display-search"]');
var navsearch = document.getElementById('nav-search');

displaysearch.addEventListener('click', function(e){
  e.preventDefault();

  if ( displaysearch.getAttribute('aria-pressed') == 'false' ) {
    displaysearch.setAttribute('aria-pressed', 'true');
    navsearch.focus();
  }
  else {
    displaysearch.setAttribute('aria-pressed', 'false');
  }

});




// 5. Links in menu with id including the word "social" open in new window
document.querySelectorAll('[class*="menu"][id*="social-"] li a').forEach(sociallink => {
  sociallink.setAttribute('target', '_blank');
  sociallink.setAttribute('rel', 'noopener');
});



// 6. Clicking links that are strictly hash (href="#") does nothing
document.querySelectorAll('[href="#"]').forEach(link => {
  link.addEventListener('click', function(e){
    e.preventDefault();
  });
});



// 7. Wordpress login form
var loginform = document.getElementById('loginform');

if ( loginform )  {
  loginform.querySelectorAll('[for]').forEach(label => {
    var placeholder = label.innerHTML;
    var labelfor = label.getAttribute('for');
    label.classList.add('sr-only');

    document.getElementById(labelfor).setAttribute('placeholder', placeholder);
  });
}



// 8. Change on scroll
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
    } else if (elementOutofView(el, 1.25)) {
      hideScrollElement(el)
    }
  })
}

window.addEventListener("scroll", () => {
  handleScrollAnimation();
});
