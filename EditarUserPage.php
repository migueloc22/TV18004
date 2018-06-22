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
				<h3 class="panel-heading text-center">Actualizar Información Personal</h3>
				  <form action=""  method="post">
					  	<div class="form-group">
						  <label for="txt_nombres">Nombres</label>
						  <input required  type="text" name="txt_nombres" id="txt_nombres" value="<?php echo $userSession[0]["nombres"]; ?>" class="form-control">
						</div>
						<div class="form-group">
                        <label for="">Apellidos</label>
                        <input required  type="text" name="txt_apellido" id="txt_apellido" value="<?php echo $userSession[0]["apellido"]; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Departamento</label>
                        <Select id="slDepartamento"   class="form-control">
                            <?php
                                $csLogica=new Logica();
                                $consultaDepartamento = array();
                                $consultaDepartamento= $csLogica->consulta("departamento");    
                                for ($i=0; $i <count($consultaDepartamento) ; $i++) { 
                                    echo "<option value='".$consultaDepartamento[$i] ["id_departamento"]."'>".$consultaDepartamento[$i] ["nombre"]."</option>";
                                }
                            ?>
                        </Select>
                    </div>
                    <div class="form-group">
                        <label for="">Ciudad</label>
                        <Select id="slCiudad" name="txt_fk_idCiudad" class="form-control">
                            
                        </Select>
                    </div>
                    <div class="form-group">
                        <label for="txt_celular">Celular</label>
                        <input required  type="number" name="txt_celular" id="txt_celular" value="<?php echo $userSession[0]["celular"]; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_correo">Correo</label>
                        <input required  type="email" name="txt_correo" id="txt_correo" value="<?php echo $userSession[0]["correo"]; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_password">Contraseña</label>
                        <input required  type="pass" name="txt_password" id="txt_password" value="<?php echo $userSession[0]["pass"]; ?>" class="form-control">
                    </div>
					
							<input type="submit" class="btn btn-primary" name="btnAction" value="Actualizar Información">
							<?php
								if(isset($_POST['btnAction'])){
                                    $nombres=$_POST['txt_nombres'];
                                    $apellido=$_POST['txt_apellido'];
                                    $celular=$_POST['txt_celular'];
                                    $correo=$_POST['txt_correo'];
                                    $pass=$_POST['txt_password'];
                                    $fk_idCiudad=$_POST['txt_fk_idCiudad'];
                                    $id_usuario=$userSession[0]["id_usuario"];
                                    $csLogica->actualizarUsuario( $nombres, $apellido, $celular, $correo, $pass, $fk_idCiudad, $id_usuario);
                                    $consultaUsuario= array();
                                    $consultaUsuario=$csLogica->consulta2("usuario","WHERE id_usuario=".$id_usuario);
                                   // session_destroy();
                                     $_SESSION ['user']=$consultaUsuario;
                            
                            }
                            ?>
						</div>
				  </form>
				  <div style="height: 500px"></div>
			</div>
		</div>
	  
	</div>
	
	<?php 
		include "template/pie_pagina.php";
	?>

    <script>
        $(document).ready(function(){
            $("#slCiudad").load("CargaDatos.php?id_departamento="+$("#slDepartamento").val()+'&Option=cargaCiudad');
            $("#slDepartamento").change(function() {
                $("#slCiudad").load("CargaDatos.php?id_departamento="+$("#slDepartamento").val()+'&Option=cargaCiudad');
                });
        })
        
    </script>
</body>
</html>