
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-none fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="<?php echo base_url('/')?>"><img
                src="assets\img\f9a6a9437f850c9aace8c28fc0df31a1.png" alt="Logo" width="220"></a>
        <!-- Navbar Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
                            href="<?php echo base_url('quienessomos')?>">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('comercializacion')?>">Comprar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('contacto')?>">Contacto</a>
                    </li>
                </ul>
                <!-- SearchBar -->
                <form class="d-flex searchbar" role="search">
                    <input type="text" class="form-control border-0 rounded-pill me-2"
                        placeholder="Buscar productos...">
                    <button class="btn search-icon" type="button"><img
                            src="assets\img\buscar.png" alt="buscar"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</nav>