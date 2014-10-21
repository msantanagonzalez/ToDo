<!DOCTYPE HTML>
<?php 
require "php/Clase_Tarea.php";
require 'php/Nav.php';
session_start();
Validar_Sesion();
$nav = new Nav;
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
               	  <h1 id="header"><a>- LISTADO TAREAS -</a></h1> <!--SECCIÓN-->
                	<table class="default"><!--TABLA-->
                       	<tr>
                        	<th width="20%">T&iacute;tulo</th>
                            <th width="20%">Proyecto</th>
                            <th width="20%">Prioridad</th>
							<th width="20%">Estado</th>
							<th width="20%"></th>
                     	</tr>
                    </table>
                  	<div style="height:350px;width:auto;overflow-y: scroll;"><!--ESTO DA LUGAR AL SCROLL-->
                   		<table class="default"><!--TABLA-->
						
						<?php
							ListarTareas($_SESSION["ID_Usuario"],NULL);
						?>
                   		</table>
                	</div>
                    
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