<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/TCPDF/tcpdf.php"; 

class MY_PDF extends TCPDF { 
    
    protected $url;

    public function __construct() { 
        parent::__construct(); 
    } 

    // URL FOR QRCODE
	public function setQR($id_cliente, $folio){
		$this->url = 'https://localhost/rgdiaz/recolector/generar_manifiesto/' . $id_cliente . "/" . $folio;
	}

	//Page header
	public function Header() {

		// Title
		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
		$this->SetFont('helvetica', 'B', 9);
		
		$title = 'SECRETARIA DEL MEDIO AMBIENTE Y RECURSOS NATURALES' . "\n" . 
				 'SUBSECRETARÍA DE GESTIÓN PARA LA PROTECCIÓN AMBIENTAL' . "\n" . 
				 'DIRECCIÓN GENERAL DE GESTIÓN INTEGRAL DE MATERIALES Y ACTIVIDADES RIESGOSAS';
		
		$this->MultiCell(0, 15, $title, 0, 'C', '', 1, '' ,'', true);

		// Image method signature:
		// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

		$this->Image('img/pdf/semarnat.png', 13, 18, 0, 20, 'PNG', '', '', true, 150, '', false, false, '', false, false, false);
		$this->Image('img/logo.png', 85, 18, 0, 20, 'PNG', '', '', true, 150, '', false, false, '', false, false, false);

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
		$this->write2DBarcode($this->url , 'QRCODE,H', 162, 18, 24, 24, $style, 'N');

		//Sub title
		$this->SetFont('helvetica', 'B', 11);
		
		$subt = 'MANIFIESTO DE ENTREGA, TRANSPORTE Y';
		$this->MultiCell(0, 0, $subt, 0, 'C', '', 1, '', 34, false);
		
		$subt = 'RECEPCIÓN DE RESIDUOS PELIGROSOS';
		$this->MultiCell(0, 0, $subt, 0, 'C', '', 1, '', 40, false);


		// Following part is part of the template
		$style = array('dash' => 0);

		// Start Transformation to rotate Generador
		$this->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$this->Rotate(90, 70, 110);
		$this->Text(50, 55, 'Generador');
		// Stop Transformation
		$this->StopTransform();

		// Start rect Generador
		$this->StartTransform();
		//Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) 
		$this->SetLineStyle( array( 'width' => 0.4, 'color' => array(0,0,0)));
		$this->Rect(14, 53.5, 5.9, 126.1, 'D');
		// Stop Transformation
		$this->StopTransform();


		// Start Transformation to rotate Transportista
		$this->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$this->Rotate(90, 110, 110);
		$this->Text(7, 15, 'Transportista');
		// Stop Transformation
		$this->StopTransform();

		// Start rect Transportista
		$this->StartTransform();
		//Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) 
		$this->SetLineStyle( array( 'width' => 0.4, 'color' => array(0,0,0)));
		$this->Rect(14, 179.7, 5.9, 45.6, 'D');
		// Stop Transformation
		$this->StopTransform();


		// Start Transformation to rotate Destinatario
		$this->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$this->Rotate(90, 139, 124);
		$this->Text(3, 0, 'Destinatario');
		// Stop Transformation
		$this->StopTransform();

		// Start rect Transportista
		$this->StartTransform();
		//Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) 
		$this->SetLineStyle( array( 'width' => 0.4, 'color' => array(0,0,0)));
		$this->Rect(14, 225.3, 5.9, 46.56, 'D');
		// Stop Transformation
		$this->StopTransform();

	}

	//Page footer
	public function Footer() {
		// Position at 30 mm from bottom
		$this->SetY(-24);
		// Set font
		$this->SetFont('helvetica', 'B', 8);
		// End Text
		$this->Cell(0, 8, 'ESTE DOCUMENTO NO ES VALIDO SIN EL SELLO DE RECEPCION Y LA FIRMA DEL ALMACENISTA', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		
		if($this->page == 1){
			$this->SetY(-18);
			$this->Cell(0, 8, 'COPIA PROVISIONAL PARA GENERADOR', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		} elseif ($this->page == 2) {
			$this->SetY(-18);
			$this->Cell(0, 8, 'ORIGINAL PARA GENERADOR', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		} elseif ($this->page == 3) {
			$this->SetY(-18);
			$this->Cell(0, 8, 'COPIA PARA DESTINATARIO', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    	} elseif ($this->page == 4) {
    		$this->SetY(-18);
			$this->Cell(0, 8, 'COPIA PARA TRANSPORTISTA', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    	}
		
	}

}
