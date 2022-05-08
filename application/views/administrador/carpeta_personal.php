	<div class="page-title">
		<h3 class="breadcrumb-header"> Mi Carpeta </h3>
	</div>
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">
				<table id="carpeta_table" class="display table table-striped table-bordered">
					<thead class="thead-dark">
						<tr>
							<th width="5%"></th>
							<th width="72%">Nombre</th>
							<th width="23%">Acciones</th>
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
									<button class="btn btn-primary" type="submit"><i class="fas fa-eye"></i> Ver Carpeta </button>
								</form>
							</td>
						</tr>       
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
