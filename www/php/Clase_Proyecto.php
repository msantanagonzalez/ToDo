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
								$sql2 = "select * from Tarea where ID_Usuario = '$ID_Usuario' and Nombre_Proyecto='".$row['Nombre_Proyecto']."'";
								$result2 = mysql_query($sql2); 
								$cantidad = mysql_num_rows($result2);
								echo $cantidad;
								echo "</td>";
								
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
										echo "<td width='20%'><button type='submit' name='accion'>Editar</button>
												<button type='submit' name='delete'>Borrar</button>
												</td>";
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

// Eliminar proyecto
	if (array_key_exists('delete', $_POST)) {
		$conn = null;
		$host = 'localhost';
		$db =   'ToDo_DB';
		$user = 'Admin_ToDo';
		$pwd =  'Pass_ToDo';
		try {
			$conn = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pwd);
		}
		catch (PDOException $e) {
			echo '<p>Error de seleccion de la BD !!</p>';
			exit;
		}
		$OK = true;
		$sql = 'DELETE FROM Proyecto WHERE Nombre_Proyecto = ?';
		$stmt = $conn->prepare($sql);
		$OK = $stmt->execute(array($_GET['Nombre_Proyecto']));
		$error = $stmt->errorInfo();
		if (!$OK) {
			echo $error[2];
		} else {
			header('Location: /ListadoProyectos.php');
			exit;
		}
	}
?>
