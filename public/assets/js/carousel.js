let list = document.querySelector('.carousel-slider .carousel-list');
let items = document.querySelectorAll('.carousel-slider .carousel-list .item');
let dots = document.querySelectorAll('.carousel-slider .dots li');

let active = 0;
let itemLength = items.length;

let refreshInterval = setInterval(autoSlide, 3000);

function autoSlide() {
    active = (active + 1) % itemLength;
    reloadSlider();
}

function reloadSlider(){
    list.style.left = -items[active].offsetLeft + 'px';

    // Update active dot
    let last_active_dot = document.querySelector('.carousel-slider .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(autoSlide, 3000);
}

dots.forEach((li, key) => {
    li.addEventListener('click', ()=> {
        active = key;
        reloadSlider();
    });
});

window.onresize = function(event) {
    reloadSlider();
};