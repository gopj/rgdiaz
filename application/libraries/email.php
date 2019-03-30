<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$mail_config['smtp_host'] = 'mail.rdiaz.mx';
$mail_config['smtp_port'] = '3535';
$mail_config['smtp_user'] = 'admin@rdiaz.mx';
$mail_config['smtp_pass'] = 'Diaz281';
$mail_config['smtp_crypto'] = 'tls'; //FIXED
$mail_config['protocol'] = 'smtp'; //FIXED
$mail_config['mailtype'] = 'html'; //FIXED
$mail_config['send_multipart'] = FALSE;

$this->email->initialize($mail_config);

