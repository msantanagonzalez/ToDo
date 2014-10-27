<?php
require 'php/FuncionesGenerales.php';
class Admin{
		
	//-------------------------------------------------LISTAR USUARIOS---------------------------------------------
	public function Listar_Usuarios(){
		ConectarDB();
		$result = mysql_query("SELECT * FROM Usuario WHERE Tipo_Usuario LIKE '1'");
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
				echo "<td width='25%'>" . "<a href='AdminPerfil.php?usuario=$row[0]'>" . $row['ID_Usuario'] . "</td>";
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
				echo "<td width='20%'>"; switch ($row['Prioridad_Tarea']){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";} echo "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
	}
	
	//-------------------------------------------------LISTAR PROYECTOS----------------------------------------------
	public function Listar_Proyectos(){
		ConectarDB();
		if(isset($_POST['agregar'])){
			$proyecto = $_POST['proyecto'];
			$prioridad = $_POST['prioridad'];
			$usuario = $_GET['usuario'];
			mysql_query("INSERT INTO Proyecto (Nombre_Proyecto, Prioridad_Proyeto) VALUES('$proyecto','$prioridad')");
			$result = mysql_query("SELECT p.Nombre_Proyecto, p.ID_Usuario, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto AND t.ID_Usuario = p.ID_Usuario), p.Prioridad_Proyecto FROM Proyecto p WHERE ID_Usuario = '$usuario' ORDER BY p.Prioridad_Proyecto");
		}else{
			$result = mysql_query("SELECT p.Nombre_Proyecto, p.ID_Usuario, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto AND t.ID_Usuario = p.ID_Usuario), p.Prioridad_Proyecto FROM Proyecto p ORDER BY p.Prioridad_Proyecto");
		}
		
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesProyecto.php?proyecto=$row[0]&usuario=$row[1]'/>" . $row[0] . "</td>";
				echo "<td width='20%'>" . $row[1] . "</td>";
				echo "<td width='20%'>" . $row[2] . "</td>";
				echo "<td width='20%'>"; switch ($row[3]){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";}  echo "</td>";
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
				echo "<td width='20%'>"; switch ($row[3]){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";} echo "</td>";
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
							<option hidden value='$row[2]' selected>";switch($row[2]){case 1:echo 'Alta';break;case 2:echo'Media';break;case 3:echo 'Baja';break;case 4:echo '-';break;default:echo '-';} echo "</option>
							<option value='1'>Alta</option> 
							<option value='2'>Media</option> 
							<option value='3'>Baja</option> 
							<option value='4'>-</option> 
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
	
	// ------------------------------------------------------ BUSCAR --------------------------------------------------------------
	public function Buscar(){
		ConectarDB();
		if(isset($_POST['buscar'])){			
			$busqueda = $_POST['busqueda'];
		}
	
	echo "<h1 id='logo'><a>- RESULTADO EN USUARIOS -</a></h1>
	<table class='default'><!--TABLA-->
                       		<tr>
                            	<th width='25%'>Usuario</th>
                            	<th width='25%'>Provincia</th>
                           		<th width='25%'>Email</th>
                            	<th width='25%'>EDITAR</th>
                     		</tr>
                    	</table>
                  	<div style='height:170px;width:auto;overflow-y: scroll;'>
                   		<table class='default'>";
						
		$resultU = mysql_query("SELECT * FROM Usuario WHERE ID_Usuario LIKE '%$busqueda%' ORDER BY ID_Usuario");
		while($row = mysql_fetch_array($resultU)){
			echo "<tr>";
				echo "<td width='25%'>" . "<a href='AdminPerfil.php?usuario=$row[0]'>" . $row['ID_Usuario'] . "</td>";
				echo "<td width='25%'>" . $row['Provincia_Usuario'] . "</td>";
				echo "<td width='25%'>" . $row['Email_Usuario'] . "</td>";
				echo "<td width='22%'>" . "<form action='../AdminEditarPerfil.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}

	echo "</table> </div> <br>";
		
	echo "<h1 id='logo'><a>- RESULTADO EN TAREAS -</a></h1>
	<table class='default'><!--TABLA-->
                       		<tr>
                            	<th width='20%'>Tarea</th>
                            	<th width='20%'>Usuario</th>
                                <th width='20%'>Proyecto</th>
                           		<th width='20%'>Prioridad</th>
                            	<th width='20%'>EDITAR</th>
                     		</tr>
                    	</table>
                  	<div style='height:170px;width:auto;overflow-y: scroll;'>
                   		<table class='default'>";
		
		$resultT = mysql_query("SELECT * FROM Tarea WHERE Nombre_Tarea LIKE '%$busqueda%' ORDER BY Prioridad_Tarea");
		while($row = mysql_fetch_array($resultT)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesTarea.php'>" . $row['Nombre_Tarea'] . "</td>";
				echo "<td width='20%'>" . $row['ID_Usuario'] . "</td>";
				echo "<td width='20%'>" . $row['Nombre_Proyecto'] . "</td>";
				echo "<td width='20%'>"; switch ($row['Prioridad_Tarea']){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";} echo "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
		
	echo "</table></div><br>";	
	
	echo "<h1 id='logo'><a>- RESULTADO EN PROYECTOS -</a></h1>
	<table class='default'>
    	<tr>
			<th width='20%'>Proyecto</th>
			<th width='20%'>Usuario</th>
			<th width='20%'>Nº Tareas</th>
			<th width='20%'>Prioridad</th>
			<th width='20%'>EDITAR</th>
		</tr>
 	</table>
   	<div style='height:170px; width:auto; overflow-y: scroll;'>
  	<table class='default'>";	
		
		$resultP = mysql_query("SELECT p.Nombre_Proyecto, p.ID_Usuario, (SELECT count(*) FROM Tarea t WHERE t.Nombre_Proyecto = p.Nombre_Proyecto AND t.ID_Usuario = p.ID_Usuario), p.Prioridad_Proyecto FROM Proyecto p WHERE Nombre_Proyecto LIKE '%$busqueda%' ORDER BY p.Prioridad_Proyecto");
		while($row = mysql_fetch_array($resultP)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesProyecto.php?proyecto=$row[0]&usuario=$row[1]'/>" . $row[0] . "</td>";
				echo "<td width='20%'>" . $row[1] . "</td>";
				echo "<td width='20%'>" . $row[2] . "</td>";
				echo "<td width='20%'>"; switch ($row['Prioridad_Tarea']){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";} echo "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarProyecto.php?editarP=$row[0]&usuario=$row[1]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
		
	echo
	"</table></div><br>";
	
	}
	
	// ------------------------------------------------------ AGREGAR PROYECTO --------------------------------------------------------------
	public function Agregar_proyecto(){
		if(isset($_POST['user'])){
			$usuario = $_POST['usuario'];
		}
		echo "<form method='POST' action='AdminGestorProyectos.php?usuario=$usuario'>
		<table class='default'>
        	<tr>
               	<td>T&Iacute;TULO:</td>
				<td><input type='text' autofocus placeholder='$T&iacute;tulo deseado...' name='proyecto' value=''/></td>
				<td>PRIORIDAD:</td>
				<td>
					<select name='prioridad'>
						<option value='1'>Alta</option>
						<option value='2'>Media</option>
						<option value='3'>Baja</option>
						<option value='4' selected>-</option>
					</select>
				</td>
			</tr>           
	   <table>
			<tr> <th colspan='4'><input type='submit' value='MODIFICAR' name='agregar'></a></th> </tr>
		</table></form>";
	}
}
?>