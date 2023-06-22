<section class="registro">
<!--recuperamos datos con la función Flashdata para mostrarlos-->

<?php $validation = \Config\Services::validation(); ?>
	<!-- Mostrar mensajes de exito -->
  <?php if (session()->getFlashdata('success')) {
        	echo " <div class='h4 text-center alert alert-info alert-dismissible' style='border-radius: 40px;'>
        	    <button type='button' class='btn-close' data-bs-dismiss='alert' style='font-size:1.2rem; color: red;'></button>" . session()->getFlashdata('success') . "
            	</div>";
    	}
		?>
	<!-- Mostrar mensajes de error -->
    <?php if (session()->getFlashdata('msg')) {
        	echo " <div class='h4 text-center alert alert-warning alert-dismissible' style='border-radius: 40px;'>
            	<button type='button' class='btn-close' data-bs-dismiss='alert' style='font-size:1.2rem; color: red;'></button>" . session()->getFlashdata('msg') . "
            	</div>";
    	}
    	?>

    

    <div class="registro-container">

        <form action="<?php echo (base_url('/enviar-form')) ?>" method="post" class="registro-container_form">

            <h2>Crea una cuenta</h2>
            
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


            <div class="registro-campo">
                <label for="name">Nombre/es</label>
                <input type="text" name="nombre" id="name" placeholder="Aa" value="<?= set_value('nombre') ?>"> 

            </div>

            <div class="registro-campo">
                <label for="surname" style="font-size: 12.8px;">Apellido</label>
                <input type="text" name="apellido" id="surname" placeholder="Aa" value="<?= set_value('apellido') ?>">
            </div>

            <div class="registro-campo">
                <label for="mail">Email</label>
                <input type="email" name="email" id="mail" placeholder="example@gmail.com" value="<?= set_value('email') ?>">
            </div>
            
            <div class="registro-campo">
                <label for="phone">Número de celular</label>
                <input type="tel" name="telefono" id="phone" placeholder="Num de celular sin 0 ni 15" value="<?= set_value('telefono') ?>">
            </div>

            <div class="registro-campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="*********">
            </div>

            <div class="registro-campo">
                <label for="Cpassword">Confirmar contraseña</label>
                <input type="password" name="password_confirm" id="Cpassword" placeholder="*********">
            </div>

            <div class="registro-buttons">
                <input type="submit" value="Registrarme" class="button-form button-guardar">
                <input type="reset" value="Cancelar" class="button-form button-cancelar">
            </div>

            <p class="registro-pregunta">Ya tienes una cuenta? <a href="<?php echo base_url('login')?>"><b>Inicia sesión.</b></a></p>
        </form>

    </div>

    <p class="registro-parrafo">Al registrarte estás aceptando nuestros <a href="<?php echo base_url('terminos') ?>"><b>Términos de Usos.</b></a></p>
</section>