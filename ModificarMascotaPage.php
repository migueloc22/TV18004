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
        $csMascota= $csLogica->consulta("mascotas");
        $id_mascota=$csMascota[0]['id_mascota'];
        $nombre=$csMascota[0]['nombre'];
        $genero=$csMascota[0]['genero'];
        $foto=$csMascota[0]['foto'];
        $peso=$csMascota[0]['peso'];
        $fecha_nac=$csMascota[0]['fecha_nac'];
        $fk_id_raza=$csMascota[0]['fk_id_raza'];
        
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
						  <input type="text" name="txt_nombre" id="txt_nombre" value="<?php echo $nombre; ?>" class="form-control">
						</div>
					  <div class="col-md-12">
						  <label for="txt_fecha_nac">Fecha de Nacimiento</label>
						  <input type="date" format="aaaa-mm-dd" name="txt_fecha_nac" id="txt_fecha_nac" class="form-control">
						</div>
					  	<div class="col-md-12">
						  <label for="txt_genero">Genero</label>
						  <select name="" id="" class="form-control">
									<option  value="hembra">Hembra</option>
									<option value="macho">Macho</option>
							</select>
						</div>
					  	<div class="col-md-12">
						  <label for="txt_peso">Peso</label>
						  <input type="number" name="txt_peso" id="txt_peso" value="<?php echo $peso; ?>" class="form-control">
						</div>
					  	<div class="col-md-12">
						  <label for="txt_">Tipo Mascota</label>
						  <select  name="cboxTpMascota" id="cboxTpMascota" class="form-control">
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
						  <label for="txt_">Raza</label>
						  <select lang="es" name="cboxRaza" id="cboxRaza" class="form-control">
							  
						  </select>
						</div>
					  	<div class="col-md-6">
							  <br>
						  <input type="submit" class="btn btn-primary" value="Actualizar">
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