
<?php 
        $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
    ?>

<main>
    
    
    <!-- Boton de wsp flotante-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://wa.link/scmdh4" class="float" target="_blank">
                <i class="fa fa-whatsapp my-float"></i>
        </a>


    <!-- Contenido principal -->
    <!-- ------------------------------- MAIN PARA ADMINISTRADOR  ------------------------------- -->

    <?php if ($perfil == '1') { ?>

<div class="admin-main">
    <div class="principal">
        <div class="container title-container">
            <h2><?php echo "¡Bienvenido administrador " . $nombre . "!" ?></h2>
        </div>

        <div class="container principal-main">
            <p><?php echo "¡Bienvenido " . $nombre . ". En esta sección puedes gestionar los productos y ofertas de nuestra empresa en la seccion CRUD PRODUCTOS, ver las consultas que te han enviado tus clientes en la pestaña CONSULTAS, y ver las ventas realizadas con sus respectivas facturas en el area de MIS VENTAS." ?></p>
        </div>
    </div>

    <!-- Imagen para admin -->
    <div class="text-center">
        <img src="<?php echo base_url("assets/img/main/19197281.jpg") ?>" alt="admin-icon" class="img-fluid mx-auto">
    </div>
</div>
        <!-- ------------------------------- MAIN PARA CLIENTES  ------------------------------- -->

        <?php } else if ($perfil == '2') { ?>
<div class="user-main">
            <!-- Carrousel -->
    <div id="carouselMainIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets\img\casamarkitoss.svg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="assets\img\promociones.svg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="assets\img\contactanos.svg" class="d-block w-100" alt="Imagen 3">
            </div>
        </div>
    </div> 

    <div class="principal">
        <div class="container title-container">
        <h2><?php echo "¡Hola " . $nombre . ", bienvenido a nuestro mayorista online!!" ?></h2>
        </div>

       <!--  <div class="container principal-main">
            <p>Bienvenido a nuestra empresa Casa Markitos. Somos una empresa familiar que se dedica a ofrecer una
            amplia variedad de productos para el hogar, la oficina y la vida cotidiana. Ofrecemos una amplia gama de
            productos, desde artículos de papelería y librería hasta productos de bazar y artículos para el hogar.</p>

            <p> Nuestro principal objetivo es ofrecer productos de alta calidad a precios competitivos para satisfacer las
            necesidades de nuestros clientes. Todos nuestros productos son seleccionados cuidadosamente y provienen de
            proveedores confiables y de renombre en la industria.</p>
        </div> -->
    </div>


    <!-- Carrousel productos -->
    <div class="ofertas">
        <div class="container title-container">
            <h3>NUESTRAS OFERTAS IMPERDIBLES!!!</h3>
        </div>
        
        <!-- Swiper -->
        <div class="container swiper">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-container mySwiper">

                <div class="swiper-wrapper">
                    <?php foreach ($productos as $producto): ?>
                        <?php if ($producto['categoria_id'] != 0 || $producto['estado'] == 0 || $producto['stock'] == 0) continue; ?>
                        <div class="swiper-slide">
                            <div class="card product-card">
                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="Imagen del producto">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $producto['nombre_prod']; ?></h4>
                                    <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?php echo base_url('catalogo') ?>" class="card-link">Ver en catalogo</a>
                                        <span class="card-price">$<?php echo $producto['precio']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>

    <?php } else { ?>

<!-- ------------------------------- MAIN PARA NO LOGEADOS  ------------------------------- -->
<div class="user-nolog">
    <!-- Carrousel -->
    <div id="carouselMainIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets\img\casamarkitoss.svg" class="d-block w-100" alt="Imagen 1">
            </div>
            <div class="carousel-item">
                <img src="assets\img\promociones.svg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="assets\img\contactanos.svg" class="d-block w-100" alt="Imagen 3">
            </div>
        </div>
    </div> 

    <div class="principal">
            <div class="container title-container">
                <h2>MAYORISTA ONLINE!</h2>
            </div>

            <div class="container principal-main">
                <p>Bienvenidos a nuestra página web, aquí podrán encontrar precios mayoristas de todos nuestros productos. Dirigiéndose a "Catálogo" encontrarán toda la lista con sus respectivos precios.
No olvides registrarte para poder llenar el carrito, ni tampoco de resolver tus dudas con el botón de WhatsApp, responderemos lo antes posible.</p>

                <p> CONSULTAR DESCUENTOS EXCLUSIVOS!!!</p>
            </div>
        </div>

    <!-- Carrousel productos -->
    <div class="ofertas">
        <div class="container title-container">
            <h3>SUPER OFERTAS IMPERDIBLES!!!</h3>
        </div>
        
        <!-- Swiper -->
        <div class="container swiper">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-container mySwiper">

                <div class="swiper-wrapper">
                    <?php foreach ($productos as $producto): ?>
                        <?php if ($producto['categoria_id'] != 0 || $producto['estado'] == 0 || $producto['stock'] == 0) continue; ?>
                        <div class="swiper-slide">
                            <div class="card">
                                <img src="<?php echo base_url() ?>/assets/uploads/<?php echo $producto['imagen']; ?>" class="card-img-top" alt="Imagen del producto">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $producto['nombre_prod']; ?></h4>
                                    <p class="card-text"><?php echo $producto['descripcion']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?php echo base_url('/catalogo') ?>" class="btn btn-success">Ver Productos</a>
                                        <span class="card-price">$<?php echo $producto['precio']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>

    <?php } ?>

    <!-- Envios -->
    

</main>