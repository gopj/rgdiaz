<!DOCTYPE html>
<html>
	<head>
		<!-- base_url -->
		<base href="<?php echo base_url(); ?>"/>

		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link href="<?=base_url('/css/bootstrap4/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?=base_url('/css/bootstrap4/open-iconic-bootstrap.css');?>" rel="stylesheet">
		<link href="<?=base_url('/css/bootstrap4/sticky-footer.css');?>" rel="stylesheet">
		<link href="<?=base_url('/css/bootstrap4/magic-check.css');?>" rel="stylesheet">    	
		
		<link href="<?=base_url('/css/bootstrap4/jquery.dataTables.min.css');?>" rel="stylesheet">
		
		<link href="<?=base_url('/css/custom.css');?>" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?=base_url('/css/estilos.css')?>">

		<script type="text/javascript" src="<?=base_url('js/jquery.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/bootstrap.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/jquery.dataTables.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/tooltip.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/popover.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/transition.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/dropdown.js')?>"></script>
		<script type="text/javascript" src="<?=base_url('js/swith.js')?>"></script>

    	<link rel="stylesheet" href="<?=base_url('plugins/font-awesome/css/font-awesome.min.css')?>" />
    	<link rel="stylesheet" href="<?=base_url('plugins/icomoon/style.css')?>" />
    	<link rel="stylesheet" href="<?=base_url('plugins/uniform/css/default.css')?>" />
    	<link rel="stylesheet" href="<?=base_url('plugins/switchery/switchery.min.css')?>" />

		<title>Recolector</title>
	</head>
	<body>
	<div class="page-container">
		<div class="page-sidebar">
            <a class="logo-box" href="<?=base_url('administrador/index')?>">
                <span>RDiaz</span>
                <i class="fas fa-unlock-alt" id="fixed-sidebar-toggle-button"></i>
                <i class="icon-close" id="sidebar-toggle-button-close"></i>
            </a>
            <div class="page-sidebar-inner">
                <div class="page-sidebar-menu">
                    <ul class="accordion-menu">
                        <li>
                            <a href="<?=base_url('administrador/index')?>">
                                <i class="menu-icon icon-home4"></i><span>Mi Carpeta</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrador/mensajes_contacto')?>">
                                <i class="menu-icon icon-inbox"></i><span>Correo</span>
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                <i class="menu-icon icon-truck"></i><span>Recolectores</span><i class="accordion-icon fa fa-angle-left"></i>
                            </a>
                            <ul>
                                <li><a href="<?=base_url('admin/recolector_consulta')?>">Consultas</a></li>
                                <li><a href="<?=base_url('admin/recolector_index')?>">Manifiestos</a></li>
                                <li><a href="<?=base_url('admin/recolector_bitacora')?>">Bítacora</a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <a href="#!">
                                <i class="menu-icon icon-user"></i><span>Clientes</span><i class="accordion-icon fa fa-angle-left"></i>
                            </a>
                            <ul>
                                <li><a href="#">+ Nuevo Cliente</a></li>
                                <li><a href="<?=base_url('administrador/admin_clientes')?>">Directorio de Clientes</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#!">
                                <i class="menu-icon icon-folder"></i><span>Carpetas</span><i class="accordion-icon fa fa-angle-left"></i>
                            </a>
                            <ul>
                                <li><a href="<?=base_url('administrador/subir_archivo');?>">Mis Documentos</a></li>
                                <li><a href="<?=base_url('administrador/subir_archivo');?>">Subir Archivos</a></li>
                                
                            </ul>
                        </li>
                        
                        <li class="menu-divider"></li>
                        <li>
                            <a href="#!">
                                <i class="menu-icon icon-settings"></i><span>Configuración</span><i class="accordion-icon fa fa-angle-left"></i>
                            </a>
                            <ul>
                                <li><a href="#">Ajustes</a></li>
                                <li><a href="<?=base_url();?>">Cerrar Sesión</a></li>
                                
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		<div class="page-content">
			<div class="page-inner">
				<?php echo $output; ?>
			</div>
		</div>	

		<!-- FOOTER -->
		<footer class="footer">
			<div class="container">
				<span class="footext"> Todos los derechos reservados &copy; <?php echo date("Y"); ?> RDíaz </span>
			</div>	
		</footer>

		<script type="text/javascript" src="<?=base_url('js/recolector.js')?>"></script>

		<script>
			$('#fecha_embarque').datepicker({
				uiLibrary: 'bootstrap4',
				format: "dd/mm/yyyy"
			});
		</script>	

	</div>		
	</body>
			
		<script type="text/javascript" src="<?=base_url('plugins/bootstrap/js/bootstrap.min.js')?>"></script>

		<script type="text/javascript" src="<?=base_url('js/crizal/jquery.min.js')?>"></script>


		<script type="text/javascript" src="<?=base_url('plugins/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>

		<!-- uniform -->
		<script type="text/javascript" src="<?=base_url('plugins/uniform/js/jquery.uniform.standalone.js')?>"></script>

		<!-- switchery -->
		<script type="text/javascript" src="<?=base_url('plugins/switchery/switchery.min.js')?>"></script>

		<!-- chartjs -->
		<script type="text/javascript" src='<?=base_url('plugins/chartjs/chart.min.js')?>'></script>

		<!-- d3.min -->
		<script type="text/javascript" src="<?=base_url('plugins/d3/d3.min.js')?>"></script>

		<!-- nv.d3.min -->
		<script type="text/javascript" src="<?=base_url('plugins/nvd3/nv.d3.min.js')?>"></script>

		<!-- float chart -->
		<script type="text/javascript" src="<?=base_url('plugins/flot/jquery.flot.min.js')?>"></script>

		<!-- float time -->
		<script type="text/javascript" src="<?=base_url('plugins/flot/jquery.flot.time.min.js')?>"></script>

		<!-- float symbol -->
		<script type="text/javascript" src="<?=base_url('plugins/flot/jquery.flot.symbol.min.js')?>"></script>

		<!-- float resize -->
		<script type="text/javascript" src="<?=base_url('plugins/flot/jquery.flot.resize.min.js')?>"></script>

		<!-- float tooltip -->
		<script type="text/javascript" src="<?=base_url('plugins/flot/jquery.flot.tooltip.min.js')?>"></script>

		<!-- float pie -->
		<script type="text/javascript" src="<?=base_url('plugins/flot/jquery.flot.pie.min.js')?>"></script>

		<!-- float pie -->
		<script type="text/javascript" src="<?=base_url('js/crizal/admin-template/pages/dashboard.js')?>"></script>

		<!-- custom scripts -->
		<script type="text/javascript" src="<?=base_url('js/main.js')?>"></script>

</html>