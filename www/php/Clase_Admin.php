<?php
require 'php/FuncionesGenerales.php';
class Admin{
		
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
		$result = mysql_query("SELECT p.Nombre_Proyecto, p.ID_Usuario, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto AND t.ID_Usuario = p.ID_Usuario), p.Prioridad_Proyecto FROM Proyecto p ORDER BY p.Prioridad_Proyecto");
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesProyecto.php?proyecto=$row[0]&usuario=$row[1]'/>" . $row[0] . "</td>";
				echo "<td width='20%'>" . $row[1] . "</td>";
				echo "<td width='20%'>" . $row[2] . "</td>";
				echo "<td width='20%'>" . $row[3] . "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarProyecto.php?editarP=$row[0]&usuario=$row[1]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
	}
	
	//--------------------------------------------------DETALLES PROYECTO------------------------------------------------
	public function Listar_Tareas_Proyecto(){
		ConectarDB();
		if(isset($_POST['accion'])){			
			$proyecto = $_POST['proyecto'];
			$usuario = $_GET['usuario'];
			$nuevaPrioridad = $_POST['prioridad'];
			mysql_query("UPDATE Proyecto SET Prioridad_Proyecto = '$nuevaPrioridad' WHERE Nombre_Proyecto LIKE '$proyecto' AND ID_Usuario LIKE '$usuario'");		
		}
		
		$proyecto = $_GET['proyecto'];
		$usuario = $_GET['usuario'];
		$result = mysql_query("SELECT t.Nombre_Tarea, t.ID_Usuario, t.Nombre_Proyecto, t.Prioridad_Tarea FROM Proyecto p, Tarea t WHERE p.Nombre_Proyecto= '$proyecto' AND p.Nombre_Proyecto = t.Nombre_Proyecto AND p.ID_Usuario = '$usuario' AND t.ID_Usuario = p.ID_Usuario ORDER BY t.Prioridad_Tarea");
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
	
	//--------------------------------------------------EDITAR PROYECTO----------------------------------
	public function Editar_Proyecto(){
		
		ConectarDB();
		$proyecto = $_GET['editarP'];
		$usuario = $_GET['usuario'];
		$result = mysql_query("SELECT * FROM Proyecto WHERE Nombre_Proyecto LIKE '$proyecto' AND ID_Usuario LIKE '$usuario'");
		$row = mysql_fetch_array($result);
	
		echo
		"<form method='POST' action='AdminDetallesProyecto.php?proyecto=$proyecto&usuario=$usuario'> 
			<input type='hidden' name='proyecto' value='$proyecto' />
			<input type='hidden' name='usuario' value='$usuario' />
			<table class='default'>
				<tr> 
					<td> T&Iacute;TULO: </td> 
					<td><input type='text' class='text' disabled name='Titulo' value='$proyecto' /></td> 
					<td>PRIORIDAD:</td> 
					<td> 
						<select name='prioridad'> 
							<option hidden value='$row[2]' selected>$row[2]</option> 
							<option value='1'>1</option> 
							<option value='2'>2</option> 
							<option value='3'>3</option> 
							<option value='4'>4</option> 
						</select> 
					</td> 
				</tr> 
				<tr>
					<td colspan='4'>
						<input type='submit' name='accion'/>
					</td>
				</tr> 
			 </table>
		</form>";
	}
	
	public function Buscar(){
		ConectarDB();
		if(isset($_POST['buscar'])){			
			$busqueda = $_POST['busqueda'];
		}
	//-------------------------------------------------LISTAR USUARIOS--------------------------------------------
		$resultU = mysql_query("SELECT * FROM Usuario WHERE ID_Usuario LIKE '%$busqueda%' ORDER BY ID_Usuario");
		while($row = mysql_fetch_array($resultU)){
			echo "<tr>";
				echo "<td width='25%'>" . "<a href='AdminPerfil.php'>" . $row['Nombre_Usuario'] . "</td>";
				echo "<td width='25%'>" . $row['Provincia_Usuario'] . "</td>";
				echo "<td width='25%'>" . $row['Email_Usuario'] . "</td>";
				echo "<td width='22%'>" . "<form action='../AdminEditarPerfil.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
	
	//--------------------------------------------------LISTAR TAREAS----------------------------------------------
		$resultT = mysql_query("SELECT * FROM Tarea WHERE Nombre_Tarea LIKE '%$busqueda%' ORDER BY Prioridad_Tarea");
		while($row = mysql_fetch_array($resultT)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesTarea.php'>" . $row['Nombre_Tarea'] . "</td>";
				echo "<td width='20%'>" . $row['ID_Usuario'] . "</td>";
				echo "<td width='20%'>" . $row['Nombre_Proyecto'] . "</td>";
				echo "<td width='20%'>" . $row['Prioridad_Tarea'] . "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
	
	//-------------------------------------------------LISTAR PROYECTOS----------------------------------------------
		$resultP = mysql_query("SELECT p.Nombre_Proyecto, p.ID_Usuario, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto AND t.ID_Usuario = p.ID_Usuario), p.Prioridad_Proyecto FROM Proyecto p WHERE Nombre_Proyecto LIKE '%$busqueda%' ORDER BY p.Prioridad_Proyecto");
		while($row = mysql_fetch_array($resultP)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesProyecto.php?proyecto=$row[0]&usuario=$row[1]'/>" . $row[0] . "</td>";
				echo "<td width='20%'>" . $row[1] . "</td>";
				echo "<td width='20%'>" . $row[2] . "</td>";
				echo "<td width='20%'>" . $row[3] . "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarProyecto.php?editarP=$row[0]&usuario=$row[1]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
	}
}
?>