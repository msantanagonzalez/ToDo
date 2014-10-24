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
									<header> <p> <div> <h1 id="logo"><a>- EDITAR PERFIL -</a></h1> </div></p></header>
										<!--INICIO TABLA-->
                                        	<br>
                                            <div style="height:350px;width:auto;overflow-y: scroll;">
                                            <table class="default">
                                            <tr>
                                            	<td>USUARIO:</td>
                                            	<td><form ><input type="text" class="text" placeholder="Nombre de usuario..."/></form></td>
                                            	<td>CORREO:</td>
                                                <td><form ><input type="text" class="text" placeholder="Correo electronico..."/></form></td>
                                            </tr>
                                            <tr>
                                            	<td>WEBSITE:</td>
                                            	<td colspan="3"><form ><input type="text" class="text" placeholder="Tu portfolio o red social..."/>
                                                </form></td>
                                            </tr>
                                            <tr>
                                            	<td>CONTRASEÑA:</td>
                                            	<td><form ><input type="password" class="text" placeholder="*****"/></form></td>
                                            	<td>REPETIR CONTRASEÑA:</td>
                                                <td><form ><input type="password" class="text" placeholder="*****"/></form></td>
                                            </tr>
                                             <tr>
                                            	<td>LOCALIDAD:</td>
                                            	<td colspan="3"><form>
                                                	<select>
                                                	<option value=""selected="selected">Localidad:</option>
                                                    <option value="1">Ourense</option>
                                                    <option value="2">Santiago</option>
                                                    <option value="3">Coruña</option>
                                                    <option value="4">Lugo</option>
                                                    </select>
                                                    </form></td>
                                            </tr>
                                            </table>
                                            </div>
                                            <table class="alternative">
                                            <tr>
                                            	<td></td>
                                            	<td><a><input type="submit" class="disabled" value="¡DAR DE BAJA! :("></a></td>
                                               	<td colspan="4"><a href="adminPerfil.html"><input type="submit" value="GUARDAR"></a></td>
                                            </tr>
                                            </table>
                                      	<!-- FIN TABLA -->
									</p>	
                           	<!-- FIN SECCIÓN -->				
							</div>
						</div>
					</div>

				<!-- INICIO BARRA LATERAL -->
					<div id="sidebarAdmin">
					
						<!-- INICIO LOGO -->
							<h1 id="header"><a href="admin.html">To-Do.</a></h1> <br>                         
                         <!-- FIN LOGO -->
					
						<!-- INICIO MENU -->
							<nav id="nav">
                             
								<ul>
                                <div align="center">
                                	<li class="current"><strong><a><img src="images/DefaultAvatar.png"> <br>SuperAdmin :)</a></strong></li>
									<li class="current"><a href="adminGestorUsuarios.html">GESTIONAR USUARIOS</a></li>
                                    <li class="current"><a href="adminGestorProyectos.html">GESTIONAR PROYECTOS</a></li>
                                    <li class="current"><a href="adminGestorTareas.html">GESTIONAR TAREAS</a></li>
									<li class="current"><em><a href="login.html">Log Out >] </a></em></li>
                                <section class="box search">
                                	<form method="post" action="#">
										<input type="text" class="text" name="search" placeholder="Search" />
									</form></section>
                                </div>
								</ul>
							</nav>
                            <!-- FIN MENU -->
					</div>
				<!-- FIN BARRA LATERAL -->
			</div>
            </div></div></div>
	</body>
</html>