<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cliente extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('persona_model');
		$this->load->model('contacto_model');
		$this->load->helper('download');
		$this->load->library('session');
		$this->load->library('email');
	}

	#	Funcion para validar el correo valido de un usuario
	public function valida_usuario_correo(){
		if($this->input->post()){
			$recupera = $this->persona_model->recupera_corr($this->input->post('correo'));
			if(is_object($recupera)){
				$acceso = true;
				echo json_encode($acceso);
			}else{
				$acceso = false;
				echo json_encode($acceso);
			}
		}
	}

	#	Funcion para restablecer contraseña de cliente y mandar correo de conformacion
	public function rest_contra(){
		if($this->input->post()){
			$correo = $this->input->post('recupera_correo');

			#-------------  CREACION DE CONTRASEÑA TEMPORAL  ------------------------
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$psw_nva = ""; #password nueva
			for($i=0;$i<8;$i++) {
				$psw_nva .= substr($str,rand(0,62),1);
			}
			$cambia_psw = $this->persona_model->cambia_psw($psw_nva,$correo);
			#	---------------------------------------------------------------------

			#------------  ENVIO DE CORREO DE CONFIRMACION  -------------------------
			/*$ci = get_instance();
			$ci->load->library('email');
			$config['protocol'] = "smtp";
			$config['smtp_host'] = "ssl://smtp.gmail.com";
			$config['smtp_port'] = "465";
			$config['smtp_user'] = "adancruzhuerta@gmail.com"; 
			$config['smtp_pass'] = "280391Adan";
			$config['charset'] = "utf-8";
			$config['mailtype'] = "html";
			$config['newline'] = "\r\n";

			$ci->email->initialize($config);

			$ci->email->from('09460322@itcolima.edu.mx', 'RESTABLECIMIENTO DE CONTRASEÑA DE SISTEMA RDIAZ');
			$list = array('adancruzhuerta@gmail.com','yaran_ramos_65@hotmail.com');
			$ci->email->to($list);
			$this->email->reply_to('adan.cruz@hotmail.es', 'Hola esta es una Prueba mas');
			$ci->email->subject('PRUEBA DE EMAIL');
			$ci->email->message("TU CONTRASEÑA TEMPORAL ES : <h3>$psw_nva</h3>");
			if($ci->email->send()){
				$cambio = true;
				echo json_encode($cambio);
			}else{
				$cambio = false;
				echo json_encode($cambio);
			}*/
			#------------------------------------------------------------------------
			/*$cambio = true;
			echo json_encode($cambio);*/

			$this->load->library('My_PHPMailer');
			$this->load->library('My_PHPMailer_smtp');

			$de = 'adan.cruz@hotmail.es';
			$para = 'adancruzhuerta@gmail.com'; 
			$asunto = 'prueba de php mailer en CODEIGNITER';
			$mensaje = 'Este es mi mensaje de phpmyler...';

			$cabeceras = "MIME-Version: 1.0\r\n";
			$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$cabeceras .= "From: $de \r\n";

			$mail = new PHPMailer();//creamos un nuevo objeto
			$mail->IsSMTP();//	protocolo SMTP
			$mail->SMTPAuth = true; // autenticacion en el SMTP
			$mail->SMTPSecure = "ssl";
			$mail->Host = "smtp.gmail.com";
			$mail->Port = 465;
			$mail->From = $de; //remitente del correo
			$mail->AddAddress($para); // Destinatario
			$mail->Username = "adancruzhuerta@gmail.com";
			$mail->Password ="280391Adan";
			$mail->Subject = $asunto;
			$mail->Body = $mensaje;
			$mail->WordWrap = 50;
			$mail->MsgHTML($mensaje);
			#$mail->AddAttachment($destino);


			if($mail->Send()){//Enviamos el correo por phpmailer
				$cambio = true;
				echo json_encode($cambio);
			}else{
				$cambio = false;
				echo json_encode($cambio);
			}
		}
	}
#	ESTA FUNCION LA HIZE PARA PROBAR SI FUNCIONA LA CLASE EMAIL DE CODEIGNITER PERO TIENE QUE IR EN 
#	LA FUNCION rest_contra.. :) 
	/*public function mail(){
		$this->load->library('My_PHPMailer');

		$de = 'adan.cruz@hotmail.es';
		$para = 'adancruzhuerta@gmail.com'; 
		$asunto = 'prueba de php mailer en CODEIGNITER';
		$mensaje = 'Este es mi mensaje de phpmyler...';

		$cabeceras = "MIME-Version: 1.0\r\n";
		$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$cabeceras .= "From: $de \r\n";

		$mail = new PHPMailer();//creamos un nuevo objeto
		$mail->IsSMTP();//	protocolo SMTP
		$mail->SMTPAuth = true; // autenticacion en el SMTP
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->From = $de; //remitente del correo
		$mail->AddAddress($para); // Destinatario
		$mail->Username = "adancruzhuerta@gmail.com";
		$mail->Password ="280391Adan";
		$mail->Subject = $asunto;
		$mail->Body = $mensaje;
		$mail->WordWrap = 50;
		$mail->MsgHTML($mensaje);
		#$mail->AddAttachment($destino);


		if($mail->Send()){//Enviamos el correo por phpmailer
		echo "EL CORREO AH SIDO ENVIADO!!";
	}else{
		echo "EL CORREO NOO AH SIDO ENVIADO!!";
	}
	}*/

}
