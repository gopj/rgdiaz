<div class="span9">
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab">Empresa Transportista</a></li>
			<li><a href="#tab2" data-toggle="tab">Empresa Destino</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<form id="generar_manifiesto" action="<?php echo site_url('administrador/generar_manifiesto') ?>" method="post">
					<div class="row">
						<div class="span3">
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_157_show_thumbnails_with_lines.png" class="icon-form">
								</span>
								<select id="id_tipo_emp_transportista" name="id_tipo_emp_transportista" onchange="comprueba_emp_trans(this.value)">
										<option value="">Selecciona Empresa Transportista</option>
									<?php foreach($emp_transportista as $row){ ?>
										<option value="<?php echo $row->id_tipo_emp_transportista;?>"><?php echo $row->nombre_empresa; ?></option>
									<?php } ?>
								</select>
							</div>
								
							<center>
							Nombre Empresa Transportista
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_450_factory.png" class="icon-form">
								</span>
								<input class="txt-well" id="nombre_emp_trans" name="nombre_emp_trans" type='text' >
							</div>
							No de Autorización Transportista
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_242_google_maps.png" class="icon-form">
								</span>
								<input class="txt-well" id="no_aut_trans" name="no_aut_trans" type='text'>
							</div>
							No de Autorización SCT
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_242_google_maps.png" class="icon-form">
								</span>
								<input class="txt-well" id="no_aut_trans_sct" name="no_aut_trans_sct" type='text'>
							</div>
							Domicilio
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_242_google_maps.png" class="icon-form">
								</span>
								<input class="txt-well" id="domicilio_emp_trans" name="domicilio_emp_trans" type='text'>
							</div>
							Teléfono
							<div class='input-prepend'>
								<span class='add-on'>
									<img src="img/glyphicons_242_google_maps.png" class="icon-form">
								</span>...
								<input class="txt-well" id="tel_emp_trans" name="tel_emp_trans" type='text'>
							</div>
							</center>
						

							<br/>
							<?php echo anchor('administrador/admin_clientes/', 'Regresar', 'class="btn btn-warning"'); ?>	
							<input type="submit" class="btn btn-primary pull-right" value="Guardar">				
						</div>

					</div>
				</form>
			</div>
			<div class="tab-pane" id="tab2">
				<p>Howdy, I'm in Section 2.</p>
			</div>
		</div>
	</div>
</div>
