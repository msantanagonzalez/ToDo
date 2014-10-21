function Registro_Password()
{
var PassOne=document.getElementById("Password_Usuario").value;
var PassTwo=document.getElementById("Password2_Usuario").value;
	if ( PassOne == PassTwo)
	{
		return true
	}
	else
	{
		alert("Los PASSWORDS deben ser iguales");
		return false;
	}
}

function Salir_Usuario()
{
		if(confirm("¿Quieres cerrar sesion?")) {
			return true;
		}		
		return false;
}

function Validar_EstadoNuevaTarea()
{
	if (document.getElementById("Validar_Estado").checked){
		 if(confirm("¿Quieres Empezar la tarea?")) {		
		 document.getElementsById('Estado_Tarea').selectedIndex = 1;
		}		
		else
		document.getElementsById('Estado_Tarea').selectedIndex = 0;
	}
  } 	


