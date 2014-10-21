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
									<header> <p> <div> <h1 id="logo"><a>- LISTADO DE PROYECTOS -</a></h1> </div></p></header>
										
                                        <!--INICIO TABLA-->
                                        	<table class="default">
                                            <tr>
                                            	<th width='25%'>Título</th>
                                            	<th width='25%'>Nº de tareas</th>
                                               	<th width='25%'>Prioridad</th>
                                                <th width='25%'>Editar</th>
                                                
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
						$nav->NavAdmin();
					?>
				<!-- FIN BARRA LATERAL -->
			</div>
            </div></div></div>
	</body>
</html>