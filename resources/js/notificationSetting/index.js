// @ts-nocheck
document.getElementById('notifications-form').addEventListener('submit', (e) => {
    e.preventDefault();

    // Obtiene las preferencias
    const preferences = {
        email: document.getElementById('email-notifications').checked,
        sms: document.getElementById('sms-notifications').checked,
        push: document.getElementById('push-notifications').checked,
    };

    // Obtiene la frecuencia seleccionada
    const frequency = document.querySelector('input[name="frequency"]:checked').value;

    // Obtiene actividades seleccionadas
    const activities = {
        newPosts: document.getElementById('new-posts').checked,
        orderUpdates: document.getElementById('order-updates').checked,
        forumReplies: document.getElementById('forum-replies').checked,
    };

    console.log('Preferencias de notificaciones guardadas:', { preferences, frequency, activities });

    alert('Tu configuración de notificaciones ha sido guardada.');
});
