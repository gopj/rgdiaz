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

function date_manifiesto($s_date){

	if ($s_date == ""){
		$date = "";
	} else {
		$date = date_create($s_date);
		$date = date_format($date, "d-n-Y");

		$date_split = explode("-", $date);

		switch ($date_split[1]) {
			case '1': $date_split[1] = "Enero"; break;
			case '2': $date_split[1] = "Febrero"; break;
			case '3': $date_split[1] = "Marzo"; break;
			case '4': $date_split[1] = "Abril"; break;
			case '5': $date_split[1] = "Mayo"; break;
			case '6': $date_split[1] = "Junio"; break;
			case '7': $date_split[1] = "Julio"; break;
			case '8': $date_split[1] = "Agosto"; break;
			case '9': $date_split[1] = "Septiembre"; break;
			case '10': $date_split[1] = "Octubre"; break;
			case '11': $date_split[1] = "Noviembre"; break;
			case '12': $date_split[1] = "Diciembre"; break;
		}

		$date = $date_split[0] . " de " . $date_split[1] . " del " . $date_split[2];
	}

	return $date;
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


// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
 
$nrs = 18; //nombre_residuo_size
$res_man_cant = count($residuos_manifiesto);
$num_table_res = (ceil($res_man_cant/$nrs));
$r = 0;
$table_data_html = '';
$residuo_final="";


//Llenar array de arr_residuos_manifiesto
for ($i=0; $i < $num_table_res; $i++) { 
	
	for ($j=0; $j < $nrs; $j++) {

		if ($res_man_cant > $r) {

			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->residuo;
			$arr_residuos_manifiesto[$i][$j][] = creti($residuos_manifiesto[$r]->caracteristica);
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->contenedor_cantidad;
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->contenedor_tipo;
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->residuo_cantidad;
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->unidad;

			$r++;
		} 
	}

}


for ($h=0; $h < $num_table_res; $h++) { 
	// add a page
	$pdf->AddPage();

	for ($i=0; $i < $nrs; $i++) {

		if (@$arr_residuos_manifiesto[$h][$i][0] == null) {
			
			$table_data_html = $table_data_html . '
				<tr>
					<td width="342" align="left" class="defined_s"> ' . $i . '</td>
					<td width="43" align="center" class="data"> </td>
					<td width="45" align="center" class="data"> </td>
					<td width="45" align="center" class="data"> </td>
					<td width="67" align="center" class="data"> </td>
					<td width="67" align="center" class="data"> </td>
				</tr>
			';

		} else {
			if (strlen(@$arr_residuos_manifiesto[$h][$i][0]) > 162) {
				$table_data_html = $table_data_html . '
					<tr>
						<td width="342" align="left" class="defined_s"> ' . $i . ' ' . $arr_residuos_manifiesto[$h][$i][0] . '</td>
						<td width="43" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][1] . ' </td>
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][2] . ' </td>
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][3] . ' </td>
						<td width="67" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][4] . ' </td>
						<td width="67" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][5] . ' </td>
					</tr>
				';
				$nrs=$nrs-2;
			} elseif (strlen(@$arr_residuos_manifiesto[$h][$i][0]) > 72) { 
				$table_data_html = $table_data_html . '
					<tr>
						<td width="342" align="left" class="defined_s"> ' . $i . ' ' . $arr_residuos_manifiesto[$h][$i][0] . '</td>
						<td width="43" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][1] . ' </td>
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][2] . ' </td>
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][3] . ' </td>
						<td width="67" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][4] . ' </td>
						<td width="67" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][5] . ' </td>
					</tr>
				';
				$nrs--;
			} else {
				$table_data_html = $table_data_html . '
					<tr>
						<td width="342" align="left" class="defined_s"> ' . $i . ' ' . $arr_residuos_manifiesto[$h][$i][0] . '</td>
						<td width="43" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][1] . ' </td>
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][2] . ' </td>
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][3] . ' </td>
						<td width="67" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][4] . ' </td>
						<td width="67" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][5] . ' </td>
					</tr>
				';
			} 
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
		padding-left: 3px;
	}

	td.defined {
		font-family: helvetica;
		font-size: 6pt;
		font-weight: normal;
		text-align: center;
		height: 15px;
		line-height:15px;
	}

	td.defined_s {
		font-family: helvetica;
		font-size: 6pt;
		font-weight: bold;
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

	td.bott_border {
		border-bottom: 3px solid #FFFFFF;
	}

	td.left_border {
		border-left: 3px solid #FFFFFF;
	}

	td.right_border {
		border-right: 3px solid #FFFFFF;
	}

	td.top_border {
		border-top: 3px solid #FFFFFF;
	}

	td.borders {
		border-top: 3px solid #FFFFFF;
		border-bottom: 3px solid #FFFFFF;
		border-left: 3px solid #FFFFFF;
		border-right: 3px solid #FFFFFF;
	}

	</style>

	<br /><br /><br /><br /><br /><br />

	<table>
	<tr>
		<td width="18" ></td>
		<td>
			<table class="manifiesto" border="1">
				<tr>
					<td width="215" align="left" class="defined"> 1.- No. DE REGISTRO AMBIENTAL </td>
					<td width="170">  '. $datos_empresa->numero_registro_ambiental .' </td>
					<td width="90"  class="defined"> 2.- NO. MANIFIESTO </td>
					<td width="67" style="color: red;"> '. $residuos_manifiesto[0]->id_cliente . "-" . $residuos_manifiesto[0]->folio .' </td>
					<td width="67"  class="defined">  PÁGINA ' . ($h+1) . '/' . $num_table_res . ' </td>
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
					<td width="394" align="left" class="data"> ' . $residuos_manifiesto[0]->responsable_tecnico . ' </td>
				</tr>

				<tr>
					<td width="215" align="left" class="defined"> 8 - NOMBRE DE LA EMPRESA TRANSPORTADORA </td>
					<td width="394" align="center"> ' . @$residuos_manifiesto[0]->emp_tran . ' </td>
				</tr>	
				<tr>
					<td width="113" align="left" class="defined"> DOMICILIO</td>
					<td width="192" align="center"> ' . @$residuos_manifiesto[0]->responsable_tecnico . ' </td>
					<td width="136" align="left" class="defined"> TELEFONO</td>
					<td width="168" align="center"> ' . @$residuos_manifiesto[0]->responsable_tecnico . ' </td>
				</tr>
				<tr>
					<td width="113" align="left" class="defined"> NO. DE AUTORIZACIÓN SCT </td>
					<td width="192" align="center"> ' . @$residuos_manifiesto[0]->responsable_tecnico . ' </td>
					<td width="136" align="left" class="defined"> No. DE AUTORIZACION  SEMARNAT </td>
					<td width="168" align="center"> ' . @$residuos_manifiesto[0]->responsable_tecnico . ' </td>
				</tr>
				<tr>
					<td width="325" align="left" class="defined"> 9 - RECIBI LOS MATERIALES DESCRITOS EN EL MANIFIESTO PARA SU TRANSPORTE</td>
					<td width="96" align="left" class="defined"> CARGO </td>
					<td width="188" align="center"> Responsable </td>
				</tr>
				<tr>
					<td width="113" align="left" class="defined"> NOMBRE </td>
					<td width="192" align="center">  ' . @$residuos_manifiesto[0]->responsable_tecnico . ' </td>
				</tr>
				<tr>
					<td width="113" align="left" class="defined"> FECHA DE EMBARQUE </td>
					<td width="192" align="center"> ' . @date_manifiesto($residuos_manifiesto[0]->fecha_ingreso) . ' </td>
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
					<td width="215" align="center"> </td>
					<td width="90" align="center"> </td>
					<td width="214" align="center"> </td>
					<td width="90" align="center"> </td>
				</tr>	


				<tr>
					<td width="215" align="left" class="defined" rowspan="2"> &nbsp;<br/> 12 - NOMBRE DE LA EMPRESA </td>
					<td width="260" align="center" rowspan="2"> ' . $residuos_manifiesto[0]->dest_final . ' </td>
					<td class="defined" width="134" align="center"> AUTORIZACION SEMARNAT </td>
				</tr>
				<tr> 
					<td width="134" class="data"> ' . $residuos_manifiesto[0]->dest_final . ' </td>
				</tr>
				<tr>
					<td width="215" align="left" class="defined"> 4.- DOMICILIO </td>
					<td width="394" align="center">' . $residuos_manifiesto[0]->dest_final . ' </td>
				</tr>
				<tr>
					<td width="215" align="left" class="defined"> MUNICIPIO </td>
					<td width="170" align="center"> ' . $residuos_manifiesto[0]->dest_final . ' </td>
					<td width="90" align="center" class="defined"> ESTADO </td>
					<td width="134" align="center"> ' . $residuos_manifiesto[0]->dest_final . ' </td>
				</tr>

				<tr>
					<td width="609" align="left" class="defined borde_inferior"> 13 - RECIBI LOS RESIDUOS DESCRITOS EN EL MANIFIESTO </td>
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
		</td>
	</tr>
	</table>

	
	';

	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	$table_data_html = '';

	/*echo $html;
	die();*/
}


$filename= "{$nombre_empresa}_{$manifiesto}.pdf";
$filename= "rdiaztmp{$id_cliente}.pdf"; 
$filelocation = $_SERVER['DOCUMENT_ROOT'] ."rgdiaz/img/pdf/";
$fileNL = $filelocation . $filename; //Linux

//Close and output PDF document
$pdf->Output($fileNL, 'D');

//$pdf->Output($fileNL, 'F');

//redirect('administriador/recolector_ver_manifiestos/' . $id_cliente, 'refresh');
?>