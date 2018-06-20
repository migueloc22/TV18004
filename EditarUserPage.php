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
    <div class="container row">
    <div style="height: 55px"></div>
        <div class="panel caja col-md-6 col-sm-offset-4">
            <form action="" method="post">
            <div class="panel-body">
                    <div class="form-group">
                        <div class="panel-heading">
                            <h1 class="text-center"><a href="index.php">
                                <span class="glyphicon  glyphicon-home"></span>
                                </a> Actualizar Información de Registro
                            </h1>
                        </div>                    
                        <label for="txt_nombres">Nombres</label>
                        <input required type="text" name="txt_nombres" id="txt_nombres" value="<?php echo $nombres; ?>" class="form-control">
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
                    <div class="form-group">
                        <?php
                            if (isset($_POST['option'])) {
                                $nombres=$_POST['txt_nombres'];
                                $apellido=$_POST['txt_apellido'];
                                $celular=$_POST['txt_celular'];
                                $correo=$_POST['txt_correo'];
                                $pass="123456789";
                                $fk_idCiudad=$_POST['txt_fk_idCiudad'];
                                $csLogica->actualizarUsuario( $nombres, $apellido, $celular, $correo, $pass, $fk_idCiudad);
                            }
                        ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <input  type="submit" value="Actualizar" name="option"  class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
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