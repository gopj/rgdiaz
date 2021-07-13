<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content">Clientes</h1></center>
	<hr>

	<form method="post" id="form_ver_manifiestos" action="<?php echo site_url('recolector/ver_manifiestos')?>">
		<div class="row">
			<div class="col-md-4 order-md-1">

				<h4 class="mb-3"> <img src="img/iconos_bt4/person-4x.png" /> Selecciona Cliente</h4> <hr>
				
				<input type="text" class="form-control form-control-lg" id="search_cliente"> <br>

				<select class="form-control" onclick="get_cliente(this.value);" id="id_persona" name="id_persona" size="20" style="width: 100%;">
					<option value="">-</option>

					<?php foreach($tclientes->result() as $row){ ?>
						<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa; ?></option>
					<?php } ?>
				</select>
			</div>


			<div class="col-md-8 order-md-2">
				<h4 class="mb-3"> <img src="img/iconos_bt4/spreadsheet-4x.png" /> Datos de la empresa</h4> <hr>
				
				<div class="form-group">
					<label class="col-form-label" for="nombre_empresa"> <center> Nombre o Razón Social </center> </label>
					<input type="text" class="form-control form-control-lg" id="nombre_empresa" disabled>
				</div>

				<div class="form-row">
					<div class="form-group col-md-8">
						<label class="col-form-label" for="calle"> <center> Calle </center> </label>
						<input type="text" class="form-control form-control-lg" id="calle" disabled>
					</div>
					<div class="form-group col-md-2">
						<label class="col-form-label" for="numero"> <center> Número </center> </label>
						<input type="text" class="form-control form-control-lg" id="numero" disabled>
					</div>
					<div class="form-group col-md-2">
						<label class="col-form-label" for="cp"> <center> Código Postal </center> </label>
						<input type="text" class="form-control form-control-lg" id="cp" disabled>
					</div>				
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="municipio"> <center> Municipio </center> </label>
						<input type="text" class="form-control form-control-lg" id="municipio" disabled>
					</div>
					<div class="form-group col-md-6">
						<label class="col-form-label" for="estado"> <center> Estado </center> </label>
						<input type="text" class="form-control form-control-lg" id="estado" disabled>
					</div>
				</div>	

				<div class="form-row">
					<div class="form-group col-md-6">
						<label class="col-form-label" for="telefono"> <center> Télefono </center> </label>
						<input type="text" class="form-control form-control-lg" id="telefono" disabled>
					</div>
					<div class="form-group col-md-6">
						<label class="col-form-label" for="email"> <center> Dirección de Email </center> </label>
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
						<button type="submit" class="btn btn-primary btn-lg btn-block" id="ver_manifiestos" name="ver_manifiestos" disabled>Ver Manifiestos</button>
					</div>
					<div class="form-group col-md-4">

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

			</div>
		</div>		
	</form>		
</main>
