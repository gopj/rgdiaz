 	// --		Desarrollado por SharkSoft 
// -- 		Adan Cruz Huerta
// -- 		Jonathan Yaran Ramos Vazquez
// --		Erick Alejandro Sandoval Flores
// -- 		Christian Ramon Magallon Garcia
//	Script para validar el envio de el formulario de inicio de sesion. Campos vacios y validos!!

// Global variable for host
var host="localhost/rgdiaz";


function validarFormSesion(){
	var expRegEmail= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;//Expresion regular correo
	var verificar = true;
	var formulario = document.getElementById("formSesion");
	var usuario = document.getElementById("correo_session");
	var password_val = document.getElementById("password_session");

	if(!usuario.value || !expRegEmail.exec(usuario.value)){
		alert('EL CORREO DE USUARIO ES REQUERIDO O ES UN CORREO INVALIDO');
		usuario.focus();
		verificar = false;
	}else if(!password_val.value){
		alert('La Contraseña es Requerida');
		password_val.focus();
		verificar = false;
	}

	//validacion de usuario dado de alta con AJAX
	if(verificar){
		var usua = $("#correo_session").val();
		var pass = $("#password_session").val();
		/*AJAX*/
		//$('#loading').html('<img style="width:35px;" src="img/load.gif"/>'); 
		jQuery.ajax({
			url:'https://' + host + '/home/valida_usuario',	//<-- Url que va procesar la peticion
			//url:'https://rgdiaz.com.mx/home/valida_usuario',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				correo: usua,
				password: pass
			}
		}).done(
			function(resp)
			{
				var miJson = JSON.parse(resp);
				if(miJson == true){
					formulario.submit();
				}else{
					alert('El USUARIO NO ES VALIDO. INGRESA DATOS NUEVAMENTE');
					formulario.reset();
				}
			}
		);
	}
}

//	Script para validar formulario de recuperacion de password!!
function recupera_psw(){
	var expRegEmail= /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;//Expresion regular correo
	var verificar = true;
	var formulario = document.getElementById("form_recupera_psw");
	var usuario = document.getElementById("recupera_correo");

	if(!usuario.value || !expRegEmail.exec(usuario.value)){
		alert("EL CORREO DE USUARIO ES REQUERIDO O ES UN CORREO INVALIDO");
		usuario.focus();
		verificar = false;
	};

	if(verificar){
		var usua = $("#recupera_correo").val();
		/*AJAX -- CHECO SI EXISTE CORREO*/
		jQuery.ajax({
			url:'https://' + host + '/cliente/valida_usuario_correo',	//<-- Url que va procesar la peticion
			//url:'https://rgdiaz.com.mx/cliente/valida_usuario_correo',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				correo: usua
			}
		}).done(
			function(resp)
			{
				var miJson = jQuery.parseJSON(resp);
				if(miJson == true){
					/*AJAX -- MODIFICO PASSWORD*/
					$('#esperar').text("Espere un momento...");
					jQuery.ajax({
						url:'https://' + host + '/cliente/rest_contra', //<-- Url que procesa peticion
						//url:'https://rgdiaz.com.mx/cliente/rest_contra',
						timeout: 3000, //sets timeout to 3 seconds
						type:'post',
						data:{
							correo: usua
						}
					}).done(
						function(resp){
							var miJson2 = jQuery.parseJSON(resp);
							if(miJson2 == true){
								alert('¡SU CONTRASEÑA HA SIDO CAMBIADA SATISFACTORIAMENTE REVISE SU CORREO. NOTA ES POSIBLE QUE EL MENSAJE SE MUESTRE COMO CORREO NO DESEADO O SPAM!');
								formulario.reset();
								$('#esperar').text("");
							}else{
								alert('OCURRIO UN PROBLEMA SU CONTRASEÑA NO FUE CAMBIADA, PONGASE EN CONTACTO CON EL ADMINISTRADOR');
								$('#esperar').text("");
							}
						}
					);
				}else{
					alert('El CORREO INGRESADO NO EXISTE. FAVOR DE REVISAR DATOS!!');
					formulario.reset();
				}
			}
		);
	};
}