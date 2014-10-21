<?php
	require 'php/Clase_Admin.php';
    require 'php/Nav.php';
    session_start();
    Validar_Sesion();
    $admin = new Admin;
    $nav = new Nav;
?>

<!DOCTYPE HTML>
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
               	  <h1 id="logo"><a>- EDITAR $nombreProyecto -</a></h1> <!--SECCIÓN-->
                	<!--INICIO TABLA-->
					<br>
					<div style="height:350px;width:auto;overflow-y: scroll;">
                    	<table class="default">
                        	<tr>
                              	<td>T&Iacute;TULO:</td>
                               	<td><form ><input type="text" autofocus class="text" placeholder="$T&iacute;tuloAsignado..."/></form></td>
                                <td>PRIORIDAD:</td>
                                <td>
                                <form>
                              		<select>
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
                           		<td colspan="3"><form ><input type="text" class="text" placeholder="$AnotacionesExistentes..."/></form></td>
                          	</tr>
                 	</div>
                       <table>
                       		<tr> <th colspan="4"><a href="DetallesProyecto.html"><input type="submit" value="MODIFICAR"></a></th> </tr>
                    	</table>
					<!-- FIN TABLA -->
                    
				</div>
			</div>
		</div>
		
        <!--BARRA LATERAL-->
        <?php $nav->NavAdmin($_SESSION["ID_Usuario"]); ?>
		<!--FIN BARRA LATERAL-->
	</table></body>
</html>