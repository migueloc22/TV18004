<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title></title>
</head>
<body>
	<?php 
        include "template/encabezado.php";
        if (!isset($_GET['id_mascota'])||$_GET['id_mascota']==0||$_GET['id_mascota']=='') {
            header('Location: MascotaPage.php');
        }
        $csMascota = array();
        $csMascota= $csLogica->consulta2("mascotas","WHERE id_mascota=".$_GET['id_mascota']);
        $id_mascota=$csMascota[0]['id_mascota'];
        $nombre=$csMascota[0]['nombre'];
        $peso=$csMascota[0]['peso'];
        $fecha_nac=$csMascota[0]['fecha_nac'];
		
		$consultaMarca = array();
		$filter="WHERE fk_id_TpMascotas IN(SELECT fk_id_tpMascotas FROM raza WHERE id_raza=".$csMascota[0]['fk_id_raza'].")";
		$consultaMarca= $csLogica->consulta2("marca",$filter); 
		$marca=$consultaMarca[0]['marca'];

		$consulta_dtCategoria = array();
		$filter="WHERE fk_idMarca =".$consultaMarca[0]['id_marca'];
		$consulta_dtCategoria= $csLogica->consulta2("categoria",$filter); 
		$categoria=$consulta_dtCategoria[0]['nombre'];
			
		$consultaDispensador = array();
		$consultaDispensador= $csLogica->consulta2("dispensador","WHERE fk_id_usuario=".$userSession[0]["id_usuario"]);    
		$dispensador = $consultaDispensador[0]['nombre'];	
		
		//$csProg = array();
		/*
    $filter="WHERE fk_id_mascota =".$csMascota[0]['id_mascota'];
		$consulta_cantidadDia= $csLogica->consulta2("programacion",$filter); 
		$CantidadDia = $consulta_cantidadDia[0]['cantidad_dia'];
		$filter="WHERE fk_id_usuario=".$userSession[0]["id_usuario"];
		$consultaMascota= $csLogica->consulta2("mascotas",$filter);*/
		$filter="WHERE fk_id_mascota =".$csMascota[0]['id_mascota'];
		$consulta_cantidadDia= $csLogica->consulta2("programacion",$filter); 
		$CantidadDia = $consulta_cantidadDia[0]['cantidad_dia'];

		$consulta_dtProgramacion = array();
		$consulta_dtProgramacion1 = array();
		$consulta_dtProgramacion2 = array();
		$consulta_dtProgramacion3 = array();
		$filter="WHERE fk_idMarca =".$consultaMarca[0]['id_marca'];
		$consulta_dtProgramacion= $csLogica->consulta2("categoria",$filter); 
		$filter="WHERE fk_id_categoria =".$consulta_dtProgramacion[0]['id_categoria'];
		$consulta_dtProgramacion1= $csLogica->consulta2("detalle_categoria",$filter); 
		$filter="WHERE fk_id_detalleCategoria =".$consulta_dtProgramacion1[0]['id_dt_categoria'];
		$consulta_dtProgramacion2= $csLogica->consulta2("programacion",$filter); 
		$filter="WHERE fk_id_programacion =".$consulta_dtProgramacion2[0]['id_programcion'];
		$consulta_dtProgramacion3= $csLogica->consulta2("detalle_programacion",$filter); 
		$porcion1=$consulta_dtProgramacion3[0]['porcion'];
		$hora1=$consulta_dtProgramacion3[0]['hora'];
		$porcion2=$consulta_dtProgramacion3[0]['porcion'];
		$hora2=$consulta_dtProgramacion3[0]['hora'];
		$porcion3=$consulta_dtProgramacion3[0]['porcion'];
		$hora3=$consulta_dtProgramacion3[0]['hora'];
		$porcion4=$consulta_dtProgramacion3[0]['porcion'];
		$hora4=$consulta_dtProgramacion3[0]['hora'];

							
	?>
	<script type="text/javascript">
		$('#lngInicio').attr('class','active');
	</script>
	<div class="container">
		<div style="height: 55px"></div>
		<div class="panel col-md-8 col-md-offset-2">
			<div class="panel-body">
				<h3 class="panel-heading text-center">Programación actual de tu CiPetS Feeder</h3>
				  <form action=""  method="post">
					  	<div class="col-md-12">
						  <label for="txt_nombre">Nombre</label>
						  <input type="text" name="txt_nombre" id="txt_nombre" value="<?php echo $nombre; ?>" class="form-control">
							<p>	</p>
						</div>
					  <div class="col-md-12">
						  <label for="txt_fecha_nac">Fecha de Nacimiento</label>
						  <input type="date" format="aaaa-mm-dd" name="txt_fecha_nac" id="txt_fecha_nac" value="<?php echo $fecha_nac; ?>" class="form-control">
							<p>	</p>
						</div>
					  	<div class="col-md-12">
						  <label for="txt_peso">Peso (en Kg)</label>
						  <input type="text" name="txt_peso" id="txt_peso" value="<?php echo $peso; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_marca">Marca de Alimento</label>
						  <input type="text" name="txt_marca" id="txt_marca" value="<?php echo $marca; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_categoria_marca">Categoría de Marca</label>
						  <input type="text" name="txt_categoria_marca" id="txt_categoria_marca" value="<?php echo $categoria; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_dispensador">Dispensador</label>
						  <input type="text" name="txt_dispensador" id="txt_dispensador" value="<?php echo $dispensador; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_dia">Porción de Alimento del Día</label>
						  <input type="text" name="txt_porcion_dia" id="txt_porcion_dia" value="<?php echo $peso; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_num_porciones">Número de Porciones</label>
						  <input type="text" name="txt_num_porciones" id="txt_num_porciones" value="<?php echo $peso; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_1">Porción 1</label>
						  <input type="text" name="txt_porcion_1" id="txt_porcion_1" value="<?php echo $porcion1; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_1">Hora Porción 1</label>
						  <input type="text" name="txt_hora_porcion_1" id="txt_hora_porcion_1" value="<?php echo $hora1; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_2">Porción 2</label>
						  <input type="text" name="txt_porcion_2" id="txt_porcion_2" value="<?php echo $porcion2; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_2">Hora Porción 2</label>
						  <input type="text" name="txt_hora_porcion_2" id="txt_hora_porcion_2" value="<?php echo $hora2; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_3">Porción 3</label>
						  <input type="text" name="txt_porcion_3" id="txt_porcion_3" value="<?php echo $porcion3; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_3">Hora Porción 3</label>
						  <input type="text" name="txt_hora_porcion_3" id="txt_hora_porcion_3" value="<?php echo $hora3; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_4">Porción 4</label>
						  <input type="text" name="txt_porcion_4" id="txt_porcion_4" value="<?php echo $porcion4; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_4">Hora Porción 4</label>
						  <input type="text" name="txt_hora_porcion_4" id="txt_hora_porcion_4" value="<?php echo $hora4; ?>" class="form-control">
							<p>	</p>
						</div>

					  	<div class="col-md-6">
							  <br>
							
							<input type="submit" class="btn btn-primary" name="btnAction" value="Editar Programación Actual">
							<?php
								if(isset($_POST['btnAction']))
								{
									$filter="WHERE fk_id_usuario=".$userSession[0]["id_usuario"];
									$consultaMascota= $csLogica->consulta2("mascotas",$filter);  
									$filter="WHERE fk_id_usuario=".$consultaMascota[0]["id_mascota"];
									$consultaMascota2= $csLogica->consulta2("mascotas",$filter);  
							 		//for ($i=0; $i <count($consultaMascota) ; $i++) { 
								 		 echo "<td>
										 <a href='CrearProgramacionPage.php?id_mascota=".$consultaMascota2[0]["id_mascota"]."' class='aling-center'><span class='glyphicon icon-defaul glyphicon-calendar' data-toggle='tooltip' title='".$consultaMascota2[0]["nombre"]."'></a>
										 </td>";
								 		 echo "</tr>";
							 		//} 
								}
							?>
						</div>
				  </form>
				  <div style="height: 500px"></div>
			</div>
		</div>
	  
	</div>
	<script>
        $(document).ready(function(){
            $("#cboxRaza").load("CargaDatos.php?id_tpMascota="+$("#cboxTpMascota").val()+'&Option=cargaRaza');
            $("#cboxTpMascota").change(function() {
                $("#cboxRaza").load("CargaDatos.php?id_tpMascota="+$("#cboxTpMascota").val()+'&Option=cargaRaza');
                });
        })
    </script>
	
	<?php 
		include "template/pie_pagina.php";
	?>
	<script>
			$(document).ready(function(){
    			$('[data-toggle="tooltip"]').tooltip(); 
			});
	</script>
</body>
</html>