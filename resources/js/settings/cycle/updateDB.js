// @ts-nocheck
document.addEventListener('DOMContentLoaded', () => {
    const selectElements = document.querySelectorAll('#ciclo-selects, #regla-selects, #lutea-selects, #sleep-selects, #water-selects, #steps-selects, #weight-selects, #height-selects, #calories-selects');
    const checkElements = document.querySelectorAll('#pregnant-input');
    const dateInput = document.querySelectorAll('#lastPeriod');
    const form = document.querySelector('.form-container form');
    const csrfToken = document.querySelector('input[name="_token"]').value;
    const notification = document.getElementById('notification-card');
    const notificationContainer = document.getElementById('notification-container');

    const autoCheckData = () => {
        for (const [key, value] of Object.entries(cycleData)) {
            const element = document.querySelector(`[name="${key}"]`);
            if (element) {
                if (element.type == 'checkbox') {
                    element.checked = Boolean(value);
                } else if (element.tagName == 'SELECT' || element.tagName == 'INPUT') {
                    element.value = value;
                };
            };
        };
    };

    const sendData = async (data) => {
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                showNotification(result.message);
            };
        } catch {};
    };

    const showNotification = (message) => {
        if (notification) {
            notificationContainer.classList.remove('hidden');
            notification.style.opacity = 1;

            setTimeout(() => {
                notification.style.opacity = 0;
                setTimeout(() => {
                    notificationContainer.classList.add('hidden');
                }, 500);
            }, 6000);
        };
    };

    selectElements.forEach(element => {
        element.addEventListener('change', function () {
            const data = {
                [this.name]: this.value
            };
            sendData(data);
        });
    });

    checkElements.forEach(element => {
        element.addEventListener('change', function () {
            const data = {
                [this.name]: this.checked ? 1 : 0
            };
            sendData(data);
        });
    });

    dateInput.forEach(element => {
        element.addEventListener('change', function () {
            const data = {
                [this.name]: this.value
            };
            sendData(data);
        });
    });

    autoCheckData();
});
