// @ts-nocheck
document.getElementById('save-button').addEventListener('click', () => {
    const cookies = document.getElementById('cookies').checked;
    const analytics = document.getElementById('analytics').checked;
    const visibility = document.querySelector('input[name="visibility"]:checked').value;
    const emailNotifications = document.getElementById('email-notifications').checked;
    const smsNotifications = document.getElementById('sms-notifications').checked;

    alert(`Ajustes guardados:
      - Cookies funcionales: ${cookies}
      - Cookies de análisis: ${analytics}
      - Visibilidad del perfil: ${visibility}
      - Notificaciones por correo: ${emailNotifications}
      - Notificaciones por SMS: ${smsNotifications}`);
});
