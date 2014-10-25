<!DOCTYPE HTML>
<?php 
require "php/Clase_Proyecto.php";
require 'php/Nav.php';
session_start();
Validar_Sesion();
$nav = new Nav;

if (isset($_GET['Nombre_Proyecto'])) {
	$Nombre_Proyecto = $_GET['Nombre_Proyecto'];
	} else {
	$Nombre_Proyecto = "NULL";
	}
?>
<html>

	<head>
		<title>> To-Do (IU4L)</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/Validaciones.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
	</head>
	
	<body class="left-sidebar">
		<div id="wrapper"><!--WRAPPER-->
			<div id="content"><!--CONTENIDO-->
				<div class="inner">
               	  <h1 id="header"><a>- <?php echo "Proyecto: ";echo $Nombre_Proyecto ?> -</a></h1> <!--SECCIÓN-->
                	<table class="default"><!--TABLA-->
                       	<tr>
                        	<th width="28%">T&iacute;tulo</th>
                            <th width="17%">Prioridad</th>
                            <th width="28%"></th>
                     	</tr>
                    </table>
                  	<div style="height:350px;width:auto;overflow-y: scroll;"><!--ESTO DA LUGAR AL SCROLL-->
					<?php
                   		Consultar_Proyecto($_SESSION["ID_Usuario"],$Nombre_Proyecto);
					?>
                	</div> <br>
				</div>
			</div>
		</div>
		
        <div id="sidebar"> <!--BARRA LATERAL-->
			<?php
       			$nav->NavUser($_SESSION["ID_Usuario"]);
			?>
		</div>
		<!-- FIN BARRA LATERAL -->
	</body>
</html>