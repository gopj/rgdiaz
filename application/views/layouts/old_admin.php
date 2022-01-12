<?php ob_start(); ?>
<!DOCTYPE html>
	<html>
		<head>
			<base href="<?=base_url()?>"/>
			<title>RDíaz</title>
			<link href="<?=base_url('img/minilogo.png')?>" type="image/x-icon" rel="shortcut icon" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/datepicker.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/admin.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/estilos.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/glyphicons.css')?>">
			
			<script type="text/javascript" src="<?=base_url('js/jquery.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/bootstrap.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/jquery.dataTables.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/tooltip.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/popover.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/transition.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/dropdown.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/swith.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/bootstrap-datepicker.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/formulario_bitacora.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/jquery.validate.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/jquery.validate.messages.js')?>"></script>
			<script type="text/javascript" src="<?=base_url('js/bitacora.js')?>"></script>
			<script src="https://kit.fontawesome.com/1e1a8bc4b5.js" crossorigin="anonymous"></script>

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
			<div class="container">
				<div class="row ">
					<div class ="col-2 ">
						<img src="img/logo.png" alt="" class="logo">
						<div>
							<br>
						<ul class="nav flex-column">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="#"><i class="fas fa-folder-plus"></i> Nueva Carpeta</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#"><i class="fas fa-plus"></i>  Nuevo Documento</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#"><i class="fas fa-folder"></i> Ricardo Díaz Virgen</a>
							</li>
							<li>
								<a href="" class="nav-link "><i class="fas fa-session"></i>Cerrar sesión</a>
							</li>
						</ul>
						</div>
					</div>

					<div class="col-10" >
						<?php echo $output; ?>
					</div>

				</div>
			</div>

			
		<footer>
			<div class="footer" style="color:#fff; font-weight:bold; ">
				<div class="container">
					<div style="">
						Derechos reservados &copy; <?php echo date("Y"); ?> RDíaz
					</div>
				</div>
			</div>
		</footer>
	</body>
	<script type="text/javascript">
				$(document).ready(function(){
	                $('#tabla').dataTable({
	                	"bJQueryUI":false,
	                	"iDisplayLength": 6,
	                	"aaSorting": [[0,'asc'], [1,'asc']]
	                });
	                
	                $('.dropdown-toggle').dropdown();

	                document.getElementById("file").onchange = function () {
    					document.getElementById("name").value = this.value;
					};
	            });
	            $('body').on('click', function (e) {
	    			$('[data-toggle="popover"]').each(function () {
	        			if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
	            		$(this).popover('hide');
	        			}
	    			});
				});
	</script>


</html>