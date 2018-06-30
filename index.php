<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
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
		<div style="height: 80px"></div>
			<div class="row">
				
				<div class="col-md-7">
					<img  src='img/logo3.png'>
					
					<p style="height: 120px"></p>
					<H1 style="color:white">
					<font face="Comic Sans MS"><b>Cuida la salud de tu mascota, controlando su cantidad de alimento</b></font></H1>
					
				</div>
				<div class="col-md-4">
				<p style="height: 40px"></p>
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
										<a href="CrearUserPage.php" class="aling-center">Regístrate</a>
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
											$msn="<div class='alert alert-success'>
                								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                								<strong>Bienvenido!</strong> Correo y contraseña son correctos.
              									</div>";
                							echo $msn;
										} else {
											$msn="<div class='alert alert-danger'>
                								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                								<strong>Error!</strong> Correo o contraseña son incorrectos.
              									</div>";
                							echo $msn;
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