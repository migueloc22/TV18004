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
		$('#lngProgrmacion').attr('class','active');
	</script>
	<div class="container">
		<div style="height: 55px"></div>
		<div class="panel">
			<div class="panel-body">
				<h3 class="panel-heading">Calcular Alimento</h3>
				  <form action="" method="post">
					  	<div class="col-md-12">
						  <label for="cbox_marca">Marca</label>
						  <select name="cbox_marca" id="cbox_marca" class="form-control" >
							<?php
								$consultaMarca = array();
								$consultaMascotas= array();
								$consultaMascotas= $csLogica->consulta2("mascotas","WHERE id_mascota=".$_GET['id_mascota']);
								$filter="WHERE fk_id_TpMascotas IN(SELECT fk_id_tpMascotas FROM raza WHERE id_raza=".$consultaMascotas[0]['fk_id_raza'].")";
								$consultaMarca= $csLogica->consulta2("marca",$filter); 
								// echo $consultaMascotas[0]['nombre'];
								for ($i=0; $i <count($consultaMarca) ; $i++) { 
									echo "<option value='".$consultaMarca[$i] ["id_marca"]."'>".$consultaMarca[$i] ["marca"]."</option>";
								}
							?>
						  </select>
						</div>
					  	<div class="col-md-12">
						  <label for="cbox_categoria">Categoria</label>
						  <select name="cbox_categoria" id="cbox_categoria" class="form-control" >
							  
						  </select>
						</div>
					  	<div class="col-md-12">
						  <label for="">Dispensador</label>
						  <select name="" id="" class="form-control" >
							<option value="">ninguno</option>
							<?php
									$consultaDispensador = array();
									$consultaDispensador= $csLogica->consulta2("dispensador","WHERE fk_id_usuario=".$userSession[0]["id_usuario"]);    
									for ($i=0; $i <count($consultaDispensador) ; $i++) { 
											echo "<option value='".$consultaDispensador[$i] ["id_dispensador"]."'>".$consultaDispensador[$i] ["nombre"]."</option>";
									}
								?>
						  </select>
						</div>
					  	<div class="col-md-12">
						  <label for="cboxHora">N Porcion</label>
						  <select name="cboxHora" id="cboxHora" class="form-control">
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
						  </select>
						</div>
						<div class="col-md-12">
							
							<br>
							<input type="submit" name="btnCalcular" value="Calcular" class="btn btn-primary">
							<p>     
							</p>
						</div>
						<?php
							if (isset($_POST['btnCalcular'])) {
								$fk_id_categoria = $_POST['cbox_categoria'];				
								$peso= $consultaMascotas[0]['peso'];
								$fecha_nac =date('Y-m-d',strtotime($consultaMascotas[0]['fecha_nac'])) ;
								$fecha_actual=date ("Y-m-d"); 
								$array_nacimiento = explode ( "-", $fecha_nac ); 
								$array_actual = explode ( "-", $fecha_actual ); 
								$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
								$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
								$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 

								//ajuste de posible negativo en $días 
								if ($dias < 0) 
								{ 
									--$meses; 

									//ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
									switch ($array_actual[1]) { 
										case 1:     $dias_mes_anterior=31; break; 
										case 2:     $dias_mes_anterior=31; break; 
										case 3:  
												if (bisiesto($array_actual[0])) 
												{ 
													$dias_mes_anterior=29; break; 
												} else { 
													$dias_mes_anterior=28; break; 
												} 
										case 4:     $dias_mes_anterior=31; break; 
										case 5:     $dias_mes_anterior=30; break; 
										case 6:     $dias_mes_anterior=31; break; 
										case 7:     $dias_mes_anterior=30; break; 
										case 8:     $dias_mes_anterior=31; break; 
										case 9:     $dias_mes_anterior=31; break; 
										case 10:     $dias_mes_anterior=30; break; 
										case 11:     $dias_mes_anterior=31; break; 
										case 12:     $dias_mes_anterior=30; break; 
									} 

									$dias=$dias + $dias_mes_anterior; 
								} 

								//ajuste de posible negativo en $meses 
								if ($meses < 0) 
								{ 
									--$anos; 
									$meses=$meses + 12; 
								} 
								if ($anos > 0) {
									$meses=($anos *12)+$meses;
								} 
								
								//echo "<br>Tu edad es: $anos años con $meses meses y $dias días"; 

								function bisiesto($anio_actual){ 
									$bisiesto=false; 
									//probamos si el mes de febrero del año actual tiene 29 días 
									if (checkdate(2,29,$anio_actual)) 
									{ 
										$bisiesto=true; 
									} 
									return $bisiesto; 
								} 
								// echo "$fecha_actual $fecha_nac" ;
								$consulta_dtCategoria= $csLogica->consulta2("detalle_categoria","WHERE fk_id_categoria ='$fk_id_categoria' ");
								if (count($consulta_dtCategoria)) {
									$porcion_dia = (($consulta_dtCategoria[0]['cant_max'] - $consulta_dtCategoria[0]['cant_min'])/2) + $consulta_dtCategoria[0]['cant_min'];
									$cboxHora=0;
									$vlPorcion1="disabled";
									$vlPorcion2="disabled";
									$vlPorcion3="disabled";
									$vlPorcion4="disabled";
									$cboxHora=$_POST['cboxHora'];
									if ($cboxHora==1 ) {
										$vlPorcion1="";
									}
									elseif ( $cboxHora==2 ) {
										$vlPorcion1="";
										$vlPorcion2="";

									}
									elseif ( $cboxHora==3 ) {
										$vlPorcion1="";
										$vlPorcion2="";
										$vlPorcion3="";

									}
									else {
										$vlPorcion1="";
										$vlPorcion2="";
										$vlPorcion3="";
										$vlPorcion4="";
									}
									
									$porcion_hora = ($porcion_dia/$cboxHora);
									echo "<p>     
										 </p>" ;
									echo "<B>Porción que debe consumir al día: </B>" ; 
									echo intval($porcion_dia);
									echo " Gramos";
									echo "<p>     
										 </p>" ;
								
						?>
						<br>
						<div class="col-md-3">
							<label for="">Porción uno:   
							<?php
								if ($vlPorcion1=="" ) {
									echo intval($porcion_hora);
									echo " Gramos";
								}
							?> </label>
						</div>
						<div class="col-md-3">
							<input type="time" name="" id="" <?php echo $vlPorcion1; ?> class="form-control">
						</div>
						<div class="col-md-3">
							<label for="">Porción dos:   
							<?php
								if ($vlPorcion2=="" ) {
									echo intval($porcion_hora);
									echo " Gramos";
								}
							?> </label>
						</div>
						<div class="col-md-3">
							<input type="time" name="" id="" <?php echo $vlPorcion2; ?> class="form-control">
						</div>
						<div class="col-md-3">
							<label for="">Porción tres:   
							<?php
								if ($vlPorcion3=="" ) {
									echo intval($porcion_hora);
									echo " Gramos";
								}
							?> </label>
						</div>
						<div class="col-md-3">
							<input type="time" name="" id="" <?php echo $vlPorcion3; ?> class="form-control">
						</div>
						<div class="col-md-3">
							<label for="">Porción cuatro:   
							<?php
								if ($vlPorcion4=="" ) {
									echo intval($porcion_hora);
									echo " Gramos";
								}
							?> </label>
						</div>
						<div class="col-md-3">
							<input type="time" name="" id="" <?php echo $vlPorcion4; ?> class="form-control">
						</div> 	
						<?php  
								}
								
							}
						?>
				  </form>
				  <div style="height: 500px"></div>
			</div>
		</div>
	  
	</div>
	<script>
        $(document).ready(function(){
            $("#cbox_categoria").load("CargaDatos.php?id_marca="+$("#cbox_marca").val()+'&Option=cargaCatagoria');
            $("#cbox_marca").change(function() {
                $("#cbox_categoria").load("CargaDatos.php?id_marca="+$("#cbox_marca").val()+'&Option=cargaCatagoria');
                });
        })
    </script>	
	<?php 
		include "template/pie_pagina.php";
	?>
</body>
</html>