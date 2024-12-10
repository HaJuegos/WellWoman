// @ts-nocheck
document.addEventListener('DOMContentLoaded', function () {
    const addCartBtn = document.getElementById('addcart');
    const form = document.getElementById('addToCartForm');
    const token = form.querySelector('input[name="_token"]')?.value;
    const notification = document.getElementById('notifications');

    addCartBtn.addEventListener('click', function (event) {
        event.preventDefault();

        addCartBtn.textContent = 'Guardando...';
        addCartBtn.disabled = true;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({})
        }).then(response => {
            return response.json();
        }).then(data => {
            if (data.success) {
                notification.style.display = 'block';
                addCartBtn.textContent = 'Añadir al carrito';
                addCartBtn.disabled = false;

                setTimeout(() => {
                    notification.style.display = 'none';
                }, 7500);
            };
        });
    });
});
