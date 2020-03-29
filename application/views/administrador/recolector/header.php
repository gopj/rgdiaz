<?php
	session_start();
?>
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
		<link href="css/bootstrap4/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap4/open-iconic-bootstrap.css" rel="stylesheet">
    	<link href="css/bootstrap4/sticky-footer.css" rel="stylesheet">
    	<link href="css/bootstrap4/magic-check.css" rel="stylesheet">    	
    	<link href="css/bootstrap4/jquery.dataTables.min.css" rel="stylesheet">
    	<link href="css/recolector.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />	
		<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="js/formulario_bitacora.js"></script>
		<script type="text/javascript" src="js/jquery.validate.js"></script>
		<script type="text/javascript" src="js/jquery.validate.messages.js"></script>
		<script type="text/javascript" src="js/bitacora.js"></script>

		<style type="text/css">
			/*table.dataTable thead tr {
				background-color: #28A745;
				color: white;
			}
			table.dataTable tfoot tr { 
				background-color: #28A745;
				color: white;	
			}
			.page-item.active .page-link {
				background-color: #28A745;
				border-color: black;
			}*/

			table.dataTable thead th{
				background: white;
			}

			table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
				background: #F3F3F3;
			}

			table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
				background: white;
			}
    	</style>
		<title>Recolector</title>
	</head>
	<body>
	
		<nav class="navbar navbar-expand-lg navbar-dark bg-success">
			<a class="navbar-brand" href="<?=site_url('administrador');?>"> 
				<?php echo $this->session->userdata('nombre');?>
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url('administrador');?>"> Mi Carpeta </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url('administrador/admin_clientes')?>">Clientes</a>
					</li>
					<li class="nav-item dropdown active">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Recolectores
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							<a class="dropdown-item" href="<?php echo site_url('administrador/recolector_consulta')?>">Consultas</a>
							<a class="dropdown-item" href="<?php echo site_url('administrador/recolector_index')?>">Bitacora</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url('administrador/subir_archivo');?>">Administrar Carpetas</a>
					</li>
				</ul>
			</div>

			<a class="btn btn-primary btn-bd-download d-none d-lg-inline-block mb-3 mb-md-0 ml-md-3" href="<?=site_url();?>"> Cerrar Sesión </a>
		</nav>

		<div class="container-fluid">

			<div class="row">

				<!-- <nav class="col-md-2 d-none d-md-block bg-light sidebar">
					<div class="container" style="padding-top:10px;">
							<img src="img/logo.png" style="width:300px;">
						</div>
				</nav> -->
					<div class="sidebar-sticky">

						<div class="container" style="padding-top:10px;">
							<img src="img/logo.png" style="width:300px;">
						</div>
					</div>
					