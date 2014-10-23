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
               	  <h1 id="logo"><a>- AGREGAR PROYECTO -</a></h1> <!--SECCIÓN-->
                	<!--INICIO TABLA-->
					<br>
                    	<?php
							$admin->Agregar_proyecto();
						?>
					<!-- FIN TABLA -->
                    
				</div>
			</div>
		</div>
		
        <!--BARRA LATERAL-->
        <?php $nav->NavAdmin($_SESSION["ID_Usuario"]); ?>
		<!--FIN BARRA LATERAL-->
	</table></body>
</html>