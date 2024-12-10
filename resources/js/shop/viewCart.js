// @ts-nocheck
const btn = document.getElementById('cartBtnView');
const closeBtn = document.getElementById('btnDialogClose');

const dialogCart = document.getElementById('cartDialog');

const btnsRemoveItem = document.querySelectorAll('.cart-item-remove');
const notificationCart = document.querySelector('.notification-cart');

const continueBtn = document.querySelector('.cart-dialog-checkout');

const totalCartElement = document.querySelector('.cart-count');

document.addEventListener('DOMContentLoaded', () => {
    const cartCountElement = document.querySelector('.cart-count');

    if (parseInt(cartCountElement.textContent) == 0) {
        cartCountElement.style.display = 'none';
    };
});

btn?.addEventListener('click', event => {
    event.preventDefault();
    dialogCart.showModal();
});

closeBtn.addEventListener('click', () => {
    dialogCart.close();
});

btnsRemoveItem.forEach(btnClose => {
    btnClose.addEventListener('click', (e) => {
        const form = btnClose.closest('form');
        const action = form.action;
        const token = form.querySelector('input[name="_token"]').value;
        const cartItem = btnClose.closest('li');
        const cartList = document.getElementById('cartItems');
        const cartSubtotal = document.querySelector('.cart-subtotal span:last-child');
        let total = parseInt(totalCartElement.textContent);

        e.preventDefault();
        btnClose.disabled = true;
        notificationCart.style.display = 'block';
        cartItem.remove();

        updateCartList(cartList, cartSubtotal);

        if (total > 0) {
            total -= 1;
            totalCartElement.textContent = total;

            if (total == 0) {
                totalCartElement.style.display = 'none';
            }
        } else {
            totalCartElement.style.display = 'none';
        };

        setTimeout(() => {
            notificationCart.style.display = 'none';
        }, 7500);

        fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
            body: JSON.stringify()
        });
    });
});

/**
 * Funcion que actualiza y verifica el carrito.
 * @param {HTMLElement | null} cartList Lista de items
 * @param {HTMLElement | null} cartSubtotal Subtotal del precio
 * @returns {Void}
 */
function updateCartList(cartList, cartSubtotal) {
    let subtotal = 0;
    const items = cartList.querySelectorAll('li');

    console.log(items);

    if (items.length == 0) {
        cartList.innerHTML = '<li class="cart-empty">Tu carrito está vacío</li>';
        cartSubtotal.parentElement.style.display = 'none';
        continueBtn.remove();
    } else {
        items.forEach(item => {
            const price = parseFloat(item.querySelector('.cart-item-price').innerText.replace('$', '').replace(',', ''));
            const quantity = parseInt(item.querySelector('.cart-item-units').innerText.split(' ')[0]);
            subtotal += price * quantity;
        });

        cartSubtotal.innerText = '$' + subtotal.toFixed(2);
        cartSubtotal.parentElement.style.display = 'block';
    };
};
