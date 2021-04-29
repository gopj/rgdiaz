
	<footer class="footer">
		<div class="container">
			<span class="text-muted"> Todos los derechos reservados &copy; <?php echo date("Y"); ?> RDíaz </span>
		</div>	
	</footer>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<!-- <script type="text/javascript" src="js/bootstrap4/jquery-3.3.1.min.js"></script> -->
	<script type="text/javascript" src="js/bootstrap4/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap4/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap4/InputSpinner.js"></script>
	<script type="text/javascript" src="js/bootstrap4/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap4/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/bootstrap4/dataTables.fixedColumns.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
	<!-- <script type="text/javascript" src="js/bootstrap4/dataTables.bootstrap4.min.js"></script> -->
	<script type="text/javascript" src="js/recolector.js"></script>

	<script>
		$('#fecha_embarque').datepicker({
			uiLibrary: 'bootstrap4',
			format: "dd/mm/yyyy"
		});
	</script>

	<!-- Modal Guarda Recolector Begin -->
	<div class="modal" id="modal_selecciona_vehiculo">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Selecciona vehículo</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="form-group col-lg-12">
						<form class="form" role="form" autocomplete="off" method='post' action="<?php echo site_url('recolector/register_vehicle');?>">
							<label class="col-lg-12 col-form-label form-control-label" for="id_vehiculo_recolector"> Selecciona Vehículo</label>
							<div class="col-lg-12">
								<select class="form-control" onclick="get_vehiculo(this.value)" id="id_vehiculo_recolector" name="id_vehiculo_recolector">
									<option value="0"> Vacío </option>
									<?php foreach($vehiculos->result() as $row){ ?>
										<option value="<?php echo $row->id_vehiculo;?>"><?php echo $row->alias; ?></option>
									<?php } ?>
								</select>
							</div>
					</div>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
					<button type="submit" class="btn btn-primary">Sí</button>
				</div>
						</form>
			</div>
		</div>
	</div>
	<!-- Modal End -->

	</body>
	
</html>