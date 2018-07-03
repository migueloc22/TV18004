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

								//$consultaProgramacion= array();
								//$consultaProgramacion= $csLogica->consulta2("programacion","WHERE id_programcion=".$_GET['id_programcion']);

								$filter="WHERE fk_id_mascota =".$consultaMascotas[0]['id_mascota'];
								$consultaProgramacion= $csLogica->consulta2("programacion",$filter); 
							?>
						  </select>
						</div>
					  	<div class="col-md-12">
						  <label for="cbox_categoria">Categoria</label>
						  <select name="cbox_categoria" id="cbox_categoria" class="form-control" >
							  
						  </select>
						</div>
					  	<!-- Dispensador -->
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
						  <label for="">Dispensador</label>
						  <select name="cboxDispensador" id="" class="form-control" >
							<option value="">Ninguno</option>
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
									for ($i=0; $i <count($consulta_dtCategoria) ; $i++) {
										if(($consulta_dtCategoria[$i]['peso_min'] <= $peso && $consulta_dtCategoria[$i]['peso_max'] >= $peso) && ($consulta_dtCategoria[$i]['edad_min'] <= $meses && $consulta_dtCategoria[$i]['edad_max'] >= $meses)){
											$porcion_dia = (($consulta_dtCategoria[$i]['cant_max'] - $consulta_dtCategoria[$i]['cant_min'])/2) + $consulta_dtCategoria[$i]['cant_min'];
										}
										else{}
									}
									//$porcion_dia = (($consulta_dtCategoria[0]['cant_max'] - $consulta_dtCategoria[0]['cant_min'])/2) + $consulta_dtCategoria[0]['cant_min'];
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
									echo "<br>     
									</br>" ;
									echo "<center><B>Porción que debe consumir al día: </B>" ; 
									echo intval($porcion_dia);
									echo "<input type='hidden' id='hd_porcion_dia' name='hd_porcion_dia' value='$porcion_dia'>" ;
									echo " Gramos";
									echo "</center>" ; 
									echo "<p>     
										 </p>" ;
								//Colocar información para realizar el cálculo
								/*	$consulta_dtCategoria = array();
									$filter="WHERE fk_idMarca =".$consultaMarca[0]['id_marca'];
									$consulta_dtCategoria= $csLogica->consulta2("categoria",$filter); 
									$categoria=$consulta_dtCategoria[0]['nombre'];

									echo "<em>Resumen información ingresada: </em>" ;
									echo "<br>	</br>" ;
									echo " <B>Marca: </B>";
									echo $consultaMarca[0]['marca'];
									$marcaE = $_POST['cbox_marca'];	
									echo "<input type='hidden' id='hd_marca' name='hd_marca' value='$marcaE'>" ;
									echo "<br>	</br>" ;
									echo " <B>Categoria: </B>";
									echo $categoria;
									$categoriaE = $_POST['cbox_categoria'];	
									echo "<input type='hidden' id='hd_categoria' name='hd_categoria' value='$categoriaE'>" ;
									echo "<br>	</br>" ;
									echo " <B>Porciones: </B>";
									echo $cboxHora;
									echo "<input type='hidden' id='hd_cboxHora' name='hd_cboxHora' value='$cboxHora'>" ;
									echo "<center><B>Programa tu Dispensador CiPetS Feeder a continuación: </B></center>" ;
									//echo " Cantidad:";*/
									$porcion_hora;
									echo "<input type='hidden' id='hd_porcionHora' name='hd_porcionHora' value='$porcion_hora'>" ;
								
									
						?>
						<br>
						
							<?php
									$consulta_dtCategoria= $csLogica->consulta2("detalle_categoria","WHERE fk_id_categoria =".$_POST['cbox_categoria']);
									$fecha=date ("Y-m-d");
									$cantidad_dia= $porcion_dia;
									$fk_id_detalleCategoria =$consulta_dtCategoria[0]['id_dt_categoria'];	
									$fk_id_mascota = $_GET['id_mascota'];	
									$fk_id_dispensador = $_POST['cboxDispensador']; 
									if((strlen($fk_id_dispensador) == 0)|| (strlen($fk_id_dispensador) < 1)){
										$fk_id_dispensador1=NULL;
									}else{
										$fk_id_dispensador1=$fk_id_dispensador;
									}
									$id_programacion=$csLogica->crearProgramacion($fecha,$cantidad_dia,$fk_id_detalleCategoria,$fk_id_mascota,$fk_id_dispensador1);
									echo "<input type='hidden' id='hd_idProgramacion' name='hd_idProgramacion' value='$id_programacion'>" ;
							
									$consulta_dtCategoria = array();
									$filter="WHERE fk_idMarca =".$consultaMarca[0]['id_marca'];
									$consulta_dtCategoria= $csLogica->consulta2("categoria",$filter); 
									$categoria=$consulta_dtCategoria[0]['nombre'];

									echo "<em>Resumen información ingresada: </em>" ;
									echo "<br>	</br>" ;
									echo " <B>Marca: </B>";
									echo $consultaMarca[0]['marca'];
									$marcaE = $_POST['cbox_marca'];	
									echo "<input type='hidden' id='hd_marca' name='hd_marca' value='$marcaE'>" ;
									echo "<br>	</br>" ;
									echo " <B>Categoria: </B>";
									echo $categoria;
									$categoriaE = $_POST['cbox_categoria'];	
									echo "<input type='hidden' id='hd_categoria' name='hd_categoria' value='$categoriaE'>" ;
									echo "<br>	</br>" ;
									echo " <B>Porciones: </B>";
									echo $cboxHora;
									echo "<input type='hidden' id='hd_cboxHora' name='hd_cboxHora' value='$cboxHora'>" ;
									echo "<center><B>Programa tu Dispensador CiPetS Feeder a continuación: </B></center>" ;
									echo "<br>	</br>" ;
									//echo " Cantidad:";

							?>
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
							<input type="time" name="txt_porcion1" id="" <?php echo $vlPorcion1; ?> class="form-control">
						
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
							<input type="time" name="txt_porcion2" id="" <?php echo $vlPorcion2; ?> class="form-control">
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
							<input type="time" name="txt_porcion3" id="" <?php echo $vlPorcion3; ?> class="form-control">
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
							<input type="time" name="txt_porcion4" id="" <?php echo $vlPorcion4; ?> class="form-control">
						</div> 	
						<div class="col-md-12">
							
							<br>
							<input type="submit" name="btnProgramar" value="Programar Dispensador" class="btn btn-primary">
							<p>     
							</p>
						</div>
						
						<?php  
													
										
								}
							
							}

							if (isset($_POST['btnProgramar'])) {
							/*	$consulta_dtCategoria= $csLogica->consulta2("detalle_categoria","WHERE fk_id_categoria =".$_POST['hd_categoria']);
								$fecha=date ("Y-m-d");
								$cantidad_dia= $_POST['hd_porcion_dia'];
								$fk_id_detalleCategoria =$consulta_dtCategoria[0]['id_dt_categoria'];	
								$fk_id_mascota = $_GET['id_mascota'];	
								$fk_id_dispensador = $_POST['cboxDispensador']; 
								$id_programacion=$csLogica->crearProgramacion($fecha,$cantidad_dia,$fk_id_detalleCategoria,$fk_id_mascota,$fk_id_dispensador);
*/
								$id_programacion= $_POST['hd_idProgramacion'];
								$cboxHora= $_POST['hd_cboxHora'];
								$porcion_hora= $_POST['hd_porcionHora'];
								if ($cboxHora==1 ) {
									$hora=$_POST['txt_porcion1'];
									$porcion=$porcion_hora;	
																			
									$csLogica->crearDetalle_Programacion($hora,$porcion,$id_programacion);
								}
								elseif ( $cboxHora==2 ) {
									$porcion=$porcion_hora;	
									
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion1'],$porcion,$id_programacion);
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion2'],$porcion,$id_programacion);
								}
								elseif ( $cboxHora==3 ) {
									$porcion=$porcion_hora;	
									
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion1'],$porcion,$id_programacion);
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion2'],$porcion,$id_programacion);
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion3'],$porcion,$id_programacion);

								}
								else {
									$porcion=$porcion_hora;	
									
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion1'],$porcion,$id_programacion);
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion2'],$porcion,$id_programacion);
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion3'],$porcion,$id_programacion);
									$csLogica->crearDetalle_Programacion($_POST['txt_porcion4'],$porcion,$id_programacion);
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