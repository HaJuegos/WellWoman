// @ts-nocheck
const element = document.querySelectorAll('.old-price');

document.addEventListener('DOMContentLoaded', () => {
    element.forEach(item => {
        const text = item.textContent.replace('$', '');

        if (Number(text) <= 0) {
            item.remove();
        };
    });
});
