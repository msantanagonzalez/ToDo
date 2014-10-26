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
			echo $sql;
			$resultado = mysql_query($sql) or die(mysql_error());
			if (mysql_num_rows($resultado) == 0)
        {
			
			$sql = "INSERT INTO Proyecto(Nombre_Proyecto,ID_Usuario,Prioridad_Proyecto) VALUES ('".$this->Nombre_Proyecto."','".$this->ID_Usuario."','".$this->Prioridad_Proyecto."')";
			mysql_query($sql);
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
							echo "<form action='EditarProyecto.php?Nombre_Proyecto=".$row['Nombre_Proyecto']."&Prioridad=".$row['Prioridad_Proyecto']."' method='post'>";
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
												<button type='submit' name='delete' onclick='return Confirmar_EliminacionProyecto()'>Borrar</button>
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
echo "<option value='NULL' name='Nombre_Proyecto'>-</option>";
	while($row = mysql_fetch_array($resultado)){								
		
		echo "<option value='".$row['Nombre_Proyecto']."' name='Nombre_Proyecto'>'".$row['Nombre_Proyecto']."'</option>";
	}
}

function Editar_Proyecto($ID_Usuario,$Nombre_Proyecto,$Prioridad_Proyecto){

if(isset($_POST['modificar'])){
ConectarDB();
	if (isset($_POST['Prioridad_Proyecto'])) {
	$Prioridad_Proyecto = $_POST['Prioridad_Proyecto'];
	} else {
	$Prioridad_Proyecto = "";
	}
	$sql = "UPDATE Proyecto SET Prioridad_Proyecto='$Prioridad_Proyecto' WHERE ID_Usuario = '$ID_Usuario'" ;
					echo $sql;
				$resultado = mysql_query($sql) or die(mysql_error());
				header('location: /ListadoProyectos.php');
}
				
echo "
<!--INICIO TABLA-->
					<br>
					<form name='FormModificar_Proyecto' id='FormModificar_Proyecto' action='EditarProyecto.php?Nombre_Proyecto=$Nombre_Proyecto' method='post' onsubmit='return Confirmar_Modificacion()'>
					<div style='height:350px;width:auto;overflow-y: scroll;'>
					
                    	<table class='default'>
                        	<tr>
                              	<td width='25%'>T&Iacute;TULO:</td>
                               	<td width='25%'><input type='text' disabled class='text' value='$Nombre_Proyecto'/ name='Nombre_Proyecto'></td>
                                <td width='25%'>PRIORIDAD:</td>
                                <td width='25%'>";
								switch($Prioridad_Proyecto)
								{
									case 1:
									echo "<select name='Prioridad_Proyecto'>
                              			<option value='1' selected>Alta</option>
                        				<option value='2'>Media</option>
                               			<option value='3'>Baja</option>
                              			<option value='4'>-</option>
                               	 	</select>";
									break;
									case 2:
									echo "<select name='Prioridad_Proyecto'>
                              			<option value='1'>Alta</option>
										<option value='2' selected>Media</option>
                               			<option value='3'>Baja</option>
                              			<option value='4'>-</option>
                               	 	</select>";
									break;
									case 3:
									echo "<select name='Prioridad_Proyecto'>
                              			<option value='1'>Alta</option>
                        				<option value='2'>Media</option>
                               			<option value='3' selected>Baja</option>
                              			<option value='4'>-</option>
                               	 	</select>";
									break;
									case 4:
									echo "<select name='Prioridad_Proyecto'>
                              			<option value='1'>Alta</option>
                        				<option value='2'>Media</option>
                               			<option value='3'>Baja</option>
                              			<option value='4' selected>-</option>
                               	 	</select>";
									break;
									default:
									echo "<select name='Prioridad_Proyecto'>
                              			<option value='1'>Alta</option>
                        				<option value='2'>Media</option>
                               			<option value='3'>Baja</option>
                              			<option value='4' selected>-</option>
                               	 	</select>";
								}
                              	echo "</td>
                      		</tr>
                 	</div>
                       <table>
					   <tr>
							<td width='25%'></td>
							<td width='25%'><a href='ListadoProyectos.php'><input type='button' value='VOLVER'></a></td> 
                       		<td width='25%'><th colspan='4'><input type='submit' name='modificar' value='GUARDAR'></th> </td>
							<td width='25%'></td>
						</tr>
                    	</table>
					</form>	
					<!-- FIN TABLA --> ";

}

function Consultar_Proyecto($ID_Usuario,$Nombre_Proyecto)
{
ConectarDB();	
$sql = "select * from Tarea where ID_Usuario = '$ID_Usuario' and Nombre_Proyecto = '$Nombre_Proyecto' order by Prioridad_Tarea";
$resultado=mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array($resultado))
							{
						echo "<table class='default'><!--TABLA-->";
							echo "<form method='post'>";
								echo "<tr>"; 
                            	echo "<td>
<a href='DetallesTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."'>"; 
								echo $row['Nombre_Tarea'];
								echo "</a></td>";
								echo "<td>";
								echo "</td>";
								
								echo "<td>";
								switch ($row['Prioridad_Tarea'])
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
								echo "<td>";
								echo "</td>";
								echo "<td>";
								echo "</td>";
                       		echo "</tr>";
							echo "</table>";	
							echo "</form>";
							}
							echo "<div align='center'>
							<a href='ListadoProyectos.php'><input type='button' value='VOLVER'></a>
							<a href='AgregarTarea.php?Nombre_Proyecto=$Nombre_Proyecto'><input type='button' value='Agregar Tarea'></a>
							</div> ";                   

							
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
