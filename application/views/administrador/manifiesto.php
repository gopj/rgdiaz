<div class="span9">
	<center><legend>Generador de Manifiesto - <?= $email->correo; ?></legend></center>
	<form id="generar_manifiesto" action="<?php echo site_url('administrador/generar_manifiesto'). "/" . $id_persona; ?>" method="post">
		<div class="row">
			<div class="span3">
				<div class='input-prepend'>
					<span class='add-on'>
						<img src="img/glyphicons_157_show_thumbnails_with_lines.png" class="icon-form">
					</span>
					<select id="manifiesto" name="manifiesto">
							<option value="">Selecciona Manifiesto</option>
						<?php foreach($cliente_manifiestos as $row){ ?>
							<option value="<?php echo $row->folio_manifiesto;?>"><?php echo $row->folio_manifiesto; ?></option>
						<?php } ?>
					</select>
				</div>

				<br/>
					
				<input type="submit" class="btn btn-primary" value="Generar Manifiesto">				
			</div>

		</div>
	</form>
	<br/><br/>

	<?php 

		$pdfpath = $_SERVER['DOCUMENT_ROOT'] . "rgdiaz/img/pdf/rdiaztmp{$id_persona}.pdf";
		if (file_exists($pdfpath)) { 
	?>

		<object data="<?= base_url('img/pdf/rdiaztmp'.$id_persona.'.pdf'); ?>" type="application/pdf" style="width:100%;height:1200px;">
			<iframe src="<?= base_url('img/pdf/rdiaztmp'.$id_persona.'.pdf'); ?>" width="100%" height="100%" style="width:100%;height:1200px; border: none;">
				Este navegador no soporta PDFs. Favor de descargar el PDF para visualizarlo: <a href="<?= base_url('img/pdf/rdiaztmp'.$id_persona.'.pdf'); ?>">Descargar PDF</a>
			</iframe>
		</object>

			
	<?php } ?>

	<br/><br/>

	<?php echo anchor('administrador/bitacora/' . $id_persona, 'Regresar', 'class="btn btn-warning"'); ?>
	

</div>