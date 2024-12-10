// @ts-nocheck
// script.js

// Actualizar información personal
document.getElementById('personal-info-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;

    alert(`Información actualizada:\nNombre: ${name}\nCorreo: ${email}\nTeléfono: ${phone}`);
});

// Guardar configuración de perfil
document.getElementById('profile-settings-form').addEventListener('submit', (e) => {
    e.preventDefault();

    const newsletter = document.getElementById('newsletter').checked;
    const publicProfile = document.getElementById('public-profile').checked;

    alert(`Configuración guardada:\nBoletín informativo: ${newsletter ? 'Sí' : 'No'}\nPerfil público: ${publicProfile ? 'Sí' : 'No'}`);
});
