<?php 
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
							<li id='lngInicio'><a href='InicioPAge.php'>Mascotas</a></li>
							<li id='lngDispensador'><a href='#'>Dispensador</a></li>
			        <li id='lngProgrmacion'><a href='ProgramacionPage.php'>Programación</a></li>			        
			      </ul>
			      <ul class='nav navbar-nav navbar-right'>
			        <li class='dropdown'>
			          <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Config <span class='caret'></span></a>
			          <ul class='dropdown-menu'>
			            <li><a href='#'>Page 1-1</a></li>
			            <li><a href='#'>Page 1-2</a></li>
			            <li><a href='#'>Page 1-3</a></li>
			          </ul>
			        </li>
			      </ul>
			    </div>
			  </div>
			</nav>

	";

 ?>