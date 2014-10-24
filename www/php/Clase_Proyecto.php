<?php
//Clase : Proyecto
//Creado el : 10/15/2014
//Base De Dato: ToDo_DB
//Administrador: Admin_ToDo
//Contraseña: Pass_ToDo

//-------------------------------------------------------
include 'FuncionesGenerales.php';


	if (isset($_POST['accion'])) {
	$accion = $_POST['accion'];
	} else {
	$accion = "";
	}
	if ($accion == 'ENVIAR'){
	
		if (isset($_POST['Nombre_Proyecto'])) {
	$Nombre_Proyecto = $_POST['Nombre_Proyecto'];
	} else {
	$Nombre_Proyecto = "NULL";
	}
	
	if (isset($_GET['ID_Usuario'])) {
	$ID_Usuario = $_GET['ID_Usuario'];
	} else {
	$ID_Usuario = "NULL";
	}
	
	if (isset($_POST['Prioridad_Proyecto'])) {
	$Prioridad_Proyecto = $_POST['Prioridad_Proyecto'];
	} else {
	$Prioridad_Proyecto = "NULL";
	}
		$proyecto = new Proyecto($Nombre_Proyecto , $ID_Usuario , $Prioridad_Proyecto);
		$proyecto->Alta_Proyecto();
	}



class Proyecto
{

//atributo Nombre : guarda el login del Proyecto
var $Nombre_Proyecto;

//atributo Nombre_Proyecto : guarda la ID del Usuario al que pertenece el proyecto
var $ID_Usuario;

//atributo Prioridad_Proyecto: guarda la prioridad que le dio el usuario o e sistama al proyecto
var $Prioridad_Proyecto;


//Constructor de la clase

function __construct($Nombre_Proyecto, $ID_Usuario, $Prioridad_Proyecto)
{
    $this->Nombre_Proyecto			= $Nombre_Proyecto;
	$this->ID_Usuario				= $ID_Usuario;
	$this->Prioridad_Proyecto			=$Prioridad_Proyecto;
    
}

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{
}

//Metodo Alta Proyecto

function Alta_Proyecto(){

	ConectarDB();
	
	        $sql = "select * from Proyecto where Nombre_Proyecto = '".$this->Nombre_Proyecto."' and ID_Usuario= '".$this->ID_Usuario."'";
			$resultado = mysql_query($sql) or die(mysql_error());
			if (mysql_num_rows($resultado) == 0)
        {
			
			$sql = "INSERT INTO Proyecto(Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto) VALUES ('".$this->Nombre_Proyecto."','".$this->ID_Usuario."','".$this->Prioridad_Proyecto."')";
			mysql_query($sql);
			//Iniciar_Sesion();
			header('location: /ListadoProyectos.php');
		}
		else{
		
			header('location: /Error_Alta_Proyecto.php');
		}
}

function Baja_Proyecto()
{

    ConectarDB();
    $sql = "select * from Proyecto where Nombre_Proyecto = '".$this->Nombre_Proyecto."'";
    $resultado = mysql_query($sql);
    if (mysql_num_rows($resultado) == 1)
    {
        $sql = "delete from Proyecto where Nombre_Proyecto = '".$this->Nombre_Proyecto."'";
        mysql_query($sql);
    echo "<br>o Nombre_Proyecto con Nombre = '".$this->Nombre_Proyecto."' fue borrado correctamente.<br>";
	header('Location: /ListadoProyectos.php');
    }
    else
        echo "<br>O '".$this->Nombre_Proyecto."' no existe.<br>";
}

//funcion Consultar: hace una búsqueda en la tabla Proyecto con
//los datos del Proyecto Si van vacios devuelve todos
function Consultar_Proyecto($Nombre_Proyecto)
{
    ConectarDB();
    $sql = "select * from Proyecto where Nombre_Proyecto = '%".$Nombre_Proyecto."%'";
    $resultado = mysql_query($sql);
	// llamada metodo mostrar Proyecto
	$this->Mostrar_Proyecto($resultado);
}

//Presenta en pantalla los datos que se le pasan en un recordset
function Mostrar_Proyecto($resultado)
{
    echo "Nombre_Proyecto"."------"."ID_Usuario"."------"."Prioridad_Proyecto"."<br>";
    while ($Proyecto = mysql_fetch_array($result))
    {
//    echo "<a href='ModBorr.php?Login_Proyecto=".$Login_Proyecto['Login_Proyecto']."'>";
    echo $Proyecto['Nombre_Proyecto'];
	echo "-------".$Proyecto['ID_Usuario'];
    echo "-------".$Proyecto['Descripcion_Proyecto'];
   
    echo "<br>";
    }
}

function RellenaDatos()
{
    ConectarDB();
    $sql = "select * from Proyecto where Nombre_Proyecto = '".$this->Nombre_Proyecto."'";
    $resultado = mysql_query($sql);
    $Proyecto = mysql_fetch_array($resultado);
	
    $this->Nombre_Proyecto			= $Nombre_Proyecto;
	$this->ID_Usuario				= $ID_Usuario;
	$this->Nombre_Proyecto 			= $Prioridad_Proyecto;
   
}

function Modificar_Proyecto()
{
    ConectarDB();
    $sql = "select * from Proyecto where Nombre_Proyecto = '".$this->Nombre_Proyecto."'";
    $resultado = mysql_query($sql);
    if (mysql_num_rows($resultado) == 1)
    {
        $sql = "UPDATE Proyecto SET Prioridad_Proyecto = '".$this->Nombre_Proyecto."'";
        echo $sql;
        mysql_query($sql);
		header ('Location: /ListadoProyectos.php');
    }
    else
    echo "<br>o Nombre_Proyecto con valor '".$this->Nombre_Proyecto."' no existe<br>";
	header ('Location: /ListadoProyectos.php');
}

//  Lista todos los proyectos de un usuario.





}//fin de clase


function ListarProyectos($ID_Usuario){
ConectarDB();
$sql = "select * from Proyecto where ID_Usuario = '$ID_Usuario' order by Prioridad_Proyecto";
$resultado=mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array($resultado))
							{
							echo "<form action='DetallesProyecto.php?Nombre_Proyecto=".$row['Nombre_Proyecto']."' method='post'>";
								echo "<tr>"; 
                            	echo "<td width='20%'>
<a href='DetallesProyecto.php?Nombre_Proyecto=".$row['Nombre_Proyecto']."'>";
								echo $row['Nombre_Proyecto'];
								echo "</a></td>";
								echo "<td width='20%'>";
								switch ($row['Prioridad_Proyecto'])
								{
									case 1:
									echo "Alta";
									break;
									case 2:
									echo "Media";
									break;
									case 3:
									echo "Baja";
									break;
									default:
									echo "Sin prioridad";
								}
								echo "</td>";
								echo "<td width='20%'><button type='submit' name='accion'>Editar</button></td>";
								echo "</td>";
                       		echo "</tr>";
							echo "</form>";
							}
}

function ListarProyectos_AltaTarea($ID_Usuario){
ConectarDB();
$sql = "select Nombre_Proyecto from Proyecto where ID_Usuario = '$ID_Usuario'";
$resultado=mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_array($resultado)){								
		
		echo "<option value='".$row['Nombre_Proyecto']."' name='Nombre_Proyecto'>'".$row['Nombre_Proyecto']."'</option>";
	}
}

?>
