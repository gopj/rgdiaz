
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
	<!-- <script type="text/javascript" src="js/bootstrap4/dataTables.bootstrap4.min.js"></script> -->
	<script type="text/javascript" src="js/recolector.js"></script>

	<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';
			window.addEventListener('load', function() {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('form_manifiesto_recolector');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
	</script>

	</body>
	
</html>