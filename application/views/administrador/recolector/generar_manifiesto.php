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

///// Testing parameters

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
// $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// QR
$pdf->setQR($id_cliente, $folio);

// $pdf->SetY(-15);
// $pdf->Cell(0, 8, '1', 0, false, 'C', 0, '', 0, false, 'T', 'M');

// Image method signature:
// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
 
$nrs = 15; //nombre_residuo_size
$res_man_cant = count($residuos_manifiesto);
$num_table_res = (ceil($res_man_cant/$nrs));
$r = 0;
$table_data_html = '';
$residuo_final="";

// Funcion Eitqueta

function funcion_etiqueta($data){
	$html_string = '';
	if($data=='S'){
		$html_string = '
			<td width="23" align="center" class="data">X</td>
			<td width="23" align="center" class="data"></td>
		';
	}else{
		$html_string = '
			<td width="23" align="center" class="data"></td>
			<td width="23" align="center" class="data">X</td>
		';
	}

	return $html_string;
}

// Funcion de clasificación

function funcion_clasificacion($data){
	$html_string = '';
	$data_split = explode(' ', $data);

	$data_array = array(
		'C' => '0',
		'R' => '0',
		'E' => '0',
		'T' => '0',
		'I' => '0',
		'B' => '0',
		'M' => '0'
	);

	foreach ($data_array as $key1 => $value1) {
		foreach ($data_split as $key2 => $value2) {
			if ($value1 == '0'){
				if ($key1==$value2){
					$data_array[$key1] = '1';
				}
			}
		}
	}

	foreach ($data_array as $key => $value) {
		if ($data_array[$key]=='1'){
			$html_string .= '<td width="15" align="center" class="data">X</td>';
		} else {
			$html_string .= '<td width="15" align="center" class="data"></td>';
		}
	}

	return $html_string;
}

//Funcion de capacidad
function capacidad_zero($val){
	$value = $val;

	if ($value == 0){
		return "ND";
	}

	return $value;

}

//funcion_clasificacion('B M');
//Llenado de array de arr_residuos_manifiesto
for ($i=0; $i < $num_table_res; $i++) { 
	
	for ($j=0; $j < $nrs; $j++) {

		if ($res_man_cant > $r) {

			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->residuo;
			$arr_residuos_manifiesto[$i][$j][] = creti($residuos_manifiesto[$r]->caracteristica);
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->contenedor_cantidad;
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->contenedor_tipo;
			$arr_residuos_manifiesto[$i][$j][] = capacidad_zero($residuos_manifiesto[$r]->contenedor_capacidad);
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->residuo_cantidad;
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->etiqueta;
			$arr_residuos_manifiesto[$i][$j][] = $residuos_manifiesto[$r]->fecha_insercion;

			$r++;
		} 
	}

}

$row_num = 0;
for ($h=0; $h < $num_table_res; $h++) { 
	// add a page
	$pdf->AddPage();

	for ($i=0; $i < $nrs; $i++) {
		$row_num = $i + 1;

		if (@$arr_residuos_manifiesto[$h][$i][0] == null) {
			
			$table_data_html = $table_data_html . '
				<tr>
					<td width="280" align="left" class="defined_s"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="15" align="center" class="defined"></td>
					<td width="45" align="center" class="data"> </td>
					<td width="44" align="center" class="data"> </td>
					<td width="43" align="center" class="data"> </td>
					<td width="46" align="center" class="data"> </td>
					<td width="23" align="center" class="data"> </td>
					<td width="23" align="center" class="data"> </td>
				</tr>
			';

		} else {
			if (strlen(@$arr_residuos_manifiesto[$h][$i][0]) > 162) {
				$table_data_html = $table_data_html . '
					<tr>
						<td width="280" align="left" class="defined_s"> ' . $arr_residuos_manifiesto[$h][$i][0] . '</td> 
						' . funcion_clasificacion($arr_residuos_manifiesto[$h][$i][1]) . ' 
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][2] . ' </td>
						<td width="44" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][3] . ' </td>
						<td width="43" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][4] . ' </td>
						<td width="46" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][5] . ' </td>
						' . funcion_etiqueta($arr_residuos_manifiesto[$h][$i][6]) . ' 
					</tr>
				';
				$nrs=$nrs-2;
			} elseif (strlen(@$arr_residuos_manifiesto[$h][$i][0]) > 72) { 
				$table_data_html = $table_data_html . '
					<tr>
						<td width="280" align="left" class="defined_s"> ' . $arr_residuos_manifiesto[$h][$i][0] . '</td>
						' . funcion_clasificacion($arr_residuos_manifiesto[$h][$i][1]) . ' 
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][2] . ' </td>
						<td width="44" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][3] . ' </td>
						<td width="43" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][4] . ' </td>
						<td width="46" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][5] . ' </td>
						' . funcion_etiqueta($arr_residuos_manifiesto[$h][$i][6]) . ' 
					</tr>
				';
				$nrs--;
			} else {
				$table_data_html = $table_data_html . '
					<tr>
						<td width="280" align="left" class="defined_s"> ' . $arr_residuos_manifiesto[$h][$i][0] . '</td>
						' . funcion_clasificacion($arr_residuos_manifiesto[$h][$i][1]) . ' 
						<td width="45" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][2] . ' </td>
						<td width="44" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][3] . ' </td>
						<td width="43" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][4] . ' </td>
						<td width="46" align="center" class="data"> ' . $arr_residuos_manifiesto[$h][$i][5] . ' </td>
						' . funcion_etiqueta($arr_residuos_manifiesto[$h][$i][6]) . ' 
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

	<br /><br /><br /><br />
		
	<a href="http://www.rdiaz.mx" style="font-size: 7pt;" target="_blank"> RDíaz </a>
	
	<br />	<br />
	
	<table>
	<tr>
		<td width="18" ></td>
		<td>
			<table class="manifiesto" border="1">
				<tr>
					<td width="130" align="left" class="defined"> 1.- No. DE REGISTRO AMBIENTAL </td>
					<td width="275">  '. $datos_empresa->numero_registro_ambiental .' </td>
					<td width="90"  class="defined"> 2.- NO. MANIFIESTO </td>
					<td width="114" style="color: red;"> '. $folio_identificador .' </td>
				</tr>
				<tr>
					<td width="200" align="left" class="defined"> 3.- RAZÓN SOCIAL DE LA EMPRESA GENERADORA </td>
					<td width="409" align="center"> '. $datos_empresa->nombre_empresa .' </td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined" bgcolor="#cccccc">DOMICILIO</td>
					<td width="75" align="center" class="defined">CÓDIGO POSTAL</td>
					<td width="39" align="center">'. $datos_empresa->cp_empresa .'</td>
					<td width="39" align="center" class="defined">CALLE</td>
					<td width="257" align="center">'. $datos_empresa->calle_empresa . '</td>
					<td width="42" align="center" class="defined">NÚM EXT</td>
					<td width="34" align="center">'. $datos_empresa->numero_empresa . '</td>
					<td width="42" align="center" class="defined">NÚM INT</td>
					<td width="34" align="center"> </td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined"> COLONIA </td>
					<td width="117" align="center">'. $datos_empresa->colonia_empresa .'</td>
					<td width="110" align="left" class="defined"> MUNICIPIO O DELEGACIÓN </td>
					<td width="183" align="center">'. $datos_empresa->municipio .'</td>
					<td width="42" align="center" class="defined"> ESTADO </td>
					<td width="110" align="center">'. $datos_empresa->estado .'</td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined">TELEFONO</td>
					<td width="190" align="center">'. $datos_empresa->telefono_empresa .'</td>
					<td width="100" align="left" class="defined">CORREO ELECTRONICO</td>
					<td width="272" align="center">'. $datos_empresa->correo_empresa .'</td>
				</tr>
				<tr>
					<td width="609" align="center" class="defined" bgcolor="#cccccc"> 4. IDENTIFICACIÓN DE LOS RESIDUOS</td>
				</tr>
				<tr>
					<td width="280" align="left" class="defined" rowspan="2"> &nbsp;<br/> 5.- DESCRIPCIÓN (Nombre del residuo y característica CRETI)  </td>
					<td width="105" align="center" class="defined"> CLASIFICACIÓN </td>
					<td width="132" align="center" class="defined"> ENVASE </td>
					<td width="46" align="center" class="defined" rowspan="2">CANTIDAD<br/>(KG) </td>
					<td width="46" align="center" class="defined"> ETIQUETA</td>
				</tr>
				<tr> 
					<td width="15" align="center" class="defined">C</td>
					<td width="15" align="center" class="defined">R</td>
					<td width="15" align="center" class="defined">E</td>
					<td width="15" align="center" class="defined">T</td>
					<td width="15" align="center" class="defined">I</td>
					<td width="15" align="center" class="defined">B</td>
					<td width="15" align="center" class="defined">M</td>
					<td width="45" class="defined" style="font-size: 5pt;">CANTIDAD</td>
					<td width="44" class="defined" style="font-size: 5pt;">TIPO</td>
					<td width="43" class="defined" style="font-size: 5pt;">CAPACIDAD</td>
					<td width="23" class="defined" style="font-size: 5pt;">SI</td>
					<td width="23" class="defined" style="font-size: 5pt;">NO</td>
				</tr>

				  	' . $table_data_html . ' 

				<tr>
					<td width="304" align="left" class="defined"> 6 - INSTRUCCIONES ESPECIALES E INFORMACION ADICIONAL PARA EL MANEJO SEGURO </td>
					<td width="305" align="center" class="data"> &nbsp;<br/> Usar guantes, gogles y cubreboca  </td>
				</tr>
				
				<tr>
					<td width="609" align="left" class="defined"> <strong> Declaro que el contenido de este lote está correctamente descrito mediante el nombre del residuo,  características CRETIB, bien empacado, marcado y rotulado; y que se han previsto las condiciones de seguridad para su transporte por vía terrestre de acuerdo a la Legislación Nacional vigente </strong> </td>
				</tr>
				<tr>
					<td width="150" align="center" class="defined" height="42"> &nbsp;<br/> NOMBRE Y FIRMA DEL RESPONSABLE </td>
					<td width="150" align="left" class="data"> &nbsp;<br/>' . $residuos_manifiesto[0]->responsable_tecnico . ' </td>
					<td width="40" align="left" class="defined" >  &nbsp;<br/> FECHA </td>
					<td width="150" align="left" class="data"> &nbsp;<br/>' . @date_manifiesto($manifiesto->fecha_embarque) . '</td>
					<td width="40" align="left" class="defined" >  &nbsp;<br/> SELLO </td>
					<td width="79" align="left" class="defined" > </td>
				</tr>

				<tr>
					<td width="215" align="left" class="defined"> 7 - NOMBRE O RAZÓN SOCIAL DEL TRANSPORTISTA </td>
					<td width="394" align="center"> ' . $datos_empresa_tran[0]->nombre_empresa . ' </td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined" bgcolor="#cccccc">DOMICILIO</td>
					<td width="75" align="center" class="defined">CÓDIGO POSTAL</td>
					<td width="39" align="center">'. $datos_empresa_tran[0]->cp_empresa .'</td>
					<td width="39" align="center" class="defined">CALLE</td>
					<td width="257" align="center">'. $datos_empresa_tran[0]->calle_empresa . '</td>
					<td width="42" align="center" class="defined">NÚM EXT</td>
					<td width="34" align="center">'. $datos_empresa_tran[0]->numero_empresa . '</td>
					<td width="42" align="center" class="defined">NÚM INT</td>
					<td width="34" align="center"> </td>
				</tr>	
				<tr>
					<td width="47" align="left" class="defined"> COLONIA </td>
					<td width="117" align="center">'. $datos_empresa_tran[0]->colonia_empresa .'</td>
					<td width="110" align="left" class="defined"> MUNICIPIO O DELEGACIÓN </td>
					<td width="183" align="center">'. $datos_empresa_tran[0]->municipio .'</td>
					<td width="42" align="center" class="defined"> ESTADO </td>
					<td width="110" align="center">'. $datos_empresa_tran[0]->estado .'</td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined">TELEFONO</td>
					<td width="190" align="center">'. $datos_empresa_tran[0]->telefono_empresa .'</td>
					<td width="100" align="left" class="defined">CORREO ELECTRONICO</td>
					<td width="272" align="center">'. $datos_empresa_tran[0]->correo_empresa .'</td>
				</tr>
				<tr>
					<td width="150" align="left" class="defined"> 8 - No. DE AUTORIZACION  SEMARNAT </td>
					<td width="154" align="center"> ' . @$datos_empresa_tran[0]->no_autorizacion_transportista . ' </td>
					<td width="133" align="left" class="defined"> 9 - NO. DE AUTORIZACIÓN SCT </td>
					<td width="172" align="center"> ' . @$datos_empresa_tran[0]->numero_registro_ambiental . ' </td>
				</tr>
				<tr>
					<td width="215" align="left" class="defined"> 10 - TIPO VEHICULO </td>
					<td width="90" align="left" class="data">  ' . @$recolector_vehiculo->nombre_tipo . ' </td>
					<td width="214" align="left" class="defined"> 11 - NÚM. DE PLACA </td>
					<td width="90" align="left" class="data">  ' . @$recolector_vehiculo->numero_placa . ' </td>
				</tr>
				<tr>
					<td width="245" align="left" class="defined"> 12 - RUTA DE LA EMPRESA GENERADORA HASTA SU ENTREGA</td>
					<td width="364" align="left" class="data"> ' . $ruta . ' </td>
				</tr>
				<tr>
					<td width="609" align="left" class="data"  style="font-size: 5pt;"> Declaro bajo protesta de decir verdad que recibí los residuos peligrosos descritos en el manifiesto para su transporte a la empresa destinataria señalada por el generador </td>
				</tr>
				<tr>
					<td width="150" align="left" class="defined" height="42"> &nbsp;<br/> NOMBRE Y FIRMA DEL RESPONSABLE </td>
					<td width="150" align="center" height="30"> &nbsp;<br/>' . $datos_recolector . ' </td>
					<td width="40" align="left" class="defined" height="30"> &nbsp;<br/> FECHA </td>
					<td width="150" align="center" height="30"> &nbsp;<br/>' . @date_manifiesto($manifiesto->fecha_embarque) . ' </td>
					<td width="40" align="left" class="defined" height="30"> &nbsp;<br/> SELLO </td>
					<td width="79" align="center" height="30"> &nbsp;<br/> </td>
				</tr>
				<tr>
					<td width="215" align="left" class="defined"> 13 - NOMBRE O RAZÓN SOCIAL DEL DESTINATARIO </td>
					<td width="394" align="center"> ' . $datos_empresa_destino->nombre_destino . ' </td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined" bgcolor="#cccccc">DOMICILIO</td>
					<td width="75" align="center" class="defined">CÓDIGO POSTAL</td>
					<td width="39" align="center">'. $datos_empresa_destino->cp .'</td>
					<td width="39" align="center" class="defined">CALLE</td>
					<td width="257" align="center">'. $datos_empresa_destino->calle . '</td>
					<td width="42" align="center" class="defined">NÚM EXT</td>
					<td width="34" align="center">'. $datos_empresa_destino->num_ext . '</td>
					<td width="42" align="center" class="defined">NÚM INT</td>
					<td width="34" align="center">'. $datos_empresa_destino->num_int . ' </td>
				</tr>	
				<tr>
					<td width="47" align="left" class="defined"> COLONIA </td>
					<td width="117" align="center">'. $datos_empresa_destino->colonia .'</td>
					<td width="110" align="left" class="defined"> MUNICIPIO O DELEGACIÓN </td>
					<td width="183" align="center">'. $datos_empresa_destino->municipio .'</td>
					<td width="42" align="center" class="defined"> ESTADO </td>
					<td width="110" align="center">'. $datos_empresa_destino->estado .'</td>
				</tr>
				<tr>
					<td width="47" align="left" class="defined">TELEFONO</td>
					<td width="190" align="center">'. $datos_empresa_destino->telefono .'</td>
					<td width="100" align="left" class="defined">CORREO ELECTRONICO</td>
					<td width="272" align="center"></td>
				</tr>
				<tr>
					<td width="215" align="left" class="defined">14 - NO DE AUTORIZACIÓN DE LA SEMARNAT  </td>
					<td width="394" align="center">'. $datos_empresa_destino->no_autorizacion_destino .'</td>
				</tr>
				<tr>
					<td width="235" align="left" class="defined">15 - NOMBRE DE LA PERSONA QUE RECIBE LOS RESIDUOS </td>
					<td width="215" align="center"> '. $manifiesto->persona_residuos .' </td>
					<td width="40" align="left" class="defined">CARGO</td>
					<td width="119" align="center">'. $manifiesto->cargo_persona  .' </td>
				</tr>
				<tr>
					<td width="95" align="left" class="defined">16 - OBSERVACIONES </td>
					<td width="514" align="center" style="font-size: 5.7pt"> ' . $manifiesto->observaciones . '</td>
				</tr>
				<tr>
					<td width="609" align="left" class="data"  style="font-size: 5pt;"> Declaro bajo protesta de decir verdad que recibí los residuos peligrosos descritos en el manifiesto </td>
				</tr>
				<tr>
					<td width="150" align="left" class="defined" height="42"> &nbsp;<br/> &nbsp;<br/> NOMBRE Y FIRMA DEL RESPONSABLE </td>
					<td width="200" align="center"> &nbsp;<br/> ' . $manifiesto->responsable_destino . ' </td>
					<td width="50" align="left" class="defined"> &nbsp;<br/> SELLO Y FECHA </td>
					<td width="209" align="center"> &nbsp;<br/> &nbsp;<br/>' . @date_manifiesto($manifiesto->fecha_embarque) . ' </td>
				</tr>
			</table>
		</td>
	</tr>
	</table>
	';


	// output the HTML content + QR Codes

	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->writeHTML($html, true, false, true, false, '');
	$pdf->writeHTML($html, true, false, true, false, '');

	$table_data_html = '';
}

////////// Debugging PDF Divider

/*echo "<pre>";
print_r($arr_residuos_manifiesto);
echo "</pre>";*/

$nombre_empresa = str_replace(" ", "_", $nombre_empresa); // Fix for spaces
$filename 		= "{$nombre_empresa}_{$folio_identificador}_{$manifiesto->fecha_embarque}.pdf";
$location 		= $_SERVER['DOCUMENT_ROOT'] ."rgdiaz/img/pdf/";
//$location 		= $_SERVER['DOCUMENT_ROOT'] ."img/pdf/";
$pdf_location	= $location . $filename;

//Close and output PDF document
$pdf->Output($pdf_location, 'FI');

//$pdf->Output($fileNL, 'F'); /// F for debugging 
//$pdf->Output($fileNL, 'FI'); /// FI for printing pdf 

//redirect('recolector/ver_manifiestos/' . $id_cliente, 'refresh');
?>