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
		<script src="js/initAdmin.js"></script>
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
                  	<header> <p> <div> <h1 id="logo"><a>- RESULTADO B&Uacute;SQUEDA -</a></h1> </div></p></header>
                		<table class="default"><!--TABLA-->
                       		<tr>
                        		<th width="20%">T&iacute;tulo</th>
                            	<th width="20%">Usuario</th>
                            	<th width="20%">Proyecto</th>
                           		<th width="20%">Prioridad</th>
                            	<th width="20%">-EDITAR-</th>
                     		</tr>
                    	</table>
                  	<div style="height:350px;width:auto;overflow-y: scroll;"><!--ESTO DA LUGAR AL SCROLL-->
                   		<table class="default"><!--TABLA-->
							<?php
								$admin->Buscar();
							?>
                   		</table>
                	</div> <br>
                    	<div align="center">* Este ha sido el resultado para la búsqueda: <em>$clavesDeBusquedaIntroducidas</em>.</div>
                    
				</div>
			</div>
		</div>
		
        <div> <!--BARRA LATERAL-->
			<?php
       			$nav->NavAdmin($_SESSION["ID_Usuario"]);
			?>
		</div>
		<!-- FIN BARRA LATERAL -->
	</body>
</html>