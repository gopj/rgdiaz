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
		<link rel="stylesheet" type="text/css" href="<?=base_url('css/estilos.css')?>">

		<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />	
		<script type="text/javascript" src="<?=base_url('js/bootstrap-datepicker.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/jquery.validate.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/jquery.validate.messages.js');?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bitacora.js');?>"></script>
		<script src="https://kit.fontawesome.com/1e1a8bc4b5.js" crossorigin="anonymous"></script>

		<title>RDiaz </title>
	</head>
	<body>
		<nav class="navbar-expand-lg fmenu"  >
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="container" id="navbarNavDropdown">
			<ul class="nav justify-content-end">
				
				<li class="nav-item ">
					<a class="nav-link gnav active" aria-current="page" href="<?=base_url('administrador/index');?>"><i class="fas fa-home"></i> Inicio</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link gnav"  href="<?=base_url('administrador/admin_clientes')?>"><i class="fas fa-user"></i>Clientes</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link gnav" href="<?=base_url('admin/recolector_index')?>"><i class="fas fa-truck"></i>Recolectores</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link gnav" href="<?=base_url('administrador/subir_archivo');?>"><i class="fas fa-folder"></i>Documentos</a>
				</li>
			</ul>
		</div>

		</nav>

		<?php echo $output; ?>

		<!-- FOOTER -->
			
		<footer>
			<div class="footer" style="color:#fff; font-weight:bold; ">
				<div class="container">
					<div style="">
						Derechos reservados &copy; <?php echo date("Y"); ?> RDíaz
					</div>
				</div>
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