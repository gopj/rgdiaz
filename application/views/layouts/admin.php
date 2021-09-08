<!DOCTYPE html>
<html>
	<head>

		<!-- base_url -->
		<base href="<?php echo base_url(); ?>"/>

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS --> 	
		<!-- <link href="css/bootstrap4/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
		<link href="<?=base_url('css/bootstrap4/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?=base_url('css/bootstrap4/open-iconic-bootstrap.css');?>" rel="stylesheet">
		<link href="<?=base_url('css/bootstrap4/sticky-footer.css');?>" rel="stylesheet">
		<link href="<?=base_url('css/bootstrap4/magic-check.css');?>" rel="stylesheet">    	
		<link href="<?=base_url('css/bootstrap4/jquery.dataTables.min.css');?>" rel="stylesheet">
		<link href="<?=base_url('css/recolector.css');?>" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />	
		<script type="text/javascript" src="<?=base_url('js/bootstrap-datepicker.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/jquery.validate.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/jquery.validate.messages.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bitacora.js');?>"></script>

		<title>Recolector</title>
	</head>
	<body>
	
		<nav class="navbar navbar-expand-lg navbar-dark bg-success">
			<a class="navbar-brand" href="<?=site_url('admin');?>"> 
				<?php echo $this->session->userdata('nombre');?>
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('administrador/index');?>"> Mi Carpeta </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('administrador/admin_clientes')?>">Clientes</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Recolectores
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="<?=base_url('admin/recolector_consulta')?>">Consultas</a>
							<a class="dropdown-item" href="<?=base_url('admin/recolector_index')?>">Manifiesto</a>
							<a class="dropdown-item" href="<?=base_url('admin/recolector_bitacora')?>">Bitacora</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url('admin/subir_archivo');?>">Administrar Carpetas</a>
					</li>
				</ul>
			</div>

			<a class="btn btn-primary btn-bd-download d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="<?=base_url();?>"> Cerrar Sesión </a>
		</nav>

		<?php echo $output; ?>

		<!-- FOOTER -->
		<footer class="footer">
			<div class="container">
				<span class="text-muted"> Todos los derechos reservados &copy; <?php echo date("Y"); ?> RDíaz </span>
			</div>	
		</footer>

		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<!-- <script type="text/javascript" src="js/bootstrap4/jquery-3.3.1.min.js"></script> -->
		<script type="text/javascript" src="<?=base_url('js/bootstrap4/jquery-3.3.1.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bootstrap4/popper.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bootstrap4/InputSpinner.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bootstrap4/bootstrap.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bootstrap4/jquery.dataTables.min.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bootstrap4/dataTables.fixedColumns.min.js')?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
		<!-- <script type="text/javascript" src="js/bootstrap4/dataTables.bootstrap4.min.js"></script> -->
		<script type="text/javascript" src="<?=base_url('js/recolector.js')?>"></script>

		<script>
			$('#fecha_embarque').datepicker({
				uiLibrary: 'bootstrap4',
				format: "dd/mm/yyyy"
			});
		</script>
	 
	</body>
	
</html>