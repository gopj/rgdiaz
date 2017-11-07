<div class="span9">
	<div class="tabbable"> <!-- Only required for left/right tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab1" data-toggle="tab"> <b> Empresa Transportista </b> </a></li>
			<li><a href="#tab2" data-toggle="tab"> <b> Empresa Destino </b> </a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="tab1">
				<form id="generar_manifiesto" action="<?php echo site_url('administrador/actualizar_transportistas') ?>" method="post">
					<div class="row pull-left">
						<div class="span6">

							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-lock">
								</span>
								<select id="id_tipo_emp_transportista" name="id_tipo_emp_transportista" onchange="comprueba_emp_trans(this.value)" style="width: 446px">
										<option value="">Selecciona Empresa Transportista</option>
									<?php foreach($emp_transportista as $row){ ?>
										<option value="<?php echo $row->id_tipo_emp_transportista;?>"><?php echo $row->nombre_empresa; ?></option>
									<?php } ?>
								</select>
							</div>
								
							Nombre Empresa Transportista
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-user">
								</span>
								<input class="txt-well" id="nombre_emp_trans" name="nombre_emp_trans" type='text' >
							</div>
							No de Autorización Transportista
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-g-keys">
								</span>
								<input class="txt-well" id="no_aut_trans" name="no_aut_trans" type='text'>
							</div>
							No de Autorización SCT
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-g-keys">
								</span>
								<input class="txt-well" id="no_aut_trans_sct" name="no_aut_trans_sct" type='text'>
							</div>
							Domicilio
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-road">
								</span>
								<input class="txt-well" id="domicilio_emp_trans" name="domicilio_emp_trans" type='text'>
							</div>
							Teléfono
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-g-phone">
								</span>
								<input class="txt-well" id="tel_emp_trans" name="tel_emp_trans" type="tel" size="10">
							</div>

							<br/>
							<?php echo anchor('administrador/admin_clientes/', 'Regresar', 'class="btn btn-warning"'); ?>	
							<input type="submit" class="btn btn-primary pull-right" value="Guardar">				
						</div>

					</div>
				</form>
			</div>
			<div class="tab-pane" id="tab2">
				<form id="generar_manifiesto" action="<?php echo site_url('administrador/actualizar_destinos') ?>" method="post">
					<div class="row pull-left">
						<div class="span6">

							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-lock">
								</span>
								<select id="id_tipo_emp_destino" name="id_tipo_emp_destino" onchange="comprueba_emp_trans(this.value)" style="width: 446px">
										<option value="">Selecciona Empresa Destino</option>
									<?php foreach($emp_destino as $row){ ?>
										<option value="<?php echo $row->id_tipo_emp_destino;?>"><?php echo $row->nombre_destino; ?></option>
									<?php } ?>
								</select>
							</div>	
								
							Nombre Empresa Destino
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-user">
								</span>
								<input class="txt-well" id="nombre_emp_dest" name="nombre_emp_dest" type='text' >
							</div>
							No de Autorización Destino
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-g-keys">
								</span>
								<input class="txt-well" id="no_aut_dest" name="no_aut_dest" type='text'>
							</div>
							Domicilio
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-road">
								</span>
								<input class="txt-well" id="domicilio_emp_dest" name="domicilio_emp_dest" type='text'>
							</div>
							Municipio
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-g-google-maps">
								</span>
								<input class="txt-well" id="municipio_emp_dest" name="municipio_emp_dest" type='text'>
							</div>
							Estado
							<div class='input-prepend'>
								<span class='add-on'>
									<img class="icon-g-google-maps">
								</span>
								<input class="txt-well" id="estado_emp_dest" name="estado_emp_dest" type='text'>
							</div>

							<br/>
							<?php echo anchor('administrador/admin_clientes/', 'Regresar', 'class="btn btn-warning"'); ?>	
							<input type="submit" class="btn btn-primary pull-right" value="Guardar">				
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
