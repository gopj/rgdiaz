var host="localhost/rgdiaz";
//var host="rdiaz.mx";

function actualiza_noti(){
	//Cambiamos con ajax el status de las notificaciones
	var rec = document.getElementById('recibe');
	
	var status = 1;
	var recibe = rec.value;

	jQuery.ajax({
			url:'http://' + host + '/index.php/cliente/cambia_status_notificacion',	//<-- Url que va procesar la peticion
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				recibe: recibe,
				id_status_notificacion: status 
			}
		}).done(function(resp){});
}

function select_bitacora(){
	var formulario = document.getElementById('form_bitacora');
	var id_tipo_bitacora = document.getElementById('id_bitacora').value;
	var bandera = true;

	if(!id_tipo_bitacora){
		alert('INGRESA UNA BITACORA');
		bandera = false;
	}
	if(bandera){
		formulario.submit();
	}
}

function actualiza_datos(){
	var formulario = document.getElementById('form_actualiza');
	var confirma;
	confirma = confirm("¡ESTAS A PUNTO DE ACTUALIZAR TUS DATOS, VERIFICA QUE SEAN CORRECTOS!");
	if (confirma==true)
  	{
  		alert('¡LOS CAMBIOS HAN SIDO GUARDADOS!');
  		formulario.submit();
  	}
}

function clave_residuo(clave){
	var cl = clave
	if(cl == "O-1"){
		cl = "O";
	}else if(cl == "O-2"){
		cl = "O";
	}else if(cl == "SO4-1"){
		cl = "SO4";
	}else if(cl == "SO4-2"){
		cl = "SO4";
	}
	document.getElementById('clave').value=cl;
	//document.getElementById('residuo').value = cl;
	//var residuo = document.getElementById('residuo');
	//alert(residuo.value);
}

function clave_transporte(opc){
	if(opc == "Otro"){
		$("#otro").removeAttr('disabled');
	}
	else{
		$("#otro").attr('disabled','disabled');
	}	
}

function valida_form_password(){
	var valida = true;
	var formulario = document.getElementById('act_password');
	var psw1 = document.getElementById('password');
	var psw2 = document.getElementById('password2');
	var id_persona = document.getElementById('id_persona');

	if(!psw1.value){
		alert("COMPLETA EL CAMPO NUEVA CONTRASEÑA");
		psw1.focus();
		valida = false;
	}else if(!psw2.value){
		alert("COMPLETA EL CAMPO REPITE CONTRASEÑA");
		psw2.focus();
		valida = false;
	}
	if(valida){
		if(psw1.value == psw2.value){
			//Actializamos con AJAX
			var password = psw1.value;
			var id_persona = id_persona.value;
			jQuery.ajax({
			url:'http://' + host + '/index.php/home/valida_usuario',	//<-- Url que va procesar la peticion
			//url:'http://rdiaz.mx/index.php/cliente/update_password',
			timeout: 3000, //sets timeout to 3 seconds
			type:'post',
			data:{
				password: password,
				id_persona: id_persona
			}
		}).done(function(resp){
			var miJson = jQuery.parseJSON(resp);
			if(miJson == true){
				alert("LA CONTRASEÑA HA SIDO CAMBIADA CON EXITO");
				formulario.reset();
			}else{
				alert("ERROR!!");
			}
		});
		}else{
			alert("LAS CONTRASEÑAS NO COINCIDEN");
			formulario.reset();
		} 
	}
}