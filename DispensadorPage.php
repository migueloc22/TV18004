<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title></title>
</head>
<body>
	<?php 
		include "template/encabezado.php";
	?>
	<script type="text/javascript">
		$('#lngDispensador').attr('class','active');
	</script>
	<div class="container">
		<div style="height: 55px"></div>
		<div class="panel">
			<div class="panel-body">
				<fieldset>
					<h3 class="panel-heading text-center">Registrar Dispensador</h3>
					<form action="" method="post">
						<div class="col-md-4">							
							<input required type="text" name="txt_nombre" id="txt_nombre" class="form-control" placeholder="Nombre" >
						</div>
						<div class="col-md-4">
							<input type="text" name="txt_serial" id="txt_serial" class="form-control" placeholder="Serial" required>
						</div>
						<div class="col-md-4">
							<?php
								if (isset($_GET['action']) && isset($_GET['id_dispensador'])) {
									switch ($_GET['action']) {
										case 'eliminar':
											echo "<a href='DispensadorPage.php' class='btn btn-danger'>Volver</a>";
											$csLogica->EliminarDispensador($_GET['id_dispensador']);
											break;
										case 'actualizar':
											echo "<input type='submit' class='btn btn-primary' name='btnAction' value='Actualizar'> ";
											echo "<a href='DispensadorPage.php' class='btn btn-danger'>Cancelar</a>";		
											$msn="<div class='alert alert-success'>
 								               <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        								        <strong>Actualizar Dispensador!</strong> Puedes editar Nombre y Serial del Dispensador seleccionado.
          									    </div>";
											echo $msn;
											
											if (isset($_POST['btnAction'])) {
												$csLogica->actualizarDispensador( $_POST['txt_nombre'], $_POST['txt_serial'],$_GET['id_dispensador']);
												header('Location: DispensadorPage.php');					
											}
											break;
										default:
											header('Location: DispensadorPage.php');
											break;
									}
								}
								else {
									echo "<input type='submit' class='btn btn-primary' name='btnAction' value='Registrar'>";
									if (isset($_POST['btnAction'])) {
										$csLogica->crearDispensador( $_POST['txt_nombre'], $_POST['txt_serial'],$userSession[0]["id_usuario"]);
									}
								}
							?>
						</div>
					</form>
				</fieldset>
				<h3 class="panel-heading text-center">Dispensadores</h3>
				<table class="table">
					<thead>
						<tr>
							<td>Nombre</td>
							<td>Serial</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php 
						$filter="WHERE fk_id_usuario=".$userSession[0]["id_usuario"];
						$consultaMascota= $csLogica->consulta2("dispensador",$filter);    
							for ($i=0; $i <count($consultaMascota) ; $i++) { 
								echo "<tr>";
								echo "<td>".$consultaMascota[$i] ["nombre"]."</td>";
								echo "<td>".$consultaMascota[$i] ["serial"]."</td>";
								echo "<td>
										<a href='DispensadorPage.php?action=actualizar&id_dispensador=".$consultaMascota[$i]["id_dispensador"]."&nombre=".$consultaMascota[$i]["nombre"]."&serial=".$consultaMascota[$i]["serial"]."' class='aling-center'><span class=' glyphicon icon-defaul glyphicon-edit'></a>
										<a href='DispensadorPage.php?action=eliminar&id_dispensador=".$consultaMascota[$i]["id_dispensador"]."' class='aling-center'><span class='glyphicon icon-danger glyphicon-remove'></a>
									</td>";
								echo "</tr>";
							} 
					?>
					</tbody>
				</table>
				<div style="height: 500px"></div>
			</div>
		</div>
	</div>
	
	
	<?php 
		include "template/pie_pagina.php";
	?>
</body>
</html>