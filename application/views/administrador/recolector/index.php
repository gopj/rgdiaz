<section class="container align-items-center">
	<div class="row">
			<!--Side panel-->
	<div class="col-3">
		<h3>Recolectores</h3>
	    <h4 class="mb-3"> Consulta de cliente</h4> <hr>
				
		<input type="text" class="form-control form-control-lg" id="search_cliente"> <br>

		<select class="form-control" onclick="get_cliente(this.value);" id="id_persona" name="id_persona" size="20" style="width: 100%;">
			<option value="">-</option>

			<?php foreach($tclientes->result() as $row){ ?>
				<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa; ?></option>
			<?php } ?>
		</select>
	</div>
	<!--start the drawer-->
	<div class="col-9">
		<form method="post" id="form_ver_manifiestos" action="<?php echo site_url('admin/recolector_ver_manifiestos')?>">
			<div class="col-md-8 order-md-2">
				<h4 class="mb-3">  Datos de la empresa</h4> <hr>
				
				<div class="form-group">
					<label class="col-form-label" for="nombre_empresa">  Nombre o Razón Social  </label>
					<input type="text" class="form-control form-control-lg" id="nombre_empresa" disabled>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="calle">  Calle  </label>
						<input type="text" class="form-control form-control-lg" id="calle" disabled>
					</div>
					<div class="form-group col-md-3">
						<label class="col-form-label" for="numero">  Número  </label>
						<input type="text" class="form-control form-control-lg" id="numero" disabled>
					</div>
					<div class="form-group col-md-3">
						<label class="col-form-label" for="cp">  Código Postal  </label>
						<input type="text" class="form-control form-control-lg" id="cp" disabled>
					</div>				
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="municipio">  Municipio  </label>
						<input type="text" class="form-control form-control-lg" id="municipio" disabled>
					</div>
					<div class="form-group col-md-6">
						<label class="col-form-label" for="estado">  Estado  </label>
						<input type="text" class="form-control form-control-lg" id="estado" disabled>
					</div>
				</div>	

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="telefono">  Télefono  </label>
						<input type="text" class="form-control form-control-lg" id="telefono" disabled>
					</div>
					<div class="form-group col-md-6">
						<label class="col-form-label" for="email">  Dirección de Email  </label>
						<input type="text" class="form-control form-control-lg" id="email" disabled>
						<input type="text" id="identificador_folio" name="identificador_folio" value="" hidden >
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
					</div>
				</div>


				<div class="form-row">
					<div class="form-group col-md-4">

					</div>
					<div class="form-group col-md-4">
						<button type="submit" class="btn btn-primary btn-lg btn-block" id="ver_manifiestos" name="ver_manifiestos" disabled>Manifiestos</button>
					</div>
					<div class="form-group col-md-4">

					</div>
				</div>
			</div>

				<!-- The Modal -->
				<div class="modal" id="id_folio_message">
					<div class="modal-dialog modal-md">
						<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Identificador de Folio no disponible </h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-8">
									<label class="col-form-label" for=""> Favor de contactar al administrador </label>
								</div>	
							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
		</form>
	</div>
	</div>
</section>
