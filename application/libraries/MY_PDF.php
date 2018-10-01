<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH."/third_party/TCPDF/tcpdf.php"; 

class MY_PDF extends TCPDF { 
    public function __construct() { 
        parent::__construct(); 
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
		$this->Image('img/pdf/qr.png', 173, 18, 0, 20, 'PNG', '', '', true, 150, '', false, false, '', false, false, false);

		//Sub title
		$this->SetFont('helvetica', 'B', 11);
		
		$subt = 'MANIFIESTO DE ENTREGA, TRANSPORTE Y';
		$this->MultiCell(0, 0, $subt, 0, 'C', '', 1, '', 34, false);
		
		$subt = 'RECEPCIÓN DE RESIDUOS PELIGROSOS';
		$this->MultiCell(0, 0, $subt, 0, 'C', '', 1, '', 40, false);

	}

	// Page footer
	public function Footer() {


		$style = array('dash' => 0);

		// Start Transformation to rotate Generador
		$this->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$this->Rotate(90, 70, 110);
		$this->Text(60, 55, 'Generador');
		// Stop Transformation
		$this->StopTransform();

		// Start rect Generador
		$this->StartTransform();
		//Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) 
		$this->SetLineStyle( array( 'width' => 0.4, 'color' => array(0,0,0)));
		$this->Rect(14, 53.5, 5.9, 131.2, 'D');
		// Stop Transformation
		$this->StopTransform();


		// Start Transformation to rotate Transportista
		$this->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$this->Rotate(90, 110, 110);
		$this->Text(0, 15, 'Transportista');
		// Stop Transformation
		$this->StopTransform();

		// Start rect Transportista
		$this->StartTransform();
		//Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) 
		$this->SetLineStyle( array( 'width' => 0.4, 'color' => array(0,0,0)));
		$this->Rect(14, 184.7, 5.9, 42.3, 'D');
		// Stop Transformation
		$this->StopTransform();


		// Start Transformation to rotate Destinatario
		$this->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$this->Rotate(90, 139, 124);
		$this->Text(0, 0, 'Destinatario');
		// Stop Transformation
		$this->StopTransform();

		// Start rect Transportista
		$this->StartTransform();
		//Rect($x, $y, $w, $h, $style='', $border_style=array(), $fill_color=array()) 
		$this->SetLineStyle( array( 'width' => 0.4, 'color' => array(0,0,0)));
		$this->Rect(14, 227, 5.9, 40.9, 'D');
		// Stop Transformation
		$this->StopTransform();


		// Position at 15 mm from bottom
		$this->SetY(-20);
		// Set font
		$this->SetFont('helvetica', 'B', 8);
		// Page number
		$this->Cell(0, 10, 'ESTE DOCUMENTO NO ES VALIDO SIN EL SELLO DE RECEPCION Y LA FIRMA DEL ALMACENISTA', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}

}