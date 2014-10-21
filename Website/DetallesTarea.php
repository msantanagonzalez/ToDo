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
               	  <h1 id="header"><a>- DETALLES $tituloTarea -</a></h1> <!--SECCIÓN-->
                	<!--INICIO TABLA-->
					<br>
				  <div style="height:350px;width:auto;overflow-y: scroll;">
                    	<table class="default">
                        	<tr>
                              	<td>T&Iacute;TULO:</td>
                               	<td><form ><input type="text" disabled class="text" placeholder="T&iacute;tulo de la tarea..."/></form></td>
                                <td>PRIORIDAD:</td>
                                <td>
                                <form>
                              		<select disabled>
                              			<option value="1">1</option>
                        				<option value="2">2</option>
                               			<option value="3">3</option>
                              			<option value="4" selected>4</option>
                               	 	</select>
                              	</form>
                              	</td>
                      		</tr>
                          	<tr>
                           		<td>NOTAS:</td>
                           		<td colspan="3"><form ><input type="text" disabled class="text" placeholder="Apartado para notas..."/></form></td>
                          	</tr>
                           	<tr>
                               	<td>Fecha Inicio:</td>
                               	<td><form><input type="date" disabled></form></td>
                               	<td>Fecha Fin:</td>
                               	<td><form ><input type="date" disabled/></form></td>
                          	</tr>
                          	<tr>
                           		<td>Proyecto:</td>
                              	<td><form ><input type="text" disabled class="text" placeholder="Asignar tarea a proyecto (v)"/></form></td>
                              	<td>Estado</td>
                                <td>
                                <form>
                              		<select disabled>
                              			<option value="Creada" selected>Creada</option>
                        				<option value="En curso">En curso</option>
                               			<option value="Finalizada">Finalizada</option>
                               	 	</select>
                              	</form>
                                </td>
                          	</tr>
                		</table>
                 	</div>
                      	<table>
							<tr> <th colspan="4"><a href="EditarTarea.php"><input type="submit" value="MODIFICAR"></a></th> 
							</tr>
                    	</table>
				  <!-- FIN TABLA -->
                    
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