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

function clearDateRequired(){
	var txtDate = $('#fecha_ingreso').val();

	//alert(txtDate);
	if (txtDate == "") { 
		document.getElementById('fecha_ingreso').required = true;
	} else {
		document.getElementById('fecha_ingreso').setCustomValidity('');
		document.getElementById('fecha_ingreso').required = false;
	}

}

function delete_residuo(id, nombre, url_delete, id_persona, folio){

	document.getElementById('eliminar_span').textContent = nombre;
	document.getElementById('folio_span').textContent = folio;
	document.getElementById("residuo_delete").setAttribute("href", url_delete);
	
} 
