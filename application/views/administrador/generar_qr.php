<?php
// create new PDF document
$pdf = new MY_QR_PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('RDiaz');
$pdf->SetAuthor('RDiaz');
$pdf->SetTitle('QR Empresa');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Set QR
$pdf->genera_qr_empresa($id_cliente);

// output the HTML content
$pdf->writeHTML('', true, false, true, false, '');

//$filename= "{$nombre_empresa}_{$manifiesto}.pdf";
$file_name              = "rdiaztmp{$id_cliente}.pdf"; 
$file_location          = $_SERVER['DOCUMENT_ROOT'] . "rgdiaz/img/pdf/";;
$pdf_name_and_location  = $file_location . $file_name; //Linux

//Close and output PDF document
$pdf->Output($pdf_name_and_location, 'FI');
?>