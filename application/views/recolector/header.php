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
			<a class="navbar-brand" href="<?= site_url('recolector'); ?>"> Recolector </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav justify-content-end">
					
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<strong> <?= $recolector->nombre ?> </strong>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item"  data-toggle="modal" data-target="#modal_selecciona_vehiculo" >Selecciona vehículo</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Cerrar sesión</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

		<div class="container" style="padding-top:10px;">
			<div class="row">
				<div class="span14">
					<img src="img/logo.png" style="width:300px;">
				</div>
			</div>
		</div>
					