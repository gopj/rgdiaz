<?php

		function creti($string){
			$creti = explode(" ", $string);
			$creti_count = count($creti);

			$creti_r = "";
			for ($i = 0; $i < $creti_count; $i++) {
				if ($i < ($creti_count-1)) {
					$creti_r .= substr($creti[$i], 0, 1) . " ";	
				} else {
					$creti_r .= substr($creti[$i], 0, 1);
				}
			}

			return $creti_r;
		}

		// create new PDF document
		$pdf = new MY_PDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator('RDiaz');
		$pdf->SetAuthor('RDiaz');
		$pdf->SetTitle('Manififesto');
		
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

		// add a page
		$pdf->AddPage();

		// Image method signature:
		// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
		$res_man_cant = count($residuos_manifiesto);
    	$r = 0;
		
		$table_data_html = '';
    	 for ($i=0; $i <= 17; $i++) {

    	 	if ($res_man_cant > $i) {
    	 		$table_data_html = $table_data_html . '
					<tr>
						<td width="342" align="left" class="data"> ' . $residuos_manifiesto[$r]->residuo . '</td>
						<td width="43" align="center" class="data"> ' . creti($residuos_manifiesto[$r]->caracteristica) . ' </td>
						<td width="45" align="center" class="data"> ' . "NULL" . ' </td>
						<td width="45" align="center" class="data"> ' . "NULL" . ' </td>
						<td width="67" align="center" class="data"> ' . $residuos_manifiesto[$r]->cantidad . ' </td>
						<td width="67" align="center" class="data"> ' . $residuos_manifiesto[$r]->unidad . ' </td>
					</tr>
					';
				$r++;
    	 	} else {
    	 		$table_data_html = $table_data_html . '
					<tr>
						<td width="342" align="left" class="data"> </td>
						<td width="43" align="center" class="data"> </td>
						<td width="45" align="center" class="data"> </td>
						<td width="45" align="center" class="data"> </td>
						<td width="67" align="center" class="data"> </td>
						<td width="67" align="center" class="data"> </td>
					</tr>
					';
    	 	}

    	} 

// define some HTML content with style
$html = '
<style>
table.manifiesto {
	font-family: helvetica;
	font-size: 8pt;
	font-weight: bold;
	text-align: center;
	height: 15px;
	line-height:15px;
}
td.defined {
	font-family: helvetica;
	font-size: 6pt;
	font-weight: normal;
	text-align: center;
	height: 15px;
	line-height:15px;
}

td.data {
	font-family: helvetica;
	font-size: 7pt;
	font-weight: bold;
	text-align: center;
	height: 15px;
	line-height:15px;

}
td.borde_inferior {
	border-bottom: 3px solid #FFFFFF;
}

td.borde_izquierdo {
	border-left: 3px solid #FFFFFF;
}

td.borde_derecho {
	border-right: 3px solid #FFFFFF;
}

td.borde_top {
	border-top: 3px solid #FFFFFF;
}

td.bodes_no {
	border-top: 3px solid #FFFFFF;
	border-bottom: 3px solid #FFFFFF;
	border-left: 3px solid #FFFFFF;
	border-right: 3px solid #FFFFFF;
}



</style>

<br /><br /><br /><br /><br /><br />

<table class="manifiesto" border="1">
	<tr>
		<td width="20" rowspan="29"> </td>
		<td width="215" align="left" class="defined"> 1.- No. DE REGISTRO AMBIENTAL </td>
		<td width="170">  '. $datos_empresa->numero_registro_ambiental .' </td>
		<td width="90"  class="defined"> 2.- NO. MANIFIESTO </td>
		<td width="67" style="color: red;"> '. $residuos_manifiesto[0]->folio .' </td>
		<td width="67"  class="defined">  PÁGINA 1/1  </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> 3.- RAZÓN SOCIAL DE LA EMPRESA GENERADORA </td>
		<td width="394" align="center"> '. $datos_empresa->nombre_empresa .' </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> 4.- DOMICILIO </td>
		<td width="260" align="center"> '. $datos_empresa->calle_empresa .', ' . $datos_empresa->colonia_empresa . ' </td>
		<td width="67" align="center" class="defined"> C.P. </td>
		<td width="67" align="center"> '. $datos_empresa->cp_empresa .' </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> MUNICIPIO </td>
		<td width="170" align="center"> '. $datos_empresa->municipio .' </td>
		<td width="90" align="center" class="defined"> ESTADO </td>
		<td width="134" align="center"> '. $datos_empresa->estado .' </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> TELEFONO </td>
		<td width="394" align="center"> '. $datos_empresa->telefono_empresa .' </td>
	</tr>
	<tr>
		<td width="342" align="left" class="defined" rowspan="2" > &nbsp;<br/> 5.- DESCRIPCIÓN (Nombre del residuo y característica CRETI)  </td>
		<td width="43" align="center" class="defined" rowspan="2"> &nbsp;<br/> CRETI </td>
		<td class="defined" width="90" align="center"> CONTENEDOR </td>
		<td width="67" class="defined" rowspan="2" style="line-height:10px;"> CANTIDAD TOTAL DE RESIDUO </td>
		<td width="67" align="center" class="defined" rowspan="2"> UNIDAD VOL/PESO </td>
	</tr>
	<tr> 
		<td width="45" class="defined" style="font-size: 5pt;"> CANTIDAD </td>
		<td width="45" class="defined" style="font-size: 5pt;"> TIPO </td>
	</tr>

	  	' . $table_data_html . ' 

	<tr>
		<td width="304" align="left" class="defined"> 6 - INSTRUCCIONES ESPECIALES E INFORMACION ADICIONAL PARA EL MANEJO SEGURO </td>
		<td width="305" align="center" class="data"> &nbsp;<br/> Usar guantes, gogles y cubreboca  </td>
	</tr>
	<tr>
		<td width="304" align="left" class="defined"> 7 - CERTIFICACIÓN DEL GENERADOR</td>
		<td width="305" align="center" class="data"> </td>
	</tr>
	<tr>
		<td width="609" align="left" class="defined"> Declaro que el contenido de este lote está correctamente descrito mediante el nombre del residuo,  características CRETIB, bien empacado, marcado y rotulado; y que se han previsto las condiciones de seguridad para su transporte por vía terrestre de acuerdo a la Legislación Nacional vigente</td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> NOMBRE Y FIRMA DEL RESPONSABLE </td>
		<td width="394" align="center" class="data"> Joel Alejandro Esponda Esponda </td>
	</tr>

	<tr>
		<td width="20" align="center" rowspan="10"> </td>
		<td width="215" align="left" class="defined"> 8 - NOMBRE DE LA EMPRESA TRANSPORTADORA </td>
		<td width="394" align="center">  Ricardo Díaz Virgen </td>
	</tr>	
	<tr>
		<td width="113" align="left" class="defined"> DOMICILIO</td>
		<td width="192" align="center"> Monthatlán 281, Col. Villa Izcalli </td>
		<td width="136" align="left" class="defined"> TELEFONO</td>
		<td width="168" align="center"> (312) 157 8255 </td>
	</tr>
	<tr>
		<td width="113" align="left" class="defined"> NO. DE AUTORIZACIÓN SCT </td>
		<td width="192" align="center"> 0617DIVR03082011230301001 </td>
		<td width="136" align="left" class="defined"> No. DE AUTORIZACION  SEMARNAT </td>
		<td width="168" align="center"> 06-10-PS-I-01-2011 </td>
	</tr>
	<tr>
		<td width="325" align="left" class="defined"> 9 - RECIBI LOS MATERIALES DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE</td>
		<td width="96" align="left" class="defined"> CARGO </td>
		<td width="188" align="center"> Responsable </td>
	</tr>
	<tr>
		<td width="113" align="left" class="defined"> NOMBRE </td>
		<td width="192" align="center">  Ricardo Díaz Virgen </td>
	</tr>
	<tr>
		<td width="113" align="left" class="defined"> FECHA DE EMBARQUE </td>
		<td width="192" align="center"> 08 de Abril del 2017  </td>
		<td width="136" align="left" height="15" class="defined"> FIRMA </td>
		<td width="168" align="center">  </td>
	</tr>
	<tr>
		<td width="609" align="left" class="defined"> 10 - RUTA DE LA EMPRESA GENERADORA HASTA SU ENTREGA </td>
	</tr>
	<tr>
		<td width="609" align="left"> Manzanillo-Tecomán, Col. </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> 11 - TIPO VEHICULO </td>
		<td width="90" align="left" class="defined">  No. DE PLACA </td>
		<td width="214" align="left" class="defined"> TIPO VEHICULO </td>
		<td width="90" align="left" class="defined">  No. DE PLACA </td>
	</tr>
	<tr>
		<td width="215" align="center"> Nissan estacas 	</td>
		<td width="90" align="center">  637-EP-5</td>
		<td width="214" align="center">  </td>
		<td width="90" align="center">  </td>
	</tr>	


	<tr>
		<td width="20" align="center" rowspan="9"> </td>
		<td width="215" align="left" class="defined" rowspan="2"> &nbsp;<br/> 12 - NOMBRE DE LA EMPRESA </td>
		<td width="260" align="center" rowspan="2"> Gestión Integral Ambiental de Occidente S.A. de C.V. </td>
		<td class="defined" width="134" align="center"> AUTORIZACION SEMARNAT </td>
	</tr>
	<tr> 
		<td width="134" class="data"> 06-09-PS-II-01-2011 </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> 4.- DOMICILIO </td>
		<td width="260" align="center"> CARRETERA A CALERAS KM 1.5 </td>
		<td width="67" align="center" class="defined"> C.P. </td>
		<td width="67" align="center"> 28130 </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> MUNICIPIO </td>
		<td width="170" align="center"> TECOMÁN </td>
		<td width="90" align="center" class="defined"> ESTADO </td>
		<td width="134" align="center"> COLIMA </td>
	</tr>

	<tr>
		<td width="607" align="left" class="defined borde_inferior"> 13 - RECIBI LOS RESIDUOS DESCRITOS EN EL MANIFIESTO </td>
	</tr>
	<tr>
		<td width="609" height="15" align="left" class="defined"> OBSERVACIONES </td>
	</tr>
	<tr>
		<td width="609" height="15" align="left" class="defined"> </td>
	</tr>
	<tr>
		<td width="113" align="center" class="defined" height="20"> NOMBRE </td>
		<td width="192" align="center"></td>
		<td width="113" align="center" class="defined" height="20"> CARGO </td>
		<td width="191" align="center"></td>
	</tr>
	<tr>
		<td width="113" align="center" class="defined" height="20"> FECHA </td>
		<td width="192" align="center"></td>
		<td width="113" align="center" class="defined" height="20"> FIRMA </td>
		<td width="191" align="center"></td>
	</tr>
</table>
';
		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');


		// add a page
		//$pdf->AddPage();

		// output the HTML content
		//$pdf->writeHTML($html, true, false, true, false, '');


		// reset pointer to the last page
		//$pdf->lastPage();

		//$filename= "{$nombre_empresa}_{$manifiesto}.pdf";
		$filename= "rdiaztmp{$id_persona}.pdf"; 
		$filelocation = $_SERVER['DOCUMENT_ROOT'] ."rgdiaz/img/pdf";
		$fileNL = $filelocation."/".$filename; //Linux

		//Close and output PDF document
		$pdf->Output($fileNL, 'F');

		redirect('administrador/manifiesto/' . $id_persona, 'refresh');
?>