<?php
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

// define some HTML content with style
$html = <<<EOF
<style>
table.manifiesto {
	font-family: helvetica;
	font-size: 8pt;
	font-weight: bold;
}
td.defined {
	font-family: helvetica;
	font-size: 6pt;
	font-weight: normal;
}

td.data {
	font-family: helvetica;
	font-size: 7pt;
	font-weight: bold;
}
tr.borde_inferior {
	border-bottom: 1px solid blue important!;
}
td.second {
		border: 2px solid #FFFFFF;
	}
</style>

<br /><br /><br /><br /><br />

<table class="manifiesto" border="1" >
	<tr>
		<td width="20" align="center" rowspan="20"> </td>
		<td width="215" align="left" class="defined"> 1.- No. DE REGISTRO AMBIENTAL </td>
		<td width="170" align="center"> AHKTS0600711 </td>
		<td width="90" align="left" class="defined"> 2.- NO. MANIFIESTO </td>
		<td width="67" align="center" style="color: red;"> 0613 </td>
		<td width="67" align="center" class="defined">  PÁGINA 1/1  </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> 3.- RAZÓN SOCIAL DE LA EMPRESA GENERADORA </td>
		<td width="394" align="center"> ALFRED H. KNIGHT S.A. DE C.V. </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> 4.- DOMICILIO </td>
		<td width="260" align="center"> DEL TRABAJO 101, TAPEIXTLES </td>
		<td width="67" align="center" class="defined"> C.P. </td>
		<td width="67" align="center"> 28239 </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> MUNICIPIO </td>
		<td width="170" align="center"> MANZANILLO </td>
		<td width="90" align="center" class="defined"> ESTADO </td>
		<td width="134" align="center"> COLIMA </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> TELEFONO </td>
		<td width="394" align="center">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="defined"> 5.- DESCRIPCIÓN (Nombre del residuo y característica CRETI) </td>
		<td width="43" align="center" class="defined"> CRETI </td>
		<td align="center">
			<table class="manifiesto" border="1">
				<tr>
					<td class="defined" width="86" align="center"> CONTENEDOR </td>
				</tr>
				<tr> 
					<td width="43" class="defined" style="font-size: 5pt;"> CANTIDAD </td>
					<td width="43" class="defined" style="font-size: 5pt;"> TIPO </td>
				</tr>
			</table>
		</td>
		<td width="67" align="left" class="defined"> CANTIDAD TOTAL DE RESIDUO </td>
		<td width="67" align="center" class="defined"> UNIDAD VOL/PESO </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data"> SÓLIDOS CONTAMINADOS CON METALES PESADOS (Macías-OPE-007)  </td>
		<td width="43" align="center" class="data"> T </td>
		<td width="45" align="center" class="data"> 1 </td>
		<td width="45" align="center" class="data"> bolsa </td>
		<td width="67" align="center" class="data"> 12.3 </td>
		<td width="67" align="center" class="data"> KG </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data"> SÓLIDOS CONTAMINADOS CON METALES PESADOS (Macías-OPE-007)  </td>
		<td width="43" align="center" class="data"> T </td>
		<td width="45" align="center" class="data"> 1 </td>
		<td width="45" align="center" class="data"> bolsa </td>
		<td width="67" align="center" class="data"> 12.3 </td>
		<td width="67" align="center" class="data"> KG </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data"> SÓLIDOS CONTAMINADOS CON METALES PESADOS (Macías-OPE-007)  </td>
		<td width="43" align="center" class="data"> T </td>
		<td width="45" align="center" class="data"> 1 </td>
		<td width="45" align="center" class="data"> bolsa </td>
		<td width="67" align="center" class="data"> 12.3 </td>
		<td width="67" align="center" class="data"> KG </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="342" align="left" class="data">  </td>
		<td width="43" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="45" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
		<td width="67" align="center" class="data">  </td>
	</tr>
	<tr>
		<td width="304" align="left" class="defined"> 6 - INSTRUCCIONES ESPECIALES E INFORMACION ADICIONAL PARA EL MANEJO SEGURO </td>
		<td width="305" align="center" class="data"> Usar guantes, gogles y cubreboca  </td>
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
		<td width="136" align="left" class="defined"> FIRMA </td>
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
		<td width="215" align="left" class="defined"> 12 - NOMBRE DE LA EMPRESA </td>
		<td width="260" align="center">  GEOCYCLE MÉXICO S.A. DE C.V.  </td>
		<td width="134" align="left" class="defined"> AUTORIZACIÓN DE SEMARNAT </td>
	</tr>
	<tr>
		<td width="609" align="left"> </td>
	</tr>
	<tr>
		<td width="215" align="left" class="defined"> DOMICILIO </td>
		<td width="260" align="center">  CARRETERA A CALERAS KM 1.5; TECOMÁN, COL.;  C.P. 28130 </td>
		<td width="134" align="center"> 06-09-PS-II-01-2011 </td>
	</tr>
	<tr class="borde_inferior">
		<td width="609" align="left" class="second"> 13 - RECIBI LOS RESIDUOS DESCRITOS EN EL MANIFIESTO </td>
	</tr>
	<tr>
		<td width="609" align="left" class="defined" style="border-top: none !important;"> OBSERVACIONES </td>
	</tr>
	

</table>
EOF;

		// output the HTML content
		$pdf->writeHTML($html, true, false, true, false, '');

		// Start Transformation to rotate
		$pdf->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$pdf->Rotate(90, 70, 110);
		$pdf->Text(82, 55, 'Generador');
		// Stop Transformation
		$pdf->StopTransform();

		// Start Transformation to rotate
		$pdf->StartTransform();
		// Rotate 20 degrees counter-clockwise centered by (70,110) which is the lower left corner of the rectangle
		$pdf->Rotate(90, 70, 110);
		$pdf->Text(28, 55, 'Transportista');
		// Stop Transformation
		$pdf->StopTransform();

		// reset pointer to the last page
		$pdf->lastPage();
		//Close and output PDF document
		$pdf->Output('Manifiesto_00001.pdf', 'I');
?>