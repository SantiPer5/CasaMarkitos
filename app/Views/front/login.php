<div class="container mt-5 login">
	
    <div style=" top: 5%; z-index: 1;">
    <!--recuperamos datos con la función Flashdata para mostrarlos-->
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
    </div>
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header text-white text-center">
						<h4>Iniciar sesión</h4>
					</div>
					<div class="card-body">
						<!-- Formulario de inicio de sesion -->
						<form method="post" action="<?= base_url('login')?>">
							<div class="form-group">
								<label for="email">Correo electrónico:</label>
								<input type="email" class="form-control" id="email" name="email" required>
							</div>
							<div class="form-group">
								<label for="password">Contraseña:</label>
								<input type="password" class="form-control" id="password" name="password" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
						</form>
						<div class="text-center mt-3">
							<a href="#">¿Olvidó su contraseña?</a>
						</div>
						<div class="text-center mt-3">
							<a href="#">¿No tiene una cuenta? Regístrese aquí</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>