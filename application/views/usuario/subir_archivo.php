<div class="container-fluid">
	<div class="card card-white">
		<div >
			<h3>Administrador de Carpeta</h3>
			<label><i>Mi Carpeta / <?php echo $ruta;?><i></label>
		</div>
	</div>
	<div class="card">
		<div class="input-group mb-2 mr-sm-2">
			<div class="input-group-prepend">
				<div class="input-group-text">Buscar</div>
			</div>
			<input type="text" class="form-control" placeholder="" id="input_busca_carpeta">
		</div>
		<div class="row justify-content-center">
			<?php foreach ($carpetas->result() as $carpe) { ?>
				<div class='card filecard align-items-center'  id='card_data'>
					<i class='icon-folder thumb'></i>
					<div class="card-body ">
						<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
							<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
							<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
							<button type="submit" class="nombre-carpeta card-title" ><?php echo $carpe->empresa?></button>
						</form>
						<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
							<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
							<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
							<button type="submit" class="btn card-subtitle contact" disabled> <?php echo $carpe->nombre?></button>
						</form>
					</div>
					<div class="row justify-content-center">
						<form id="ver_bitacora" method='post' action="<?php echo site_url('administrador/bitacora');?>">
							<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
							<button type="submit" class="btn card-link " title="Ver Bitacora"><i class="icon-file-empty"></i> Ver Bitacora </button>
						</form>
						<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
							<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
							<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
							<button type="submit" class="btn" title="Ver Expediente"><i class="icon-folder-open"></i> Ver Expediente</button>
						</form>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>