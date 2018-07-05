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

				$marca= array();
				$consultaMarca = array();
				$categoria = array();

//CONSULTA NOMBRE DE MARCA			
		$filter1="LEFT JOIN  detalle_categoria on programacion.fk_id_detalleCategoria = detalle_categoria.id_dt_categoria LEFT JOIN  categoria on detalle_categoria.fk_id_categoria=categoria.id_categoria LEFT JOIN marca ON categoria.fk_idMarca=marca.id_marca where programacion.fk_id_mascota=".$csMascota[0]['id_mascota'];
		$consultaMarca= $csLogica->consulta2("programacion",$filter1); 
		$marca=$consultaMarca[count($consultaMarca)-1]['marca'];

//CONSULTA NOMBRE DE CATEGORIA
		$categoria=$consultaMarca[count($consultaMarca)-1]['nombre'];

//CONSULTA NOMBRE DE DISPENSADOR		
		$consultaDispensador = array();
		$consultaDispensador= $csLogica->consulta2("dispensador","WHERE fk_id_usuario=".$userSession[0]["id_usuario"]);    
		$dispensador = $consultaDispensador[0]['nombre'];	
	
	//CONSULTA CANTIDAD DÍA
		$porcion_dia= array();
		$porcion_dia=$consultaMarca[count($consultaMarca)-1]['cantidad_dia'];

	//CONSULTA PORCIONES Y HORAS
		$consulta_dtProgramacion = array();
		$consulta_dtProgramacion1 = array();
		$consulta_dtProgramacion2 = array();
		$consulta_dtProgramacion3 = array();
		$filter4="WHERE fk_idMarca =".$consultaMarca[0]['id_marca'];
		$consulta_dtProgramacion= $csLogica->consulta2("categoria",$filter4); 
		$filter5="WHERE fk_id_categoria =".$consulta_dtProgramacion[0]['id_categoria'];
		$consulta_dtProgramacion1= $csLogica->consulta2("detalle_categoria",$filter5); 
		$filter6="WHERE fk_id_detalleCategoria =".$consulta_dtProgramacion1[0]['id_dt_categoria'];
		$consulta_dtProgramacion2= $csLogica->consulta2("programacion",$filter6); 
		$filter7="WHERE fk_id_programacion =".$consulta_dtProgramacion2[0]['id_programcion'];
		$consulta_dtProgramacion3= $csLogica->consulta2("detalle_programacion",$filter7); 
		//Número de porciones	
		$num_porciones = $porcion_dia/($consulta_dtProgramacion3[0]['porcion']);
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
						  <label for="txt_peso">Peso</label>
						  <input type="text" name="txt_peso" id="txt_peso" value="<?php echo $peso; echo " Kg"; ?>" class="form-control">
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
						  <label for="txt_porcion_dia">Cantidad de Alimento del Día</label>
						  <input type="text" name="txt_porcion_dia" id="txt_porcion_dia" value="<?php echo $porcion_dia; echo " Gramos"; ?>" class="form-control">
							<p>	</p>
						</div>
						<div class="col-md-12">
						  <label for="txt_num_porciones">Número de Porciones al Día</label>
						  <input type="text" name="txt_num_porciones" id="txt_num_porciones" value="<?php echo $num_porciones; ?>" class="form-control">
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