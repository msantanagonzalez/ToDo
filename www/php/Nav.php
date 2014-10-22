<?php
class Nav{	
	public function NavAdmin($ID_Usuario){
		echo "<div id='sidebarAdmin'> 
			<h1 id='header'><a href='Admin.php'>To-Do.</a></h1>		
                <nav id='nav'> 
              		<ul>
                		<div align='center'>
                       		<li class='current'><strong><a><img src='images/DefaultAvatar.png'><br>".$ID_Usuario."</a></strong></li>
							<li class='current'><a href='AdminGestorUsuarios.php'>GESTIONAR USUARIOS</a></li>
                           	<li class='current'><a href='AdminGestorProyectos.php'>GESTIONAR PROYECTOS</a></li>
                           	<li class='current'><a href='AdminGestorTareas.php'>GESTIONAR TAREAS</a></li>
							<li class='current'><a href='/php/Cerrar_Sesion.php' id='Logout_Usuario' onclick ='return Salir_Usuario()'>Log Out >]</a></li>
                            <form method='post' action='Buscar' style='text-align:center'>
                        	<section class='box search'>
								<ul class='desplegable'>
									<li style='width:100%'>
										<input type='text' class='text' name='Palabra' placeholder='Buscar...' />
											<ul style='width:100%'>
												<input type='text' class='text' name='Prioridad' placeholder='Usuario' />
												<input type='text' class='text' name='Prioridad' placeholder='Prioridad' />
												<input type='text' class='text' name='Proyecto' placeholder='Proyecto' />
												<input type='date' name='Fecha' />
											</ul>
										</li>
									</ul>
                      			</section>
                            </form>
                      	</div>
					</ul>
				</nav>
		</div>";
	}
	
	public function NavUser($ID_Usuario){
		echo "<div id='sidebar'> 
			<h1 id='logo'><a href='Index.php'>To-Do.</a></h1> 	
                <nav id='nav'> 
              		<ul>
                		<div align='center'>
                       		<li class='current'>
                            	<a href='Perfil.php'>
                            		<img src='images/DefaultAvatar.png'><em><strong><br>".$ID_Usuario."</strong></em><strong></strong></img>
                            	</a>
                         	</li>
							<li class='current'><strong><a href='AgregarTarea.php'>NUEVA TAREA (+)</a></strong></li>
							<li class='current'><a href='ListadoProyectos.php'>LISTADO PROYECTOS.</a></li>
                            <li class='current'><a href='ListadoTareas.php'>LISTADO TAREAS.</a></li>
							<li class='current'><a href='/php/Cerrar_Sesion.php' id='Logout_Usuario' onclick ='return Salir_Usuario()'>Log Out >]</a></li>
                            <form method='post' action='Buscar' style='text-align:center'>
                        	<section class='box search'>
								<ul class='desplegable'>
									<li style='width:100%'>
										<input type='text' class='text' name='Palabra' placeholder='Buscar...' />
											<ul style='width:100%'>
												<input type='text' class='text' name='Prioridad' placeholder='Prioridad' />
												<input type='text' class='text' name='Proyecto' placeholder='Proyecto' />
												<input type='date' name='Fecha' />
											</ul>
										</li>
									</ul>
                      			</section>
                            </form>
                      	</div>
					</ul>
				</nav>
		</div>";
	}
}
?>