// @ts-nocheck
const calendarBtn = document.getElementById('calendar');
const shopBtn = document.getElementById('shop');
const searchBtn = document.getElementById('forums');
const userBtn = document.getElementById('user');
const logo = document.querySelector('.logo');

const dialogCalendar = document.getElementById('nologin');

document.addEventListener('DOMContentLoaded', () => {
    switch (pageID) {
        case 'shopPage': {
            const btn = document.getElementById('shop');

            btn.remove();
            logo.classList.add('offset3btns');
        } break;
        case 'profilePage': {
            const btn = document.getElementById('user');

            btn.remove();
            logo.classList.add('offset3btns');
        } break;
        case 'postPage': {
            const btn = document.getElementById('forums');

            btn.remove();
            logo.classList.add('offset3btns');
        } break;
        case 'calendarPage': {
            const btn = document.getElementById('calendar');

            btn.remove();
            logo.classList.add('offset3btns');
        } break;
    };

    if (isLogin) {
        userBtn.innerHTML = '<span class="material-symbols-outlined">account_circle</span>Mi Cuenta';
    };
});

logo.addEventListener('click', () => {
    window.location.href = mainPageVar;
});

calendarBtn?.addEventListener('click', (event) => {
    window.location.href = calendarPageVar;
});

shopBtn?.addEventListener('click', () => {
    window.location.href = shopPageVar;
});

searchBtn?.addEventListener('click', () => {
    window.location.href = forumsPageVar;
});

userBtn?.addEventListener('click', (event) => {
    if (isLogin) {
        window.location.href = myProfileVar;
    } else {
        window.location.href = userPageVar;
    };
});
