<div id="main-wrapper">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Carpeta Personal </h3>
	</div>
	<div class="col-md-12">
		<div class="card card-white">
			<div class="card-body">

				<div class="span9">
					<table id="tabla" class="display">
						<thead>
							<tr>
								<th width="5%"></th>
								<th width="75%">Nombre</th>
								<th width="20%">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($carpetas->result() as $carpe) { ?>
							<tr>
							<td><center><img src='img/iconos/folder.png'></center></td>
								<td>
									<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
										<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
										<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
										<input class="nombre-carpeta"  type="submit" value="<?php echo $carpe->nombre?>">
									</form>
								</td>
								<td align="center">
									<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
										<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
										<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
										<input class="btn btn-mini btn-primary"  type="submit" value="Ver Carpeta">
									</form>
								</td>
							</tr>       
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
