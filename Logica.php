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
        function crearUsuario( $nombres, $apellido, $calular, $correo, $pass, $fk_idCiudad)
        {
            $sentencia=$this->cnn->prepare("INSERT INTO usuario (nombres, apellido, calular, correo, pass, fk_idCiudad) VALUES (?,?,?,?,?,?)");
            $sentencia->bind_param('ssssss', $nombres1, $apellido1, $calular1, $correo1, $pass1, $fk_idCiudad1);
            $nombres1=$nombres;
            $apellido1=$apellido;
            $calular1=$calular;
            $correo1=$correo;
            $pass1=$pass;
            $fk_idCiudad1=$fk_idCiudad;
            if ($sentencia->execute()) {
                echo "Usuario registrado";
            } else {
                echo "Usuario no registrado";
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
                echo "Dispensador registrado";
            } else {
                echo "Dispensador no registrado";
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
                echo "Mascota registrada";
            } else {
                echo "Mascota no registrada";
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
                echo "Dispensador actualizado";
            } else {
                echo "Dispensador no actualizado";
            }
            $sentencia->close();        
        }
        function EliminarDispensador($id_dispensador)
        {
            $sentencia=$this->cnn->prepare("DELETE FROM  dispensador Where id_dispensador=?");
            $sentencia->bind_param('s',$id_dispensador1);
            $id_dispensador1=$id_dispensador;           
            if ($sentencia->execute()) {
                echo "Dispensador Eliminado";
            } else {
                echo "Dispensador no Eliminado";
            }
            $sentencia->close();        
        }
        function actualizarUsuario( $nombres, $apellido, $calular, $correo, $pass, $fk_idCiudad,$id_usuario)
        {
            $sentencia=$this->cnn->prepare("UPDATE usuario SET nombres=?,apellido=?,calular=?,correo=?,pass=?,fk_idCiudad=? WHERE id_usuario=?,");
            $sentencia->bind_param('sssssss', $nombres1, $apellido1, $calular1, $correo1, $pass1, $fk_idCiudad1,$id_usuario1);
            $nombres1=$nombres;
            $apellido1=$apellido;
            $calular1=$calular;
            $correo1=$correo;
            $pass1=$pass;
            $fk_idCiudad1=$fk_idCiudad;
            $id_usuario1=$id_usuario;
            if ($sentencia->execute()) {
                echo "Usuario registrado";
            } else {
                echo "Usuario no registrado";
            }
            
            
            $sentencia->close();
        }
        function eliminarUsuario( $id_usuario)
        {
            $sentencia=$this->cnn->prepare("DELETE FROM usuario WHERE id_usuario=? ");
            $sentencia->bind_param('s',$id_usuario);
            $id_usuario1=$id_usuario;
            if ($sentencia->execute()) {
                echo "Usuario registrado";
            } else {
                echo "Usuario no registrado";
            }
            $sentencia->close();
        }
        function eliminarMascotas($id)
        {
            $sentencia=$this->cnn->prepare("DELETE FROM mascotas WHERE id_mascota=? ");
            $sentencia->bind_param('s',$id1);
            $id1=$id;
            if ($sentencia->execute()) {
                echo "Mascota  Eliminada";
            } else {
                echo "Mascota no Eliminada";
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