<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/products/index.css',
        'resources/css/products/main/index.css',

        // JS
        'resources/js/products/filters.js',
        'resources/js/products/dbEvents.js',
        'resources/js/products/addToCart.js',
    ])

    <title>WellWoman - Producto °{{ $product->id }} "{{ $product->name }}"</title>
</head>

<body>
    {{-- Header reutilizable --}}
    @include('main.header')

    <main>
        <div class="notifications" id="notifications" style="display: none;">
            <x-notification-success message="Se guardo el producto al carrito" subtext="Revisa la tienda" />
        </div>

        <div class="product-details-container">

            <section class="product-img-container">
                <div class="product-img">
                    <img src="{{ $product->image_url }}" alt="product-img{{ $product->id }}">
                </div>
            </section>

            <section class="product-content">
                <div class="product-name">
                    <h2>{{ $product->name }} </h2>
                </div>

                <div class="product-starts">
                    <span>4.9
                        <span class="material-symbols-outlined">
                            star_rate
                        </span>
                        <span class="material-symbols-outlined">
                            star_rate
                        </span>
                        <span class="material-symbols-outlined">
                            star_rate
                        </span>
                        <span class="material-symbols-outlined">
                            star_rate
                        </span>
                        <span class="material-symbols-outlined">
                            star_rate_half
                        </span>
                        (12)
                    </span>
                </div>

                <div class="product-price">
                    <h2 class="actual-price">${{ number_format($product->price) }}</h2>
                    <h2 class="old-price">${{ number_format($product->oldprice) }}</h2>
                </div>


                <div class="product-desc">
                    <p>{{ $product->description }}</p>
                </div>
            </section>

            <section class="product-btns">
                <div class="product-stock">
                    <h1>Stock disponible: {{ $product->stock }} unidad(es)</h1>
                    <form class="form-btn-addcart" action="{{ route('shop.startPaymentOne', ['id' => $product->id]) }}"
                        method="post">
                        @csrf

                        <button type="submit"> Comprar ahora </button>
                    </form>

                    @auth
                        <form id="addToCartForm" class="form-btn-addcart" action="{{ route('shop.addItemCart', ['id' => $product->id]) }}"
                            method="post">
                            @csrf
                            <button type="button" id="addcart"> Añadir al carrito </button>
                        </form>
                    @endauth

                    <div class="product-user">
                        <h1>Vendido por: <img
                                src="{{ !$userData ? 'https://i.ibb.co/gwMfpgz/icons8-usuario-femenino-en-c-rculo-100.webp' : $userData->profile_url }}"
                                alt="userpfp">
                            {{ !$userData ? '' : $userData->name }}
                        </h1>
                    </div>
                </div>

                <div class="product-methods">
                    <h1>Medios de pago</h1>

                    <p>Tarjetas de credito</p>
                    <div class="product-icons">
                        <i class="fa fa-cc-visa" style="font-size:36px"></i>
                        <i class="fa fa-cc-mastercard" style="font-size:36px"></i>
                    </div>

                    <p>Tarjetas de debito</p>
                    <div class="product-icons">
                        <i class="fa fa-credit-card" style="font-size:36px"></i>
                        <i class="fa fa-paypal" style="font-size:36px"></i>
                    </div>

                    <p>Efectivo</p>
                    <div class="product-icons">
                        <i class="fa fa-paypal" style="font-size:36px"></i>
                    </div>

            </section>
        </div>
    </main>

    {{-- Footer reutilizable --}}
    @include('main.footer')
</body>

</html>
