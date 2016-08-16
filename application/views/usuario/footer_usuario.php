		<!--*********************MODAL DE BITACORA **************************************-->
		<div id="bit" class="modal hide fade">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<big style="font-weight:bold;">Bitacoras</big>
				</div>
				<form id="form_bitacora" method="post" action="<?php echo site_url('cliente/bitacora');?>">
					<div class="modal-body">
						Bitacora
						<div class='input-prepend'>
							<span class='add-on'>
								<img src="img/glyphicons_029_notes_2.png" height="18" width="18">
							</span>
							<select name="id_bitacora" id="id_bitacora">
								<option value="">Seleccione una Bitacora</option>
								<?php 
									foreach($bitacoras->result() as $row){
								?>
									<option value="<?php echo $row->id_tipo_bitacora?>"><?php echo $row->nombre;?></option>
								<?php
									}
								?>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button"  onclick="select_bitacora();" class="btn btn-primary" value="Ver Bitacora">
					</div>
				</form>
			</div>

			<!-- ************************************************************************* -->
			<?php
				$notif = "";
				if (count($new_noti) > 0) {
					$notif = "<div class='cont-not'>";
					foreach ($new_noti as $row) {
						$ruta = $row->ruta_archivo;
						$array = explode("/", $ruta);
						$pos = count($array);
						$notif .= "<div class='notif'><span class='notif1'>Se agregó <b>".$array[$pos-1]."</b> en la carpeta <b>".$array[$pos-2]."</b></span></div>";
					}
					$notif .= "</div>";
				}
			?>
		<footer>
			<div class="footer" style="color:#fff; font-weight:bold; ">
					<div class="container">
						<div style="">
							Derechos reservados &copy;2014 RDíaz
						</div>
						<div class="pull-right" style="font-weight:normal; font-size:14px;">
							Desarrollado por: <a href="http://sharksoft.com.mx" style="color:#fff;" target="_blank">Shark Soft</a>
						</div>
					</div>
				</div>
		</footer>		
	</body>
	<script>
		$(document).ready(function(){
			$('#tabla').dataTable({
              	"bJQueryUI":true
            });
        })
		
		$('#notificaciones').popover({
			animation: true,
			html: true,
			content: "<?php echo $notif; ?>",
			placement: "bottom",
			trigger: "click"
		});

		$('body').on('click', function (e) {
			$('[data-toggle="popover"]').each(function () {
		   		if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
			   		$(this).popover('hide');
		   		}
			});
		});

		$('.dropdown-toggle').dropdown()
	</script>
</html>