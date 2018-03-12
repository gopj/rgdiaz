function otro_residuo_peligroso(dato) {
	var cl = dato;
	var arrcl = cl.split(",");
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
		document.getElementById('lb_clave').innerHTML=arrcl[1];
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
	var arrcl = cl.split(",");
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


		document.getElementById('lb_autorizacion').innerHTML=arrcl[1];
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
	var arrcl = cl.split(",");
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
		document.getElementById('lb_autorizacion_dest').innerHTML=arrcl[1];
	}
}

function clearValidity(){
	document.getElementById('unidad').setCustomValidity('');
}

function clearRequired(){
	var numberOfChecked = $('input:checkbox:checked').length;

	if (numberOfChecked > 0){
		document.getElementById('check1').setCustomValidity('');
		document.getElementById('check1').required = false;
	} else {
		document.getElementById('check1').required = true;
	}
}

function clearDateRequired(fecha){
	var txtDate = $('#' + fecha).val();

	//console.log(fecha);

	if (txtDate == "") { 
		document.getElementById(fecha).required = true;
	} else {
		document.getElementById(fecha).setCustomValidity('');
		document.getElementById(fecha).required = false;
	}

}

function delete_residuo(id, nombre, url_delete, id_persona, folio){

	document.getElementById('eliminar_span').textContent = nombre;
	document.getElementById('folio_span').textContent = folio;
	document.getElementById("residuo_delete").setAttribute("href", url_delete);
	
} 

function automatic_pass() {
	var numberOfChecked = $('input:checkbox:checked').length;
	var randomstring = gen_pass();

	//console.log(randomstring);

	if (numberOfChecked > 0){
		document.getElementById('clave').value = randomstring;
		document.getElementById('clave2').value = randomstring;
		$("#clave").attr('disabled','disabled');
	} else {
		$("#clave").removeAttr('disabled');
	}
}

function gen_pass() {
	var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 6;
	var randomstring = '';
	var charCount = 0;
	var numCount = 0;

	for (var i=0; i<string_length; i++) {
		// If random bit is 0, there are less than 3 digits already saved, and there are not already 5 characters saved, generate a numeric value. 
		if((Math.floor(Math.random() * 2) == 0) && numCount < 3 || charCount >= 5) {
			var rnum = Math.floor(Math.random() * 10);
			randomstring += rnum;
			numCount += 1;
		} else {
			// If any of the above criteria fail, go ahead and generate an alpha character from the chars string
			var rnum = Math.floor(Math.random() * chars.length);
			randomstring += chars.substring(rnum,rnum+1);
			charCount += 1;
		}
	}

	return randomstring;

}
