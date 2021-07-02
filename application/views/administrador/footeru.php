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
								<?php
                                    foreach($clientes->result() as $row){ 
                                ?>
										<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa;?></option>
								<?php 
									}
								?>
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
						<!-- <div class="pull-right" style="font-weight:normal; font-size:14px;">
							Desarrollado por: Shark Soft
						</div> -->
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
	                
	                /*$('.dropdown-toggle').dropdown();

	                	document.getElementById("file").onchange = this.value;
    					document.getElementById("name").value = this.value;
					};*/
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