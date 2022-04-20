<!DOCTYPE html>
<html>
	<head>
		<!-- base_url -->
		<base href="<?php echo base_url(); ?>"/>
		<!-- metas -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="keywords" content="admin,dashboard" />
		<meta name="description" content="RDíaz - Servicios Integrales en Materia Ambiental" />

		<!-- title  -->
		<title>RD&iacute;az - Servicios Integrales en Materia Ambiental</title>

		<!-- favicon -->
		<link rel="shortcut icon" href="<?=base_url('img/minilogo.png')?>">
		<link rel="apple-touch-icon" href="<?=base_url('img/crizal/logos/apple-touch-icon-57x57.png')?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('img/crizal/logos/apple-touch-icon-72x72.png')?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('img/crizal/logos/apple-touch-icon-114x114.png')?>">

		<!-- Bootstrap CSS --> 	
    	<!-- <link href="css/bootstrap4/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
		<link href="<?=base_url('css/bootstrap4/bootstrap.min.css')?>" rel="stylesheet">
		<link href="<?=base_url('css/bootstrap4/open-iconic-bootstrap.css')?>" rel="stylesheet">
    	<link href="<?=base_url('css/bootstrap4/sticky-footer.css')?>" rel="stylesheet">
    	<link href="<?=base_url('css/bootstrap4/magic-check.css')?>" rel="stylesheet">    	
    	<link href="<?=base_url('css/bootstrap4/jquery.dataTables.min.css')?>" rel="stylesheet">
    	<link href="<?=base_url('css/recolector.css')?>" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/css/gijgo.min.css" rel="stylesheet" type="text/css" />	

		<style type="text/css">
			/* PROD*/
			table.dataTable thead th{
				background: white;
			}

			table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(odd) {
				background: #F3F3F3;
				color: black;
			}

			table.dataTable.table-striped.DTFC_Cloned tbody tr:nth-of-type(even) {
					background: white;
			}
    	</style>
		<title>Recolector</title>
	</head>
	<body>
	
		<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-success">
			<a class="navbar-brand" href="<?= site_url('recolector'); ?>"> Recolector </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav justify-content-end">
					<li class="nav-item">
						<a class="nav-link" >
							<strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" >
							<strong> <?= @$cliente->nombre_empresa ?> </strong>
						</a>
					</li>
				</ul>
			</div>

			<div class="btn-group dropleft">
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<strong> <?= $recolector->nombre ?> </strong>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item"  data-toggle="modal" data-target="#modal_selecciona_vehiculo" onclick="selected_vehicle()">Selecciona vehículo</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Cerrar sesión</a>
				</div>
			</div>
		</nav>

		<div class="container" style="padding-top: 63px;">
			<div class="row">
				<div class="span14">
					<img src="<?=base_url('img/logo.png')?>" style="width:300px;">
				</div>
			</div>
		</div>
		<?=$output?>

	<footer class="footer">
		<div class="container">
			<span class="text-muted"> Todos los derechos reservados &copy; <?php echo date("Y"); ?> RDíaz </span>
		</div>	
	</footer>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script type="text/javascript" src="<?=base_url('js/bootstrap4/jquery-3.3.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/bootstrap4/popper.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/bootstrap4/InputSpinner.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/bootstrap4/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/bootstrap4/jquery.dataTables.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/bootstrap4/dataTables.fixedColumns.min.js')?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.6/js/gijgo.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=base_url('js/recolector.js')?>"></script>

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
										<option value="<?=$row->id_vehiculo;?>"><?=$row->alias; ?></option>
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