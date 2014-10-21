<!DOCTYPE HTML>
<html>

	<head>
		<title> > To-Do (IU4L)</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
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
					<h1 id="header" style="width:75%"><a>¡VAYA DESPISTE! Ö</a></h1> <br>  
                     		<form action="php/Autenticar.php" method="post" style="width:65%" style="color:red">
                           		<br><input type="text" placeholder="¡¡¡ ESTE CORREO ELECTR&Oacute;NICO NO EXISTE!!! :(" required/ name="Correo_Usuario">
                           		<div style="margin-top:1em">
                                
                               	* Te enviaremos un link con tu contrase&ntilde;a para que recuperes tu cuenta
                                <div> <br><br>
                        	
                           <a href="Login.php"><input type="button" value="VOLVER"></a> &nbsp;
							<input type="submit" name="accion" value="ENVIAR"></a> 
                        
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>