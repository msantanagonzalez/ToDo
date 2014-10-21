<?php
function ConectarDB()
{
	//nombres base de datos
    mysql_connect("localhost","Admin_ToDo","Pass_ToDo") or die("Error de conexión a la BD");
    mysql_select_db("ToDo_DB") or die("Error de selección de la BD");
}

function Iniciar_Sesion()
{
session_start();
$_SESSION["ID_Usuario"] = $_REQUEST['Login_Usuario'];
$_SESSION["Estado_Usuario"] = "ON";
}

function Cerrar_Sesion()
{
session_start();
session_unset(); 
session_destroy(); 
header('location: /Login.php');
}

function Validar_Sesion()
{
if($_SESSION["Estado_Usuario"] !== "ON")
{
   header('location: /Error_Login.php');
}
}



?>