<?php if (! defined('BASEPATH')) exit('No direct script acces allowed');
	require_once('PHPMailer/class.smtp.php');

class My_PHPMailer_smtp extends PHPMailer{
	public function __construct(){
		parent::__construct();
	}
}