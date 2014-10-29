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
				echo "<td width='22%'>" . "<form action='../AdminEditarPerfil.php?usuario=$row[0]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
	}
	
	//--------------------------------------------------LISTAR TAREAS----------------------------------------------
	public function Listar_Tareas(){
		ConectarDB();
		$result = mysql_query("SELECT * FROM Tarea ORDER BY Prioridad_Tarea");
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesTarea.php?tarea=$row[0]&usuario=$row[1]&proyecto=$row[2]'>" . $row[0] . "</td>";
				echo "<td width='20%'>" . $row['ID_Usuario'] . "</td>";
				echo "<td width='20%'>" . $row['Nombre_Proyecto'] . "</td>";
				echo "<td width='20%'>"; switch ($row['Prioridad_Tarea']){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";} echo "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php?tarea=$row[0]&usuario=$row[1]&proyecto=$row[2]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
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
	
	//------------------------------------------------------------DETALLES PROYECTO------------------------------------------------
	public function Listar_Tareas_Proyecto(){
		ConectarDB();
		if(isset($_POST['EliminarProyecto']))
		{
		$proyecto = $_GET['proyecto'];
		$usuario = $_GET['usuario'];
		$sql ="delete from Proyecto where ID_Usuario = '$usuario' and Nombre_Proyecto = '$proyecto'";
		echo $sql;
        mysql_query($sql) or die(mysql_error());
		header('location: /AdminGestorProyectos.php');
		}
		
		if(isset($_POST['AgregarTarea'])){
			$proyecto = $_POST['proyecto'];
			$usuario = $_POST['usuario'];
			mysql_query("INSERT INTO Tarea(Nombre_Tarea, ID_Usuario, Nombre_Proyecto, Descripcion_Tarea, Etiqueta_Tarea, Estado_Tarea, Prioridad_Tarea 
			, Fecha_Inicio, Fecha_Fin_Estimada, Fecha_Inicio_Real, Fecha_Fin_Real) VALUES('".$_POST['titulo']."', '$usuario', '$proyecto'
			, '".$_POST['descripcion']."', '".$_POST['etiqueta']."', '".$_POST['estado']."', '".$_POST['prioridad']."', '".$_POST['eFechaInicio']."'
			, '".$_POST['eFechaFin']."', '".$_POST['rFechaInicio']."', '".$_POST['rFechaFin']."')");
		}
		if(isset($_POST['EditarProyecto'])){			
			$proyecto = $_GET['proyecto'];
			$usuario = $_GET['usuario'];
			$nuevaPrioridad = $_POST['prioridad'];
			mysql_query("UPDATE Proyecto SET Prioridad_Proyecto = '$nuevaPrioridad' WHERE Nombre_Proyecto LIKE '$proyecto' AND ID_Usuario LIKE '$usuario'");		
		}else{
			$proyecto = $_GET['proyecto'];
			$usuario = $_GET['usuario'];
		}
		$result = mysql_query("SELECT t.Nombre_Tarea, t.ID_Usuario, t.Nombre_Proyecto, t.Prioridad_Tarea FROM Proyecto p, Tarea t WHERE p.Nombre_Proyecto= '$proyecto' AND p.Nombre_Proyecto = t.Nombre_Proyecto AND p.ID_Usuario = '$usuario' AND t.ID_Usuario = p.ID_Usuario ORDER BY t.Prioridad_Tarea");
		while($row = mysql_fetch_array($result)){
			echo "<tr>";
				echo "<td width='20%'>" . "<a href='AdminDetallesTarea.php?tarea=$row[0]&usuario=$row[1]&proyecto=$row[2]'>" . $row[0] . "</td>";
				echo "<td width='20%'>" . $row[1] . "</td>";
				echo "<td width='20%'>" . $row[2] . "</td>";
				echo "<td width='20%'>"; switch ($row[3]){case 1:echo "Alta";break;case 2:echo "Media";break;case 3:echo "Baja";break;
case 4:echo "-";break;default:echo "-";} echo "</td>";
				echo "<td width='17%'>" . "<form action='../AdminEditarTarea.php?tarea=$row[0]&usuario=$row[1]&proyecto=$row[2]' method='post'>" . "<button type='submit' name='Editar'>" . "Editar" . "</button>" . "</form>" . "</td>";
			echo "</tr>";
		}
		echo "<tr>
					<td colspan='6'>
						<form action='AdminAgregarTarea.php?usuario=$usuario&proyecto=$proyecto' method='post'>
							<input type='submit' name='AgregarTarea' value='AGREGAR TAREA'/>
						</form>
					</td>
				</tr>";
	}
	
	//--------------------------------------------------EDITAR PROYECTO----------------------------------
	public function Editar_Proyecto(){
		ConectarDB();
		$proyecto = $_GET['editarP'];
		$usuario = $_GET['usuario'];
		$result = mysql_query("SELECT * FROM Proyecto WHERE Nombre_Proyecto LIKE '$proyecto' AND ID_Usuario LIKE '$usuario'");
		$row = mysql_fetch_array($result);
	
		echo
		"<form method='POST' action='AdminDetallesProyecto.php?usuario=$usuario&proyecto=$proyecto'> 
		
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
					<td width='30%'></td>
                    <td width='20%' colspan='2'><input type='submit' name='EliminarProyecto' value='ELIMINAR'></a></td>
					<td width='15%'><input type='submit' name='EditarProyecto'/></td>
					<td width='30%'></td>
				</tr> 
			 </table>
		</form>";
	}
	
	// ------------------------------------------------------ AGREGAR PROYECTO --------------------------------------------------------------
	public function Agregar_proyecto(){
		ConectarDB();
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
	
	//--------------------------------------------------------DETALLES TAREA-----------------------------------------------------------
	public function Detalles_Tarea(){
		ConectarDB();
		if(isset($_POST['EditarTarea'])){			
			//$proyecto = $_POST['proyecto'];
			$usuario = $_POST['usuario'];
			$tarea = $_POST['tarea'];
			$proyecto = $_POST['proyecto'];
			mysql_query("UPDATE Tarea SET Descripcion_Tarea='".$_POST['descripcion']."', Etiqueta_Tarea='".$_POST['etiqueta']."', Prioridad_Tarea='".$_POST['prioridad']."', Fecha_Inicio_Real='".$_POST['rFechaInicio']."', Fecha_Fin_Real='".$_POST['rFechaFin']."', Nombre_Proyecto ='$proyecto' WHERE ID_Usuario = '$usuario' AND Nombre_Tarea = '$tarea'");		
		}else{
			$tarea = $_GET['tarea'];
			$usuario = $_GET['usuario'];
			$proyecto = $_GET['proyecto'];
		}
		$result = mysql_query("SELECT * FROM Tarea WHERE Nombre_Tarea = '$tarea' AND ID_Usuario = '$usuario'");
		$row = mysql_fetch_array($result);
		echo "<form method='post' action='AdminEditarTarea.php?tarea=$tarea&usuario=$usuario'>			
				<div style='height:395px;width:auto;overflow-y: scroll;'>
				<table class='default'>
				
                   <tr>
					<td>Titulo:</td>
					<td><input type='text' disabled value='$row[0]''></td>
					<td>Prioridad:</td>
					<td>
					<select disabled name='prioridad'> 
							<option hidden value='$row[6]' selected>";
							switch($row[6]){case 1:echo 'Alta';break;case 2:echo'Media';break;case 3:echo 'Baja';
							break;case 4:echo '-';break;default:echo '-';} echo "</option>
							<option value='1'>Alta</option> 
							<option value='2'>Media</option> 
							<option value='3'>Baja</option> 
							<option value='4'>-</option> 
						</select> </td>
					 </tr>
					
					<tr>
					 <td>Estado:</td>
					<td><input type='text' disabled  value='$row[5]' name='estado' id='Estado_Tarea'></td>
					<td>Etiqueta:</td>
					<td><input type='text' disabled value='$row[4]' name='etiqueta'></td>	
					</tr>
					</tr>
							<td>Descripcion:</td>
                           	<td colspan='3'><input type='text' disabled value='$row[3]' name='descripcion'></td>
                    </tr>
							
							<tr>
                               	<td>Fecha Inicio Estimada:</td>
                               	<td><input type='date' disabled name='eFechaInicio' value='$row[7]'></td>
                               	<td>Fecha Fin Estimada:</td>
                               	<td><input type='date' disabled name='eFechaFin' value='$row[8]'></td>
                          	</tr>
							<tr>
                           		<td>Fecha Inicio Real:</td>
                               	<td><input type='date' disabled name='rFechaInicio' value='$row[9]'></td>
                               	<td>Fecha Fin Real:</td>
                               	<td><input type='date' disabled name='rFechaFin' value='$row[10]'></td>
                          	</tr>
							
							<tr>
                           		<td>Proyecto:</td>
                              	<td colspan='3'>
								<select name='proyecto'>";
									$result = mysql_query("SELECT Nombre_Proyecto FROM Proyecto WHERE ID_Usuario = '$usuario'");
									echo "<option hidden selected value='$proyecto'> $proyecto </option>";
									while($row = mysql_fetch_array($result))
										echo "<option value='".$row['Nombre_Proyecto']."'> $row[0] </option>";
								echo "</select>
										
                          		</td>
                          	</tr>
							
                		</table>
                 	</div>
					<table class='alternative'>
                          	<tr>
								<td width='30%'></td>
                              	<td width='20%' colspan='2'><input type='submit' name='EliminarTarea' value='ELIMINAR'></a></td>
								<td width='15%'><input type='submit' name='DetallesTarea' value='MODIFICAR' onclick='return Validar_EstadoTarea()'></td>
								<td width='30%'></td>
                          	</tr>
                      	</table>
						</form>	";
	}
	
	// ---------------------------------------------------------------EDITAR TAREA---------------------------------------------------------------
	public function Editar_Tarea(){
	
		ConectarDB();

		$tarea = $_GET['tarea'];
		$usuario = $_GET['usuario'];
		$proyecto = $_GET['proyecto'];
		
		if(isset($_POST['EliminarTarea']))
		{
		$sql ="delete from Tarea where ID_Usuario = '$usuario' and Nombre_Tarea = '$tarea'";
        mysql_query($sql) or die(mysql_error());
		header('location: /AdminGestorTareas.php');
		}
		
		$result = mysql_query("SELECT * FROM Tarea WHERE Nombre_Tarea = '$tarea' AND ID_Usuario = '$usuario'");
		$row = mysql_fetch_array($result);
		echo "<form method='post' action='AdminDetallesTarea.php?tarea=$tarea&usuario=$usuario&proyecto=$proyecto'>
				<input type='hidden' name='tarea' value='$tarea'>
				<input type='hidden' name='usuario' value='$usuario'>
				<input type='hidden' name='proyecto' value='$proyecto'>		
				<div style='height:395px;width:auto;overflow-y: scroll;'>
				<table class='default'>
				
                   <tr>
					<td>Titulo:</td>
					<td><input type='text' disabled value='$row[0]''></td>
					<td>Prioridad:</td>
					<td>
					<select name='prioridad'> 
							<option hidden value='$row[6]' selected>";
							switch($row[6]){case 1:echo 'Alta';break;case 2:echo'Media';break;case 3:echo 'Baja';
							break;case 4:echo '-';break;default:echo '-';} echo "</option>
							<option value='1'>Alta</option> 
							<option value='2'>Media</option> 
							<option value='3'>Baja</option> 
							<option value='4'>-</option> 
						</select> </td>
					 </tr>
					
					<tr>
					 <td>Estado:</td>
					<td><input type='text' value='$row[5]' name='estado'></td>
					<td>Etiqueta:</td>
					<td><input type='text' value='$row[4]' name='etiqueta'></td>	
					</tr>
					</tr>
							<td>Descripcion:</td>
                           	<td colspan='3'><input type='text' value='$row[3]' name='descripcion'></td>
                    </tr>
							
							<tr>
                               	<td>Fecha Inicio Estimada:</td>
                               	<td><input type='date' disabled name='eFechaInicio' value='$row[7]'></td>
                               	<td>Fecha Fin Estimada:</td>
                               	<td><input type='date' disabled name='eFechaFin' value='$row[8]'></td>
                          	</tr>
							<tr>
                           		<td>Fecha Inicio Real:</td>
                               	<td><input type='date' name='rFechaInicio' value='$row[9]'></td>
                               	<td>Fecha Fin Real:</td>
                               	<td><input type='date' name='rFechaFin' value='$row[10]'></td>
                          	</tr>
							
							<tr>
                           		<td>Proyecto:</td>
                              	<td colspan='3'>
								<select name='proyecto'>";
									$result = mysql_query("SELECT Nombre_Proyecto FROM Proyecto WHERE ID_Usuario = '$usuario'");
									echo "<option hidden selected value='$proyecto'> $proyecto </option>";
									while($row = mysql_fetch_array($result))
										echo "<option value='".$row['Nombre_Proyecto']."'> $row[0] </option>";
								echo "</select>
										
                          		</td>
							</tr>
							
                		</table>
                 	</div>
                   	<div align='center' style='margin-top:1em'><input type='submit' name='EditarTarea' value='GUARDAR' onclick='return Validar_EstadoTarea()'></div>
				</form>	";
	}
	
	//------------------------------------------------------AGREGAR TAREA-----------------------------------------------------------
	public function Agregar_Tarea(){
		ConectarDB();
		$usuario = $_GET['usuario'];
		$proyecto = $_GET['proyecto'];
		echo "<form method='post' action='AdminDetallesProyecto.php?usuario=$usuario&proyecto=$proyecto'>
				<input type='hidden' name='usuario' value='$usuario'>	
				<input type='hidden' name='proyecto' value='$proyecto'>
				<div style='height:350px;width:auto;overflow-y: scroll;'>
				<table class='default'>
                   <tr>
					<td>Titulo:</td>
					<td><input type='text' name='titulo' value=''></td>
					<td>Prioridad:</td>
					<td>
					<select name='prioridad'> 
								<option value='1'>Alta</option>
								<option value='2'>Media</option>
								<option value='3'>Baja</option>
								<option value='4' selected>-</option>
						</select> </td>
					 </tr>
					
					<tr>
					 <td>Estado:</td>
					<td><input type='text' value='' name='estado'></td>
					<td>Etiqueta:</td>
					<td><input type='text' value='' name='etiqueta'></td>	
					</tr>
					</tr>
							<td>Descripcion:</td>
                           	<td colspan='3'><input type='text' value='' name='descripcion'></td>
                    </tr>
							
							<tr>
                               	<td>Fecha Inicio Estimada:</td>
                               	<td><input type='date' name='eFechaInicio' value=''></td>
                               	<td>Fecha Fin Estimada:</td>
                               	<td><input type='date' name='eFechaFin' value=''></td>
                          	</tr>
							<tr>
                           		<td>Fecha Inicio Real:</td>
                               	<td><input type='date' name='rFechaInicio' value=''></td>
                               	<td>Fecha Fin Real:</td>
                               	<td><input type='date' name='rFechaFin' value=''></td>
                          	</tr>
							
                		</table>
                 	</div>
                      	<table>
							<tr> 
								<input type='submit' name='AgregarTarea' value='GUARDAR' onclick='return Validar_EstadoTarea()'>
							</tr>
                    	</table>
						</form>	";
	}
	
	//---------------------------------------------------------EDITAR PERFIL-------------------------------------------------------------
	public function Editar_Perfil(){
		ConectarDB();
		
		if (isset($_POST['EliminarUsuario'])) {
		if (isset($_GET['usuario'])) {
		$ID_Usuario = $_GET['usuario'];
		} else {
		$ID_Usuario = "NULL";
		}
			Baja_Usuario($ID_Usuario);
	}
		
		$usuario = $_GET['usuario'];
		$result = mysql_query("SELECT * FROM Usuario WHERE ID_Usuario = '$usuario'");
		$row = mysql_fetch_array($result);
		
		echo "<form method='post' action='AdminPerfil.php?usuario=$usuario' onsubmit='return Validar_CodigoPostal();'>
				<input type='hidden' name='usuario' value='$usuario'>
				<div style='height:350px;width:auto;overflow-y: scroll;'>
					<table class='default'>
						<tr> 
						<td>USUARIO:</td> 
                         <td><input type='text' class='text' value='".$row['Nombre_Usuario']."' name='nombre'></td>
                               	<td>CORREO:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Email_Usuario']."' name='email'></td>
                          	</tr>
                           	<tr>
                             	<td>APELLIDO1:</td>
                               	<td><input type='text' class='text' value='".$row['Apellido1_Usuario']."' name='apel1'></td>
                               	<td>APELLIDO2:</td>
                              	<td><input type='text' class='text' value='".$row['Apellido2_Usuario']."' name='apel2'></td>
                         	</tr>
                          	<tr>
                               	<td>CALLE:</td>
                              	<td><input type='text' class='text' value='".$row['Calle_Usuario']."' name='calle'></td>
								<td>PORTAL:</td>
                               	<td><input type='text' class='text' value='".$row['N_Portal_Usuario']."' name='portal'></td>
                               	
                       		</tr>
							<tr>
                          		<td>PROVINCIA:</td>
                              	<td><input type='text' class='text' value='".$row['Provincia_Usuario']."' name='provincia'></td>
								<td>CODIGO POSTAL:</td>
                              	<td><input type='text' class='text' value='".$row['CP_Usuario']."' name='cp' id='Campo_CodigoPostal'></td>
                       		</tr>
							<tr>
								<td>FECHA DE NACIMIENTO:</td>
                               	<td colspan='3'><input type='text' class='text' value='".$row['Fecha_Nacimiento']."' name='fechaNac'></td>
											
							</tr>
                     	</table>
                    </div>
                      	<table class='alternative'>
                          	<tr>
							<td width='30%'></td>
                              	<td width='10%' colspan='4'><input type='submit' name='EditarPerfil' value='GUARDAR'></a></td>
								<td width='25%'></td>
                          	</tr>
                      	</table>
					</form> ";	
	}
	
	//---------------------------------------------------------VER PERFIL------------------------------------------------------------
	public function Ver_Perfil(){
		ConectarDB();
		if(isset($_POST['EditarPerfil'])){
			$usuario = $_POST['usuario'];
			mysql_query("UPDATE Usuario SET Nombre_Usuario = '".$_POST['nombre']."', Apellido1_Usuario = '".$_POST['apel1']."'
			, Apellido2_Usuario = '".$_POST['apel2']."', Fecha_Nacimiento = '".$_POST['fechaNac']."'
			, Calle_Usuario = '".$_POST['calle']."', N_Portal_Usuario = '".$_POST['portal']."', Provincia_Usuario = '".$_POST['provincia']."'
			, CP_Usuario = '".$_POST['cp']."' WHERE ID_Usuario = '$usuario'");
			
		} else $usuario = $_GET['usuario'];
		
		$result = mysql_query("SELECT * FROM Usuario WHERE ID_Usuario = '$usuario'");
		$row = mysql_fetch_array($result);
		
		echo "<form method='POST' action='AdminEditarPerfil.php?usuario=$usuario''>
				<div style='height:350px;width:auto;overflow-y: scroll;'>
					<table class='default'>
						<tr> 
						<td>USUARIO:</td> 
                         <td><input type='text' disabled class='text' value='".$row['Nombre_Usuario']."' name='nombre'></td>
                               	<td>CORREO:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Email_Usuario']."' name='email'></td>
                          	</tr>
                           	<tr>
                             	<td>APELLIDO1:</td>
                               	<td><input type='text' disabled class='text' value='".$row['Apellido1_Usuario']."' name='apel1'></td>
                               	<td>APELLIDO2:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Apellido2_Usuario']."' name='apel2'></td>
                         	</tr>
                          	<tr>
                               	<td>CALLE:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Calle_Usuario']."' name='calle'></td>
								<td>PORTAL:</td>
                               	<td><input type='text' disabled class='text' value='".$row['N_Portal_Usuario']."' name='portal'></td>
                               	
                       		</tr>
							<tr>
                          		<td>PROVINCIA:</td>
                              	<td><input type='text' disabled class='text' value='".$row['Provincia_Usuario']."' name='provincia'></td>
								<td>CODIGO POSTAL:</td>
                              	<td><input type='text' disabled class='text' value='".$row['CP_Usuario']."' name='cp' id='Campo_CodigoPostal'></td>
                       		</tr>
							<tr>
								<td>FECHA DE NACIMIENTO:</td>
                               	<td colspan='3'><input type='text' disabled class='text' value='".$row['Fecha_Nacimiento']."' name='fechaNac'></td>
												
							</tr>
                     	</table>
                    </div>
                      	<table class='alternative'>
                          	<tr>
								<td width='30%'></td>
                              	<td width='20%' colspan='2'><input type='submit' name='EliminarUsuario' value='ELIMINAR'></a></td>
								<td width='15%'><input type='submit' name='DetallesTarea' value='MODIFICAR'></td>
								<td width='30%'></td>
                          	</tr>
                      	</table>
					</form> ";	
	}
}
//---------------------------------------Modificar_PassAdmin-------------------------------------------------
function Modificar_PassAdmin($ID_Usuario){
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
				     header('location: /Admin.php');
					
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
echo 			"<form name='FormModificar_Pass' id='FormModificar_Pass' onsubmit='return Validar_NuevoPass()' action='AdminEditarPass.php' method='post'>
					
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
//---------------------------------------Baja_Usuario-------------------------------------------------
function Baja_Usuario($ID_Usuario){
	ConectarDB();

		$sql = "select * from Usuario where ID_Usuario= '".$ID_Usuario."'";
		echo $sql;
        $resultado = mysql_query($sql) or die(mysql_error());
		$res = mysql_fetch_array($resultado);
        if (mysql_num_rows($resultado) == 1){
			$sql_delete="DELETE FROM Usuario where ID_Usuario = '".$ID_Usuario."'";
			$resul_delete = mysql_query($sql_delete) or die("?No se ha podido eliminar el registro!");
			header('location: /AdminGestorUsuarios.php');
		}
		else
		{
		}

}//fin Baja_Usuario

?>