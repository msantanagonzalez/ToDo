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
	if ($accion == 'DARSE DE BAJA :('){
	echo "LLAMA A DARSE DE BAJA, VALOR USUARIO:";
		echo $ID_Usuario;
//		Baja_Usuario();
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

function Baja_Usuario(){

	ConectarDB();
/*
		$sql = "select * from Usuario where ID_Usuario = '$ID_Usuario.'";
		echo $sql;
        $resultado = mysql_query($sql) or die(mysql_error());
		$res = mysql_fetch_array($resultado);
        if (mysql_num_rows($resultado) == 1){
		
			//delete * from Usuario where ID_Usuario = "$ID_Usuario";
		}

*/
}//fin Baja_Usuario

function Consultar_Usuario($ID_Usuario)
{
    ConectarDB();
    $sql = "select * from Usuario where ID_Usuario = '".$ID_Usuario."'";
    $resultado = mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_array($resultado) or die(mysql_error());
	
	echo "<form name='FormConsultar_Usuario' id='FormConsultar_Usuario' action='php/Clase_Usuario.php' method='post'>
					<div style='height:350px;width:auto;overflow-y: scroll;'>
					<table class='default'>
						<tr> 
						<td>USUARIO:</td> 
                         <td><input type='text' disabled class='text' value='".$row['Nombre_Usuario']."' / name='Nombre_Usuario'></td>
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
                               	<td><input type='submit' name = 'accion' value='DARSE DE BAJA :('/></a></td>
                              	<td colspan='4'><a href='EditarPerfil.php'><input type='button' value='MODIFICAR'></a></td>
                          	</tr>
                      	</table>
					</form> ";
	
}
function Modificar_Usuario($ID_Usuario)
{
    ConectarDB();
		
		if(isset($_POST['accion'])){
	
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
			  

function Guardar_Modificacion()
{
echo "IMPLEMENTAR GUARDAR MODIFICACION CON DATOS:";
echo $Login_Usuario;
echo $Password_Usuario;

}

?>