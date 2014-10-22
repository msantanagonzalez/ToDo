<?php
require 'php/FuncionesGenerales.php';

if (isset($_POST['Prioridad'])) {
	$Pri = $_POST['Prioridad'];
	} else {
	$Pri = 'NULL';
	}

class Admin{
// Variables
var $Pri;


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
   			echo "<td width='20%'>" . "<a href='AdminDetallesTarea.php'>" . $row[0] . "</td>";
   			echo "<td width='20%'>" . $row['ID_Usuario'] . "</td>";
			echo "<td width='20%'>" . $row['Nombre_Proyecto'] . "</td>";
			echo "<td width='20%'>" . $row['Prioridad_Tarea'] . "</td>";
			echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//-------------------------------------------------LISTAR PROYECTOS----------------------------------------------
public function Listar_Proyectos(){
	ConectarDB();
	$result = mysql_query("SELECT p.Nombre_Proyecto, p.ID_Usuario, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto), p.Prioridad_Proyecto FROM Proyecto p ORDER BY p.Prioridad_Proyecto");
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
   			echo "<td width='20%'>" . "<a href='AdminDetallesProyecto.php?proyecto=$row[0]'/>" . $row[0] . "</td>";
   			echo "<td width='20%'>" . $row[1] . "</td>";
			echo "<td width='20%'>" . $row[2] . "</td>";
			echo "<td width='20%'>" . $row[3] . "</td>";
			echo "<td width='17%'>" . "<form action='../AdminEditarProyecto.php?editarP=$row[0]&prioridad=$row[2]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//--------------------------------------------------DETALLES PROYECTO------------------------------------------------
public function Listar_Tareas_Proyecto(){
	ConectarDB();
	$proyecto = $_GET['proyecto'];
	$result = mysql_query("SELECT t.Nombre_Tarea, t.ID_Usuario, t.Nombre_Proyecto, t.Prioridad_Tarea FROM Proyecto p, Tarea t WHERE p.Nombre_Proyecto LIKE '$proyecto' AND p.Nombre_Proyecto = t.Nombre_Proyecto ORDER BY t.Prioridad_Tarea");
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
   			echo "<td width='20%'>" . "<a href='AdminDetallesTarea.php'>" . $row[0] . "</td>";
   			echo "<td width='20%'>" . $row[1] . "</td>";
			echo "<td width='20%'>" . $row[2] . "</td>";
			echo "<td width='20%'>" . $row[3] . "</td>";
			echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
		echo "</tr>";
	}
}

//--------------------------------------------------EDITAR PROYECTO--------*No funciona!--------------
public function Editar_Proyecto(){
	ConectarDB();
	$proyecto = $_GET['editarP'];
	$result = mysql_query("SELECT * FROM Proyecto WHERE Nombre_Proyecto LIKE '$proyecto'");
	// $prioridad = $_GET['prioridad'];
	$row = mysql_fetch_array($result); 
	echo 
	"<form action='AdminDetallesProyecto.php?proyecto=$proyecto' method='POST' onsubmit='Cosa();'>" .
	"<tr>" .
    	"<td> T&Iacute;TULO: </td>" .
        	"<td><input type='text' class='text' disabled name='Titulo' value='$proyecto' /></td>" .
                "<td>PRIORIDAD:</td>" .
					"<td>" .
                   		"<select name='Prioridad'>" .
							"<option hidden value='$row[2]' selected>$row[2]</option>" .
                      		"<option value='1'>1</option>" .
                    		"<option value='2'>2</option>" .
                    		"<option value='3'>3</option>" .
                        	"<option value='4'>4</option>" .
                  		"</select>" .
                  	"</td>" .
   	"</tr>" .
	"<tr><td colspan='4'><input type='submit'/></td></tr>" .
	"</form>";
}
public function Cosa(){
	$proyecto = $_GET['proyecto'];
	$nuevaPrioridad = $_POST['Prioridad'];
	mysql_query("UPDATE Proyecto SET Prioridad_Proyecto = '1' WHERE Nombre_Proyecto LIKE 'P2'");
}
}
?>