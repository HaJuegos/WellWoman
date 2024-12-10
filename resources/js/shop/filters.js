// @ts-nocheck
const addProductDialog = document.getElementById('addProductDialog');
const imageInput = document.getElementById('image');
const form = addProductDialog.querySelector('form');
const elements = document.querySelectorAll('.oldprice');

document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const categoryInput = document.getElementById('categoryInput');

    searchInput.addEventListener('input', filterSystem);
    categoryInput.addEventListener('change', filterSystem);

    elements.forEach(element => {
        const text = element.textContent.replace('$', '');

        if (Number(text) <= 0) {
            element?.remove();
        };
    });
});

form.addEventListener('submit', (e) => {
    const file = imageInput.files[0];
    if (file) {
        const validTypes = [
            'image/jpeg', 'image/png', 'image/gif', 'image/webp',
            'image/bmp', 'image/tiff', 'image/svg+xml', 'image/vnd.microsoft.icon',
            'image/heic', 'image/heif'
        ];

        if (!validTypes.includes(file.type)) {
            e.preventDefault();
            alert('Error: Tipo de archivo no valido. Por favor sube solo imagenes/gifs.');
        };
    };
});

/**
 * Funcion que filtra todos los elementos de la tienda para que se visualizen dependiendo si se escribe en el input o en filtro de categorias.
 * @returns {Void}
 */
function filterSystem() {
    const fixSearchInput = searchInput?.value?.toLowerCase() || '';
    const fixSelectCategoryInput = categoryInput?.value.toLowerCase() || '';

    document.querySelectorAll('.item-products').forEach(product => {
        const name = product.querySelector('.description')?.textContent?.toLowerCase() || '';
        const category = product.getAttribute('product-category')?.toLowerCase() || '';
        const matchName = name.includes(fixSearchInput);
        const mathCategory = !fixSelectCategoryInput || category == fixSelectCategoryInput;

        if (matchName && mathCategory) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        };
    });
};
