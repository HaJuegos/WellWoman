// @ts-nocheck
const button = document.querySelector('.buttonPato');
const image = document.getElementById('image');
const pages = document.querySelectorAll('.carru-imgs img');
const buttonL = document.getElementById('carousel-button-l');
const buttonR = document.getElementById('carousel-button-r');
const texts = document.querySelectorAll('.text-carousel span');
let currentIndex = 0;
let currentPage = 0;

const sound = new Audio("https://github.com/HaJuegos/WellWoman/raw/refs/heads/main/ww_audios/duck.wav");
sound.preload = "auto";

document.addEventListener('DOMContentLoaded', () => {
    setInterval(() => {
        texts[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % texts.length;
        texts[currentIndex].classList.add('active');
    }, 7000);

    setInterval(() => changePage(1), 3000);

    button.addEventListener('click', () => {
        sound.play();

        image.style.opacity = 1;
        image.classList.add('animate');

        setTimeout(() => {
            image.style.opacity = 0;
        }, 2000);
    });

    buttonL?.addEventListener('click', () => {
        changePage(-1);
    });

    buttonR?.addEventListener('click', () => {
        changePage(1);
    });

    /**
   * Esta funcion cambia la visibilidad de las paginas del carrusel de imagenes.
   * @param {Number} index Numero de imagen a mostrar
   * @returns {Void}
   */
    function showPage(index) {
        pages[currentPage].classList.remove('active');
        currentPage = (index + pages.length) % pages.length;
        pages[currentPage].classList.add('active');
    };

    /**
     * Cambia la pagina del carrusel de imagenes
     * @param {Number} step Paso de cambio
     * @returns {Void}
     */
    function changePage(step) {
        showPage(currentPage + step);
    };

});
