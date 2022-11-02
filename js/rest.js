
var
    menu = document.getElementById("menu");
humberger = document.getElementById("humberger");
countiner = document.getElementById("countiner");
scroll_fun = document.getElementById("scroll-fun");
intro = document.getElementById("intro");
border1 = document.getElementById("border");
border12 = document.getElementById("border1-2");
border2 = document.querySelector(".border2");
search_bar = document.querySelector(".search-tab");


search_bar.onclick = () => {
    search_bar.classList.add('search_open');
    setTimeout(() => {
        search_bar.children[0].children[0].classList.add('input_open');
        search_bar.children[0].children[0].focus();
    }, 600)
}
search_bar.children[0].children[0].onblur = () => {
    search_bar.classList.remove('search_open');
    search_bar.children[0].children[0].classList.remove('input_open');
}
var x = true;
humberger.onclick = function () {
    if (x == true) {
        menu.classList.add("open2");
        humberger.classList.add("open");
        x = false;
    }
    else {
        menu.classList.remove("open2");
        humberger.classList.remove("open");
        x = true;
    }
}
var swiper = new Swiper('.swiper-container', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
        rotate: 5,
        stretch: -10,
        depth: 120,
        modifier: 2,
        slideShadows: true,
    },
    loop: true,
});

var logo = document.getElementById("logo");

window.onload = function () {
    countiner.classList.add("intro2");

}