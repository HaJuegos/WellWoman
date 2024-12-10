// @ts-nocheck
const addBtn = document.getElementById('addProductBtn');
const addBtn2 = document.querySelector('.noitems-submessage');
const cancelBtn = document.getElementById('canceladditem');
const dialogAdd = document.getElementById('addProductDialog');

const cancelBtnRemove = document.getElementById('cancelremoveitem');
const dialogRemove = document.getElementById('removeitem');

const dialogEdit = document.getElementById('editProductDialog');

const areaDialog1 = document.getElementById('addProductDialog');
const areaDialog2 = document.getElementById('editProductDialog');
const textareas = document.querySelectorAll('.editProduct-container textarea, .dialog-content textarea');

const searchInput = document.getElementById("searchInput");

const deletedBtn = document.querySelectorAll('.deletedBtn');
const btnsSubmit = document.querySelectorAll('.submit-btn, .editProduct-submit');

addBtn?.addEventListener('click', (event) => {
    event.preventDefault();
    dialogAdd?.showModal();
});

addBtn2?.addEventListener('click', (event) => {
    event.preventDefault();
    dialogAdd?.showModal();
});

cancelBtn?.addEventListener('click', () => {
    dialogAdd?.close();
});

cancelBtnRemove?.addEventListener('click', () => {
    dialogRemove?.close();
});

document.querySelectorAll('.delete-btn').forEach((btn) => {
    btn.addEventListener('click', (e) => {
        const productId = e.target.closest('.item-products').getAttribute('product-id');
        const form = document.querySelector('#removeitem form');

        if (form) {
            form.action = form.action.replace('id-placeholder', productId);
        };

        dialogRemove?.showModal();
    });
});

document.querySelectorAll('.cancelremoveitem').forEach((btn) => {
    btn.addEventListener('click', () => {
        const form = document.querySelector('#removeitem form');

        if (form) {
            form.action = form.action.replace(/\/\d+$/, '/id-placeholder');
        };

        dialogRemove?.close();
    });
});

document.querySelectorAll('.edit-btn').forEach((editBtn) => {
    editBtn.addEventListener('click', (event) => {
        event.preventDefault();
        const form = document.querySelector('#editProductDialog form');

        const product = event.target.closest('.item-products');
        const id = product.getAttribute('product-id');
        const name = product.querySelector('.description').textContent;
        const price = product.querySelector('.price').textContent.replace(/[^0-9]/g, '');
        const stock = product.querySelector('.stock').textContent.replace(/[^0-9]/g, '');
        const brand = product.getAttribute('product-brand');
        const category = product.getAttribute('product-category');
        const desc = product.getAttribute('product-desc');

        document.getElementById('edit-productId').value = id;
        document.getElementById('edit-productName').value = name;
        document.getElementById('edit-productPrice').value = price;
        document.getElementById('edit-productQuantity').value = stock;
        document.getElementById('edit-productCategory').value = category;
        document.getElementById('edit-productBrand').value = brand;
        document.getElementById('edit-productDesc').value = desc;

        if (form) {
            form.action = form.action.replace('id-placeholder', id);
        };

        dialogEdit.showModal();
    });
});

document.querySelectorAll('.canceladditem').forEach((btn) => {
    btn.addEventListener('click', () => {
        const form = document.querySelector('#editProductDialog form');

        if (form) {
            form.action = form.action.replace(/\/\d+$/, '/id-placeholder');
        };

        dialogEdit?.close();
    });
});

textareas.forEach(textarea => {
    textarea.addEventListener('focus', () => {
        textarea.style.height = '20cm';
        areaDialog1.style.height = '100%';
        areaDialog2.style.height = '100%';
    });

    textarea.addEventListener('blur', () => {
        textarea.style.height = '';
        areaDialog1.style.height = '';
        areaDialog2.style.height = '';
    });
});

btnsSubmit.forEach(btn => {
    btn.addEventListener('click', (event) => {
        const form = btn.closest('form');
        let isValid = true;

        form.querySelectorAll('input[required], textarea[required]').forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
            };
        });

        if (isValid) {
            btn.disabled = true;
            btn.innerHTML = 'Espera un momento...';

            form.submit();
        } else {
            event.preventDefault();
            alert("Por favor completa todo el formulario.");
        };
    });
});

deletedBtn.forEach(btn => {
    btn.addEventListener('click', (event) => {
        btn.disabled = true;
        btn.innerHTML = 'Espera un momento...';

        const form = btn.closest('form');

        if (form) {
            form.submit();
        };
    });
});

searchInput?.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
    };
});
