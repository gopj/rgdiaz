<?php
	include_once('conecta.php');
	include_once('PHPExcel.php');

	$carreras = array('','Ing. Sistemas','Ing. Informatica','Ing. Industrial');
	$especialidad = array('','Especialidad 1','Especialidad 2');

	$SQL = "SELECT * FROM alumnos";

	$res = mysql_query($SQL) or die("Error en la consulta ".mysql_error());

	if($res > 0 )
	{
		date_default_timezone_set('America/Mexico_City');
		if (PHP_SAPI == 'cli')
    		die('Este archivo solo se puede ver desde un navegador web');
    	
    	//Se crea el objeto PHPExcel
    	$objPHPExcel = new PHPExcel();

    	$objPHPExcel->getProperties()->setCreator("Reporte") // Nombre del autor
    		->setLastModifiedBy("RDiaz") //Ultimo usuario que lo modificó
    		->setTitle("Reporte Excel con PHP y MySQL") // Titulo
    		->setSubject("Reporte Excel con PHP y MySQL") //Asunto
    		->setDescription("Reporte de Residuos") //Descripción
    		->setKeywords("Reporte Bitacora") //Etiquetas
    		->setCategory("Reporte excel"); //Categorias

		// Se agregan los titulos del reporte
		$objPHPExcel->setActiveSheetIndex(0)
			->mergeCells('A1:A2')
		    ->setCellValue('A1',  'FOLIO DEL MANIFIESTO')
		    ->mergeCells('B1:B2')
		    ->setCellValue('B1',  'RESIDUO PELIGROSO')
		    ->mergeCells('C1:C2')
		    ->setCellValue('C1',  'CLAVE')
		    ->mergeCells('D1:D2')
		    ->setCellValue('D1',  'CANTIDAD')
		    ->mergeCells('E1:E2')
		    ->setCellValue('E1',  'UNIDAD DE MEDIDA')
		    ->mergeCells('F1:F2')
		    ->setCellValue('F1',  'CARACTERISTICA DE PELIGROSIDAD')
		    ->mergeCells('G1:G2')
		    ->setCellValue('G1',  'AREA DE GENERACION')
		    ->mergeCells('H1:I1')
		    ->setCellValue('H1',  'FECHA EN EL ALMACEN')
		    ->setCellValue('H2',  'INGRESO')
		    ->setCellValue('I2',  'SALIDA')
		    ->mergeCells('J1:J2')
		    ->setCellValue('J1',  'SIGUIENTE FASE')
		    ->mergeCells('K1:K2')
		    ->setCellValue('K1',  'EMPRESA TRANSPORTISTA')
		    ->mergeCells('L1:L2')
		    ->setCellValue('L1',  'DESTINO FINAL')
		    ->mergeCells('M1:M2')
		    ->setCellValue('M1',  'RESPONSABLE TECNICO');

		//Se agregan los datos de los alumnos

 		/*$i = 4; //Numero de fila donde se va a comenzar a rellenar
 		while ($fila = mysql_fetch_assoc($res)) {
		    $objPHPExcel->setActiveSheetIndex(0)
		        ->setCellValue('A'.$i, $fila['no_control'])
		        ->setCellValue('B'.$i, $fila['nombre'])
		        ->setCellValue('C'.$i, $fila['ap_paterno'])
		        ->setCellValue('D'.$i, $fila['ap_materno'])
		        ->setCellValue('E'.$i, $fila['semestre'])
		        ->setCellValue('F'.$i, $fila['correo'])
		        ->setCellValue('G'.$i, $carreras[$fila['carrera']])
		        ->setCellValue('H'.$i, $especialidad[$fila['especialidad']]);
		    $i++;
		}*/

		$estiloTituloColumnas = array(
		    'font' => array(
		        'name'  => 'Arial',
		        'bold'  => true,
		        'color' => array(
		            'rgb' => '000000'
		        )
		    ),
		    'fill' => array(
		        'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
		    'rotation'   => 90,
		        'startcolor' => array(
		            'rgb' => 'C5D9F1'
		        ),
		        'endcolor' => array(
		            'argb' => 'C5D9F1'
		        )
		    ),
		    'borders' => array(
		        'allborders' => array(
		            'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
		            'color' => array(
		                'rgb' => '000000'
		            )
		        )
		    ),
		    'alignment' =>  array(
		        'horizontal'=> PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		        'vertical'  => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		        'wrap'      => TRUE
		    )
		);

		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->getActiveSheet()->getStyle('A2:M2')->applyFromArray($estiloTituloColumnas);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("A")->setWidth(16);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("B")->setWidth(24);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("C")->setWidth(10);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("D")->setWidth(12);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("E")->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("F")->setWidth(25);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("G")->setWidth(20);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("H")->setWidth(14);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("I")->setWidth(14);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("J")->setWidth(15);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("K")->setWidth(22);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("L")->setWidth(14);
		$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension("M")->setWidth(18);

		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Bitacora');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);

		// Inmovilizar paneles
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Bitacora.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
	else
	{
    	print_r('No hay resultados para mostrar');
	}
?>