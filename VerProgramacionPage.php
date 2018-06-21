<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
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

		$consultaDispensador = array();
		$consultaDispensador= $csLogica->consulta2("dispensador","WHERE fk_id_usuario=".$userSession[0]["id_usuario"]);    
		$dispensador = $consultaDispensador[0]['nombre'];	

		$csMascota = array();
		$csMascota= $csLogica->consulta2("mascotas","WHERE id_mascota=".$_GET['id_mascota']);

		
							
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
						</div>
					  <div class="col-md-12">
						  <label for="txt_fecha_nac">Fecha de Nacimiento</label>
						  <input type="date" format="aaaa-mm-dd" name="txt_fecha_nac" id="txt_fecha_nac" value="<?php echo $fecha_nac; ?>" class="form-control">
						</div>
					  	<div class="col-md-12">
						  <label for="txt_peso">Peso</label>
						  <input type="text" name="txt_peso" id="txt_peso" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_marca">Marca de Alimento</label>
						  <input type="text" name="txt_marca" id="txt_marca" value="<?php echo $marca; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_categoria_marca">Categoría de Marca</label>
						  <input type="text" name="txt_categoria_marca" id="txt_categoria_marca" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_dispensador">Dispensador</label>
						  <input type="text" name="txt_dispensador" id="txt_dispensador" value="<?php echo $dispensador; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_dia">Porción de Alimento del Día</label>
						  <input type="text" name="txt_porcion_dia" id="txt_porcion_dia" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_num_porciones">Número de Porciones</label>
						  <input type="text" name="txt_num_porciones" id="txt_num_porciones" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_1">Porción 1</label>
						  <input type="text" name="txt_porcion_1" id="txt_porcion_1" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_1">Hora Porción 1</label>
						  <input type="text" name="txt_hora_porcion_1" id="txt_hora_porcion_1" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_2">Porción 2</label>
						  <input type="text" name="txt_porcion_2" id="txt_porcion_2" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_2">Hora Porción 2</label>
						  <input type="text" name="txt_hora_porcion_2" id="txt_hora_porcion_2" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_3">Porción 3</label>
						  <input type="text" name="txt_porcion_3" id="txt_porcion_3" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_3">Hora Porción 3</label>
						  <input type="text" name="txt_hora_porcion_3" id="txt_hora_porcion_3" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_porcion_4">Porción 4</label>
						  <input type="text" name="txt_porcion_4" id="txt_porcion_4" value="<?php echo $peso; ?>" class="form-control">
						</div>
						<div class="col-md-12">
						  <label for="txt_hora_porcion_4">Hora Porción 4</label>
						  <input type="text" name="txt_hora_porcion_4" id="txt_hora_porcion_4" value="<?php echo $peso; ?>" class="form-control">
						</div>

					  	<div class="col-md-6">
							  <br>
							
							<input type="submit" class="btn btn-primary" name="btnAction" value="Editar Programación Actual">
							<?php
								if(isset($_POST['btnAction']))
								{
									header('Location: CrearProgramacionPage.php');
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
</body>
</html>