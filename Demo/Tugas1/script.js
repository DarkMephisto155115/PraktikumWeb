const hoverBackgrounds = {
    reverse: 'url("asset/BG/website_bg-reverse.jpg") no-repeat center center',
    wuwa: 'url("asset/BG/website_bg-ww.jpg") no-repeat center center',
    zzz: 'url("asset/BG/website_bg-zzz.jpg") no-repeat center center',
    honkai: 'url("asset/BG/website_bg-honkai.jpg") no-repeat center center',
    limbus: 'url("asset/BG/website_bg-limbus.jpg") no-repeat center center',
    cs: 'url("asset/BG/website_bg-cs.jpg") no-repeat center center',
    nikke: 'url("asset/BG/website_bg-nikke.jpg") no-repeat center center',
    tog: 'url("asset/BG/website_bg-tog.jpg") no-repeat center center',
    es: 'url("asset/BG/website_bg-es.jpg") no-repeat center center',
    afk: 'url("asset/BG/website_bg-afk.jpg") no-repeat center center',
};


const cards = document.querySelectorAll('.card');

cards.forEach(card => {
    card.addEventListener('mouseenter', () => {

        const parentDiv = card.parentElement;
        const matchingClass = Array.from(parentDiv.classList).find(cls => hoverBackgrounds[cls]);

        if (matchingClass) {

            document.body.style.setProperty('--before-bg', hoverBackgrounds[matchingClass]);
        }
    });
});


document.body.style.setProperty('--before-bg', hoverBackgrounds.reverse);




//navbar js
document.querySelector('a[href="#game-list"]').addEventListener("click", function (e) {
  e.preventDefault();

  const targetElement = document.querySelector("#all-games");

  if (targetElement) {
    const headerOffset = 100;
    const elementPosition = targetElement.getBoundingClientRect().top;
    const offsetPosition = elementPosition + window.scrollY - headerOffset;

    window.scrollTo({
      top: offsetPosition,
      behavior: "smooth"
    });
  } else {
    console.error("Target element '#all-games' not found.");
  }
});


document.querySelector('a[href="#about-us"]').addEventListener("click", function (e) {
    e.preventDefault();

    const targetElement = document.querySelector("#about-us");

    if (targetElement) {
      const headerOffset = 150;
      const elementPosition = targetElement.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.scrollY - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
      });
    }
});

document.querySelector('a[href="#our-service"]').addEventListener("click", function (e) {
    e.preventDefault();

    const targetElement = document.querySelector("#our-service");

    if (targetElement) {
      const headerOffset = 150;
      const elementPosition = targetElement.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.scrollY - headerOffset;

      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth"
      });
    }
});


// Responsive navbar
window.addEventListener("scroll", function () {
    var navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
        navbar.classList.remove("transparent");
    } else {
        navbar.classList.add("transparent");
        navbar.classList.remove("scrolled");
    }
});

const arrow = document.getElementById('arrowDown');


function animateArrow() {
    arrow.style.transition = 'transform 0.5s ease-in-out';
    arrow.style.transform = 'translateY(20px)';
    arrow.style.opacity = 0.3;


    setTimeout(() => {
        arrow.style.transform = 'translateY(0px)';
    }, 500);
}


setInterval(animateArrow, 1000);
