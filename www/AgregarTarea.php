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
               	  <h1 id="header"><a>- AGREGAR TAREA -</a></h1> <!--SECCIÓN-->
				  <form name="Agregar_Tarea" action="" id="Agregar_Tarea" method="post" onsubmit="">
                	<!--INICIO TABLA-->
					<br>
					<div style="height:350px;width:auto;overflow-y: scroll;">
                    	<table class="default">
                        	<tr>
                              	<td>Nombre:</td>
                               	<td><input type="text"  class="text" placeholder="T&iacute;tulo de la tarea..."/ name="Nombre_Tarea"></td>
                                <td>PRIORIDAD:</td>
                                <td>
                              		<select>
                              			<option value="4" name="Prioridad_Tarea">Sin Prioridad</option>
                        				<option value="3" name="Prioridad_Tarea">Baja</option>
                               			<option value="2" name="Prioridad_Tarea">Media</option>
                              			<option value="1" name="Prioridad_Tarea">Alta</option>
                               	 	</select>
                              	</td>
                      		</tr>
                          	<tr>
                           		<td>Descripcion:</td>
                           		<td colspan="3"><input type="text" class="text" placeholder="Apartado para notas..."/ name="Descripcion_Tarea"></td>
                          	</tr>
                           	<tr>
                               	<td>Fecha Inicio:</td>
                               	<td><input type="date" / name="Fecha_Inicio"></td>
                               	<td>Fecha Fin:</td>
                               	<td><input type="date" / name="Fecha_Fin_Estimada"></td>
                          	</tr>
                          	<tr>
                              	<td>Estado:</td>
                                <td>
                              		<select id="Estado_Tarea">
                              			<option value="Creada" name="Estado_Tarea">Creada</option>
										<option value="En Curso" name="Estado_Tarea">En Curso</option>
                               	 	</select>
									<input type="checkbox" name="Empezar_Tarea" id="Validar_Estado" value="En Curso" onclick="Validar_EstadoNuevaTarea();">Empezar tarea<br>
                                </td>
                          	</tr>
                		</table>
					
                 	</div>
                       <table>
                       		<tr> <th colspan="4"><input type="submit" value="AGREGAR" name="accion"/></th> </tr>
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