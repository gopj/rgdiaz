//	Funcion para validar al agregar una carpeta nueva
function valida_nom_carpeta(){
	var expRegNombre = /^\s*$/;
	var expRegValido = /^[\s-\w ñÑ]*$/;
	var formulario = document.getElementById('form_carp');
	var nombre = document.getElementById('nombrecarpeta');
	var validar = true;

	if(!nombre.value || expRegNombre.test(nombre.value)){
		alert("¡ESCRIBE UN NOMBRE VALIDO A LA CARPETA!");
		nombre.focus();
		validar = false;
	}else if(!expRegValido.test(nombre.value)){
		alert("NO SE PERMITEN / : * ? < > |");
		nombre.focus();
		validar = false; 
	}

	if(validar){
		formulario.submit();
		alert('¡LA CARPETA FUE CREADA SATISFACTORIAMENTE!');
	}
}
