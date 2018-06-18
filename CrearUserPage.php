<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body class="body">
    <?php
        include "Logica.php";
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
                                </a> Registro Usuario
                            </h1>
                        </div>                    
                        <label for="txt_nombres">Nombres</label>
                        <input required type="text" name="txt_nombres" id="txt_nombres" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <input required  type="text" name="txt_apellido" id="txt_apellido" class="form-control">
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
                        <input required  type="number" name="txt_celular" id="txt_celular" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="txt_correo">Correo</label>
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
                                $csLogica->crearUsuario( $nombres, $apellido, $celular, $correo, $pass, $fk_idCiudad);
                            }
                        ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <input  type="submit" value="crear Usuario" name="option"  class="btn btn-primary">
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