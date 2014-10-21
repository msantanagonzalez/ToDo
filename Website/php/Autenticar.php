<?php
// Incluimos la clase del jugador

require "Clase_Usuario.php";

	//Guardamos los datos en variables locales
	
	if (isset($_REQUEST['Login_Usuario'])) {
	$Login_Usuario = $_REQUEST['Login_Usuario'];
	} else {
	$Login_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Password_Usuario'])) {
	$Password_Usuario = $_REQUEST['Password_Usuario'];
	} else {
	$Password_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Correo_Usuario'])) {
	$Correo_Usuario = $_REQUEST['Correo_Usuario'];
	} else {
	$Correo_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Nombre_Usuario'])) {
	$Nombre_Usuario = $_REQUEST['Nombre_Usuario'];
	} else {
	$Nombre_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Apellido1_Usuario'])) {
	$Apellido1_Usuario = $_REQUEST['Apellido1_Usuario'];
	} else {
	$Apellido1_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Apellido2_Usuario'])) {
	$Apellido2_Usuario = $_REQUEST['Apellido2_Usuario'];
	} else {
	$Apellido2_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Calle_Usuario'])) {
	$Calle_Usuario = $_REQUEST['Calle_Usuario'];
	} else {
	$Calle_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['N_Portal_Usuario'])) {
	$N_Portal_Usuario = $_REQUEST['N_Portal_Usuario'];
	} else {
	$N_Portal_Usuario = "NULL";
	}

	if (isset($_REQUEST['Provincia_Usuario'])) {
	$Provincia_Usuario = $_REQUEST['Provincia_Usuario'];
	} else {
	$Provincia_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['CP_Usuario'])) {
	$CP_Usuario = $_REQUEST['CP_Usuario'];
	} else {
	$CP_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Nacimiento_Usuario'])) {
	$Nacimiento_Usuario = $_REQUEST['Nacimiento_Usuario'];
	} else {
	$Nacimiento_Usuario = "NULL";
	}
	
	if (isset($_REQUEST['Tipo_Usuario'])) {
	$Tipo_Usuario = $_REQUEST['Tipo_Usuario'];
	} else {
	$Tipo_Usuario = "1";
	}
	
	if (isset($_REQUEST['Password2_Usuario'])) {
	$Password2_Usuario = $_REQUEST['Password2_Usuario'];
	} else {
	$Password2_Usuario = "NULL";
	}
	
	$accion = $_REQUEST['accion'];

//Creamos objeto usuario
$usuario = new Usuario($Login_Usuario,$Password_Usuario,$Correo_Usuario,$Nombre_Usuario,$Apellido1_Usuario,$Apellido2_Usuario,$Nacimiento_Usuario,$Calle_Usuario, $N_Portal_Usuario, $Provincia_Usuario, $CP_Usuario, $Tipo_Usuario);	

// Tenemos tres tipos de acciones:"REGISTRAR","ENVIAR","ENTRAR",
if ($accion == "REGISTRAR") 
{
//Llamamos a funcion AltaUsuario de la clase Usuario
$usuario->Alta_Usuario();
}

if ($accion=="ENTRAR")
{
$usuario->Login_Usuario();
}

if ($accion=="ENVIAR")
{
header('location: /Login.php');
}


?>