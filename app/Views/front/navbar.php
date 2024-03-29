
<!-- Navbar -->

    <?php 
        $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
        $persona = $session->get('id_persona');
    ?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-none fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo base_url('/')?>"><img
                src="<?php echo base_url('/assets/img/f9a6a9437f850c9aace8c28fc0df31a1.png')?>" alt="Logo" width="220"></a>
        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- ------------------------------- NAVBAR PARA ADMINISTRADOR  ------------------------------- -->

            <?php if ($perfil == '1') { ?>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNav" aria-labelledby="navbarNavLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-white">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url('/')?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/ventas')?>">Mis Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/crud_productos')?>">Crud Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/consulta_contactos')?>">Consultas</a>
                    </li>



                </ul>
                
                <form class="d-flex align-items-center">
                    <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url('assets/img/user-icon.png')?>" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end text-small" aria-labelledby="dropdownUser1" style="top: 150%;">
                        <li>
                        <p class="text-center"><?php echo "¡Bienvenido " . $nombre . "!" ?></p>
                        </li>
                        <li>
                        <a class="dropdown-item" href="<?php echo base_url('logout'); ?>" tabindex="-1" aria-disabled="true"><i class="nav-icon fa-solid fa-right-from-bracket"></i>Cerrar Sesión</a>
                        </li>
                    </ul>
                    </div>

                </form>
            </div>
        </div>


        <!-- ------------------------------- NAVBAR PARA CLIENTES  ------------------------------- -->

            <?php } else if ($perfil == '2') { ?>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNav" aria-labelledby="navbarNavLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-white">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url('/')?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/catalogo')?>">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('/ver_carrito') ?>">Carrito</a>
                    </li>
                    
                    



                </ul>
            

                    <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url('assets/img/user-icon.png')?>" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-lg-end text-small" aria-labelledby="dropdownUser1" style="top: 150%;">
                        <li>
                        <p class="text-center" style="background-color: #ffcc00; padding: 10px;"><?php echo "¡Hola " . $nombre . "!" ?></p>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo base_url('/miperfil') ?>"><i class="nav-icon"></i>Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('/ventas') ?>"><i class="nav-icon"></i>Mis Compras</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                        <a class="dropdown-item" href="<?php echo base_url('logout'); ?>" tabindex="-1" aria-disabled="true"><i class="nav-icon fa-solid fa-right-from-bracket"></i>Cerrar Sesión</a>
                        </li>
                    </ul>
                    </div>

                </form>
            </div>
        </div>
        


            <?php } else { ?>

        <!-- ------------------------------- NAVBAR PARA NO LOGEADOS  ------------------------------- -->
        <!-- Navbar  -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNav" aria-labelledby="navbarNavLabel">
            <div class="offcanvas-header">
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-white">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url('/')?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="<?php echo base_url('/catalogo')?>">Catalogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('contacto')?>">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('login')?>">Iniciar Sesion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('singup')?>">Registrarme</a>
                    </li>
                </ul>

            </div>
        </div>
        

        <?php } ?>

    </div>
</nav>