// Gloval variable for host
${host} host="${host}";
//${host}="rdiaz.mx";

function get_cliente(id){

	var id_per = id;
	
	if (id_per == 0) {
		$("#ver_manifiestos").attr('disabled','disabled');
	} else {
		$("#ver_manifiestos").removeAttr('disabled');
	}

	//AJAX
	jQuery.ajax({
			url:'http${host}/index.php/recolector/get_cliente',	//<-- Url que va procesar la peticion
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


// You could use it like this:

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
			"zeroRecords": "No resultados para esa búsqueda.",
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
		url:'http://${host}/index.php/recolector/get_clave_residuo',	//<-- Url que va procesar la peticion
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
	var empresa_destino = document.getElementById('empresa_destino');
	var fecha_embarque = document.getElementById('fecha_embarque').value;
	var responsable_tecnico = document.getElementById('responsable_tecnico').value;

	var s_empresa_destino = empresa_destino.options[empresa_destino.selectedIndex].value;

	console.log(s_empresa_destino);
	console.log(fecha_embarque);
	console.log(responsable_tecnico);

	$("#terminar_responsable").val(responsable_tecnico);
	$("#terminar_fecha").val(fecha_embarque);
	$("#terminar_empresa_destino").val(s_empresa_destino);
} );

function terminar_manifiesto() {
	
	var empresa_destino = document.getElementById('empresa_destino');
	var fecha_embarque = document.getElementById('fecha_embarque').value;
	var responsable_tecnico = document.getElementById('responsable_tecnico').value;

	var s_empresa_destino = empresa_destino.options[empresa_destino.selectedIndex].value;

	console.log(s_empresa_destino);
	console.log(fecha_embarque);
	console.log(responsable_tecnico);

	$("#terminar_responsable").val(responsable_tecnico);
	$("#terminar_fecha").val(fecha_embarque);
	$("#terminar_empresa_destino").val(s_empresa_destino);
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
	} else {
		document.getElementById('caracteristica_check1').required = true;
		document.getElementById('caracteristica_check2').required = true;
		document.getElementById('caracteristica_check3').required = true;
		document.getElementById('caracteristica_check4').required = true;
		document.getElementById('caracteristica_check5').required = true;
		document.getElementById('caracteristica_check6').required = true;
	}
}

function check_resposanble() {

	$tecnico = document.getElementById('terminar_responsable').value;

	if ($tecnico == "") {
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
