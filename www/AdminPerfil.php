<?php
	require 'php/Clase_Admin.php';
	require 'php/Nav.php';
	session_start();
	Validar_Sesion();
	$admin = new Admin;
	$nav = new Nav;
	if (isset($_GET['usuario'])) $usuario = $_GET['usuario'];
	else $usuario = $_POST['usuario'];
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
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Content -->
					<div id="content">
						<div class="inner">
							<!--INICIO SECCIÓN-->
									<header> <p> <div> <h1 id="logo"><a>- PERFIL DE: <?php echo $usuario; ?> -</a></h1> </div></p></header>
										<!--INICIO TABLA-->
                                        	<br>
                                            <?php
												$admin->Ver_Perfil();
											?>
                                      	<!-- FIN TABLA -->
									</p>	
                           	<!-- FIN SECCIÓN -->				
							</div>
						</div>
					</div>

				<!-- INICIO BARRA LATERAL -->
					<?php
						$nav->NavAdmin($_SESSION["ID_Usuario"]);
					?>
				<!-- FIN BARRA LATERAL -->
			</div>
            </div></div></div>
	</body>
</html>
