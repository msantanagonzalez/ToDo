<?php
//Clase : Tarea
//Creado el : 10/15/2014
//Base De Dato: ToDo_DB
//Administrador: Admin_ToDo
//Contraseña: Pass_ToDo
//-------------------------------------------------------
require 'Clase_Proyecto.php';
class Tarea
{

//atributo Nombre : guarda el login del Tarea
var $Nombre_Tarea;

//atributo ID_Usuario : guarda la ID del Tarea al que pertenece a tqarea
var $ID_Usuario;

//atributo Nombre_Pryecto: guarda el nombre del proyecto 
//al que esta asociada la tarea si lo tiene
var $Nombre_Proyecto;

//atributo Descripcion : guarda una breve descripcioon de la tareas
var $Descripcion_Tarea;

//atributo Etiqueta : guarda el valor de la etiqueta de la tarea
var $Etiqueta_Tarea;

//atributo Estado: guarda el estado de la taera,(creada, en curso, finalizada) 
var $Estado_Tarea;

//atributo prioridad tarea
var $Prioridad_Tarea;

//atributo fecha de inicio
var $Fecha_Inicio;

//atributo fecha fin estimada
var $Fecha_Fin_Estimada;

//atributo fecha inicio real
var $Fecha_Inicio_Real;

//atributo fecha fin real
var $Fecha_Fin_Real;


//Constructor de la clase

function __construct($Nombre_Tarea, $ID_Usuario, $Nombre_Proyecto, $Descripcion_Tarea, $Etiqueta_Tarea, $Estado_Tarea, $Prioridad_Tarea,$Fecha_Inicio, $Fecha_Fin_Estimada, $Fecha_Inicio_Real, $Fecha_Fin_Real)
{
    $this->Nombre_Tarea			= $Nombre_Tarea;
	$this->ID_Usuario				= $ID_Usuario;
	$this->Nombre_Proyecto			=$Nombre_Proyecto;
    $this->Descripcion_Tarea 			= $Descripcion_Tarea;
    $this->Etiqueta_Tarea 		= $Etiqueta_Tarea;
	$this->Estado_Tarea 		= $Estado_Tarea;
	$this->Prioridad_Tarea	= $Prioridad_Tarea;
	$this->Fecha_Inicio 			= $Fecha_Inicio;
	$this->Fecha_Fin_Estimada 		= $Fecha_Fin_Estimada;
	$this->Fecha_Inicio_Real 		= $Fecha_Inicio_Real;
	$this->Fecha_Fin_Real 		= $Fecha_Fin_Real;
}

//funcion de destrucción del objeto: se ejecuta automaticamente
//al finalizar el script
function __destruct()
{
}

}//fin de clase

function ListarTareas($ID_Usuario,$Estado_Tarea)
{
ConectarDB();
if ( $Estado_Tarea !== NULL )
{
	$sql = "select * from Tarea where ID_Usuario = '$ID_Usuario' and Estado_Tarea = '$Estado_Tarea' order by Prioridad_Tarea";	

							$resultado=mysql_query($sql) or die(mysql_error());
							while($row = mysql_fetch_array($resultado))
							{
							 echo "<form action='EditarTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."'' method='post'>";
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
								echo "<td width='25%'><button type='submit' name='accion'>Editar</button></td>";
								echo "</a></td>";
                       		echo "</tr>";
							echo "</form>";
							}
}
else
{
	$sql = "select * from Tarea where ID_Usuario = '$ID_Usuario' order by Prioridad_Tarea";	
							$resultado=mysql_query($sql) or die(mysql_error());
							while($row = mysql_fetch_array($resultado))
							{
								echo "<tr>"; 
								echo "<td width='20%'>
		<a href='DetallesTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."'>"; 
								echo  $row['Nombre_Tarea'] ;
								echo "</a></td>";
                            	echo "<td width='20%'>
		<a href='DetallesProyecto.php?Nombre_Proyecto=".$row['Nombre_Proyecto']."'>";
								echo $row['Nombre_Proyecto'];
								echo "</a></td>";
								echo "<td width='20%'>";
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
									echo "-";
								}
								echo "</td>";
								echo "<td width='20%'>"; 
								echo  $row['Estado_Tarea'] ;
								echo "</a></td>";
								echo "<td width='20%'>" . "<form action='EditarTarea.php' method='post'>" . "<button type='submit' name='Editar_Tarea'>" . "Editar" . "</button>" . "</form>" . "</td>";
								echo "</td>";
                       		echo "</tr>";
							}
}

} //fin listar tareas

function Detalle_Tarea($ID_Usuario,$Nombre_Tarea)
{
ConectarDB();
	if(isset($_POST['eliminar']))
	{
		$sql ="delete from Tarea where ID_Usuario = '$ID_Usuario' and Nombre_Tarea = '$Nombre_Tarea'";
        mysql_query($sql) or die(mysql_error());
		header('location: /ListadoTareas.php.php');
	}
				
$sql = "select * from Tarea where ID_Usuario = '$ID_Usuario' and Nombre_Tarea = '$Nombre_Tarea'";	
$resultado=mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($resultado);

echo " <div class='inner'>
		<h1 id='header'><a>- DETALLES $Nombre_Tarea -</a></h1> <!--SECCIÓN-->
		<!--INICIO TABLA-->
		<br>
				<form name='FormDetalle_Tarea' id='FormDetalle_Tarea' onsubmit='return Confirmar_EliminacionTarea()' action='DetallesTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."' method='post'>
				<div style='height:350px;width:auto;overflow-y: scroll;'>
				<table class='default'>
				
                   <tr>
					<td>Titulo:</td>
					<td><input type='text' disabled class='text' value='".$row['Nombre_Tarea']."' / name='Nombre_Tarea'></td>
					<td>Prioridad:</td>
					<td>";
					switch ($row['Prioridad_Tarea'])
								{
									case 1:
									echo "<input type='text' disabled class='text' value='Alta' / name='Prioridad_Tarea' id='Prioridad_Tarea'>";
									break;
									case 2:
									echo "<input type='text' disabled class='text' value='Media' / name='Prioridad_Tarea' id='Prioridad_Tarea'>";
									break;
									case 3:
									echo "<input type='text' disabled class='text' value='Baja' / name='Prioridad_Tarea' id='Prioridad_Tarea'>";
									break;
									case 4:
									echo "<input type='text' disabled class='text' value='-' / name='Prioridad_Tarea' id='Prioridad_Tarea'>";
									break;
									default:
									echo "<input type='text' disabled class='text' value='-' / name='Prioridad_Tarea' id='Prioridad_Tarea'>";
								}
                     echo "</td>
					 <td>Estado:</td>
					<td><input type='text' disabled class='text' value='".$row['Estado_Tarea']."'/ name='Estado_Tarea' id='Estado_Tarea'></td>
                  </tr>
							
					<tr>
							<td>Etiqueta:</td>
                           	<td><input type='text' disabled class='text' value='".$row['Etiqueta_Tarea']."'/ name='Etiqueta_Tarea'></td>	
							<td>Descripcion:</td>
                           	<td colspan='3'><input type='text' disabled class='text' value='".$row['Descripcion_Tarea']."'/ name='Descripcion_Tarea'></td>
                    </tr>
							
							<tr>
                               	<td colspan='2'>Fecha Inicio Estimada:</td>
                               	<td><input type='date' disabled/ value='".$row['Fecha_Inicio']."'></td>
                               	<td colspan='2'>Fecha Fin Estimada:</td>
                               	<td><input type='date' disabled/ value='".$row['Fecha_Fin_Estimada']."'></td>
                          	</tr>
							<tr>
                           		<td  colspan='2'>Fecha Inicio Real:</td>
                               	<td><input type='date' disabled value='".$row['Fecha_Inicio_Real']."'></td>
                               	<td colspan='2'>Fecha Fin Real:</td>
                               	<td><input type='date' disabled/ value='".$row['Fecha_Fin_Real']."'></td>
                          	</tr>
							
							<tr>
								<td></td>
                           		<td colspan='2'>Proyecto:</td>
                              	<td colspan='2'><input type='text' disabled class='text' value=' ";
								if ( $row['Nombre_Proyecto'] == "" )
								{
								echo "SIN PROYECTO";
								}
								else
								{
								echo $row['Nombre_Proyecto'] ;
								}
								echo "'/ name='Nombre_Proyecto'></td>
                          	</tr>
							
                		</table>
                 	</div>
                      	<table>
							<tr> 
							<td width='25%'>
							<th colspan='4'><a href='EditarTarea.php?Nombre_Tarea=".$row['Nombre_Tarea']."'><input type='button' value='MODIFICAR' onclick='return Validar_EstadoTarea()'></a></th> 
							</td>
							<td width='25%'>
							<input type='submit' name='eliminar' value='ELIMINAR'>
							</td>
							<td width='25%'>
							</td>
							</tr>
                    	</table>
						</form>
				  <!-- FIN TABLA -->
                    
				</div>";
}

function Modificar_Tarea($ID_Usuario,$Nombre_Tarea,$Estado_Tarea)
{
ConectarDB();
$sql = "select * from Tarea where ID_Usuario = '$ID_Usuario' and Nombre_Tarea = '$Nombre_Tarea'";	
$resultado=mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($resultado);

echo " <div class='inner'>
		<h1 id='header'><a>- DETALLES $Nombre_Tarea -</a></h1> <!--SECCIÓN-->
		<!--INICIO TABLA-->
		<br>
				<form name='FormConsultar_Tarea' id='FormConsultar_Tarea' action='php/Clase_Tarea.php' method='post'>
				<div style='height:350px;width:auto;overflow-y: scroll;'>
				<table class='default'>
                   <tr>
					<td>Titulo:</td>
					<td>
					<input type='text' disabled class='text' value='".$row['Nombre_Tarea']."' / name='Nombre_Tarea'>
					</td>
					<td>Prioridad:</td>
					<td>";
					echo "<select name='Prioridad_Tarea'>
					  <option value='4'>-</option>
					  <option value='1'>Alta</option>
					  <option value='2'>Media</option>
					  <option value='3'>Baja</option>
					</select> ";
                     echo "</td>
					 <td>Estado:</td>
					<td>";
					switch ($row['Estado_Tarea'])
						{
						case "Creada":
						echo "<select name='Estado_Tarea'>
								<option value='Creada' selected>Creada</option>
								  <option value='En Curso'>En Curso</option>
								  <option value='Finalizada'>Finalizada</option>
								</select> ";
						break;
						case "En Curso":
						echo "<select name='Estado_Tarea'>
								  <option value='En Curso' selected>En Curso</option>
								  <option value='Finalizada'>Finalizada</option>
								</select> ";
						break;
						case "Finalizada":
						echo "<select name='Estado_Tarea'>
								  <option value='Finalizada' selected>Finalizada</option>
								</select> ";
						break;
						default:
							
						}
					echo "</td>
                      		</tr>
							
							<tr>
							<td>Etiqueta:</td>
                           	<td><input type='text' class='text' value='".$row['Etiqueta_Tarea']."'/ name='Etiqueta_Tarea'></td>	
							<td>Descripcion:</td>
                           	<td colspan='3'><input type='text' class='text' value='".$row['Descripcion_Tarea']."'/ name='Descripcion_Tarea'></td>
                          	</tr>
							
							<tr>
                               	<td colspan='2'>Fecha Inicio Estimada:</td>
                               	<td><input type='date' disabled/ value='".$row['Fecha_Inicio']."'></td>
                               	<td colspan='2'>Fecha Fin Estimada:</td>
                               	<td><input type='date' disabled/ value='".$row['Fecha_Fin_Estimada']."'></td>
                          	</tr>
							<tr>
                           		<td  colspan='2'>Fecha Inicio Real:</td>
                               	<td><input type='date' disabled value='".$row['Fecha_Inicio_Real']."'></td>
                               	<td colspan='2'>Fecha Fin Real:</td>
                               	<td><input type='date' disabled/ value='".$row['Fecha_Fin_Real']."'></td>
                          	</tr>
							
							<tr>
								<td></td>
                           		<td colspan='2'>Proyecto:</td>
                              	<td colspan='2'><input type='text' disabled class='text' value=' ";
								if ( $row['Nombre_Proyecto'] == "" )
								{
								echo "SIN PROYECTO";
								}
								else
								{
								echo $row['Nombre_Proyecto'] ;
								}
								echo "'/></td>
								<td></td>
                          	</tr>
							
                		</table>
                 	</div>
                      	<table>
							<tr> 
							<td width='25%'>
							<th colspan='4'><input type='submit' name='accion' value='GUARDAR'></th> 
							</td>
							<td width='25%'>
							</td>
							</tr>
                    	</table>
						</form>
				  <!-- FIN TABLA -->
                    
				</div>";
}

?>