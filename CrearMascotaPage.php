<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
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
		<div class="panel col-md-8 col-md-offset-2">
			<div class="panel-body">
				<h3 class="panel-heading text-center">Registro de Mascota</h3>
				  <form action=""  method="post">
					  	<div class="col-md-12">
						  <label for="txt_nombre">Nombre</label>
						  <input required type="text" name="txt_nombre" id="txt_nombre" class="form-control">
						</div>
					  <div class="col-md-12">
						  <label for="txt_fecha_nac">Fecha de Nacimiento</label>
						  <input required type="date" format="aaaa-mm-dd" name="txt_fecha_nac" id="txt_fecha_nac" class="form-control">
						</div>
					  	<div class="col-md-12">
						  <label for="cbox_genero">Genero</label>
						  <select name="cbox_genero" id="cbox_genero" class="form-control">
									<option value="hembra">Hembra</option>
									<option value="macho">Macho</option>
							</select>
						</div>
					  	<div class="col-md-12">
						  <label for="txt_peso">Peso (en Kg)</label>
						  <input required type="number" name="txt_peso" id="txt_peso" class="form-control">
						</div>
					  	<div class="col-md-12">
						  <label for="cboxTpMascota">Tipo Mascota</label>
						  <select name="cboxTpMascota" id="cboxTpMascota" class="form-control">
								<?php
									$consultaTpMascota = array();
									$consultaTpMascota= $csLogica->consulta("tipomascota");    
									for ($i=0; $i <count($consultaTpMascota) ; $i++) { 
											echo "<option value='".$consultaTpMascota[$i] ["id_Mascotas"]."'>".$consultaTpMascota[$i] ["tpMascota"]."</option>";
									}
								?>
						  </select>
						</div>
					  	<div class="col-md-12">
						  <label for="cbox_raza">Raza</label>
						  <select name="cbox_raza" id="cbox_raza" class="form-control">
							  
						  </select>
						</div>
					  	<div class="col-md-6">
								<?php 
									if (isset($_POST['action'])) {
										$nombre=$_POST['txt_nombre'];
										$genero=$_POST['cbox_genero'];
										if ($_POST['cboxTpMascota']=="2") {
											$foto="perro.jpg";
										} else {
											$foto="gato.jpg";
										}
										$peso=$_POST['txt_peso'];
										$fecha_nac=date('Y/m/d',strtotime($_POST['txt_fecha_nac']));
										$fk_id_usuario=$userSession[0]["id_usuario"];
										$fk_id_raza=$_POST['cbox_raza'];
										// echo $fecha_nac;
										$csLogica->crearMascota($nombre,$genero,$foto,$peso,$fecha_nac,$fk_id_usuario,$fk_id_raza);
									}
									
								
								?>
						  <input  type="submit" class="btn btn-primary" name="action" value="Registrar">
						</div>
				  </form>
				  <div style="height: 500px"></div>
			</div>
		</div>
	  
	</div>
	<script>
        $(document).ready(function(){
            $("#cbox_raza").load("CargaDatos.php?id_tpMascota="+$("#cboxTpMascota").val()+'&Option=cargaRaza');
            $("#cboxTpMascota").change(function() {
                $("#cbox_raza").load("CargaDatos.php?id_tpMascota="+$("#cboxTpMascota").val()+'&Option=cargaRaza');
                });
        })
    </script>
	
	<?php 
		include "template/pie_pagina.php";
	?>
</body>
</html>