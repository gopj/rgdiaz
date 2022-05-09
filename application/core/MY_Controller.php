<?php
class My_Controller extends CI_Controller{
	// Propiedad para asignar el layout, valor por defecto: 'default'
	private $layout = "empty";
	public function __construct(){
		parent::__construct();
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