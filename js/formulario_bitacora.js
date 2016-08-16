function otro_residuo_peligroso(dato) {
	var cl = dato;
	if (cl == "Otro") {
		document.getElementById('lb_clave').innerHTML="";
		$("#otro_residuo").removeAttr('disabled');
		$("#clave").removeAttr('disabled');
		document.getElementById('otro_residuo').focus();
	} else {
		document.getElementById('otro_residuo').value = "";
		document.getElementById('clave').value = "";
		$("#otro_residuo").attr('disabled','disabled');
		$("#clave").attr('disabled','disabled');
		if(cl == "O-1") {
			cl = "O";
		}else if(cl == "O-2") {
			cl = "O";
		}else if(cl == "SO4-1") {
			cl = "SO4";
		}else if(cl == "SO4-2") {
			cl = "SO4";
		}
		document.getElementById('lb_clave').innerHTML=cl;
	}
}

function otra_area_generacion(dato) {
	var cl = dato;
	if (cl == "Otro") {
		$("#otro_area").removeAttr('disabled');
		document.getElementById('otro_area').focus();
	} else {
		document.getElementById('otro_area').value = "";
		$("#otro_area").attr('disabled','disabled');
	}
}

function otra_empresa_transportista(dato) {
	var cl = dato;
	if (cl == "Otro") {
		document.getElementById('lb_autorizacion').innerHTML="";
		$("#otro_empresa").removeAttr('disabled');
		$("#no_auto").removeAttr('disabled');
		document.getElementById('otro_empresa').focus();
	} else {
		document.getElementById('otro_empresa').value = "";
		document.getElementById('no_auto').value = "";
		$("#otro_empresa").attr('disabled','disabled');
		$("#no_auto").attr('disabled','disabled');
		document.getElementById('lb_autorizacion').innerHTML=cl;
	}
}

function otro_modalidad_trabajo(dato)
{
	var cl = dato;
	if (cl == "Otro") {
		$("#otro_modalidad").removeAttr('disabled');
		document.getElementById('otro_modalidad').focus();
	} else {
		document.getElementById('otro_modalidad').value = "";
		$("#otro_modalidad").attr('disabled','disabled');
	}
}

function otra_destino(dato) {
	var cl = dato;
	if (cl == "Otro") {
		document.getElementById('lb_autorizacion_dest').innerHTML="";
		$("#otro_dest").removeAttr('disabled');
		$("#no_auto_dest").removeAttr('disabled');
		document.getElementById('otro_dest').focus();
	} else {
		document.getElementById('otro_dest').value = "";
		document.getElementById('no_auto_dest').value = "";
		$("#otro_dest").attr('disabled','disabled');
		$("#no_auto_dest").attr('disabled','disabled');
		document.getElementById('lb_autorizacion_dest').innerHTML=cl;
	}
}

// Validaciones Cliente 
function reg_bit_new(){ 
	var expRegNum = /^\d*$/; // Expresion regular números positivos
	var expRegNom = /^\s*$/; // Expresion regular nombre valido
	var formulario = document.getElementById('form_bitacora_residuo_peligroso');
	var residuo = document.getElementById('residuo');
	var otro_residuo = document.getElementById('otro_residuo');
	var clave = document.getElementById('clave');
	var cantidad = document.getElementById('cantidad');
	var radio1 = document.getElementById('radio1');
	var radio2 = document.getElementById('radio2');
	var check1 = document.getElementById('check1');	
	var check2 = document.getElementById('check2');
	var check3 = document.getElementById('check3');
	var check4 = document.getElementById('check4');
	var area_generacion = document.getElementById('area_generacion');
	var otro_area = document.getElementById('otro_area');
	var fecha_ingreso = document.getElementById('fecha_ingreso');
	var valida = true;

	if(!residuo.value){
		alert("INGRESA EL CAMPO RESIDUO PELIGROSO");
		residuo.focus();
		valida = false;
	}else if(residuo.value == "Otro"){
		if(!otro_residuo.value || expRegNom.test(otro_residuo.value)){
			alert("INGRESA EL NOMBRE DE OTRO RESIDUO");
			otro_residuo.focus();
			valida = false;
		}else if(!clave.value || expRegNom.test(clave.value)){
			alert("INGRSA CLAVE DE OTRO RESIDUO");
			clave.focus();
			valida = false;
		}else if(!cantidad.value || !expRegNum.exec(cantidad.value) || cantidad.value == 0){
			alert("INGRESA EL CAMPO CANTIDAD O UN NUMERO VALIDO");
			cantidad.focus();
			valida = false;
		}else if (cantidad.value <= 0){
			alert("INGRESA EL CAMPO CANTIDAD O UN NUMERO VALIDO");
			cantidad.focus();
			valida = false;
		}else if(!radio1.checked && !radio2.checked){
			alert("INGRESA UNIDAD DE MEDIDA 'Kg o Ton'");
			valida = false;
		}else if(!check1.checked && !check2.checked && !check3.checked && !check4.checked){
			alert("SELECCIONA ALGUNA CARACTERISTICA DE PELIGROSIDAD");
			valida = false;
		}else if(!area_generacion.value){
			alert("SELECCIONA UN AREA DE GENERACION");
			area_generacion.focus();
			valida = false;
		}else if(area_generacion.value == "Otro"){
			if(!otro_area.value || expRegNom.test(otro_area.value)){
				alert("INGRESA OTRA AREA DE GENERACION");
				otro_area.focus();
				valida = false;
			}else if(!fecha_ingreso.value){
				alert("INGRESA UNA FECHA DE INGRESO");
			fecha_ingreso.focus();
			valida = false;
			}
		}else if(!fecha_ingreso.value){
			alert("INGRESA UNA FECHA DE INGRESO");
			fecha_ingreso.focus();
			valida = false;
		}
	}else if(!cantidad.value || !expRegNum.exec(cantidad.value) || cantidad.value == 0){
		alert("INGRESA EL CAMPO CANTIDAD O UN NUMERO VALIDO");
		cantidad.focus();
		valida = false;
	}else if (cantidad.value <= 0){
			alert("INGRESA EL CAMPO CANTIDAD O UN NUMERO VALIDO");
			cantidad.focus();
			valida = false;
	}else if(!radio1.checked && !radio2.checked){
		alert("INGRESA UNIDAD DE MEDIDA 'Kg o Ton'");
		valida = false;
	}else if(!check1.checked && !check2.checked && !check3.checked && !check4.checked){
		alert("SELECCIONA ALGUNA CARACTERISTICA DE PELIGROSIDAD");
		valida = false;
	}else if(!area_generacion.value){
			alert("SELECCIONA UN AREA DE GENERACION");
			area_generacion.focus();
			valida = false;
	}else if(area_generacion.value == "Otro"){
		if(!otro_area.value || expRegNom.test(otro_area.value)){
			alert("INGRESA OTRA AREA DE GENERACION");
			otro_area.focus();
			valida = false;
		}else if(!fecha_ingreso.value){
			alert("INGRESA UNA FECHA DE INGRESO");
			fecha_ingreso.focus();
			valida = false;
		}
	}else if(!fecha_ingreso.value){
			alert("INGRESA UNA FECHA DE INGRESO");
			fecha_ingreso.focus();
			valida = false;
	}
	
	
	if(valida){
		alert('DATOS GUARDADOS CORRECTAMENTE');
		formulario.submit(); 
		/*var ok = confirm("¡REVISA QUE LOS DATOS SEAN CORRECTOS, UNA VEZ INGRESADOS NO PODRÁS MODIFICARLOS!");
		if(ok == true){
			alert('DATOS GUARDADOS CORRECTAMENTE');
			formulario.submit();
		}*/
	}
				
}

function delete_residuo(id, nombre, url_delete){
	
	console.log(id);
	console.log(nombre);
	console.log(url_delete + id);

	document.getElementById('eliminar_span').textContent = nombre ;
	document.getElementById("residuo_delete").setAttribute("href", url_delete + id);
	
}