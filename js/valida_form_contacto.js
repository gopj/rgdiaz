// --		Desarrollado por SharkSoft 
// -- 		Adan Cruz Huerta
// -- 		Jonathan Yaran Ramos Vazquez
// --		Erick Alejandro Sandoval Flores
// -- 		Christian Ramon Magallon Garcia
//	Script para validar el envio de el formulario de contactanos. Campos vacios y validos!!

function validarForm(){
	var verificar = true;
	var expRegEmail= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;//Expresion regular correo
	var formulario = document.getElementById("form_contacto");
	var nombre = document.getElementById("nombre");
	var telefono = document.getElementById("telefono");
	var email = document.getElementById("email");
	var asunto = document.getElementById("asunto");
	var mensaje = document.getElementById("mensaje");

	if(!nombre.value)
	{
		alert("EL CAMPO NOMBRE DEL CONTACTO O DE LA EMPRESA ES REQUERIDO");
		nombre.focus();
		verificar = false;
	}
	else if(!telefono.value){
		alert("EL CAMPO TELEFONO ES REQUERIDO");
		telefono.focus();
		verificar = false;
	}
	else if(!email.value || !expRegEmail.exec(email.value)){
		alert("EL CAMPO DIRECCION DE EMAIL ES REQUERIDO O NO ES VALIDO");
		email.focus();
		verificar = false;
	}
	else if(!asunto.value){
		alert("EL CAMPO ASUNTO ES REQUERIDO");
		asunto.focus();
		verificar = false;
	}
	else if(!mensaje.value){
		alert("EL CAMPO MENSAJE ES REQUERIDO");
		mensaje.focus();
		verificar = false;
	}
	if (verificar){
		// Mandamos el formulario 
		formulario.submit();
		formulario.reset();
		alert('¡SU MENSAJE HA SIDO ENVIADO, PRONTO NOS COMUNICAREMOS CON USTED!');
	}
}