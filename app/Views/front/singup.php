<?php
    helper('form'); ?>

<div class="container registro">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="form-container">
					<h1>Registro de Usuario</h1>
					<?php form_open() ?>
						<div class="form-group">
							<label for="nombre">Nombre:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
						<div class="form-group">
							<label for="apellido">Apellido:</label>
							<input type="text" class="form-control" id="apellido" name="apellido" required>
						</div>
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
						<div class="form-group">
							<label for="contraseña">Contraseña:</label>
							<input type="password" class="form-control" id="contraseña" name="contraseña" required>
						</div>
						<div class="form-group">
							<label for="confirmar-contraseña">Confirmar Contraseña:</label>
							<input type="password" class="form-control" id="confirmar-contraseña" name="confirmar-contraseña" required>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Registrarse</button>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>