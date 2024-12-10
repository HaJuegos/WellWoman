<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/shop/index.css',
        'resources/css/shop/main/index.css',

        'resources/css/shop/dialog/index.css',
        'resources/css/shop/dialog/cart.css',

        // JS
        'resources/js/shop/buttons.js',
        'resources/js/shop/filters.js',
        'resources/js/shop/adminStuff.js',
        'resources/js/shop/viewCart.js',
    ])

    <script>
        const roles = @json($roles);
    </script>

    <title>WellWoman - Tienda</title>

</head>

<body>
    @switch(session('session_type'))
        @case('itemSaved')
            <x-notification-success message="Se ha añadido el item a la tienda." subtext="Genial!" />
        @break

        @case('itemDeleted')
            <x-notification-success message="Se ha eliminado el item de la tienda." subtext="No te extrañaremos." />
        @break

        @case('itemEdited')
            <x-notification-success message="Se ha editado un item de la tienda." subtext="Un cambio de look no esta mal" />
        @break

        @case('noPurchase')
            <x-notification-success message="Se ha editado un item de la tienda." subtext="Un cambio de look no esta mal" />
        @break
    @endswitch

    {{-- Esto ya exporta el header de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.header')

    <main>
        <div class="notification-cart" style="display: none;">
            <x-notification-success message="Se ha eliminado un item del carrito" subtext="" />
        </div>

        <form>
            <div class="search-container">

                <h3 class="add-product-title">Agregar productos</h3>

                <button type="button" class="add-product-btn" id="addProductBtn">
                    <span class="material-symbols-outlined">
                        add
                    </span> Añadir un Producto
                </button>

                <label class="texto, search-label">Buscar:</label>
                <input type="text" id="searchInput" class="search-input" placeholder="Ingresa el producto"
                    name="search">

                <h3 class="texto">Por Categorías</h3>

                <aside class="sidebar">
                    <select id="categoryInput">
                        <option value="">Todos</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria }}"> {{ $categoria }}</option>
                        @endforeach
                    </select>
                </aside>
            </div>
        </form>

        <div class="products-container" id="productsContainer">
            <div class="products-header">
                <h2>Tienda</h2>

                @auth
                    <button class="cart-button" id="cartBtnView">
                        <span class="material-symbols-outlined">shopping_cart</span>
                        <span class="cart-count">{{ $totalCart }}</span>
                    </button>
                @endauth
            </div>

            <div class="products">
                @if (isset($noitems) && $noitems)
                    <div class="noitems">
                        <span class="noitems-message">Aún no hay items en la tienda</span>
                        <span class="noitems-submessage">¿Añadimos algunos?</span>
                        <img src="https://i.ibb.co/FJKbxrM/nkoworried.webp" alt="nkoworried" class="noitems-image">
                    </div>
                @else
                    @foreach ($productos as $producto)
                        <div class="item-products" product-id="{{ $producto->id }}"
                            product-category="{{ strtolower($producto->category) }}"
                            product-brand="{{ $producto->mark }}" product-desc="{{ $producto->description }}">
                            <a href="{{ route('shop.viewProduct', ['id' => $producto->id]) }}">

                                <div class="imgs">
                                    <img loading="lazy" src="{{ $producto->image_url }}"
                                        alt="product{{ $producto->id }}">
                                </div>

                                <div class="box-description">
                                    <p class="description">{{ $producto->name }}</p>
                                    <div class="prices">
                                        <p class="price">${{ number_format($producto->price, 0, ',', '.') }}</p>
                                        <p class="price oldprice">
                                            ${{ number_format($producto->oldprice, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <p class="stock">Articulos Disponibles: {{ $producto->stock }}</p>
                                </div>
                            </a>
                            <button type="button" class="edit-btn" id="editBtnItem"><span
                                    class="material-symbols-outlined"> edit </span></button>
                            <button type="button" class="delete-btn" id="deletedBtnItem"><span
                                    class="material-symbols-outlined"> delete </span></button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <dialog id="addProductDialog" class="dialogadd">
            <form action="{{ route('shop.getData') }}" method="POST" enctype="multipart/form-data"
                class="dialog-content" autocomplete="on">
                @csrf

                <h2>Añadir Producto</h2>

                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" placeholder="Nombre del producto" autofocus="on"
                    required>

                <label for="description">Descripción</label>
                <textarea id="description" name="description" placeholder="Descripción del producto" required></textarea>

                <label for="price">Precio (Sin decimales)</label>
                <input type="number" id="price" name="price" placeholder="Precio del Producto" min="0"
                    step="0.01" required>

                <label for="quantity">Cantidad</label>
                <input type="number" id="quantity" name="quantity" placeholder="Cantidad Stock del Producto"
                    min="0" required>

                <label for="quantity">Marca</label>
                <input type="text" id="brand" name="brand" placeholder="Marca del Producto" required>

                <label for="category">Categoría</label>
                <input type="text" id="category" name="category" placeholder="Categoria del Producto"
                    autofocus="on" required>

                <label for="image">Imagen del producto</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <div class="dialog-buttons">
                    <button type="button" id="canceladditem">Cancelar</button>
                    <button type="submit" class="submit-btn">Añadir Producto</button>
                </div>
            </form>
        </dialog>

        <dialog id="removeitem" class="dialogremove">
            <form action="{{ route('shop.removeItem', ['id' => 'id-placeholder']) }}" method="POST"
                class="removeitem-container">
                @csrf

                <h3>¿Estás seguro de que deseas eliminar este producto?</h3>

                <div class="removeitem-btns">
                    <button type="button" class="cancelremoveitem" id="cancelremoveitem">Cancelar</button>
                    <button type="submit" class="deletedBtn">Eliminar</button>
                </div>
            </form>
        </dialog>

        <dialog id="editProductDialog" class="dialogedit">
            <form action="{{ route('shop.editItem', ['id' => 'id-placeholder']) }}" method="post"
                enctype="multipart/form-data" class="editProduct-container" autocomplete="on">
                @csrf

                <h2>Editar Producto</h2>

                <label for="name">ID del Producto</label>
                <input type="number" id="edit-productId" name="id" placeholder="ID Unico del Producto"
                    readonly>

                <label for="name">Nombre</label>
                <input type="text" id="edit-productName" name="name" placeholder="Nombre del producto"
                    autofocus="on" required>

                <label for="description">Descripción</label>
                <textarea id="edit-productDesc" name="description" placeholder="Descripción del producto" required></textarea>

                <label for="price">Precio (Sin decimales)</label>
                <input type="number" id="edit-productPrice" name="price" placeholder="Precio del Producto"
                    min="0" step="0.01" required>

                <label for="quantity">Cantidad</label>
                <input type="number" id="edit-productQuantity" name="quantity"
                    placeholder="Cantidad Stock del Producto" min="0" required>

                <label for="quantity">Marca</label>
                <input type="text" id="edit-productBrand" name="brand" placeholder="Marca del Producto"
                    required>

                <label for="category">Categoría</label>
                <input type="text" id="edit-productCategory" name="category" placeholder="Categoria del Producto"
                    autofocus="on" required>

                <label for="image">Imagen del producto</label>
                <input type="file" id="image" name="image" accept="image/*">

                <div class="editProduct-buttons">
                    <button type="button" class="canceladditem" id="canceladditem">Cancelar</button>
                    <button type="submit" class="editProduct-submit">Editar Producto</button>
                </div>
            </form>
        </dialog>

        @auth
            <dialog id="cartDialog" class="cart-dialog">
                <h3>Resumen del Carrito</h3>

                <div class="cart-header">
                    <span class="cart-column-title">Nombre</span>
                    <span class="cart-column-title">Unidades</span>
                    <span class="cart-column-title">Precio</span>
                </div>

                <ul id="cartItems">
                    @if ($carrito->isEmpty())
                        <li class="cart-empty">Tu carrito está vacío</li>
                    @else
                        @php $subtotal = 0; @endphp

                        @foreach ($carrito as $producto)
                            @php $totalProducto = $producto->pivot->quantity * $producto->price; @endphp
                            @php $subtotal += $totalProducto; @endphp

                            <li id="cart-product-element">
                                <div class="cart-item-name">
                                    <img src="{{ $producto->image_url }}" alt="img-product" class="cart-item-image">
                                    <strong>{{ $producto->name }}</strong>
                                </div>
                                <div class="cart-item-units">{{ $producto->pivot->quantity }} unidades</div>
                                <div class="cart-item-price">${{ number_format($totalProducto, 2) }}</div>

                                <form action="{{ route('shop.removeItemCart', ['id' => $producto->id]) }}"
                                    method="post">
                                    @csrf

                                    <button type="button" class="cart-item-remove" id="cartItemRemoveBtn"><span
                                            class="material-symbols-outlined"> delete </span></button>
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>

                @if (!$carrito->isEmpty())
                    <div class="cart-subtotal">
                        <span><strong>Subtotal:</strong></span>
                        <span>${{ number_format($subtotal, 2) }}</span>
                    </div>
                @endif

                <div class="cart-dialog-footer">
                    <button class="cart-dialog-close" id="btnDialogClose">Cerrar</button>

                    @if (!$carrito->isEmpty())
                        <form class="form-btn-addcart" action="{{ route('shop.startPaymentMany') }}" method="post">
                            @csrf

                            <button type="submit" class="cart-dialog-checkout">Finalizar Compra</button>
                        </form>
                    @endif
                </div>
            </dialog>
        @endauth
    </main>

    {{-- Esto ya exporta el footer de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.footer')
</body>

</html>
