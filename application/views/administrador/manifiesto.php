<div class="span9">
	<center><legend>Generador de Manifiesto</legend></center>
	<div class="row">
		<div class="span3">
			<div class='input-prepend'>
				<span class='add-on'>
					<img src="img/glyphicons_157_show_thumbnails_with_lines.png" class="icon-form">
				</span>
				<select id="id_persona" name="id_persona">
						<option value="">Selecciona Manifiesto</option>
					<?php foreach($cliente_manifiestos as $row){ ?>
						<option value="<?php echo $row->folio_manifiesto;?>"><?php echo $row->folio_manifiesto; ?></option>
					<?php } ?>
				</select>
			</div>

			<a href="<?= site_url('administrador/generar_manifiesto/' . $id_persona) ?>" class="btn btn-primary" > Generar Manifiesto </a>
			<object data="/files/examples/example_053.pdf" type="application/pdf" style="width:100%;height:1200px;" internalinstanceid="25" title="">
  				alt : <a href="https://tcpdf.org/files/examples/example_053.pdf" class="tooltipstered">example_053.pdf</a>
			</object>
			
		</div><br/>

	</div>

</div>