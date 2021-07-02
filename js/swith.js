// Global variable for host
var host="localhost/rgdiaz";


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
			url:'http://' + host + '/index.php/administrador/verifica_correo',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/verifica_correo',
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
	var archivo = document.getElementById('name');
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
			url:'http://' + host + '/index.php/administrador/eliminar_carpeta',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/eliminar_carpeta',
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

	alert("HI");

	$("#nombre_contacto").val("");
	$("#telefono_contacto").val("");
	$("#telefono_contacto_alt").val("");
	$("#email_contacto").val("");
	$("#password_contacto").val("");
	$("#estado_cuenta").val("");


	var id_per = id;
	if(id_per == 0){
		$("#btn_expediente").attr('disabled','disabled');
		$("#btn_bitacora").attr('disabled','disabled');
		$("#btn_guardar").attr('disabled','disabled');
		$("#update_status").attr('disabled','disabled');
	}
	else{
		$("#btn_expediente").removeAttr('disabled');
		$("#btn_bitacora").removeAttr('disabled');
		$("#btn_guardar").removeAttr('disabled');
	}

	//AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/administrador/obtiene_cliente',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/obtiene_cliente',
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

function comprueba_emp_trans(id){
	$("#nombre_emp_trans").val("");
	$("#no_aut_trans").val("");
	$("#no_aut_trans_sct").val("");
	$("#domicilio_emp_trans").val("");
	$("#tel_emp_trans").val("");

	var id_tipo_emp_trans = id;

	//AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/administrador/obtiene_emp_trans',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/obtiene_cliente',
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
			url:'http://' + host + '/index.php/administrador/obtiene_emp_dest',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/obtiene_emp_dest',
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
			url:'http://' + host + '/index.php/administrador/verifica_correo',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/verifica_correo',
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
			url:'http://' + host + '/index.php/administrador/envia_correo_admin',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/envia_correo_admin',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				id_persona: id_p,
				asunto: asun,
				mensaje:mens
			}
		}).done(:
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
			alert("¡LOS DATOS HAN SIDO MODIFICADOS!");
			formulario.submit();
		}
	}
}

function update(){
	var cliente = $("#persona3").val();
	// AJAX
	jQuery.ajax({
			url:'http://' + host + '/index.php/administrador/update_status_cliente',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/administrador/update_status_cliente',
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