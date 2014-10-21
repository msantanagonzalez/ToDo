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
		<script src="js/Validaciones.js"></script>		
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
					<h1 id="header" style="width:75%"><a>- REGISTRO -</a></h1> <br>  
						<form id="Registro" onsubmit="return Registro_Password()" action="php/Autenticar.php" method="post" style="width:65%" >
                            	<br> <input type="text" placeholder="USUARIO..." required/ name="Login_Usuario"> <br>
                           		<input type="text" placeholder="¡¡¡ERROR- YA EXISTE ESTE CORREO ELECTR&Oacute;NICO!!!" required autofocus/ name="Correo_Usuario"> <br>
                           		<input type="password" placeholder="CONTRASE&Ntilde;A..." required/ name="Password_Usuario" id="Password_Usuario"> <br>
                                <input type="password" placeholder="REPETIR CONTRASE&Ntilde;A..." required/ name="Password2_Usuario" id="Password2_Usuario"> <br>
                                <input type="text" placeholder="NOMBRE..." required/ name="Nombre_Usuario"> <br>
                                <input type="text" placeholder="PRIMER APELLIDO..." required/ name="Apellido1_Usuario"> <br>
                              <input type="text" placeholder="SEGUNDO APELLIDO..." required/ name="Apellido2_Usuario"> <br>
                              <input type="text" placeholder="CALLE..."/ name="Calle_Usuario"> <br>
                                <input type="text" placeholder="PORTAL"/ name="N_Portal_Usuario"> <br>
                                <input type="text" placeholder="PROVINCIA..."/ name="Provincia_Usuario"> <br>
                                <input type="text" placeholder="CODIGO POSTAL"/ name="CP_Usuario"> <br>
                                <input type="date" placeholder="FECHA DE NACIMIENTO" name="Nacimiento_Usuario"/> <br>
                                
                            <a href="Login.php"><input type="button" class="disabled" value="VOLVER"></a> &nbsp;
                       		<input type="submit" name="accion" value="REGISTRAR">
                            
                      	</form>
                    </div>
				</div>
			</div>
		</div>
	</body>
</html>