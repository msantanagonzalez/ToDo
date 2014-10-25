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
		alert("|ERROR| Los PASSWORDS deben ser iguales");
		return false;
	}
}

function Fecha_Sistema()
{
var f = new Date();
document.write(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
}

function Salir_Usuario()
{
		if(confirm("¿Quieres cerrar sesion?")) {
			return true;
		}		
		return false;
}

function Validar_Entero(Numero)
{
if (Numero % 1 == 0) {
		return true;
    }
    else
		alert ("|ERROR| Valor: " + "'" + Numero +"'" + " debe ser entero");
		return false;
}

function Validar_CodigoPostal()
{
	var codigoPostal = document.getElementById("Campo_CodigoPostal").value;
	if (isNaN(codigoPostal) == true){
        alert ("|ERROR| Valor: " + "'" + codigoPostal +"'" + " debe ser numerico");
		return false;
    }
	else
	{
		if (Validar_Entero(codigoPostal)){
			if(codigoPostal.length == 0 | codigoPostal.length == 5)
			{
				if(confirm("¿Modificar datos?")) {
				alert("Informacion modificada correctamente");
					return true;
				}		
				else
				{
				return false;
				}
			
			}
			else 
			{
				alert("|ERROR| El formato del codigo postal no es correcto");
				return false;
			}
				return false;
		}
	}
}

function Confirmar_EliminacionProyecto()
{
	if(confirm("¿Eliminar Proyecto?"))
	{
		alert("Proyecto Eliminado");
		return true;
	}		
	else
	{
		return false;
	}
}

function Confirmar_EliminacionTarea()
{
	if(confirm("¿Eliminar Tarea?"))
	{
		alert("Tarea Eliminado");
		return true;
	}		
	else
	{
		return false;
	}
}

function Validar_EstadoTarea()
{
	var estadoTarea=document.getElementById("Estado_Tarea").value;
	if( estadoTarea == "Finalizada" )
	{
		alert("|ERROR| Tarea finalizada");
		return false;
	}
	else
	{
		return true;
	}
}

function Confirmar_Modificacion()
{
	if(confirm("¿Modificar datos?"))
	{
		alert("Datos modificados");
		return true;
	}		
	else
	{
		return false;
	}
}

function Confirmar_BajaUsuario()
{
	if(confirm("¿Deseas darte de baja?"))
	{
		alert("Muchas gracias");
		return true;
	}		
	else
	{
		return false;
	}
}
