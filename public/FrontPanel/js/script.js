/*=============== CHANGE BACKGROUND HEADER ===============*/
const scrollHeader = () =>{
    const header = document.getElementById('header')
    // Add a class if the bottom offset is greater than 50 of the viewport
    this.scrollY >= 50 ? header.classList.add('scroll-header') 
                       : header.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)

/*=============== TESTIMONIAL SWIPER ===============*/
let testimonialSwiper = new Swiper(".testimonial-swiper", {
    spaceBetween: 30,
    loop: 'true',

    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

/*=============== SWIPER PRODUCTS ===============*/
let swiperProducts = new Swiper(".products__container", {
    spaceBetween: 32,
    grabCursor:true,
    centeredSlides: true,
    slidesPerView: 'auto',
    loop: true,

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    breakpoints: {
        
        1024: {
          spaceBetween: 72,
        },
    },
});

/*=============== SCROLL SECTIONS ACTIVE LINK ===============*/


/*=============== SHOW SCROLL UP ===============*/ 
// JavaScript
const scrollUp = () => {
    const scrollUp = document.getElementById('scroll-up')
    // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
    this.scrollY >= 500 ? scrollUp.classList.add('show-scroll')
                        : scrollUp.classList.remove('show-scroll');
}

window.addEventListener('scroll', scrollUp)

const scrollUpElement = document.getElementById('scroll-up');

scrollUpElement.addEventListener('click', function(e) {
    e.preventDefault();
    scrollUpElement.classList.toggle('show');
    const popup = document.getElementById('popup');
    popup.classList.toggle('show');
    setTimeout(function() {
        popup.classList.remove('show');
    }, 5000);
});

/*=============== DARK LIGHT THEME ===============*/ 
const themeButton = document.getElementById('theme-button');
const darkTheme = 'dark-theme';
const iconTheme = 'ri-sun-line';

// Check if dark theme is already enabled in local storage
let isDarkTheme = localStorage.getItem('darkTheme') === 'true';

// Set initial theme state
if (isDarkTheme) {
  document.body.classList.add(darkTheme);
  themeButton.classList.add(iconTheme);
} else {
  document.body.classList.remove(darkTheme);
  themeButton.classList.remove(iconTheme);
}

// Toggle theme on button click
themeButton.addEventListener('click', () => {
  document.body.classList.toggle(darkTheme);
  themeButton.classList.toggle(iconTheme);

  // Update local storage
  localStorage.setItem('darkTheme', document.body.classList.contains(darkTheme));
});

/*=============== SCROLL REVEAL ANIMATION ===============*/
const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2500,
    delay: 400,
})
sr.reveal(`.home__data, .products__container, .footer__container, .footer__info, `)
sr.reveal(`.home__images`, {delay: 600, origin: 'bottom'})
sr.reveal(`.new__card, .brand__img`, {interval: 100})
sr.reveal(`.collection__explore:nth-child(1)`, {origin: 'right'})
sr.reveal(`.collection__explore:nth-child(2)`, {origin: 'left'})


const counters = document.querySelectorAll('.info-box p');
const speed = 300; // adjust the speed of the animation

counters.forEach((counter) => {
  const target = parseInt(counter.getAttribute('data-target')); // get the actual count from data-target attribute
  let count = 0;
  let interval = setInterval(() => {
    if (count < target) {
      count += Math.ceil(target / speed);
      counter.textContent = count;
    } else {
      clearInterval(interval);
      counter.textContent = target;
    }
  }, 10); // adjust the interval time
});


let mixerPortfolio = mixitup('.work__container', {
  selectors: {
      target: '.work__card'
  },
  animation: {
      duration: 300
  }
});

/* Link active work */ 
const linkWork = document.querySelectorAll('.work__item')

function activeWork() {
  linkWork.forEach(L => L.classList.remove('active-work'))
  this.classList.add('active-work')
}

linkWork.forEach(L => L.addEventListener('click', activeWork))



/*=============== SWIPER TESTIMONIAL ===============*/
let swiperTestimonial = new Swiper(".testimonial__container", {
  spaceBetween: 24,
  loop:true,
  grabCursor:true,

 pagination: {
     el: ".swiper-pagination",
     clickable:true,
 },
 breakpoints: {
     576: {
       slidesPerView: 2,
     },
     768: {
       slidesPerView: 2,
       spaceBetween: 48,
     },
     
 },
})

/*=============== SERVICES MODAL ===============*/
const modalViews = document.querySelectorAll('.services__modal'),
      modalBtns = document.querySelectorAll('.services__button'),
      modalClose = document.querySelectorAll('.services__modal-close')

let modal = function(modalClick){
    modalViews[modalClick].classList.add('active-modal')
}  
modalBtns.forEach((mb, i) =>{
    mb.addEventListener('click', () =>{
        modal(i)
    })
})    

modalClose.forEach((mc) =>{
    mc.addEventListener('click', () =>{
        modalViews.forEach((mv) =>{
            mv.classList.remove('active-modal')
        })
    })
})

function toggleMenu() {
  var menu = document.getElementById("languageMenu");
  var isExpanded = menu.getAttribute('aria-hidden') === 'true';
  menu.style.display = isExpanded ? 'block' : 'none';
  menu.setAttribute('aria-hidden', !isExpanded);
  document.querySelector('.img-trans').setAttribute('aria-expanded', isExpanded);
}