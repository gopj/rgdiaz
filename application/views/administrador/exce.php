<?php
						error_reporting(E_ALL);
						ini_set('display_errors', TRUE);
						ini_set('display_startup_errors', TRUE);
						define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
						date_default_timezone_set('Europe/London');
						$id_persona = $this->input->post('id_persona');
			    		$objReader = PHPExcel_IOFactory::createReader('Excel5');
			    		$objPHPExcel = $objReader->load("plantilla/plantilla.xls");
			    		$residuos_peligrosos = $this->residuo_peligroso_model->get_residuos($id_persona);
			    		$nombre_empresa = $this->persona_model->get_nombre_empresa($id_persona);
			    		$baseRow = 3;

						$style = array(
							'alignment' => array(
								'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							),
							'font' => array(
								'bold' => true
							)

						);

						$objPHPExcel->getActiveSheet()->mergeCells('B1:P1');
						$objPHPExcel->getActiveSheet()
										->setCellValue('B1', $nombre_empresa)
										->getStyle("B1")->applyFromArray($style);

						foreach($residuos_peligrosos as $row =>$r) {
							$col = $baseRow + $row;
							$objPHPExcel->getActiveSheet()
											->setCellValue('B'.$col, $r->folio)
							                ->setCellValue('C'.$col, $r->residuo)
							                ->setCellValue('D'.$col, $r->clave)
							                ->setCellValue('E'.$col, $r->cantidad)
							                ->setCellValue('F'.$col, $r->unidad)
							                ->setCellValue('G'.$col, $r->caracteristica)
							                ->setCellValue('H'.$col, $r->area_generacion)
							                ->setCellValue('I'.$col, $r->fecha_ingreso)
							                ->setCellValue('J'.$col, $r->fecha_salida)
							                ->setCellValue('K'.$col, $r->emp_tran)
							                ->setCellValue('L'.$col, $r->no_aut_transp)
							                ->setCellValue('M'.$col, $r->dest_final)
							               	->setCellValue('N'.$col, $r->no_aut_dest_final)
							               	->setCellValue('O'.$col, $r->sig_manejo)
							               	->setCellValue('P'.$col, $r->resp_tec);
							                              
						}
						echo date('H:i:s') , " Write to Excel5 format" , EOL;
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						$objWriter->save(str_replace('.php', '.xls', __FILE__));
						echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
						echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;
						echo date('H:i:s') , " Done writing file" , EOL;
						echo 'File has been created in ' , getcwd() , EOL;				
?>