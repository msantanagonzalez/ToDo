<?php
require 'php/FuncionesGenerales.php';
class Admin{
// Variables
private $Proyecto;

// Funciones
public function getProyecto(){
	return $this->Proyecto;
}

public function setProyecto($Proyecto){
	$this->Proyecto = $Proyecto;
}

//-------------------------------------------------LISTAR USUARIOS---------------------------------------------
public function Listar_Usuarios(){
	ConectarDB();
	$result = mysql_query("SELECT * FROM Usuario WHERE Tipo_Usuario LIKE '1'");
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
   			echo "<td width='25%'>" . "<a href='AdminPerfil.php'>" . $row['Nombre_Usuario'] . "</td>";
   			echo "<td width='25%'>" . $row['Provincia_Usuario'] . "</td>";
			echo "<td width='25%'>" . $row['Email_Usuario'] . "</td>";
			echo "<td width='22%'>" . "<form action='../AdminEditarPerfil.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//--------------------------------------------------LISTAR TAREAS----------------------------------------------
public function Listar_Tareas(){
	ConectarDB();
	$result = mysql_query("SELECT * FROM Tarea ORDER BY Prioridad_Tarea");
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
   			echo "<td width='25%'>" . "<a href='AdminDetallesTarea.php'>" . $row['Nombre_Tarea'] . "</td>";
   			echo "<td width='25%'>" . $row['Nombre_Proyecto'] . "</td>";
			echo "<td width='25%'>" . $row['Prioridad_Tarea'] . "</td>";
			echo "<td width='22%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//-------------------------------------------------LISTAR PROYECTOS----------------------------------------------
public function Listar_Proyectos(){
	ConectarDB();
	$result = mysql_query("SELECT p.Nombre_Proyecto, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto), p.Prioridad_Proyecto FROM Proyecto p ORDER BY p.Prioridad_Proyecto");
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
   			echo "<td width='25%'>" . "<a href='AdminDetallesProyecto.php?proyecto=$row[0]'/>" . $row[0] . "</td>";
   			echo "<td width='25%'>" . $row[1] . "</td>";
			echo "<td width='25%'>" . $row[2] . "</td>";
			echo "<td width='22%'>" . "<form action='../AdminEditarProyecto.php?editarP=$row[0]&prioridad=$row[2]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//--------------------------------------------------DETALLES PROYECTO------------------------------------------------
public function Listar_Tareas_Proyecto(){
	ConectarDB();
	$proyecto = $_GET['proyecto'];
	$result = mysql_query("SELECT Nombre_Tarea, Prioridad_Tarea FROM Proyecto p, Tarea t WHERE p.Nombre_Proyecto LIKE '$proyecto' AND p.Nombre_Proyecto = t.Nombre_Proyecto ORDER BY t.Prioridad_Tarea");
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
   			echo "<td width='33%'>" . "<a href='AdminDetallesTarea.php'>" . $row[0] . "</td>";
   			echo "<td width='33%'>" . $row[1] . "</td>";
			echo "<td width='30%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//--------------------------------------------------EDITAR PROYECTO--------------------------------------------------
public function Editar_Proyecto(){
	ConectarDB();
	$proyecto = $_GET['editarP'];
	$result = mysql_query("SELECT * FROM Proyecto WHERE Nombre_Proyecto LIKE '$proyecto'");
	// $prioridad = $_GET['prioridad'];
	$row = mysql_fetch_array($result); 
	echo "<tr>" .
    	"<td> T&Iacute;TULO: </td>" .
        	"<td><input type='text' class='text' disabled name='Titulo' value='$proyecto' /></td>" .
                "<td>PRIORIDAD:</td>" .
					"<td>" .
					"<form method='post' action='Clase_Admin.php'>" .
                   		"<select name='Prioridad'>" .
							"<option hidden value='$row[2]' selected>$row[2]</option>" .
                      		"<option value='1'>1</option>" .
                    		"<option value='2'>2</option>" .
                    		"<option value='3'>3</option>" .
                        	"<option value='4'>4</option>" .
                  		"</select>" .
					"</form>" .
                  	"</td>" .
   	"</tr>";
	$nuevaPrioridad = $_POST['Prioridad'];
	echo $nuevaPrioridad;
	//$update = "UPDATE Proyecto SET Prioridad_Proyecto = '$nuevaPrioridad' WHERE Nombre_Proyecto LIKE '$proyecto'";
	
echo	"<tr><td colspan='4'> <a href='AdminDetallesProyecto.php?proyecto=$proyecto'>YO EDITO COSAS.</a></td></tr>";
	// <input type='submit'onsubmit='mysql_query($update) name='accion' value='MODIFICAR!'/>
}
}
?>