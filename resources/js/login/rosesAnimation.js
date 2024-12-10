const rosas = document.querySelectorAll('.rosa');

rosas.forEach(rosa => {
    rosa.addEventListener('click', () => {
        // @ts-ignore
        rosa.style.display = 'none';
    });
});