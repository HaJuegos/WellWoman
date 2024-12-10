// @ts-nocheck
const adminStuff = document.querySelectorAll('#adminUsetsBtn');
const profileInput = document.querySelector('.profile-image');
const inputImg = document.getElementById('fileInput');
const form = document.getElementById('imageForm');
const badgeAdmin = document.getElementById('badgeAdmin');
const badgeVendor = document.getElementById('badgeVendor');
const logoutBtn = document.getElementById('logoutBtn');

const buttons = document.querySelectorAll(".profile-button:not(.logout, #adminUsetsBtn, #cycleBtn #privacityBtn #rememberBtn #infoBtn #helpmeBtn)");

const manageUsersBtn = document.getElementById('adminUsetsBtn');
const cycleBtn = document.getElementById('cycleBtn');

const privacityBtn = document.getElementById('privacityBtn');
const rememberBtn = document.getElementById('rememberBtn');
const infoBtn = document.getElementById('infoBtn');
const helpmeBtn = document.getElementById('helpmeBtn');

const sound = new Audio("https://github.com/HaJuegos/WellWoman/raw/refs/heads/main/ww_audios/error.ogg");
sound.preload = "auto";

document.addEventListener('DOMContentLoaded', () => {
    if (!rol.includes('Administrador')) {
        adminStuff.forEach(element => {
            element.remove();
        });

        badgeAdmin.remove();
    };

    if (!rol.includes('Vendedor')) {
        badgeVendor.remove();
    };
});

profileInput.addEventListener('click', () => {
    inputImg.click();
});

inputImg.addEventListener('change', () => {
    const file = inputImg.files[0];

    if (file) {
        const validTypes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'image/bmp', 'image/tiff', 'image/svg+xml', 'image/vnd.microsoft.icon',
            'image/heic', 'image/heif'
        ];

        if (!validTypes.includes(file.type)) {
            alert('Error: Tipo de archivo no válido. Por favor sube solo imágenes.');
        } else {
            form.submit();
        };
    };
});

logoutBtn.addEventListener('click', () => {
    window.location.href = logoutVar;
});

manageUsersBtn.addEventListener('click', () => {
    window.location.href = manageUsersVar;
});

cycleBtn.addEventListener('click', () => {
    window.location.href = settingsVar;
});

privacityBtn.addEventListener('click', () => {
    window.location.href = privacyVar;
});

rememberBtn.addEventListener('click', () => {
    window.location.href = notiVar;
});

infoBtn.addEventListener('click', () => {
    window.location.href = dataVar;
});

helpmeBtn.addEventListener('click', () => {
    window.location.href = helpVar;
});
