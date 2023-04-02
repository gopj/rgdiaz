<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/TCPDF/tcpdf.php"; 

class MY_QR_PDF extends TCPDF { 
    
    protected $url;

    public function __construct() { 
        parent::__construct(); 
    } 

	// URL FOR QRCODE
	public function genera_qr_empresa($id_cliente){
		$this->url = 'https://localhost/rgdiaz/admin/recolector_crear_manifiesto/' . $id_cliente ;
		//$this->url = 'http://rdiaz.mx/recolector/generar_manifiesto_no_login/' . $id_cliente . "/" . $codigo;
	}

	//Page header
	public function Header() {

		// Title
		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$this->SetFont('helvetica', 'B', 9);

		// Image method signature:
		// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

		$this->Image('img/logo.png', 85, 0, 0, 20, 'PNG', '', '', true, 150, '', false, false, '', false, false, false);

		// set style for barcode
		$style = array(
			'border' => false,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
		);
		// Bar code print
		$this->write2DBarcode($this->url , 'QRCODE,H', 15, 15, 90, 90, $style, 'N');
		$this->write2DBarcode($this->url , 'QRCODE,H', 105, 15, 90, 90, $style, 'N');
		$this->write2DBarcode($this->url , 'QRCODE,H', 15, 96, 90, 90, $style, 'N');
		$this->write2DBarcode($this->url , 'QRCODE,H', 105, 96, 90, 90, $style, 'N');
		$this->write2DBarcode($this->url , 'QRCODE,H', 15, 178, 90, 90, $style, 'N');
		$this->write2DBarcode($this->url , 'QRCODE,H', 105, 178, 90, 90, $style, 'N');

	}

	//Page footer
	public function Footer() {
		// Position at 30 mm from bottom
		$this->SetY(-24);
		// Set font
		$this->SetFont('helvetica', 'B', 8);
		// End Text
		$this->Cell(0, 8, 'ESTE DOCUMENTO NO ES VALIDO SIN EL SELLO DE RECEPCION Y LA FIRMA DEL ALMACENISTA', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
	}

}

?>