// @ts-nocheck
const images = document.querySelectorAll(".carouseli-images img");
const captions = document.querySelectorAll(".carousel-caption");

let currentIndex = 0;

function changeSlide(direction) {
    // Ocultar la descripción actual
    captions[currentIndex].style.display = "none";

    // Cambiar la imagen activa
    images[currentIndex].classList.remove("active");

    // Calcular el nuevo índice
    currentIndex = (currentIndex + direction + images.length) % images.length;

    // Mostrar la nueva descripción
    captions[currentIndex].style.display = "block";

    // Cambiar la imagen activa
    images[currentIndex].classList.add("active");
}

// Asignar los eventos a los botones
document.querySelector(".prev").addEventListener("click", () => changeSlide(-1));
document.querySelector(".next").addEventListener("click", () => changeSlide(1));
