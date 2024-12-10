<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="{{ asset('imgs/favicon.ico') }}" sizes="any" type="image/x-icon">

    @vite([
        // CSS
        'resources/css/main/index.css',
        'resources/css/main/content/index.css',

        // JS
        'resources/js/main/carruselStuff.js',
        'resources/js/main/carousel.js',
    ])

    <title>WellWoman - Pagina Principal</title>
</head>

<body>
    {{-- Esto ya exporta el header de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.header')

    <main loading="lazy">
        <div class="portada">
            <div class="containerimagenabajo">
                <div class="image-wrapper">
                    <img loading="lazy" src="https://i.ibb.co/7zML6cv/main-girl.webp" alt="gifl-img">
                </div>

                <div class="text-carousel">
                    <span class="active">Bienvenid@ a WellWoman, Disfruta de tu estadia y usa toda las herramientas
                        disponibles.</span>
                    <span>Visita nuestros Foros, Encuentra tus productos favoritos y aprovecha nuestro calendario</span>
                    <span>No olvides que puedes contactarnos para buscar Ayuda</span>
                </div>
            </div>
        </div>

        <div class="carrusel-container">
            <p class="titleMain">Productos Destacados</p>

            <div class="carrusel">
                <div class="carru-imgs">
                    <img loading="lazy" src="https://i.ibb.co/nQ2Xywm/carru-img1.webp" alt="carru-img1" class="active">
                    <img loading="lazy" src="https://i.ibb.co/cTQfD5N/carru-img2.webp" alt="carru-img2">
                    <img loading="lazy" src="https://i.ibb.co/rHgrndf/carru-img3.webp" alt="carru-img3">
                </div>
                <div class="carrusel-bts">
                    <button class="carru-button" id="carousel-button-l">&#10094;</button>
                    <button class="carru-button" id="carousel-button-r">&#10095;</button>
                </div>
            </div>
        </div>

        <div class="products-container">
            <p class="titleMain">Otros Productos</p>

            <div class="products">
                <div class="item-product">
                    <p>Mas vendido</p>
                    <img loading="lazy" src="https://i.ibb.co/4NJthB2/product1.webp" alt="img1_product">
                </div>
                <div class="item-product">
                    <p>Más Votaciones</p>
                    <img loading="lazy" src="https://i.ibb.co/wYfgfBb/product2.webp" alt="img2_product">
                </div>
                <div class="item-product">
                    <p>Más Comprado</p>
                    <img loading="lazy" src="https://i.ibb.co/HqvpTKP/product3.webp" alt="img3_product">
                </div>
                <div class="item-product">
                    <p>Recomendado de la semana</p>
                    <img loading="lazy" src="https://i.ibb.co/27Vvd2X/product4.webp" alt="img4_product">
                </div>
            </div>
        </div>

        <div class="carouseli-container">
            <div class="carouseli">
                <div class="carouseli-images">
                    <h2>Puede ser de tu interés</h2>
                    <img src="https://vinculotic.com/wp-content/uploads/2021/06/Femtech-01-1021x580.jpg" alt="Imagen 1"
                        class="active">
                    <img src="https://www.flowww.com.mx/hubfs/Q22022%20Junio/M%C3%A9xico/Blog/tecnologias-industria-belleza.webp"
                        alt="Imagen 2">
                    <img src="https://www.abc.es/media/bienestar/2021/04/10/salud-mental-mujeres-k23F--1200x630@abc.jpeg"
                        alt="Imagen 3">
                </div>
                <button class="prev">&#10094;</button>
                <button class="next">&#10095;</button>
            </div>
            <div class="carouseli-text">
                <div class="carousel-caption" id="caption-1">
                    <h2>Tecnología al Servicio de la Salud Femenina</h2>
                    <p>La tecnología está revolucionando la salud de la mujer con herramientas como apps de seguimiento
                        menstrual, que ayudan a monitorear ciclos y detectar problemas. Dispositivos inteligentes
                        también aportan datos sobre ovulación, sueño y actividad física.</p>
                    <p>La telemedicina, por su parte, facilita consultas ginecológicas en línea, especialmente en zonas
                        con difícil acceso. Sin embargo, garantizar la privacidad de los datos sigue siendo un desafío
                        clave en esta revolución digital.</p>
                </div>
                <div class="carousel-caption" id="caption-2" style="display: none;">
                    <h2>Tecnología e Innovación en Cosméticos</h2>
                    <p>La industria cosmética avanza con tecnología que mejora la experiencia del consumidor. Apps de
                        realidad aumentada permiten probar productos virtualmente antes de comprarlos, y los
                        dispositivos inteligentes personalizan rutinas según el tipo de piel.</p>
                    <p>Además, los ingredientes sostenibles y las fórmulas científicas están transformando los
                        estándares, ofreciendo cosméticos más efectivos y respetuosos con el medio ambiente. La
                        innovación no solo está en la calidad, sino también en la forma en que los productos se adaptan
                        a las necesidades individuales.</p>
                </div>
                <div class="carousel-caption" id="caption-3" style="display: none;">
                    <h2>Cuidado de la Salud Mental</h2>
                    <p>El cuidado de la salud mental es clave para el bienestar femenino, especialmente frente a los
                        desafíos del día a día. Factores como el estrés laboral, las responsabilidades familiares y los
                        cambios hormonales pueden afectar el equilibrio emocional.</p>
                    <p>Es importante incluir prácticas como la meditación, el ejercicio físico y el descanso adecuado en
                        la rutina diaria. Además, hablar con profesionales de salud mental y apoyarse en redes de amigas
                        y familiares ayuda a fortalecer la resiliencia. Priorizar el autocuidado no es egoísmo, sino una
                        forma de asegurar bienestar integral.</p>
                </div>
            </div>
        </div>

        <div class="carta-container">
            <div class="carta">
                <div class="carta-border-top"></div>
                <div class="img">
                    <img src="https://i.redd.it/6i2fwuugx1f91.gif" alt="Harold's Image">
                </div>
                <span>Harold</span>
                <p class="job">Lider Super Dictador</p>

            </div>
            <div class="carta">
                <div class="carta-border-top"></div>
                <div class="img">
                    <img src="https://i.gifer.com/origin/f5/f5baef4b6b6677020ab8d091ef78a3bc_w200.gif"
                        alt="David's Image">
                </div>
                <span>David</span>
                <p class="job">Trabajador Explotado</p>

            </div>
            <div class="carta">
                <div class="carta-border-top"></div>
                <div class="img">
                    <img src="https://media.tenor.com/sL0lh-DBYzUAAAAM/uw-u-duck.gif" alt="Ronald's Image">
                </div>
                <span>Ronald</span>
                <p class="job">Lider Ejecutivo</p>

            </div>
            <div class="carta">
                <div class="carta-border-top"></div>
                <div class="img">
                    <img src="https://media.tenor.com/iQD0Y6C72FsAAAAM/duck-dance.gif" alt="Jhonatan's Image">
                </div>
                <span>Jhonatan</span>
                <p class="job">Espia Supervisor</p>

            </div>
        </div>
    </main>

    <div class="pato-secret">
        <button class="buttonPato">.</button>

        <img id="image" loading="lazy"
            src="https://i.gifer.com/origin/f5/f5baef4b6b6677020ab8d091ef78a3bc_w200.gif" alt="duck-gif">
    </div>

    {{-- Esto ya exporta el footer de forma automatica y asi no se repite codigo, y tambien esa es su forma de llamarlo, como si fuese una funcion. --}}
    @include('main.footer')

    <script src="{{ Vite::asset('resources/js/main/carousel.js') }}" defer></script>
</body>

</html>
