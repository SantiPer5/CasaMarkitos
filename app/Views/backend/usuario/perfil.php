<?php 
        $session = session();
        $nombre = $session->get('nombre');
        $perfil = $session->get('perfil_id');
    ?>

<!--  protected $allowedFields = ['nombre', 'apellido', 'email', 'telefono', 'password', 'perfil_id', 'estado'];
} -->

<p>ID de Usuario: <?= $usuario['id_persona'] ?></p>

<section class="perfil">
    <div class="container">
        <div class="card editar-perfil-card">
            <!-- Aquí se mostrará el mensaje de flash data si está presente -->
                <?php if (session()->getFlashdata('mensaje_data')): ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashdata('mensaje_data') ?>
                    </div>
                <?php endif; ?>
            <div class="card-body">
                <div class="title">
                    <h1 class="mb-4">Editar Perfil</h1>
                    <form action="<?= base_url('/editarPerfil') ?>" method="post" enctype="multipart/form-data" class="editar-registro-container_form">
                        <!-- Mostrar mensaje flash de éxito si está presente -->
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Mostrar errores de validación -->
                        <?php if (isset($validation) && $validation->getErrors()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($validation->getErrors() as $error) : ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <h2>Datos de Perfil</h2>

                                <div class="form-group">
                                    <label for="name">Nombre/es</label>
                                    <input type="text" name="nombre" id="name" class="form-control" value="<?= $usuario['nombre'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="surname">Apellido</label>
                                    <input type="text" name="apellido" id="surname" class="form-control" value="<?= $usuario['apellido'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="phone">Número de celular</label>
                                    <input type="tel" name="telefono" id="phone" class="form-control" value="<?= $usuario['telefono'] ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h2>Datos adicionales</h2>
                                
                                <!-- <div class="form-group">
                                    <label for="rsocial">Razón Social</label>
                                    <input type="text" name="rsocial" id="rsocial" class="form-control" value="<?= $usuario['rsocial'] ?>">
                                </div> -->
                                
                                <div class="form-group">
                                    <label for="domicilio">Domicilio</label>
                                    <input type="text" name="domicilio" id="domicilio" class="form-control" value="<?= $usuario['domicilio'] ?>">
                                </div> 
                                
                                <div class="form-group">
                                    <label for="provincia">Provincia</label>
                                    <input type="text" name="provincia" id="provinicia" class="form-control" value="<?= $usuario['provincia'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="cpostal">Codigo Postal</label>
                                    <input type="text" name="cpostal" id="cpostal" class="form-control" value="<?= $usuario['cpostal'] ?>">
                                </div>

                                <!-- <div class="form-group">
                                    <label for="cuit">Número de Cuil/Cuit</label>
                                    <input type="text" name="cuit" id="cuit" class="form-control" value="<?= $usuario['cuit'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="condicioniva">Condicion de IVA</label>
                                    <input type="text" name="condicioniva" id="condicioniva" class="form-control" value="<?= $usuario['condicioniva'] ?>">
                                </div> -->
                            </div>
                        </div>

                        <div class="editar-registro-buttons text-center">
                            <input type="hidden" name="id_persona" value="<?= $usuario['nombre'] ?>">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                            <a href="<?php echo base_url('#'); ?>" class="btn btn-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
