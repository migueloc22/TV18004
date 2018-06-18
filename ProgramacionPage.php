<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php 
		include "template/encabezado.php";
	?>
	<script type="text/javascript">
		$('#lngInicio').attr('class','active');
	</script>
	<div class="container">
		<div style="height: 55px"></div>
		<div class="panel">
			<div class="panel-body">
				<h3 class="text-center">Programación</h3>
				<div class="col-md-offset-11">
					<a href="CrearProgramacionPage.php" class="">
						<div class="text-center icon-plus">
							<span class="glyphicon  glyphicon-plus"></span>
						</div>
					</a>
				</div>
				<div style="height: 500px"></div>
			</div>
		</div>
	  
	</div>
	
	
	<?php 
		include "template/pie_pagina.php";
	?>
</body>
</html>