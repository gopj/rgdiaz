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

function clearValidity(rc) {
    alert(rc);

	//document.getElementById(radio_cehck).setCustomValidity('');
}

$( document ).ready(function () {

	var alert = "<br> <div class='alert alert-error'> <button type='button' class='close' data-dismiss='alert'>&times;</button>";

	$("#form_actualizar_registros" ).validate( { 
		rules: {
			fecha_salida: {
				required: true
			},
			emp_tran:{
				required: true
			},
			otro_empresa:{
				required: true
			},
			no_auto:{
				required: true
			},
			folio:{
				required: true
			},
			dest_final:{
				required: true
			},
			otro_dest:{
				required: true
			},
			no_auto_dest:{
				required: true
			},
			sig_manejo:{
				required: true
			},
			otro_modalidad:{
				required: true
			},
			resp_tec:{
				required: true
			}

		},
		messages: {
			fecha_salida: 	alert + " Por favor ingresa fecha de salida",
			emp_tran: 		alert + " Por favor ingresa empresa transportista",
			otro_empresa: 	alert + " Por favor ingresa otra empresa",
			no_auto: 		alert + " Por favor ingresa numero de autorización de transportista",
			folio: 			alert + " Por favor ingresa el folio",
			dest_final: 	alert + " Por favor ingresa el destino final",
			otro_dest: 		alert + " Por favor ingresa otro desitno final",
			no_auto_dest: 	alert + " Por favor ingresa numero de autorización de destino",
			sig_manejo: 	alert + " Por favor ingresa la modalidad",
			otro_modalidad: alert + " Por favor ingresa otra otro_modalidad_trabajo",
			resp_tec: 		alert + " Por favor ingresa al nombre del Responsable Técnico"

		},
		highlight: function ( element ) { 
			  $(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function (element) {
			element.text('OK!').addClass('valid')
			//element.addClass('valid')
			.closest('.control-group').removeClass('error').addClass('success');
		}
	});
});



function delete_residuo(id, nombre, url_delete, id_persona, folio){

	document.getElementById('eliminar_span').textContent = nombre;
	document.getElementById('folio_span').textContent = folio;
	document.getElementById("residuo_delete").setAttribute("href", url_delete);
	
}