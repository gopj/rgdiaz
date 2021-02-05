
// Gloval variable for host
var host="localhost/rgdiaz";

//var host="rdiaz.mx";

function get_cliente(id){

	var id_per = id;
	
	if (id_per == 0) {
		$("#ver_manifiestos").attr('disabled','disabled');
	} else {
		$("#ver_manifiestos").removeAttr('disabled');
	}

	//AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/recolector/get_cliente',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/recolector/get_cliente',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona: id_per,
			}
		}).done(
			function(resp) {
				var json_data = jQuery.parseJSON(resp);
				var id_persona = json_data.id_persona;
				var nombre_empresa = json_data.nombre_empresa;
				var calle = json_data.calle_empresa;
				var numero = json_data.numero_empresa;
				var cp = json_data.cp_empresa;
				var municipio = json_data.municipio;
				var estado = json_data.estado;
				var telefono = json_data.telefono_empresa;
				var email = json_data.correo_empresa;

				$("#nombre_empresa").val(nombre_empresa);
				$("#calle").val(calle);
				$("#numero").val(numero);
				$("#cp").val(cp);
				$("#municipio").val(municipio);
				$("#estado").val(estado);
				$("#telefono").val(telefono);
				$("#email").val(email);
			}
		);

	//echo site_url('administrador/obtiene_cliente'); ?>"  <--	Ruta de la peticion
}

/// RECOLECTOR
$("#guarda_recolector").attr('disabled','disabled');
$("#edita_recolector").attr('disabled','disabled');
$("#elimina_recolector").attr('disabled','disabled');

function get_recolector(id){

	var id_per = id;

	console.log(id)

	if (id_per) {
		$("#nombre_recolector").attr('disabled','disabled');
		$("#correo").attr('disabled','disabled');
		$("#clave").attr('disabled','disabled');
		$("#clave_automatica").attr('disabled','disabled');
		$("#guarda_recolector").attr('disabled','disabled');
		$("#edita_recolector").removeAttr('disabled');
		$("#elimina_recolector").removeAttr('disabled');
	} else {
		$("#nombre_recolector").removeAttr('disabled');
		$("#correo").removeAttr('disabled');
		$("#clave").removeAttr('disabled');
		$("#clave_automatica").removeAttr('disabled');
		$("#edita_recolector").attr('disabled','disabled');
		$("#elimina_recolector").attr('disabled','disabled');
	}
    console.log(id_per);
	//AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/administrador/get_recolector',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/recolector/get_cliente',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona: id_per,
			}
		}).done(
			function(resp) {
				var json_data = jQuery.parseJSON(resp);
				var id_persona = json_data.id_persona;
				var nombre = json_data.nombre;
				var correo = json_data.correo;
				var clave = json_data.password;
	
				$("#nombre_recolector").val(nombre);
				$("#correo").val(correo);
				$("#clave").val(clave);

			}
		);

	//echo site_url('administrador/obtiene_cliente'); ?>"  <--	Ruta de la peticion
}

function update_recolector(){
	$("#nombre_recolector").removeAttr('disabled');
	$("#correo").removeAttr('disabled');
	$("#clave").removeAttr('disabled');
	$("#clave_automatica").removeAttr('disabled');
	$("#guarda_recolector").attr('disabled','disabled');
	$("#edita_recolector").removeAttr('disabled');
	$("#elimina_recolector").attr('disabled','disabled');
}

function onchange_recolector(){
	$("#guarda_recolector").removeAttr('disabled');
	$("#edita_recolector").attr('disabled','disabled');
}

function delete_recolector(id, url){
	url_delete =  url + id;
	document.getElementById("btn_delete_recolector").setAttribute("href", url_delete);
}

/// VEHICULO
$("#guarda_vehiculo").attr('disabled','disabled');
$("#edita_vehiculo").attr('disabled','disabled');
$("#elimina_vehiculo").attr('disabled','disabled');

function get_vehiculo(id){

	var id_vehiculo = id;
	
	if (id_vehiculo) {
		$("#modelo").attr('disabled','disabled');
		$("#marca").attr('disabled','disabled');
		$("#tipo").attr('disabled','disabled');
		$("#placa").attr('disabled','disabled');
		$("#guarda_vehiculo").attr('disabled','disabled');
		$("#edita_vehiculo").removeAttr('disabled');
		$("#elimina_vehiculo").removeAttr('disabled');
	} else {
		$("#modelo").removeAttr('disabled');
		$("#marca").removeAttr('disabled');
		$("#tipo").removeAttr('disabled');
		$("#placa").removeAttr('disabled');
		$("#edita_vehiculo").attr('disabled','disabled');
		$("#elimina_vehiculo").attr('disabled','disabled');
	}

    console.log(id_vehiculo);
	//AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/administrador/get_vehiculo',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/recolector/get_cliente',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_vehiculo: id_vehiculo,
			}
		}).done(
			function(resp) {
				var json_data = jQuery.parseJSON(resp);
				var id_vehiculo = json_data.id_vehiculo;
				var modelo = json_data.modelo;
				var marca = json_data.marca;
				var tipo = json_data.tipo_vehiculo;
				var placa = json_data.numero_placa;
	
				$("#modelo").val(modelo);
				$("#marca").val(marca);
				$("#tipo").val(tipo);
				$("#placa").val(placa);

			}
		);

	//echo site_url('administrador/obtiene_cliente'); ?>"  <--	Ruta de la peticion
}

function update_vehiculo(){
	$("#modelo").removeAttr('disabled');
	$("#marca").removeAttr('disabled');
	$("#tipo").removeAttr('disabled');
	$("#placa").removeAttr('disabled');
	$("#guarda_vehiculo").attr('disabled','disabled');
	$("#edita_vehiculo").removeAttr('disabled');
	$("#elimina_vehiculo").attr('disabled','disabled');
}

function onchange_vehiculo(){
	$("#guarda_vehiculo").removeAttr('disabled');
	$("#edita_vehiculo").attr('disabled','disabled');
}

function delete_vehiculo(id, url){
	url_delete =  url + id;
	document.getElementById("btn_delete_vehiculo").setAttribute("href", url_delete);
}

/// DESTINO
$("#guarda_destino").attr('disabled','disabled');
$("#edita_destino").attr('disabled','disabled');
$("#elimina_destino").attr('disabled','disabled');

function get_destino(id){

	var id_destino = id;
	
	if (id_destino) {
		$("#nombre_destino").attr('disabled','disabled');
		$("#numero_autorizacion").attr('disabled','disabled');
		$("#calle").attr('disabled','disabled');
		$("#num_ext").attr('disabled','disabled');
		$("#num_int").attr('disabled','disabled');
		$("#cp").attr('disabled','disabled');
		$("#colonia").attr('disabled','disabled');
		$("#municipio").attr('disabled','disabled');
		$("#estado").attr('disabled','disabled');
		$("#telefono").attr('disabled','disabled');
		$("#guarda_destino").attr('disabled','disabled');
		$("#edita_destino").removeAttr('disabled');
		$("#elimina_destino").removeAttr('disabled');
	} else {
		$("#nombre_destino").removeAttr('disabled');
		$("#numero_autorizacion").removeAttr('disabled');
		$("#calle").removeAttr('disabled');
		$("#num_ext").removeAttr('disabled');
		$("#num_int").removeAttr('disabled');
		$("#cp").removeAttr('disabled');
		$("#colonia").removeAttr('disabled');
		$("#municipio").removeAttr('disabled');
		$("#estado").removeAttr('disabled');
		$("#telefono").removeAttr('disabled');
		$("#edita_destino").attr('disabled','disabled');
		$("#elimina_destino").attr('disabled','disabled');
	}
    console.log(id_destino);
	//AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/administrador/get_destino',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/recolector/get_cliente',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_destino: id_destino,
			}
		}).done(
			function(resp) {
				var json_data = jQuery.parseJSON(resp);
				var id_destino = json_data.id_destino;
				var nombre_destino = json_data.nombre_destino;
				var numero_autorizacion = json_data.no_autorizacion_destino
				var calle = json_data.calle;
				var num_ext = json_data.num_ext;
				var num_int = json_data.num_int;
				var cp = json_data.cp;
				var colonia = json_data.colonia;
				var municipio = json_data.municipio;
				var estado = json_data.estado;
				var telefono = json_data.telefono;
	
				$("#nombre_destino").val(nombre_destino);
				$("#numero_autorizacion").val(numero_autorizacion);
				$("#calle").val(calle);
				$("#num_ext").val(num_ext);
				$("#num_int").val(num_int);
				$("#cp").val(cp);
				$("#colonia").val(colonia);
				$("#municipio").val(municipio);
				$("#estado").val(estado);
				$("#telefono").val(telefono);

			}
		);

	//echo site_url('administrador/obtiene_cliente'); ?>"  <--	Ruta de la peticion
}

function update_destino(){
	$("#nombre_destino").removeAttr('disabled');
	$("#numero_autorizacion").removeAttr('disabled');
	$("#calle").removeAttr('disabled');
	$("#num_ext").removeAttr('disabled');
	$("#num_int").removeAttr('disabled');
	$("#cp").removeAttr('disabled');
	$("#colonia").removeAttr('disabled');
	$("#municipio").removeAttr('disabled');
	$("#estado").removeAttr('disabled');
	$("#telefono").removeAttr('disabled');
	$("#guarda_destino").attr('disabled','disabled');
	$("#edita_destino").removeAttr('disabled');
	$("#elimina_destino").attr('disabled','disabled');
}

function onchange_destino(){
	$("#guarda_destino").removeAttr('disabled');
	$("#edita_destino").attr('disabled','disabled');
}

function delete_destino(id, url){
	url_delete =  url + id;
	document.getElementById("btn_delete_destino").setAttribute("href", url_delete);
}

//jQuery extension method:
jQuery.fn.filterByText = function(textbox) {
	return this.each(function() {
		var select = this;
		var options = [];
		$(select).find('option').each(function() {
			options.push({
				value: $(this).val(),
				text: $(this).text()
			});
		});
		$(select).data('options', options);

		$(textbox).bind('change keyup', function() {
			var options = $(select).empty().data('options');
			var search = $.trim($(this).val());
			var regex = new RegExp(search, "gi");

			$.each(options, function(i) {
				var option = options[i];
				if (option.text.match(regex) !== null) {
					$(select).append(
						$('<option>').text(option.text).val(option.value)
					);
				}
			});
		});
	});
};



$(function() {
	$('#id_persona').filterByText($('#search_cliente'));
});


$(document).ready(function() {
	$('#tabla_manifiestos').DataTable( {
		"pageLength": 50,
		"language": {
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"search": "Buscar:",
			"zeroRecords": "No resultados para esa búsqueda.",
			"info": "Mostrando página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtered from _MAX_ total records)"
		}
	} );
} );	

$(document).ready(function() {
	var table = $('#tabla_residuos').DataTable( {
		"scrollY": 			true,
		"scrollX": 			true,
		"scrollCollapse": 	true,
		"pageLength": 		10,
		"language": {
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"search": "Buscar:",
			"zeroRecords": "No hay resultados para esa búsqueda.",
			"info": "Mostrando página _PAGE_ de _PAGES_",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(filtered from _MAX_ total records)"
		},
 		"fixedColumns": {
            "leftColumns": 	1,
            "rightColumns": 1
        },
        "columnDefs": [
    		{ 
    			"width": "500px", 
    			"targets": 1 
    		}
  		]
	} );
} );

function update_clave(id_clave) {
	var id = id_clave;

	//AJAX
	jQuery.ajax({
		url:'http://' + host + '/index.php/recolector/get_clave_residuo',	//<-- Url que va procesar la peticion
		//url:'http://rdiaz.mx/index.php/recolector/get_clave_residuo',
		timeout: 3000, //sets timeout to 3 seconds
		type:'post',
		data:{
			id: id
		}
	}).done(
		function(resp) {
			var json_data = jQuery.parseJSON(resp);
			var clave = json_data.clave;
			
			console.log(clave);
			$("#clave").val(clave);
		}
	);
}


$("input[type='number']").InputSpinner();


$(document).ready(function() {
	var empresa_destino 	= document.getElementById('empresa_destino');
	var fecha_embarque 		= document.getElementById('fecha_embarque').value;
	var responsable_tecnico = document.getElementById('responsable_tecnico').value;
	var ruta 				= document.getElementById('ruta').value;
	var observaciones		= document.getElementById('observaciones').value;

	var s_empresa_destino = empresa_destino.options[empresa_destino.selectedIndex].value;

	console.log(s_empresa_destino);
	console.log(fecha_embarque);
	console.log(responsable_tecnico);
	console.log(ruta);
	console.log(observaciones);

	$("#terminar_responsable").val(responsable_tecnico);
	$("#terminar_fecha").val(fecha_embarque);
	$("#terminar_empresa_destino").val(s_empresa_destino);
	$("#terminar_ruta").val(s_empresa_destino);
	$("#terminar_observaciones").val(s_empresa_destino);
} );

function terminar_manifiesto() {
	
	var empresa_destino 	= document.getElementById('empresa_destino');
	var fecha_embarque 		= document.getElementById('fecha_embarque').value;
	var responsable_tecnico = document.getElementById('responsable_tecnico').value;
	var ruta 				= document.getElementById('ruta').value;
	var observaciones		= document.getElementById('observaciones').value;

	var s_empresa_destino = empresa_destino.options[empresa_destino.selectedIndex].value;

	console.log(s_empresa_destino);
	console.log(fecha_embarque);
	console.log(responsable_tecnico);
	console.log(ruta);
	console.log(observaciones);

	$("#terminar_responsable").val(responsable_tecnico);
	$("#terminar_fecha").val(fecha_embarque);
	$("#terminar_empresa_destino").val(s_empresa_destino);
	$("#terminar_ruta").val(ruta);
	$("#terminar_observaciones").val(observaciones);
}

function clear_required(){
	var numberOfChecked = $('input:checkbox:checked').length;

	if (numberOfChecked > 0){
		document.getElementById('caracteristica_check1').required = false;
		document.getElementById('caracteristica_check2').required = false;
		document.getElementById('caracteristica_check3').required = false;
		document.getElementById('caracteristica_check4').required = false;
		document.getElementById('caracteristica_check5').required = false;
		document.getElementById('caracteristica_check6').required = false;
		document.getElementById('caracteristica_check7').required = false;
	} else {
		document.getElementById('caracteristica_check1').required = true;
		document.getElementById('caracteristica_check2').required = true;
		document.getElementById('caracteristica_check3').required = true;
		document.getElementById('caracteristica_check4').required = true;
		document.getElementById('caracteristica_check5').required = true;
		document.getElementById('caracteristica_check6').required = true;
		document.getElementById('caracteristica_check7').required = true;
	}
}

function check_resposanble() {

	$tecnico = document.getElementById('terminar_responsable').value;
	$ruta = document.getElementById('terminar_ruta').value;
	$observaciones = document.getElementById('terminar_observaciones').value;

	if ( ($tecnico == "") || ($ruta == "") || ($observaciones == "") ){
		$("#b_terminar_manifiesto").attr('disabled','disabled');
	} else {
		$("#b_terminar_manifiesto").removeAttr('disabled');
	}
}

$( document ).ready(function() {
    check_resposanble();
});

(function() {
	'use strict';
	window.addEventListener('load', function() {
		var form = document.getElementById('form_manifiesto_recolector');
		form.addEventListener('submit', function(event) {
			if (form.checkValidity() === false) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
	}, false);
})();


function delete_last_residuo(id, nombre, url_delete, id_persona, folio){

	document.getElementById('eliminar_span').textContent = nombre;
	document.getElementById('folio_span').textContent = folio;
	document.getElementById("residuo_delete").setAttribute("href", url_delete);
	
}
