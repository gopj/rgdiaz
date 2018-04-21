function get_cliente(id){

	var id_per = id;
	
	if (id_per == 0) {
		$("#ver_manifiestos").attr('disabled','disabled');
	} else {
		$("#ver_manifiestos").removeAttr('disabled');
	}

	//AJAX
	jQuery.ajax({
			url:'http://localhost/rgdiaz/index.php/recolector/get_cliente',	//<-- Url que va procesar la peticion
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