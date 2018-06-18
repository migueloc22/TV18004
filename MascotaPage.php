<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="UTF-8">
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
				<h3 class="panel-header text-center">Mascotas</h3>
				<div>
					<div class="col-md-offset-11">
						<a href="CrearMascotaPage.php" class="">
							<div class="text-center icon-plus">
								<span class="glyphicon  glyphicon-plus"></span>
							</div>
						</a>
					</div>
				</div> 
				<br>
				<?php 
					if (isset($_GET['action']) && isset($_GET['id_mascota'])) {
						$csLogica->eliminarMascotas($_GET['id_mascota']);
					}
				?>
				<br>
					<table class="table">
						<thead>
							<tr>
								<td>Foto</td>
								<td>Nombre</td>
								<td>Peso</td>
								<td>Fecha de Nacimiento</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
						<?php 
							$filter="WHERE fk_id_usuario=".$userSession[0]["id_usuario"];
					 		$consultaMascota= $csLogica->consulta2("mascotas",$filter);    
							 for ($i=0; $i <count($consultaMascota) ; $i++) { 
								 echo "<tr>";
								 echo "<td> <img class='img img-circle' style='height: auto; width: 50px;' src='img/".$consultaMascota[$i] ["foto"]."' alt='img/".$consultaMascota[$i] ["foto"]."'></td>";
								 echo "<td>".$consultaMascota[$i] ["nombre"]."</td>";
								 echo "<td>".$consultaMascota[$i] ["peso"]."</td>";
								 echo "<td>". date('d-m-Y',strtotime($consultaMascota[$i] ["fecha_nac"]))."</td>";
								 echo "<td>
										 <a href='ModificarMascotaPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-edit'></a>
										 <a href='CrearProgramacionPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-calendar'></a>
										 <a href='MascotaPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-eye-open'></a>										 
										 <a href='MascotaPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."&action=eliminar' class='aling-center'><span class='glyphicon icon-danger glyphicon-remove'></a>
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