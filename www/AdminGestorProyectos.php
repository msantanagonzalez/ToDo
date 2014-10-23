<?php
	require 'php/Clase_Admin.php';
	require 'php/Nav.php';
	session_start();
	Validar_Sesion();
	$admin = new Admin;
	$nav = new Nav;
	if(isset($_GET['usuario'])){
		$usuario = $_GET['usuario'];
	}
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
		<div id="wrapper"><!-- Wrapper -->
			<div id="content"><!-- Content -->
				<div class="inner"><!--INICIO SECCIÓN-->
					<header> <p> <div> <h1 id="logo"><a>- PROYECTOS <?php if(isset($_GET['usuario'])){echo $usuario;} ?> -</a></h1> </div></p></header>
                    	<!--INICIO TABLA-->
                        	<table class="default">
                             	<tr>
                                  	<th width='20%'>Título</th>
                                    <th width='20%'>Usuario</th>
                                    <th width='20%'>Nº de tareas</th>
                                    <th width='20%'>Prioridad</th>
                                    <th width='20%'>Editar</th>  
                                </tr>
                            </table>
                            <div style="height:350px;width:auto;overflow-y: scroll;">
                            	<table class="default">
                                	<?php
										$admin->Listar_Proyectos();
									?>
 								</table>
                                <!-- FIN TABLA -->
                            </div>
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