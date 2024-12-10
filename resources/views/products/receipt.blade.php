<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/products/index.css',
        'resources/css/products/receipt.css',
    ])

    <title>WellWoman - Recibo de Compra</title>
</head>

<body>
    {{-- Header reutilizable --}}
    @include('main.header')

    <main>
        <div class="receipt-container">
            <section class="receipt-header">
                <h2>¡Gracias por tu compra!</h2>
                <p>Tu pago ha sido procesado correctamente. Aquí tienes los detalles de tu compra:</p>
            </section>

            <section class="receipt-details">
                <h3>ID de la transacción:</h3>
                <p>{{ $factura->id }}</p>

                <h3>Creador del producto:</h3>
                <div class="creator-info">
                    <img src="{{ $factura->creador->profile_url }}" alt="Creator Icon" class="creator-icon">
                    <p>{{ $factura->creador->name }}</p>
                </div>

                <h3>Email del comprador:</h3>
                <p>{{ $factura->comprador->email }}</p>

                <h3>Fecha:</h3>
                <p>{{ \Carbon\Carbon::parse($factura->purchase_date)->format('d/m/Y H:i:s') }}</p>

                <h3>Subtotal:</h3>
                <p>${{ number_format($factura->subtotal, 2) }}</p>

                <h3>Total:</h3>
                <p>${{ number_format($factura->total, 2) }}</p>
            </section>

            <section class="receipt-products">
                <h3>Productos:</h3>
                <ul>
                    @foreach ($factura->productos as $producto)
                        <li class="product-item">
                            <div class="product-img">
                                <img src="{{ $producto->image_url }}" alt="product-img-{{ $producto->id }}">
                            </div>
                            <div class="product-info">
                                <h4>{{ $producto->name }}</h4>
                                <p>Cantidad: {{ $producto->pivot->quantity }}</p>
                                <p>Precio por unidad: ${{ number_format($producto->pivot->price, 2) }}</p>
                                <p>Total: ${{ number_format($producto->pivot->quantity * $producto->pivot->price, 2) }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </section>

            <section class="receipt-actions">
                <button onclick="window.print()">Imprimir Recibo</button>
                <a href="{{ route('shop.index') }}" class="btn btn-secondary">Regresar a la tienda</a>
            </section>
        </div>
    </main>

    {{-- Footer reutilizable --}}
    @include('main.footer')
</body>

</html>
