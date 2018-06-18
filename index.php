<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--estilos-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<!--scrips-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<?php
		include "Logica.php";
		$csLogica=new Logica();
		if (isset($_GET['CerrarSession'])) {
			switch ($_GET['CerrarSession']) {
				case '1':
					session_destroy();
					break;
				
				default:
					# code...
					break;
			}
		}
		
		if (isset($_SESSION['user'])) {
			header("Location: MascotaPage.php");
		}
	?>
</head>
	<body class="body">
		<div class="container">
			<div class="row">
				<div style="height: 120px"></div>
				<div class="col-sm-4 col-sm-offset-7">
					<div class="panel caja" >
						<form method="POST" action="#">
							<div class="panel-body">
								<p class="text-center"><span class="glyphicon span glyphicon-user"></span></p>
								<h3 class="text-center">Login</h3>
								<legend></legend>
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-sm-12" for="usuario"><h4>Correo</h4></label>
										<div class="col-sm-10 col-sm-offset-1">
											<input type="email" id="txt_correo" name="txt_correo" class="form-control input">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-12" for="usuario"><h4>Contraseña</h4></label>
										<div class="col-sm-10 col-sm-offset-1">
											<input type="password" id="txt_pass" name="txt_pass" class="form-control input">
										</div>
									</div>				
									<div class="form-group">
										<a href="CrearUser.php" class="aling-center">Registrar</a>
									</div>				
								</div>
							</div>
							<div class="panel-footer">
								<img src="">
								<?php
									if (isset($_POST['btn1'])) {
										$correo=$_POST['txt_correo'];
										$pass=$_POST['txt_pass'];
										// echo $correo.$pass;
										if ($csLogica->SessionUser($correo,$pass)) {
											header('Location: MascotaPage.php');
											echo "Correo o cantraseña son correcto";
										} else {
											echo "Correo o cantraseña son incorrecto";
										}
										
									}
								  ?>
								<div class="form-group ">
									<input type="submit" class="btn btn-primary btn-md" required name="btn1" value="Entrar">
									<input type="reset" class="btn btn-default btn-md" required name="" value="limpiar">
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