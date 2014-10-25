<!DOCTYPE HTML>
<?php 
require "php/Clase_Proyecto.php";
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
               	  <h1 id="header"><a>- AGREGAR NUEVO PROYECTO -</a></h1> <!--SECCIÓN-->
                	
					
					<form id="AgregarProyecto" action="php/Clase_Proyecto.php?ID_Usuario=<?php echo $_SESSION["ID_Usuario"]; ?>" method="post" >
						<!--INICIO TABLA-->
					<br>
					<div style="height:350px;width:auto;overflow-y: scroll;">
                    	<table class="default">
                        	<tr>
                              	<td>T&Iacute;TULO:</td>
                               	<td><input type="text" required class="text" name= "Nombre_Proyecto" placeholder="T&iacute;tulo del proyecto..."/></td>
                                <td>PRIORIDAD:</td>
                                <td>
                              		<select name="Prioridad_Proyecto">
										<option value="4" selected>-</option>
                              			<option value="1">Alta</option>
                        				<option value="2">Media</option>
                               			<option value="3">Baja</option>
                               	 	</select>
                              	</td>
                      		</tr>
                 	</div>
                       <table>
                       		<tr> <th colspan="4"><input type="submit" name="accion" value="ENVIAR"></a></th> </tr>
                    	</table>
					<!-- FIN TABLA -->
                    </form>
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