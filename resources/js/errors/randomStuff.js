// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    randomImg();
    randomMsgError();
});

function randomImg() {
    const images = document.querySelectorAll('.gatillo');
    const randomIndex = Math.floor(Math.random() * images.length);
    images[randomIndex].classList.remove('hidden');
};

function randomMsgError() {
    const messages = [
        "¿Te has perdido?",
        "Supongo que no todo sale como esperas",
        "Ups... Llamen a Ha",
        "Missingno",
        "Espero y el error sea 404 y no otra cosa.",
        "Algo escribiste mal.",
        "Entonces, ¿Como va tu dia?",
        "LLegar aqui puede ser facil y dificil a la vez.",
        "Esta vez no hay un juego del dinosaurio.",
        "Si algo, fue culpa de git.",
        "David no termino la pagina.",
        "MySql no sirve.",
        "Reporta este bug en... no se.",
        "La responsividad deberia ser automatica.",
        "Laravel te amamos (no realmente).",
        "El equipo de futbol \"phpartisan\" tuvo que ser nerfeado por el bien de la trama.",
        "Todo fue culpa de Ha",
        "Ha nos obligo",
    ];
    const randomMessage = messages[Math.floor(Math.random() * messages.length)];
    const messageContainer = document.querySelector('.random-msg label');
    messageContainer.textContent = randomMessage;
};
