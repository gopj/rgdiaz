<?php ob_start(); ?>
<!DOCTYPE html>
	<html>
		<head>
			<base href="<?=base_url()?>"/>
			<title>RDíaz</title>
			<link href="<?=base_url('img/minilogo.png')?>" type="image/x-icon" rel="shortcut icon" />
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap-responsive.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/datepicker.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/estilos.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/demo_table_jui.css')?>">
			<link rel="stylesheet" type="text/css" href="<?=base_url('css/jquery-ui-1.8.4.custom.css')?>">
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
		</head>
		<body>
			<nav>
				<div class="navbar navbar-fixed-top">
					<div class="navbar-inner">
						<div class="container">
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<a href="<?=base_url('administrador')?>" class="brand"><?php echo $this->session->userdata('nombre');?></a>
							<div class="collapse nav-collapse">
								<ul class="nav pull-right">
									<li class="divider-vertical"></li>
									<li><a href="<?=base_url('administrador')?>">Mi carpeta</a></li>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Clientes<b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="#alta" data-toggle="modal">Dar de alta</a></li>
											<li><a href="#baja" data-toggle="modal">Dar de baja</a></li>
											<li><a href="<?=base_url('administrador/admin_clientes') ?>">Consulta</a></li>
										</ul>
									</li>
									<li class="divider-vertical"></li>
									<li class="dropdown">
										<a href="" class="dropdown-toggle" data-toggle="dropdown">Recolectores<b class="caret"></b></a>
										<ul class="dropdown-menu"> 
												<li><a href="<?=base_url('admin/recolector_consulta')?>">Consultas</a></li>
												<li><a href="<?=base_url('admin/recolector_index') ?>">Manifiestos</a></li>
												<li><a href="<?=base_url('admin/recolector_bitacora') ?>">Bitacora</a></li>
										</ul>
									</li>
									
									<li class="divider-vertical"></li>
									<li><a href="<?=base_url('administrador/subir_archivo');?>">Administrar Carpetas</a></li>
									<li class="divider-vertical"></li>
									<li>
									<li><a href="<?=base_url('home/logout');?>" style="margin-top:-10px;"><button type="button" class="btn btn-primary">Cerrar Sesión</button></a></li>
									<li class="divider-vertical"></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>

			<div class="container" style="padding-top:50px;">
				<div class="row">
					<div class="span12">
						<img src="img/logo.png" height="300" width="300">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="span3">								
					<form  method="post" action="<?=base_url('administrador/mensajes_contacto')?>">
							<button class="well-notificacion" type="submit">
								<div style="inline:block;">
									<img src="img/glyphicons_245_chat.png" style="float:left; margin-top:2px; height:18; width:18;"> 
									<span style="float:left; margin-left:10px;">Mensajes de Contacto</span>
									<span class="badge barrabackground" style="float:right; margin-top:2px;"><?php echo $mensajes; ?></span>
								</div>
							</button>
						</form>
						<br>
					<form>
						<button class="well-notificacion" href="#correo" data-toggle="modal">
							<div style="inline:block;">
								<img src="img/glyphicons_010_envelope.png" style="float:left; margin-top:2px; height:18; width:18;"> 
								<span style="float:left; margin-left:10px;">Enviar Correo</span>
							</div>
						</button>
					</form>
				</div>
			

			<?php echo $output; ?>
			
			</div>

			<!-- MODAL DE ENVIAR CORREO ELECTRONICO -->
			<div id="correo" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<big style="font-weight:bold;">Enviar Correo</big>
				</div>
				
				<form id="form_correo_admin">
					<div class="modal-body">
						LISTA DE CLIENTES: <br/>
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_003_user.png" class="icon-form">
							</span>
							<select name="id_persona" id="id_persona">
								<option value="">Seleccione Cliente </option>
								<?php
                                    foreach($clientes->result() as $row){ 
                                ?>
										<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre;?></option>
								<?php 
									}
								?>
							</select>
						</div>
						Asunto:
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_065_tag.png" class="icon-form">
							</span>
							<input class="txt-well" id="asunto_correo" type='text'>
						</div>
						Mensaje:
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_245_chat.png" class="icon-form">
							</span>
							<textarea class="txt-well" id="mensaje_correo" rows='4' cols="20"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-primary" onclick="envia_correo_admin()" value="Enviar">
					</div>
				</form>
			</div>
			<!-- ********************************************************************************** -->
			<!-- MODAL DE ALTA DE CLIENTE -->
			<div id="alta" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<big style="font-weight:bold;">Alta de Cliente</big>
				</div>
				<form id="form_alta_cliente2" method="post" action="<?php echo site_url('administrador/alta_cliente'); ?>">
					<div class="modal-body">
						Correo Electrónico:
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_003_user.png" class="icon-form">
							</span>
							<input class="txt-modal" type="text" id="alta_correo" name="correo"/>
						</div>
						<br/>
						Nota: se le enviara automáticamente al cliente un correo con su usuario y contraseña.
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-primary"  onclick="alta_cliente();" value="Dar de Alta">
						<a href="<?php echo site_url('administrador/alta_cliente_admin'); ?>" class="btn btn-primary">Dar de alta y registrar datos</a>
					</div>
				</form>
			</div>
			<!-- ********************************************************************************** -->
			<!-- MODAL DE BAJA CLIENTE -->
			<div id="baja" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<big style="font-weight:bold;">Baja de Cliente</big>
				</div>
				<form id="baja_cliente" method="post" action="<?php echo site_url('administrador/baja_cliente'); ?>">
					<div class="modal-body">
						Usuario:
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_003_user.png" class="icon-form">
							</span>
							<select name="id_persona" id="id_persona_baja"><!--Mandamos una bandera para ver si ingreso un cliente-->
								<option value="0">Seleccione cliente</option>
								<?php foreach($clientes->result() as $row){ ?>
									<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa;?></option>
								<?php } ?>
							</select>
						</div>
						Razón:
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_030_pencil.png" class="icon-form">
							</span>
							<input id="razon" class="txt-modal" name="razon" type='text'>
						</div>
						<br/>
						Nota: se le enviara automáticamente al cliente un correo notificandole que a sido dado de baja.
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-primary" onclick="cliente_baja();" value="Dar de Baja">
					</div>
				</form>
			</div>
			<!-- ********************************************************************************** -->
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
	                	"bJQueryUI":true,
	                	"iDisplayLength": 200,
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