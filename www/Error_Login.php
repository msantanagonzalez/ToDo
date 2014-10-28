<!DOCTYPE HTML>
<html>

	<head>
		<title> > To-Do (IU4L)</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/Validaciones.js"></script>
		<!-- Esto sobra para que no cargue la barra en formato movil.
        <script src="js/skel-layers.min.js"></script> -->
		<script src="js/init.js"></script>	
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
	</head>

	<body>
		<div id="wrapper"> <!-- WRAPPER --> 
			<div id="content"> <!-- CONTENIDO --> 
				<div class="inner" align="center">    
					<h1 id="header" style="width:75%"><a>- LOGIN -</a></h1> <br>  
                     		<form action="php/Autenticar.php" method="post" style="width:65%" onsubmit="MD5_Pass()">
                            	<a> Las credenciales no coinciden :( </a> <br>
                           		<br><input type="text" placeholder="USUARIO:" required/ name="Login_Usuario"> <br>
                           		<input type="password" placeholder="CONTRASE&Ntilde;A:" required/ name="Password_Usuario" id="Password_Usuario">
                        	<br>
                        	<a href="Olvide.php"> <input type="button" value="Olvid&eacute; mi contrase&ntilde;a :("></a>
                        	&nbsp;&nbsp; <a href="Registro.php"><input type="button" value="REGISTRO"></a> &nbsp;&nbsp;
                       		<input type="submit" name="accion" value="ENTRAR">
                            
                      	</form>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>