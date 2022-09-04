// Global variable for host
//var host="http://rdiaz.mx";
var host="https://localhost/rgdiaz";

function swith(){
	// Preguntamos confirmar dar de alta cliente
	var formulario = document.getElementById('form_alta_cliente');
	var bandera;
	bandera = confirm("¿ESTA USTED SEGURO DE DAR DE ALTA UN NUEVO CLIENTE?");
	if(bandera){
		formulario.submit();
		alert('EL USUARIO HA SIDO AGREGADO SATISFACTORIAMENTE. SE MANDO SUS DATOS DE ACCESO A SU EMAIL!');
	}else{
		//alert('ALTA DE CLIENTE CANCELADA!');
	}
}
//Funcion que valida correo y manda los datos de modal dar de alta cliente 
function alta_cliente(){
	var expRegEmail= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;//Expresion regular correo
	var formulario = document.getElementById('form_alta_cliente2');
	var validar = true;
	var correo = document.getElementById('alta_correo');

	if(!correo.value || !expRegEmail.exec(correo.value)){
		alert('EL CORREO DE USUARIO ES REQUERIDO O ES UN CORREO INVALIDO');
		correo.focus();
		validar = false;
	}

	if(validar){
		//	Consultamos si el correo ya existe con ajax
		var email = document.getElementById('alta_correo').value;
		//alert(email);
		jQuery.ajax({
			url: host + '/administrador/verifica_correo',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				correo: email
			}
		}).done(
			function(resp)
			{
				var miJson = jQuery.parseJSON(resp);
				if(miJson == true){
					alert('¡EL CORREO YA EXISTE FAVOR DE INGRESAR UN CORREO DIFERENTE!');
					formulario.reset();
					correo.focus();
				}else{
					alert('EL CLIENTE HA SIDO DADO DE ALTA');
					formulario.submit();
				}
			}
		);
	}
}   

//Funcion que nos avisa si el cliente ha sido dado de baja 
function cliente_baja(){
	var formulario = document.getElementById('baja_cliente');
	var id_persona = document.getElementById('id_persona_baja');
	var validar = true;
	var razon = document.getElementById('razon');
	
	if(!id_persona_baja.value || id_persona_baja.value == 0){
		alert('INGRESA UN CLIENTE');
		id_persona_baja.focus();
		validar = false;
	}else if(!razon.value){
			razon.focus();
			alert('¡ESCRIBE UNA RAZON POR LA CUAL SERÁ DADO DE BAJA!');
			validar = false;
		}
	
	if(validar){
		alert('¡EL USUARIO HA SIDO DADO DE BAJA!');
		formulario.submit();
	}
}


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


// 	Funcion para validar al agregar un archivo a carpeta
function valida_archivo(){
	var form_archivo = document.getElementById('form_archivo');
	var archivo = document.getElementById('file');
	var validar = true;

	if(!archivo.value){
		alert("¡SELECCIONA AL MENOS UN ARCHIVO!");
		archivo.focus();
		validar = false;
	}

	if(validar){
		form_archivo.submit();
	}	
}

function eliminar_archivo(){
	var formulario_eliminar = document.getElementById('form_eliminar');
	var r=confirm("¿ESTA SEGURO QUE DESEA ELIMINAR EL ARCHIVO?");
	if(r == true){
		formulario_eliminar.submit();
		alert('EL ARCHIVO FUE ELIMINADO'); 
	}
}

function eliminar_carpeta(){
	//var form_carpeta = document.getElementById('form_eliminar_carpeta');
	var id_per = document.getElementById('id_persona');
	var id_car = document.getElementById('id_carpeta');
	var ruta = document.getElementById('ruta_carpeta');
	alert(id_car.value);
	var res = confirm("¿ESTA SEGURO QUE DESEA ELIMINAR LA CARPETA?");
	if(res == true){
		// hago mi metodo ajax
			var id_p = id_per.value;
			var id_c = id_per.value;
			var r =  ruta.value;
		//	---------------------	
			jQuery.ajax({
			url: host + '/administrador/eliminar_carpeta',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona: id_p,
				id_carpeta: id_c,
				ruta_carpeta: r 
			}
		}).done(
			function(resp)
			{
				var miJson = jQuery.parseJSON(resp);
				if(miJson == true){
					alert('¡LA CARPETA FUE ELIMINADA CORRECTAMENTE!');
				}else{
					alert('LA CARPETA NO FUE ELIMINADA');
				}
			}
		);
	}else{
		alert('CARPETA NO ELIMINADA');
	}
}

function compruebausuario(id){
	var id_per = id;

	$("#nombre_empresa").val("");
	$("#cp_empresa").val("");
	$("#colonia_empresa").val("");
	$("#calle_empresa").val("");
	$("#numero_empresa").val("");
	$("#email_empresa").val("");
	$("#municipio_empresa").val("");
	$("#estado_empresa").val("");
	$("#telefono_empresa").val("");
	$("#numero_registro_ambiental").val("");
	$("#persona_expediente").val("");
	$("#persona_bitacora").val("");
	$("#ruta").val("");
	$("#nombre_contacto").val("");
	$("#telefono_contacto").val("");
	$("#telefono_contacto_alt").val("");
	$("#email_contacto").val("");
	$("#password_contacto").val("");
	$("#estado_cuenta").val("");
	$("#identificador_folio").val("");
	$("#id_cliente").val(id);

	if (id_per == 0) {
		$("#btn_expediente").attr('disabled','disabled');
		$("#btn_bitacora").attr('disabled','disabled');
		$("#btn_guardar").attr('disabled','disabled');
		$("#update_status").attr('disabled','disabled');
		$("#activar_campos").attr('disabled','disabled');
	} else {
		$("#btn_expediente").removeAttr('disabled');
		$("#btn_bitacora").removeAttr('disabled');
		$("#btn_guardar").removeAttr('disabled');
		$("#activar_campos").removeAttr('disabled');
	}

	//AJAX
	jQuery.ajax({
			url: host + '/administrador/obtiene_cliente',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona: id_per,
			}
		}).done(
			function(resp)
			{
				var miJson = jQuery.parseJSON(resp);

				var id_persona = miJson.id_persona;
				var nombre = miJson.nombre;
				var correo = miJson.correo;
				var password_contacto = miJson.password_contacto;
				var telefono_personal = miJson.telefono_personal;
				var telefono_personal_alt = miJson.telefono_personal_alt;
				var nombre_empresa = miJson.nombre_empresa;
				var calle_empresa = miJson.calle_empresa;
				var correo_empresa = miJson.correo_empresa;
				var cp_empresa = miJson.cp_empresa;
				var colonia_empresa = miJson.colonia_empresa;
				var numero_empresa = miJson.numero_empresa;
				var status_persona = miJson.id_status_persona;
				var municipio = miJson.municipio;
				var estado = miJson.estado;
				var telefono_empresa = miJson.telefono_empresa;
				var numero_registro_ambiental = miJson.numero_registro_ambiental;
				var identificador_folio = miJson.identificador_folio;
				var ruta_carpeta = "clientes/"+id_persona;
				if(status_persona == 1){
					var status_persona = "Activo";
				}else{
					var status_persona = "Inactivo";
				}
				var ruta = miJson.ruta;
				$("#persona").val(ruta_carpeta);
				$("#persona").val(id_persona);
				$("#persona3").val(id_persona);
				$("#nombre_empresa").val(nombre_empresa);
				$("#cp_empresa").val(cp_empresa);
				$("#colonia_empresa").val(colonia_empresa);
				$("#calle_empresa").val(calle_empresa);
				$("#numero_empresa").val(numero_empresa);
				$("#email_empresa").val(correo_empresa);
				$("#municipio_empresa").val(municipio);
				$("#estado_empresa").val(estado);
				$("#telefono_empresa").val(telefono_empresa);
				$("#numero_registro_ambiental").val(numero_registro_ambiental);
				$("#persona_expediente").val(id_persona);
				$("#persona_bitacora").val(id_persona);
				$("#ruta").val(ruta);
				$("#identificador_folio").val(identificador_folio);

				$("#nombre_contacto").val(nombre);
				$("#telefono_contacto").val(telefono_personal);
				$("#telefono_contacto_alt").val(telefono_personal_alt);
				$("#email_contacto").val(correo);
				$("#password_contacto").val(password_contacto);
				$("#estado_cuenta").val(status_persona);

				if(status_persona == "Inactivo"){
					$("#update_status").removeAttr('disabled');
				}else{
					$("#update_status").attr('disabled','disabled');
				}  
			}
		);

	//echo site_url('administrador/obtiene_cliente'); ?>"  <--	Ruta de la peticion
}

function lock_inputs(){
	$("#nombre_empresa").attr("readonly","true");
	$("#password_contacto").attr("readonly","true");
}

function comprueba_emp_trans(id){
	$("#nombre_emp_trans").val("");
	$("#no_aut_trans").val("");
	$("#no_aut_trans_sct").val("");
	$("#domicilio_emp_trans").val("");
	$("#tel_emp_trans").val("");

	var id_tipo_emp_trans = id;

	//AJAX
	jQuery.ajax({
			url: host + '/administrador/obtiene_emp_trans',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_tipo_emp_trans: id_tipo_emp_trans,
			}
		}).done(
			function(resp)
			{
				var json_data = jQuery.parseJSON(resp);
				var nombre_emp_trans = json_data.nombre_emp_trans;
				var no_autorizacion_transportista = json_data.no_autorizacion_transportista;
				var no_autorizacion_sct = json_data.no_autorizacion_sct;
				var domicilio = json_data.domicilio;
				var telefono = json_data.telefono;

				$("#nombre_emp_trans").val(nombre_emp_trans);
				$("#no_aut_trans").val(no_autorizacion_transportista);
				$("#no_aut_trans_sct").val(no_autorizacion_sct);
				$("#domicilio_emp_trans").val(domicilio);
				$("#tel_emp_trans").val(telefono);
			}
		);
}

function comprueba_emp_dest(id){
	$("#nombre_emp_dest").val("");
	$("#no_aut_dest").val("");
	$("#domicilio_emp_dest").val("");
	$("#municipio_emp_dest").val("");
	$("#estado_emp_dest").val("");

	var id_tipo_emp_dest = id;

	//AJAX
	jQuery.ajax({
			url: host + '/administrador/obtiene_emp_dest',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_tipo_emp_dest: id_tipo_emp_dest,
			}
		}).done(
			function(resp)
			{
				var json_data = jQuery.parseJSON(resp);
				var nombre_emp_dest = json_data.nombre_emp_dest;
				var no_aut_dest = json_data.no_autorizacion_destino;
				var domicilio_emp_dest = json_data.domicilio;
				var municipio_emp_dest = json_data.municipio;
				var estado_emp_dest = json_data.estado;

				$("#nombre_emp_dest").val(nombre_emp_dest);
				$("#no_aut_dest").val(no_aut_dest);
				$("#domicilio_emp_dest").val(domicilio_emp_dest);
				$("#municipio_emp_dest").val(municipio_emp_dest);
				$("#estado_emp_dest").val(estado_emp_dest);
			}
		);
}

function alta_correo_post(){
	var correo =  $('#alta_correo').val();

	$('#alta_correo_hidd').val(correo)
}

function alta_cliente_admin(){
	var expRegEmail= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;//Expresion regular correo
	var expRegNum = /^(?:\+|-)?\d+$/; // Expresion regular números
	var expRegCp = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;//Expresion regular codigo postal
	var form = document.getElementById('altaCAdmin');
	var nombreEmpresa = document.getElementById('nomEmp');
	var codigo = document.getElementById('cpEmp');
	var colonia = document.getElementById('colEmp');
	var calle = document.getElementById('calleEmp');
	var numero = document.getElementById('numEmp');
	var emailEmpresa = document.getElementById('correo_empresa');
	var municipio = document.getElementById('munEmp');
	var estado =  document.getElementById('esEmp');
	var telefono_empresa = document.getElementById('telEmp');
	var numero_registro_ambiental = document.getElementById('numRegAmb');

	var nombreContacto = document.getElementById('nomCont');
	var telefonoContacto = document.getElementById('telCont');
	var emailContacto = document.getElementById('emailCont');
	var valida = true;


	if(!nombreEmpresa.value){
		alert("EL CAMPO NOMBRE O RAZON SOCIAL ES REQUERIDO");
		nombreEmpresa.focus();
		valida = false;
	}else if(!calle.value){
		alert("EL CAMPO CALLE ES REQUERIDO");
		calle.focus();
		valida = false;
	}else if(!numero.value){
		alert("EL CAMPO NÚMERO ES REQUERIDO O NO ES NÚMERO VALIDO");
		numero.focus();
		valida= false;
	}else if(!colonia.value){
		alert("EL CAMPO COLONIA ES REQUERIDO");
		colonia.focus()
		valida= false;
	}else if(!municipio.value){
		alert("EL CAMPO MUNICIPIO ES REQUERIDO");
		municipio.focus();
		valida = false;
	}else if(!codigo.value || !expRegCp.exec(codigo.value)){
		alert("EL CAMPO CODIGO POSTAL ES REQUERIDO O NO ES VALIDO");
		codigo.focus();
		valida = false;
	}else if(!estado.value){
		alert("EL CAMPO ESTADO ES REQUERIDO");
		estado.focus();
		valida = false;
	}else if(!telefono_empresa.value){
		alert("EL CAMPO TELEFONO DE LA EMPRESA ES REQUERIDO");
		telefono_empresa.focus();
		valida = false;
	}else if(!numero_registro_ambiental.value){
		alert("EL CAMPO No REGISTRO AMBIENTAL ES REQUERIDO");
		numero_registro_ambiental.focus();
		valida = false;
	} else if(!emailEmpresa.value || !expRegEmail.exec(emailEmpresa.value)){
		alert("EL CAMPO CORREO DE LA EMPRESA ES REQUERIDO");
		emailEmpresa.focus();
		valida = false;
	}else if(!nombreContacto.value){
		alert("EL CAMPO NOMBRE ES REQUERIDO");
		nombreContacto.focus();
		valida = false;
	}else if(!telefonoContacto.value){
		alert("EL CAMPO TELEFONO DE CONTACTO ES REQUERIDO");
		telefonoContacto.focus();
		valida = false;
	}else if(!emailContacto.value || !expRegEmail.exec(emailContacto.value)){
		alert("EL CAMPO DIRECCION DE EMAIL ES REQUERIDO O NO ES VALIDO");
		emailContacto.focus();
		valida = false;
	}
	if(valida){
		//AJAX
		var email = emailContacto.value;
		var empresa = nombreEmpresa.value;
	jQuery.ajax({
			url: host + '/administrador/verifica_correo',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				nombre_empresa:empresa,
				correo:email
			}
		}).done(
			function(resp){
			var miJson = jQuery.parseJSON(resp);
			if(miJson == true){
				alert("EL NOMBRE DE LA EMPRESA O EL CORREO DE CONTACTO INGRESADO YA EXISTEN FAVOR DE PROBAR CON OTROS DATOS!");
				valida = false;
			}else{
				alert("EL CLIENTE AH SIDO CREADO CON EXITO");
				form.submit();
			}
			}
		);
		
	}
}

function envia_correo_admin(){
	var formulario = document.getElementById('form_correo_admin');
	var valida = true;

	var id_persona = document.getElementById('id_persona');

	var asunto = document.getElementById('asunto_correo');
	var mensaje = document.getElementById('mensaje_correo');
	if(!id_persona.value){
		alert('¡SELECCIONA UN CLIENTE');
		id_persona.focus();
		valida = false;
	}else if(!asunto.value){
		alert('INGRSA UN ASUNTO AL CORREO');
		asunto.focus();
		valida = false;
	}else if(!mensaje.value){
		alert('INGRESA UN MENSAJE AL CORREO');
		mensaje.focus();
		valida = false;
	}

	if(valida){
		var id_p = id_persona.value;
		var asun = asunto.value;
		var mens = mensaje.value;
		//AJAX
		jQuery.ajax({
			url: host + '/administrador/envia_correo_admin',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona: id_p,
				asunto: asun,
				mensaje:mens
			}
		}).done(
			function(resp) {
				var miJson = jQuery.parseJSON(resp);

				if(miJson){
					alert('EL CORREO HA SIDO ENVIADO SATISFACTORIAMENTE');
					formulario.reset();
				}else{
					alert('SU CORREO NO HA SIDO ENVIADO');
				}
			}
		);
	}
}

function confir_act_admin(){
	// Validamos que no lleguen campos vacios 
	var formulario = document.getElementById('act_datos_admin');
	var valida = true;
	var expRegEmail= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;//Expresion regular correo
	var expRegNum = /^(?:\+|-)?\d+$/; // Expresion regular números
	var expRegCp = /^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/;//Expresion regular codigo postal

	var cp_empresa = document.getElementById('cp_empresa');
	var colonia_empresa = document.getElementById('colonia_empresa');
	var calle_empresa = document.getElementById('calle_empresa');
	var numero_empresa = document.getElementById('numero_empresa');
	var email_empresa = document.getElementById('email_empresa');

	var nombre_contacto = document.getElementById('nombre_contacto');
	var telefono_contacto = document.getElementById('telefono_contacto');

	if(!cp_empresa.value || !expRegCp.exec(cp_empresa.value)){
		alert("EL CAMPO CODIGO POSTAL ES REQUERIDO O NO ES VALIDO");
		cp_empresa.focus();
		valida = false;
	}else if(!colonia_empresa.value){
		alert("INGRESA UNA COLONIA");
		colonia_empresa.focus();
		valida = false;
	}else if(!calle_empresa.value){
		alert("INGRESA UNA CALLE");
		calle_empresa.focus();
		valida = false;
	}else if(!numero_empresa.value){
		alert("INGRESA UN NUMERO VALIDO");
		numero_empresa.focus();
		valida = false;
	}else if(!email_empresa.value || !expRegEmail.exec(email_empresa.value)){
		alert("INGRESA UN CORREO VALIDO");
		email_empresa.focus();
		valida = false;
	}else if(!nombre_contacto.value){
		alert("EL CAMPO NOMBRE ES REQUERIDO");
		nombre_contacto.focus();
		valida = false;
	}else if(!telefono_contacto.value){
		alert("EL TELEFONO ES REQUERIDO");
		telefono_contacto.focus();
		valida = false;
	}

	if(valida){
		var ok = confirm("¡ESTA POR ACTUALIZAR LOS DATOS DE SU CLIENTE, VERIFIQUE QUE LOS DATOS SEAN CORRECTOS!");
		if(ok == true){

			gen_identificador_duiplicado(); // Verificación de duplicados en la DB

			alert("¡LOS DATOS HAN SIDO MODIFICADOS!");
			formulario.submit();
		}
	}
}

function update(){
	var cliente = $("#id_cliente").val();
	// AJAX
	jQuery.ajax({
			url: host + '/administrador/update_status_cliente',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona:cliente
			}
		}).done( function(resp)
			{
				var miJson = jQuery.parseJSON(resp);

				if(miJson){
					alert('EL CLIENTE HA SIDO ACTIVADO');
					$("#estado_cuenta").val("Activo");
				}else{
					alert('ERROR');
				}
			}
		);
}

function enable_fields(){
	$("#nombre_empresa").prop('readonly', false);
	$("#password_contacto").prop('readonly', false);
	$("#activar_campos").prop('disabled', true);
}

function gen_identificador_folio() {
	var nombre_empresa = document.getElementById('nombre_empresa');
	var nombre_empresa_val = nombre_empresa.value;
	var nombre = nombre_empresa_val.toUpperCase();
	
	var nombre_split = nombre.replace(' Y ', ' ');
	var nombre_abr = '';

	nombre_split = nombre_split.replace(' DE ', ' ');
	nombre_split = nombre_split.split(' ');

	for ( var i = 0 ; i < nombre_split.length ; i++ ) {
		nombre_abr += nombre_split[i].charAt(0);
	}

	nombre_abr = nombre_abr.replace(/[^a-zA-Z0-9]/g,'');

	// Still to provide more inputs
	if (nombre_abr.length > 6) {
		nombre_abr = nombre_abr.replace('SACV', '');
		nombre_abr = nombre_abr.replace('SRLCV', '');
		nombre_abr = nombre_abr.replace('SAPICV', '');
		nombre_abr = nombre_abr.replace('SAPICV', '');
		nombre_abr = nombre_abr.replace('SACV', '');
		nombre_abr = nombre_abr.replace('SADCV', '');
		nombre_abr = nombre_abr.replace('SRLCV', '');

		nombre_abr = nombre_abr.substr(0, 4); // 4 Es el numero maximo para el folio 
	}

	$("#identificador_folio").val(nombre_abr);

}

function gen_identificador_duiplicado() {
	var identificador_folio_val = document.getElementById('identificador_folio');
	var identificador_folio = identificador_folio_val.value;

	//AJAX
	jQuery.ajax({
		url: host + '/administrador/identificador_duplicado',	//<-- Url que va procesar la peticion
		timeout: 3000, //sets timeout to 3 seconds
		type:'post',
		data:{
			identificador_folio: identificador_folio
		}
	}).done(
		function(resp)
		{
			var json_data = jQuery.parseJSON(resp);
			var identificador_folio_r = json_data.identificador_folio;

			if (identificador_folio_r){
				alert("FOLIO " + identificador_folio_r + " ESTÁ DUPLICADO, FAVOR DE ELEJIR UNO DIFERENTE.");
				//$('#modal_folio_identificador').modal('show');
			}
		}
	);

}

function get_message_info(id){
	$("#email_subject").text("");
	$("#email").text("");
	$("#email_date").text("");
	$("#email_message").text("");
	$("#email_phone").text("");
	$("#message_list li").removeAttr("class");
	$("#delete_message").removeAttr("disabled");
	$("#mark_read").removeAttr("disabled");
	$("#mark_read").removeAttr("class");
	$("#mark_read").attr("class", "btn btn-success");
	$(".note-codable").attr( "name", "text_message");
	$(".note-codable").attr( "id", "text_message");

	var email_id = id;
	var url_delete = '\'' + host + '/administrador/eliminar_mensaje/' + email_id + '\'';
	var url_reply = 'administrador/contestar_mensaje_contacto/' + email_id;

	//AJAX
	jQuery.ajax({
		url: host + '/administrador/get_message',	//<-- Url que va procesar la peticion
		timeout: 3000, //sets timeout to 3 seconds
		type:'post',
		data:{
			email_id: email_id,
		}
	}).done(function(resp) {
		var json_data = jQuery.parseJSON(resp);
		var email_subject = json_data.email_subject;
		var email = json_data.email;
		var email_date = json_data.email_date;
		var email_message = json_data.email_message;
		var email_phone = json_data.email_phone;
		var email_status = json_data.status;

		if (email_subject == ""){
			email_subject = "-";
		}

		if (email_status == 1){
			$("#mark_read").attr("disabled", "true");
			$("#mark_read").removeAttr("onclick");
			$("#mark_read").attr("class", "btn btn-secondary");
		}

		email_phone = "Teléfono: " + email_phone;

		$("#mark_read").attr("onclick", "mark_read(" + id + ")");

		$("#email_subject").text(email_subject);
		$("#email").text(email);
		$("#email_date").text(email_date);
		$("#email_message").text(email_message);
		$("#email_phone").text(email_phone);
		$("#delete_message").attr('onclick', 'delete_message(' + url_delete + ')');
		$("#form_reply_message").attr('action', url_reply);
		$('#email_respond').text($('#email').text());
	});
}

function mark_read(id){
	$.ajax({
		url: host + '/administrador/mark_read/' + id,
		success:function(data){
			var new_unreads = $.parseJSON(data);
			$("#message_count").text(new_unreads);
			$("#" + id).remove();
		},
	});
}

function delete_message(url_delete){
	$('#email_delete').text($('#email').text());
	$('#mensaje_delete').attr('href', url_delete)
} 


function get_baja_clientes(){
	$.ajax({
		url: host + '/administrador/get_clientes',
		success:function(data){
			var opts = $.parseJSON(data);
			$('#id_persona_baja').append('<option value="-1">Selecciona empresa</option>');
			$.each(opts, function(i, d) {
				$('#id_persona_baja').append('<option value="' + d.id_persona + '">' + d.nombre_empresa + '</option>');
			});		
		},
	});
}

function get_chart(){
	var date_start = $("#date_start").val();
	var date_end = $("#date_end").val();
	var id_persona = $("#id_persona").val();

	jQuery.ajax({
		url: host + '/admin/get_data_chart',
		timeout: 3000, //sets timeout to 3 seconds
		type:'post',
		data:{
			id_persona: id_persona,
			date_start: date_start,
			date_end: date_end
		}
	}).done(function(data_chart) {
		//var json_data = jQuery.parseJSON(data_chart);
		var json_data = JSON.parse(data_chart);
		var hwm = $("#hazardous_waste_monthly");

		var print_data = json_data;

		console.log(print_data);

		var lineChart = new Chart( hwm, {type: 'line', data: { labels: ['2018-01', '2018-02', '2018-03', '2018-04', '2018-05', '2018-06', '2018-07', '2018-08', '2018-09', '2018-10', '2018-11'], datasets: [{ label: 'Aceites lubricantes usados', data: [0, 0, 3, 3, 0, 0, 0, 4, 0, 0, 0], fill: true, backgroundColor: 'rgba(236, 94, 105, 0.2)', borderColor: 'rgb(236, 94, 105)', pointBackgroundColor: 'rgb(236, 94, 105)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(236, 94, 105)'}, { label: 'Sólidos de mantenimiento automotriz', data: [0, 0, 3, 2, 0, 0, 0, 4, 0, 0, 0], fill: true, backgroundColor: 'rgba(0, 112, 224, 0.2)', borderColor: 'rgb(0, 112, 224)', pointBackgroundColor: 'rgb(0, 112, 224)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(0, 112, 224)'}, { label: 'cubetas impregnadas de aceite', data: [0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0], fill: true, backgroundColor: 'rgba(21, 145, 77, 0.2)', borderColor: 'rgb(21, 145, 77)', pointBackgroundColor: 'rgb(21, 145, 77)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(21, 145, 77)'}, { label: 'Sólidos otros (cubetas impregnadas con aceite)', data: [0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0], fill: true, backgroundColor: 'rgba(187, 237, 52, 0.2)', borderColor: 'rgb(187, 237, 52)', pointBackgroundColor: 'rgb(187, 237, 52)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(187, 237, 52)'}, { label: 'Sólidos telas o pieles imppregnadas de residuos peligrosos', data: [0, 0, 3, 3, 0, 0, 0, 3, 0, 0, 0], fill: true, backgroundColor: 'rgba(140, 54, 201, 0.2)', borderColor: 'rgb(140, 54, 201)', pointBackgroundColor: 'rgb(140, 54, 201)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(140, 54, 201)'}, { label: 'Solidos otros (papel, carton, plastico, impregnados de aceite lubricante)', data: [0, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0], fill: true, backgroundColor: 'rgba(229, 125, 41, 0.2)', borderColor: 'rgb(229, 125, 41)', pointBackgroundColor: 'rgb(229, 125, 41)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(229, 125, 41)'}, { label: 'Otros residuos peligrosos (agua contaminada)', data: [0, 0, 0, 0, 0, 0, 0, 3, 0, 0, 0], fill: true, backgroundColor: 'rgba(209, 37, 137, 0.2)', borderColor: 'rgb(209, 37, 137)', pointBackgroundColor: 'rgb(209, 37, 137)', pointBorderColor: '#fff', pointHoverBackgroundColor: '#fff', pointHoverBorderColor: 'rgb(209, 37, 137)'}]}
} );
	});
}

$(document).ready(function() {
	$("#delete_message").attr("disabled", "true");
	$("#mark_read").attr("disabled", "true");
	$("#reply_message").attr("disabled", "true");
	$(".note-editable").attr( "style", "height: 195.65px");
	$(".email-list").attr("style", "height: auto; max-height: 576px;");
	$('#date_start').datepicker();
	$('#date_end').datepicker();
	
	$(':file').change(function () {
		$('.custom-file-label').text(this.files.length + " Archivo seleccionado(s)");
	});

	$.ajax({
		url: host + '/administrador/get_unread',
		success:function(data){
			var unread = $.parseJSON(data);
			$("#message_count").text(unread);
		},
	});

	$("#message_list li").click(function() {
		$(this).attr('class', 'active');
	});

	$("#input_busca_mensaje").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#message_list *").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$(".note-editable").on("keyup", function() {
		$("#reply_message").removeAttr("disabled");
		$("#text_message").text($(".note-editable").text());
	});

	$( "#contestar_mensaje" ).click(function() {
		$( "#form_reply_message" ).submit();
	});

	$("#input_busca_carpeta").on("keyup", function() {
		// Search text
		var text = $(this).val();
		//var text = $(this).val().toLowerCase();
		var text_search = text.replace(/ /g, "_");

		if (text_search) {
			$("[id*=card_data_]").not("[id*=card_data_]" + text_search).hide();
			$("[id*=card_data_]:contains('" + text +"')").show();
		} else {
			$("[id*=card_data]").show();
		}
		
	});

});