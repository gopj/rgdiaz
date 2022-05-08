<?php
class My_Controller extends CI_Controller{
	// Propiedad para asignar el layout, valor por defecto: 'default'
	private $layout = "default";
	public function __construct($requireLogin = FALSE, $code = null){
		parent::__construct();
		if($requireLogin){
			if(!$this->session->userdata('user')){
				// Mostrar mensaje que necesita identificarse como usuario del sistema
				redirect('login');
			} elseif(!is_null($code)){
				$user = $this->session->userdata('user');
				if($user['code'] != $code){
					// Mostrar mensaje, no tienes permisos

					if ($this->session->userdata('tipo') == 1) {
						redirect("admin");
					} elseif ($this->session->userdata('tipo') == 2) {
						redirect("recolector");
					} elseif ($this->session->userdata('tipo') == 3) {
						redirect("cliente");
					}
					
				}
			}
		}
	}
	/**
	 * Set layout for change the default layout
	 * @param $layout
	 */
	protected function setLayout($layout){
		$this->layout = $layout;
	}
	/**
	 * @Override _output
	 * @param $output
	 *
	 * Sobre-escribe la funcion _output, recibe como parametro el contenido procesado de la vista de cada metodo.
	 * Lo envia a una nueva vista que se utiliza como layout es decir vista general.
	 */
	public function _output($output){
		$data['output'] = $output;
		echo $this->load->view("layouts/{$this->layout}", $data, true);
	}
}