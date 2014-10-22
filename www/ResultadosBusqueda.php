<!DOCTYPE HTML>
<?php 
require "php/clases/FuncionesGenerales.php";
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
               	  <h1 id="header"><a>- RESULTADOS BUSQUEDA -</a></h1> <!--SECCIÓN-->
                	<table class="default"><!--TABLA-->
                       	<tr>
                        	<th width="28%">T&iacute;tulo</th>
                            <th width="27%">Proyecto</th>
                            <th width="17%">Prioridad</th>
                            <th width="28%">-EDITAR-</th>
                     	</tr>
                    </table>
                  	<div style="height:350px;width:auto;overflow-y: scroll;"><!--ESTO DA LUGAR AL SCROLL-->
                   		<table class="default"><!--TABLA-->
                   			<tr align="center"> 
                      			<td width="28%"><a href="DetallesTarea.html">Prueba0</a></td>
                       			<td width="27%"><a href="DetallesProyecto.html">Pro</td>
               					<td width="17%">IV</td>
             					<td width="28%">-EDITAR-</td>
							</tr>
							<tr align="center"> 
								<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
                            	<td>IV</td>
								<td>-EDITAR-</td>
                       		</tr>
                      		<tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
								<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
                            	<td>IV</td>
								<td>-EDITAR-</td>
                       		</tr>
                      		<tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
								<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
                            	<td>IV</td>
								<td>-EDITAR-</td>
                       		</tr>
                      		<tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
								<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
                            	<td>IV</td>
								<td>-EDITAR-</td>
                       		</tr>
                      		<tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
								<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
                            	<td>IV</td>
								<td>-EDITAR-</td>
                       		</tr>
                      		<tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                            <tr align="center"> 
                        		<td><a href="DetallesTarea.html">Prueba0</a></td>
                            	<td><a href="DetallesProyecto.html">Pro</td>
           						<td>IV</td>
                            	<td>-EDITAR-</td>
                      		</tr>
                   		</table>
                	</div> <br>
                    	<div align="center">* Este ha sido el resultado para la búsqueda: <em>$clavesDeBusquedaIntroducidas</em>.</div>
                    
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