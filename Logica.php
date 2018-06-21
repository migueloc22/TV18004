<?php
    session_start();
    class Logica 
    {
        private $cnn;
         function __construct() {
             $servidor="localhost";
             $usuario="root";
             $pass="";
             $baseDatos="cipetsdb";
           $this->cnn=mysqli_connect($servidor,$usuario,$pass,$baseDatos);
           if (!$this->cnn)  {
            echo"Error de conexión".mysqli_connect_error();
           }
        }
        //Crear una funcion con el nombre de la sentencia de sql en español + el nombre de la tabla
        //los parametros debe ser los mismo con el nombre de la base de datos para no confundirse con los nombres mas adelante
        // cada el valor que va insertar en sql debe referirce en simblo ?
        //las cantidad de s son los numeros de valores q va ultilizar  
        function crearUsuario( $nombres, $apellido, $celular, $correo, $pass, $fk_idCiudad)
        {
            $sentencia=$this->cnn->prepare("INSERT INTO usuario (nombres, apellido, celular, correo, pass, fk_idCiudad) VALUES (?,?,?,?,?,?)");
            $sentencia->bind_param('ssssss', $nombres1, $apellido1, $celular1, $correo1, $pass1, $fk_idCiudad1);
            $nombres1=$nombres;
            $apellido1=$apellido;
            $celular1=$celular;
            $correo1=$correo;
            $pass1=$pass;
            $fk_idCiudad1=$fk_idCiudad;
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Bienvenido!</strong> Registro Exitoso.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Registro no Exitoso.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }
        function crearDispensador( $nombre, $serial,$fk_id_usuario)
        {
            $sentencia=$this->cnn->prepare("INSERT INTO dispensador (nombre,serial,fk_id_usuario) VALUES (?,?,?)");
            $sentencia->bind_param('sss', $nombre1, $serial1, $fk_id_usuario1);
            $nombre1=$nombre;
            $serial1=$serial;
            $fk_id_usuario1=$fk_id_usuario;
           
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Dispensador registrado!</strong> Registro Exitoso.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Dispensador no registrado.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }
        function crearMascota($nombre,$genero,$foto,$peso,$fecha_nac,$fk_id_usuario,$fk_id_raza)
        {
            $sentencia=$this->cnn->prepare("INSERT INTO mascotas ( nombre, genero, foto, peso, fecha_nac, fk_id_usuario, fk_id_raza) VALUES (?,?,?,?,?,?,?)");
            $sentencia->bind_param('sssssss', $nombre1,$genero1,$foto1,$peso1,$fecha_nac1,$fk_id_usuario1,$fk_id_raza1);
            $nombre1=$nombre;
            $genero1=$genero;
            $foto1=$foto;
            $peso1=$peso;
            $fecha_nac1=$fecha_nac;
            $fk_id_usuario1=$fk_id_usuario;
            $fk_id_raza1=$fk_id_raza;
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Mascota registrada!</strong> Registro Exitoso.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Mascota no registrada.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }
        function actualizarMascota($nombre,$genero,$foto,$peso,$fecha_nac,$fk_id_raza,$id_mascota)
        {
            $sentencia=$this->cnn->prepare("UPDATE mascotas SET  nombre=?, genero=?, foto=?, peso=?, fecha_nac=?,  fk_id_raza=? WHERE id_mascota=?");
            $sentencia->bind_param('sssssss', $nombre1,$genero1,$foto1,$peso1,$fecha_nac1,$fk_id_raza1,$id_mascota1);
            $nombre1=$nombre;
            $genero1=$genero;
            $foto1=$foto;
            $peso1=$peso;
            $fecha_nac1=$fecha_nac;
            $fk_id_raza1=$fk_id_raza;
            $id_mascota1=$id_mascota;
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Información Actualizada!</strong> Actualización Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Actualización Fallida.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }
        function actualizarDispensador( $nombre, $serial,$id_dispensador)
        {
            $sentencia=$this->cnn->prepare("UPDATE  dispensador SET nombre=?,serial=? Where id_dispensador=?");
            $sentencia->bind_param('sss', $nombre1, $serial1,$id_dispensador1);
            $nombre1=$nombre;
            $serial1=$serial;
            $id_dispensador1=$id_dispensador;           
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Información Actualizada!</strong> Actualización Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Actualización Fallida.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }
        function EliminarDispensador($id_dispensador)
        {
            $sentencia=$this->cnn->prepare("DELETE FROM  dispensador Where id_dispensador=?");
            $sentencia->bind_param('s',$id_dispensador1);
            $id_dispensador1=$id_dispensador;           
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Dispensador Eliminado!</strong> Eliminación Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Dispensador no Eliminado.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }
        function actualizarUsuario( $nombres, $apellido, $celular, $correo, $pass, $fk_idCiudad,$id_usuario)
        {
            $sentencia=$this->cnn->prepare("UPDATE usuario SET nombres=?,apellido=?,celular=?,correo=?,pass=?,fk_idCiudad=? WHERE id_usuario=?,");
            $sentencia->bind_param('sssssss', $nombres1, $apellido1, $celular1, $correo1, $pass1, $fk_idCiudad1,$id_usuario1);
            $nombres1=$nombres;
            $apellido1=$apellido;
            $celular1=$celular;
            $correo1=$correo;
            $pass1=$pass;
            $fk_idCiudad1=$fk_idCiudad;
            $id_usuario1=$id_usuario;
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Información Actualizada!</strong> Actualización Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Actualización Fallida.
              </div>";
                echo $msn;
            }
            
            $sentencia->close();
        }
        function eliminarUsuario( $id_usuario)
        {
            $sentencia=$this->cnn->prepare("DELETE FROM usuario WHERE id_usuario=? ");
            $sentencia->bind_param('s',$id_usuario);
            $id_usuario1=$id_usuario;
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Usuario Eliminado!</strong> Eliminación Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Usuario no Eliminado.
              </div>";
                echo $msn;
            }
            $sentencia->close();
        }
        function eliminarMascotas($id)
        {
            $sentencia=$this->cnn->prepare("DELETE FROM mascotas WHERE id_mascota=? ");
            $sentencia->bind_param('s',$id1);
            $id1=$id;
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Mascota  Eliminada!</strong> Eliminación Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Mascota no Eliminada.
              </div>";
                echo $msn;
            }
            $sentencia->close();
        }

        function crearProgramacion($fecha,$cantidad_dia,$fk_id_detalle,$fk_id_mascota,$fk_id_dispensador)
        {
            $sentencia=$this->cnn->prepare("INSERT INTO programacion ( fecha, cantidad_dia, fk_id_detalle, fk_id_mascota, fk_id_dispensador) VALUES (?,?,?,?,?)");
            $sentencia->bind_param('sssss', $fecha1,$cantidad_dia1,$fk_id_detalle1,$fk_id_mascota1,$fk_id_dispensador1);
            $fecha1=$fecha;
            $cantidad_dia1=$cantidad_dia;
            $fk_id_detalle1=$fk_id_detalle;
            $fk_id_mascota1=$fk_id_mascota;
            $fk_id_dispensador1=$fk_id_dispensador;
            
            if ($sentencia->execute()) {
                
            } else {
                
            }
            $sentencia->close();        
        }
        function programar($hora,$porcion,$estado,$fk_id_programacion)
        {
            $sentencia=$this->cnn->prepare("INSERT INTO detalle_programacion ( hora, porcion, estado, fk_id_programacion) VALUES (?,?,?,?)");
            $sentencia->bind_param('ssss', $hora1,$porcion1,$estado1,$fk_id_programacion1);
            $hora1=$hora;
            $porcion1=$porcion;
            $estado1=$estado;
            $fk_id_programacion1=$fk_id_programacion;
            
            if ($sentencia->execute()) {
                $msn="<div class='alert alert-success'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Dispensador Programado!</strong> Programación Exitosa.
              </div>";
                echo $msn;
            } else {
                $msn="<div class='alert alert-danger'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Error!</strong> Programación Fallida.
              </div>";
                echo $msn;
            }
            $sentencia->close();        
        }

        function consulta($tabla)
        {
            $query='SELECT * FROM '.$tabla;
            $resultado=mysqli_query($this->cnn,$query);
            $arrayResult = array();
            while ($data = mysqli_fetch_assoc($resultado)) {
                $arrayResult[]=$data;
            }
            return $arrayResult;
        }
        function SessionUser($correo,$pass)
        {
            $query="SELECT * FROM usuario WHERE correo = '".$correo."'";
            $resultado=mysqli_query($this->cnn,$query);
            $arrayResult = array();
            $mensaje=false;
            if ($data = mysqli_fetch_assoc($resultado)) {
                if ($data['pass']==$pass) {
                    $_SESSION ['user'][]=$data;
                    $mensaje=true;
                } 
            }
            return $mensaje;
        }
        function consulta2($tabla,$filtro)
        {
            $query='SELECT * FROM '.$tabla. ' '. $filtro;
            $resultado=mysqli_query($this->cnn,$query);
            $arrayResult = array();
            while ($data = mysqli_fetch_assoc($resultado)) {
                $arrayResult[]=$data;
            }
            return $arrayResult;
        }
    }
      //$csLogica=new Logica();
    // // $csLogica->crearUsuario( "mac", "cifu", "213", "dcd", "213", "1");
    // // $consultaUser = array();
    // // $consultaUser= $csLogica->consulta("usuario");    
    // // for ($i=0; $i <count($consultaUser) ; $i++) { 
    // //     echo 'id = '.$consultaUser[$i] ['id_usuario'].' nombre='.$consultaUser[$i] ['nombres'].'<br>';
    // // }
    // $csLogica->SessionUser("dcd","213");
    // if (isset($_SESSION['user'])) {

    //     $buu = array();
    //     $buu=$_SESSION['user'];
    //     var_dump($buu);
    //     //echo $buu[0]["nombres"];
    // }
    // $csLogica->crearDispensador( 'txt_nombre','txt_serial',"20");
    
?>