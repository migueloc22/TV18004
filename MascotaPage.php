<!DOCTYPE html>
<html>
<head lang="es">
	<meta http-equiv="Content-Type"content="text/html;charset=UTF-8"/>
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
						<a href="CrearMascotaPage.php" class="" data-toggle='tooltip' title='Agregar Mascota'>
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
								<td>Peso (Kg)</td>
								<td>Edad</td>  <!-- Fecha de Nacimiento -->
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
								 $fecha_nac =date('Y-m-d',strtotime($consultaMascota[0]['fecha_nac'])) ;
								$fecha_actual=date ("Y-m-d"); 
								$array_nacimiento = explode ( "-", $fecha_nac ); 
								$array_actual = explode ( "-", $fecha_actual ); 
								echo "<td>".$anos =  $array_actual[0] - $array_nacimiento[0]." años y ".$meses = $array_actual[1] - $array_nacimiento[1]." meses</td>"; // calculamos años y meses 
								//echo "<td>".$meses = $array_actual[1] - $array_nacimiento[1]." meses</td>"; // calculamos meses 
								$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días
								 
								 echo "<td>
										 <a href='ModificarMascotaPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-edit' data-toggle='tooltip' title='Editar'></a>
										 <a href='CrearProgramacionPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-calendar' data-toggle='tooltip' title='Programación'></a>
										 <a href='VerProgramacionPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-eye-open' data-toggle='tooltip' title='Visualización'></a>										 
										 <a href='MascotaPage.php?id_mascota=".$consultaMascota[$i]["id_mascota"]."&action=eliminar' class='aling-center'><span class='glyphicon icon-danger glyphicon-remove' data-toggle='tooltip' title='Eliminar'></a>
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
	<script>
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip(); 
			});
	</script>
	<?php 
		include "template/pie_pagina.php";
	?>
</body>
</html>