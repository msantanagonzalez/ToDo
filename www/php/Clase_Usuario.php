<?php
//Clase : Usuario
//Creado el : 10/15/2014
//Base De Dato: ToDo_DB
//Administrador: Admin_ToDo
//Contraseña: Pass_ToDo
//-------------------------------------------------------
require 'FuncionesGenerales.php';

if (isset($_POST['ID_Usuario'])) {
	$ID_Usuario = $_POST['ID_Usuario'];
	} else {
	$ID_Usuario = "NULL";
	}
	
	if (isset($_POST['accion'])) {
	$accion = $_POST['accion'];
	} else {
	$accion = "";
	}
	
class Usuario
{

//atributo login : guarda el login del usuario
var $ID_Usuario;

//atributo PASS : guarda la PASS del usuario
var $Password_Usuario;

//atributo email: guarda la direccion de correao del usuario
var $Email_Usuario;

//atributo Nombre : guarda el nombre del usuario
var $Nombre_Usuario;

//atributo apellidos : guarda los apellidos del usuario
var $Apellido1_Usuario;
var $Apellido2_Usuario;

//atributo Fecha_Nacimiento: Guarda fecha nacimiento 
var $Fecha_Nacimiento;

// Campos Direccion:

var $Calle_Usuario;
var $N_Portal_Usuario;
var $Provincia_Usuario;
var $CP_Usuario;

// atributo tipo_usuario
var $Tipo_Usuario;

//Constructor de la clase
//parametros: el dni, el nombre y los apellidos
function __construct($ID_Usuario, $Password_Usuario, $Email_Usuario, $Nombre_Usuario, $Apellido1_Usuario, $Apellido2_Usuario, $Fecha_Nacimiento_Usuario,$Calle_Usuario, $N_Portal_Usuario, $Provincia_Usuario, $CP_Usuario, $Tipo_Usuario)
{
    $this->ID_Usuario			= $ID_Usuario;
	$this->Password_Usuario				= $Password_Usuario;
	$this->Email_Usuario			=$Email_Usuario;
    $this->Nombre_Usuario 			= $Nombre_Usuario;
    $this->Apellido1_Usuario 		= $Apellido1_Usuario;
	$this->Apellido2_Usuario 		= $Apellido2_Usuario;
	$this->Fecha_Nacimiento = $Fecha_Nacimiento;
	$this->Calle_Usuario 			= $Calle_Usuario;
	$this->N_Portal_Usuario 		= $N_Portal_Usuario;
	$this->Provincia_Usuario 		= $Provincia_Usuario;
	$this->CP_Usuario 		= $CP_Usuario;
	$this->Tipo_Usuario 			= $Tipo_Usuario;
}

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{
}

//Metodo Alta Usuario
function Alta_Usuario()
{
    ConectarDB();

        $sql = "select * from Usuario where ID_Usuario = '".$this->ID_Usuario."' or Email_Usuario = '".$this->Email_Usuario."' ";
        $resultado = mysql_query($sql) or die(mysql_error());
		$res = mysql_fetch_array($resultado);
        if (mysql_num_rows($resultado) == 0)
        {
			$sql = "INSERT INTO Usuario(ID_Usuario,Email_Usuario,Nombre_Usuario,Apellido1_Usuario,Apellido2_Usuario,Password_Usuario,Fecha_Nacimiento,Calle_Usuario,N_Portal_Usuario,Provincia_Usuario,CP_Usuario,Tipo_Usuario) valueS ('".$this->ID_Usuario."','".$this->Email_Usuario."','".$this->Nombre_Usuario."','".$this->Apellido1_Usuario."','".$this->Apellido2_Usuario."','".$this->Password_Usuario."','".$this->Fecha_Nacimiento_Usuario."','".$this->Calle_Usuario."','".$this->N_Portal_Usuario."','".$this->Provincia_Usuario."','".$this->CP_Usuario."','".$this->Tipo_Usuario."')";
			mysql_query($sql);
			Iniciar_Sesion();
			header('location: /Index.php');
        }
        else
		{
			if ( "".$this->Email_Usuario."" == $res['Email_Usuario'] )
			{
			header('Location: /Error_Correo_Registro.php');
			}
			else
			{
			header('Location: /Error_Usuario_Registro.php');
			}
				
		}
}

function Login_Usuario()
{
		ConectarDB();
        $sql = "select * from Usuario where ID_Usuario = '".$this->ID_Usuario."'";

        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 0)
		{
			header('location: /Error_Login.php');
        }
		else
		{
					$sql = "select * from Usuario where ID_Usuario = '".$this->ID_Usuario."'";
					$resultado = mysql_query($sql);
					$res = mysql_fetch_array($resultado);
					if( "".$this->Password_Usuario."" == $res['Password_Usuario'])
					{
						if ( $res['Tipo_Usuario'] == 0)
						{
						Iniciar_Sesion();
						header('location: /Admin.php');
						}
						else
						{
						Iniciar_Sesion();
						header('location: /Index.php');
						}
					}
					else
					{
						header('location: /Error_Login.php');									
					}			
		}	
}

}//fin de clase

function Baja_Usuario($ID_Usuario){

	ConectarDB();

		$sql = "select * from Usuario where ID_Usuario= '".$ID_Usuario."'";
		echo $sql;
        $resultado = mysql_query($sql) or die(mysql_error());
		$res = mysql_fetch_array($resultado);
        if (mysql_num_rows($resultado) == 1){
		
		
			echo " existe";
			$sql_delete="DELETE FROM Usuario where ID_Usuario = '".$ID_Usuario."'";
			echo $sql_delete;
			$resul_delete = mysql_query($sql_delete) or die("¡No se ha podido eliminar el registro!");
			Cerrar_Sesion();
		}
		else
		{
			header('location: /Index.php');
		}

}//fin Baja_Usuario

function Consultar_Usuario($ID_Usuario)
{
    ConectarDB();
	
	
	if (isset($_POST['baja'])) {
	
		if (isset($_GET['ID_Usuario'])) {
		$ID_Usuario = $_GET['ID_Usuario'];
		} else {
		$ID_Usuario = "NULL";
		}
			Baja_Usuario($ID_Usuario);
	}
	
	
    $sql = "select * from Usuario where ID_Usuario = '".$ID_Usuario."'";
    $resultado = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($resultado) or die(mysql_error());
	
	echo "<form name='FormConsultar_Usuario' id='FormConsultar_Usuario' action='Perfil.php?ID_Usuario=$ID_Usuario' method='post' onsubmit='return Confirmar_BajaUsuario()'>
					<div style='height:350px;width:auto;overflow-y: scroll;'>
					<table class='default'>
						<tr> 
						<td>USUARIO:</td> 
                         <td><input type='text' disabled class='text' value='$ID_Usuario' / name='Nombre_Usuario'></td>
                               	<td>CORREO:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Email_Usuario']."' / name='Email_Usuario'></td>
                          	</tr>
                           	<tr>
                             	<td>APELLIDO1:</td>
                               	<td><input type='text' disabled class='text' value='".$row['Apellido1_Usuario']."'/ name='Apellido1_Usuario'></td>
                               	<td>APELLIDO2:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Apellido2_Usuario']."'/ name='Apellido2_Usuario'></td>
                         	</tr>
                          	<tr>
                               	<td>CALLE:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Calle_Usuario']."'/ name='Calle_Usuario'></td>
								<td>PORTAL:</td>
                               	<td><input type='text' disabled class='text' value='".$row['N_Portal_Usuario']."'/ name='Portal_Usuario'></td>
                               	
                       		</tr>
							<tr>
                          		<td>PROVINCIA:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Provincia_Usuario']."'/ name='Provincia_Usuario'></td>
								<td>CODIGO POSTAL:</td>
                              	<td><input type='text' disabled class='text' value='".$row['CP_Usuario']."'/ name='CP_Usuario'></td>
                       		</tr>
							<tr>
							<td></td>
							<td>FECHA DE NACIMIENTO:</td>
                               	<td><input type='text' disabled class='text' value='".$row['Fecha_Nacimiento']."'/ name='Fecha_Nacimiento'></td>
							</tr>
                     	</table>
                    </div>
                      	<table class='alternative'>
                          	<tr>
                             	<td></td>
                               	<td><input type='submit' name='baja' value='DARSE DE BAJA :('/></a></td>
                              	<td colspan='4'><a href='EditarPerfil.php'><input type='button' value='MODIFICAR'></a></td>
                          	</tr>
                      	</table>
					</form> ";
	
}
function Modificar_Usuario($ID_Usuario)
{
    ConectarDB();
		
		if(isset($_POST['accion'])){

		    $s = "select * from Usuario where ID_Usuario = '".$ID_Usuario."'";
			$r = mysql_query($s) or die(mysql_error());
			$tupla = mysql_fetch_array($r) or die(mysql_error());

			if($tupla['Password_Usuario'] == $_POST['Password_Usuario']){
		
					$sql = "UPDATE Usuario SET Nombre_Usuario='".$_POST['Nombre_Usuario']."',
					Apellido1_Usuario='".$_POST['Apellido1_Usuario']."',
					Apellido2_Usuario='".$_POST['Apellido2_Usuario']."',
					Calle_Usuario='".$_POST['Calle_Usuario']."',
					N_Portal_Usuario='".$_POST['N_Portal_Usuario']."',
					Provincia_Usuario='".$_POST['Provincia_Usuario']."',
					CP_Usuario='".$_POST['CP_Usuario']."',
					Fecha_Nacimiento='".$_POST['Fecha_Nacimiento']."'
					WHERE ID_Usuario = '".$ID_Usuario."'" ;
				$resultado = mysql_query($sql) or die(mysql_error());
				header('location: /Perfil.php');
			}else{
			?>
				<script language="javascript"> alert("PASSWORD INCORRECTO."); </script>
			<?php
				//echo "<h1> password incorrecto </h1>";
			}
		}
			
	
    $sql = "select * from Usuario where ID_Usuario = '".$ID_Usuario."'";
    $resultado = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($resultado) or die(mysql_error());
	
	//
	echo "<form name='FormModificar_Usuario' id='FormModificar_Usuario' action='EditarPerfil.php' method='post' onsubmit='return Validar_CodigoPostal()'';
		>
					<div style='height:350px;width:auto;overflow-y: scroll;'>
					<table class='default'>
						<tr> 
						<td>USUARIO:</td> 
                         <td><input type='text' class='text' value='".$row['Nombre_Usuario']."' / name='Nombre_Usuario'></td>
                               	<td>CORREO:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Email_Usuario']."' / name='Email_Usuario'></td>
                          	</tr>
                           	<tr>
                             	<td>APELLIDO1:</td>
                               	<td><input type='text' class='text' value='".$row['Apellido1_Usuario']."'/ name='Apellido1_Usuario'></td>
                               	<td>APELLIDO2:</td>
                              	<td><input type='text' class='text' value='".$row['Apellido2_Usuario']."'/ name='Apellido2_Usuario'></td>
                         	</tr>
                          	<tr>
                               	<td>CALLE:</td>
                              	<td><input type='text' class='text' value='".$row['Calle_Usuario']."'/ name='Calle_Usuario'></td>
								<td>PORTAL:</td>
                               	<td><input type='text' class='text' value='".$row['N_Portal_Usuario']."'/ name='N_Portal_Usuario'></td>
                               	
                       		</tr>
							<tr>
                          		<td>PROVINCIA:</td>
                              	<td><input type='text' class='text' value='".$row['Provincia_Usuario']."'/ name='Provincia_Usuario'></td>
								<td>CODIGO POSTAL:</td>
                              	<td><input type='text' class='text' value='".$row['CP_Usuario']."'/ name='CP_Usuario' id='Campo_CodigoPostal'></td>
                       		</tr>
							<tr>
							<td>FECHA DE NACIMIENTO:</td>
                               	<td><input type='text' class='text' value='".$row['Fecha_Nacimiento']."'/ name='Fecha_Nacimiento'></td>
							<td>CONTRASE&Ntilde;A</td>
							<td><input type='password' required/ name='Password_Usuario' id='Password_Usuario'></td>							
							</tr>
                     	</table>
                    </div>
                      	<table class='alternative'>
                          	<tr>
							<td width='30%'></td>
                              	<td width='10%' colspan='4'><input type='submit' name='accion' value='GUARDAR'></a></td>
								<td width='25%'></td>
                          	</tr>
                      	</table>
					</form> ";	
		
		    }
						
function Modificar_Pass($ID_Usuario){
if(isset($_POST['accion'])){
	ConectarDB();

	if($_POST['Pass_Nuevo'] == $_POST['Pass_Nuevo_Conf']){

	
					$s = "select * from Usuario where ID_Usuario = '".$ID_Usuario."'";
					$r = mysql_query($s) or die(mysql_error());
					$tupla = mysql_fetch_array($r) or die(mysql_error());
					
					if($tupla['Password_Usuario'] == $_POST['Password_Usuario']){
					
					$sql = "UPDATE Usuario SET Password_Usuario='".$_POST['Pass_Nuevo']."'
					WHERE ID_Usuario = '".$ID_Usuario."'" ;
					
					$resultado = mysql_query($sql) or die(mysql_error());
				     header('location: /Perfil.php');
					
					}
					
					else{
					?>
				<script language="javascript"> alert("PASSWORD INCORRECTO."); </script>
			<?php
				}					
}

else{
echo "Los nuevos passwords no coinciden";
}
}
echo 			"<form name='FormModificar_Pass' id='FormModificar_Pass' onsubmit='return Validar_NuevoPass()' action='EditarPass.php' method='post'>
					
					<div style='height:350px;width:auto;overflow-y: scroll;'>
                    	<table class='default'>
                        	<tr>
                              	<td>PASSWORD ACTUAL:</td>
                               	<td><input type='password' required name= 'Password_Usuario' id = 'Password_Usuario' placeholder='Password actual'/></td>
							</tr>
							<tr>
								<td>PASSWORD NUEVO:</td>
								<td><input type='password' required name= 'Pass_Nuevo' id='Pass_Nuevo' placeholder='Password nuevo'/></td>
							</tr>	
							<tr>
								<td>PASSWORD NUEVO CONFIRMACION:</td>
								<td><input type='password' required name= 'Pass_Nuevo_Conf' id='Pass_Nuevo_Conf' placeholder='Confirmacion del nuevo password'/></td>
                      		</tr>
						</table>
						
						
						<table class='alternative'>
                          	<tr>
							<td width='30%'></td>
                              	<td width='10%' colspan='4'><input type='submit' name='accion' value='MODIFICAR'></a></td>
								<td width='25%'></td>
                          	</tr>
                      	</table>
						
						
					</form>  ";                    						
}
			
			
			
			  
function Buscar($ID_Usuario){
		ConectarDB();
		if(isset($_POST['buscar'])){			
			$busqueda = $_POST['busqueda'];
		}
		
	echo "<h1 id='header'><a>- RESULTADO EN TAREAS -</a></h1>
	<table class='default'><!--TABLA-->
                       		<tr>
                            	<th width='20%'>Tarea</th>
                                <th width='20%'>Proyecto</th>
                           		<th width='20%'>Prioridad</th>
								<th width='20%'>Estado</th>
                            	<th width='20%'>EDITAR</th>
                     		</tr>
                    	</table>
                  	<div style='height:170px;width:auto;overflow-y: scroll;'>
                   		<table class='default'>";
		
		$sqlTarea = "select * from Tarea where ID_Usuario = '$ID_Usuario' and Nombre_Tarea LIKE '%$busqueda%' order by Prioridad_Tarea";	
		$resultadoTarea=mysql_query($sqlTarea) or die(mysql_error());
		while($row = mysql_fetch_array($resultadoTarea)){
			echo "<form>";
								echo "<tr>"; 
								echo "<td width='25%'>
	<a href='DetallesTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."'>"; 
								echo  $row['Nombre_Tarea'] ;
								echo "</a></td>";
                            	echo "<td width='25%'>
	<a href='DetallesProyecto.php?Nombre_Proyecto=".$row['Nombre_Proyecto']."'>";
								echo $row['Nombre_Proyecto'];
								echo "</a></td>";
								echo "<td width='25%'>";
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
									case 4:
									echo "-";
									break;
									default:
									echo "-";
								}
								echo "</a></td>";
								echo "<td width='25%'>";
								echo $row['Estado_Tarea'];
								echo "</td>";
								echo "<td width='25%'><a href='EditarTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."'><button type='button' name='accion'>Editar</button></a></td>";
								echo "</a></td>";
                       		echo "</tr>";
							echo "</form>";
							
		}
		
	echo "</table></div><br>";	
	
	echo "<h1 id='header'><a>- RESULTADO EN PROYECTOS -</a></h1>
	<table class='default'>
    	<tr>
			<th width='20%'>Proyecto</th>
			<th width='20%'>Tareas</th>
			<th width='20%'>Prioridad</th>
			<th width='20%'>EDITAR</th>
		</tr>
 	</table>
   	<div style='height:170px; width:auto; overflow-y: scroll;'>
  	<table class='default'>";	
		
		$sqlProyecto = "select * from Proyecto where ID_Usuario = '$ID_Usuario' and Nombre_Proyecto LIKE '%$busqueda%' order by Prioridad_Proyecto";
		$resultadoProyecto=mysql_query($sqlProyecto) or die(mysql_error());
		while($row = mysql_fetch_array($resultadoProyecto)){
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
		
	echo "</table></div><br>";
	
	}
?>