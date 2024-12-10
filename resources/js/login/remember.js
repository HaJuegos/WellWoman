// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const checkRemember = document.getElementById('cbx-3');
    const nameInput = document.getElementById('nameinput');
    const passInput = document.getElementById('passinput');

    if (localStorage.getItem('isrememberinput') == 'true') {
        nameInput.value = localStorage.getItem('username') || '';
        passInput.value = localStorage.getItem('password') || '';
        checkRemember.checked = true;
    };

    const form = document.querySelector('form');

    form.addEventListener('submit', () => {
        if (checkRemember.checked) {
            localStorage.setItem('username', nameInput.value);
            localStorage.setItem('password', passInput.value);
            localStorage.setItem('isrememberinput', 'true');
        } else {
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.setItem('isrememberinput', 'false');
        };
    });

    checkRemember.addEventListener('change', () => {
        if (checkRemember.checked) {
            localStorage.setItem('username', nameInput.value);
            localStorage.setItem('password', passInput.value);
            localStorage.setItem('isrememberinput', 'true');
        } else {
            localStorage.removeItem('username');
            localStorage.removeItem('password');
            localStorage.setItem('isrememberinput', 'false');
        };
    });

    nameInput.addEventListener('input', () => {
        if (checkRemember.checked) {
            localStorage.setItem('username', nameInput.value);
        };
    });

    passInput.addEventListener('input', () => {
        if (checkRemember.checked) {
            localStorage.setItem('password', passInput.value);
        };
    });
});
