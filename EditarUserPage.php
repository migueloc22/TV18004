<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<?php 
        include "template/encabezado.php";
        if (!isset($_GET['id_usuario'])||$_GET['id_usuario']==0||$_GET['id_usuario']=='') {
            header('Location: EditarUserPage.php');
		}
		$csUsuario = array();
        $csUsuario= $csLogica->consulta2("usuario","WHERE id_usuario=".$_GET['id_usuario']);
        $id_usuario=$csUsuario[0]['id_usuario'];
        $nombres=$csUsuario[0]['nombres'];
        $apellido=$csUsuario[0]['apellido'];
        $celular=$csUsuario[0]['celular'];
        $correo=$csUsuario[0]['correo'];
        $pass=$csUsuario[0]['pass'];
        $fk_idCiudad=$csUsuario[0]['fk_idCiudad'];
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
					  	<div class="col-md-12">
						  <label for="txt_nombre">Nombres</label>
						  <input type="text" name="txt_nombre" id="txt_nombre" value="<?php echo $nombres; ?>" class="form-control">
						</div>
						<div class="form-group">
                        <label for="">Apellidos</label>
                        <input required  type="text" name="txt_apellido" id="txt_apellido" value="<?php echo $apellido; ?>" class="form-control">
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
                        <label for="">ciudad</label>
                        <Select id="slCiudad" name="txt_fk_idCiudad" class="form-control">
                            
                        </Select>
                    </div>
                    <div class="form-group">
                        <label for="txt_celular">Celular</label>
                        <input required  type="number" name="txt_celular" id="txt_celular" value="<?php echo $celular; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_correo">Correo</label>
                        <input required  type="email" name="txt_correo" id="txt_correo" value="<?php echo $correo; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_correo">Contraseña</label>
                        <input required  type="email" name="txt_correo" id="txt_correo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_correo">Repetir Contraseña</label>
                        <input required  type="email" name="txt_correo" id="txt_correo" class="form-control">
                    </div>
					
							<input type="submit" class="btn btn-primary" name="btnAction" value="Actualizar">
							<?php
								if(isset($_POST['btnAction']))
								{
									header('Location: MascotaPage.php');
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
</body>
</html>