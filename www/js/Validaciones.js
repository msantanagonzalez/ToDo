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



