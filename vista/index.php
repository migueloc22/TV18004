<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--estilos-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<!--scrips-->
	<script type="text/javascript" src="vista/js/jquery.min.js"></script>
	<script type="text/javascript" src="vista/js/bootstrap.min.js"></script>
</head>
	<body style="background-color: #d8d7d7">
		<div class="container">
			<div class="row">
				<div style="height: 120px"></div>
				<div class="col-sm-4 col-sm-offset-7">
					<div class="panel" >
						<form method="POST" action="#">
							<div class="panel-body">
								<p class="text-center"><span class="glyphicon span glyphicon-user"></span></p>
								<h3 class="text-center">Login</h3>
								<legend></legend>
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-sm-12" for="usuario"><h4>Correo</h4></label>
										<div class="col-sm-10 col-sm-offset-1">
											<input type="email" id="usuario" name="txtUsuario" class="form-control input">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-12" for="usuario"><h4>Contraseña</h4></label>
										<div class="col-sm-10 col-sm-offset-1">
											<input type="password" id="usuario" name="txtUsuario" class="form-control input">
										</div>
									</div>				
									<div class="form-group">
										<a href="" class="aling-center">Registrar</a>
									</div>				
								</div>
							</div>
							<div class="panel-footer">
								<img src="">
								<?php
									if (isset($_POST['btn1'])) {
										header('Location: InicioPage.php');
									}
								  ?>
								<div class="form-group ">
									<input type="submit" class="btn btn-primary btn-md"  name="btn1" value="Entrar">
									<input type="reset" class="btn btn-default btn-md"  name="" value="limpiar">
								</div>
								
							</div>
						</form>
					</div><!---->
					
				</div>
			</div>
			
		</div>
		
		<?php 
			include "template/pie_pagina.php";
		?>
	</body>
</html>