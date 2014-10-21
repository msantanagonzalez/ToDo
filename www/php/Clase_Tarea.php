<?php
//Clase : Tarea
//Creado el : 10/15/2014
//Base De Dato: ToDo_DB
//Administrador: Admin_ToDo
//Contraseña: Pass_ToDo
//-------------------------------------------------------
require 'FuncionesGenerales.php';
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
								echo "<tr>"; 
								echo "<td width='25%'><a href='DetallesTarea.php'>"; 
								echo  $row['Nombre_Tarea'] ;
								echo "</a></td>";
                            	echo "<td width='25%'><a href='DetallesProyecto.php'>";
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
									echo "Sin prioridad";
									break;
									default:
									echo "Sin prioridad";
								}
								echo "</a></td>";
								echo "<td width='25%'>" . "<form action='EditarTarea.php' method='post'>" . "<button type='submit' name='Editar_Tarea'>" . "Editar" . "</button>" . "</form>" . "</td>";
								echo "</a></td>";
                       		echo "</tr>";
							}
}
else
{
	$sql = "select * from Tarea where ID_Usuario = '$ID_Usuario' order by Prioridad_Tarea";	
							$resultado=mysql_query($sql) or die(mysql_error());
							while($row = mysql_fetch_array($resultado))
							{
								echo "<tr>"; 
								echo "<td width='20%'><a href='DetallesTarea.php'>"; 
								echo  $row['Nombre_Tarea'] ;
								echo "</a></td>";
                            	echo "<td width='20%'><a href='DetallesProyecto.php'>";
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
									echo "Sin prioridad";
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



?>