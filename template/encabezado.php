<?php 
	include "Logica.php";
	$csLogica=new Logica();
	//Valida la session de usuario y crea una variable local para usar
	if (isset($_SESSION['user'])) {
		$userSession = array();
		$userSession=$_SESSION['user'];
	}
	else {
		header("Location: index.php");
	}
	header("Content-Type: text/html;charset='UTF-8'");
	echo "<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>";
	echo "<link rel='stylesheet' type='text/css' href='css/estilo.css'>";
	echo "<script type='text/javascript' src='js/jquery.min.js'></script>";
	echo "<script type='text/javascript' src='js/bootstrap.min.js'></script>";
	echo "
			<nav class='navbar navbar-default navbar-fixed-top'>
			  <div class='container-fluid'>
			    <div class='navbar-header'>
			      <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>
			        <span class='icon-bar'></span>
			        <span class='icon-bar'></span>
			        <span class='icon-bar'></span>                        
			      </button>
			      <a class='navbar-brand' href='#'>
			      	<img class='logo' src='img/CiPetSmarca.png'>
			      </a>
			    </div>
			    <div class='collapse navbar-collapse' id='myNavbar'>
			      <ul class='nav navbar-nav'>
			        <li id='lngInicio'><a href='MascotaPage.php'>Mascotas</a></li>
			        <li id='lngDispensador'><a href='DispensadorPage.php'>Dispensador</a></li>
			      </ul>
			      <ul class='nav navbar-nav navbar-right'>
			        <li class='dropdown'>
			          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>".$userSession[0]["nombres"]." ".$userSession[0]["apellido"]." <span class='caret'></span></a>
			          <ul class='dropdown-menu'>
			            <li><a href='EditarUserPage.php'>Editar Usuario</a></li>
			            <li><a  href='index.php?CerrarSession=1'>Cerrar Sesión</a></li>
			          </ul>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>
	";

 ?>