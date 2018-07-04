<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title></title>
</head>
<?php
//echo "<meta http-equiv='Content-Type' content='text/html' charset='utf-8'>";
        include "Logica.php";
        $csLogica=new Logica();
        switch ($_GET['Option']) {
            case 'cargaCiudad':
                $consultaDepartamento = array();
                $fk_id_departamento=$_GET['id_departamento'];
                $filtro = "WHERE fk_id_departamento=" . $fk_id_departamento;
                $consultaDepartamento= $csLogica->consulta2("ciudad",$filtro);    
                for ($i=0; $i <count($consultaDepartamento) ; $i++) { 
                    echo "<option value='".$consultaDepartamento[$i] ["id_ciudad"]."'>".$consultaDepartamento[$i] ["nombre"]."</option>";
                }
            break;
            case 'cargaCiudad2':
                $consultaDepartamento = array();
                $fk_id_departamento=$_GET['id_departamento'];
                $id_ciudad=$_GET['id_ciudad'];
                $filtro = "WHERE fk_id_departamento=" . $fk_id_departamento;
                $consultaDepartamento= $csLogica->consulta2("ciudad",$filtro);    
                for ($i=0; $i <count($consultaDepartamento) ; $i++) {
                    if ($id_ciudad==$consultaDepartamento[$i] ["id_ciudad"]) {
                        echo "<option value='".$consultaDepartamento[$i] ["id_ciudad"]."'selected='true'>".$consultaDepartamento[$i] ["nombre"]."</option>";
                    } else {
                        echo "<option value='".$consultaDepartamento[$i] ["id_ciudad"]."'>".$consultaDepartamento[$i] ["nombre"]."</option>";
                    }
                }
            break;
            case 'cargaRaza':
                $consultaDepartamento = array();
                $fk_id_tpMascotas=$_GET['id_tpMascota'];
                $filtro = "WHERE fk_id_tpMascotas=" . $fk_id_tpMascotas;
                $consultaDepartamento= $csLogica->consulta2("raza",$filtro);    
                for ($i=0; $i <count($consultaDepartamento) ; $i++) { 
                    echo "<option value='".$consultaDepartamento[$i] ["id_raza"]."'>".$consultaDepartamento[$i] ["nombre"]."</option>";
                }
            break;
            case 'cargaCatagoria':
                $consultaMarca = array();
                $fk_idMarca=$_GET['id_marca'];
                $filtro = "WHERE fk_idMarca=" . $fk_idMarca;
                $consultaMarca= $csLogica->consulta2("categoria",$filtro);    
                for ($i=0; $i <count($consultaMarca) ; $i++) { 
                    echo "<option value='".$consultaMarca[$i] ["id_categoria"]."'>".$consultaMarca[$i] ["nombre"]."</option>";
                }
            break;
            default:
                echo "error carga";
                break;
        }
        
        
?>