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
							Derechos reservados &copy; <?php echo date("Y"); ?> RDíaz
						</div>
						<!-- <div class="pull-right" style="font-weight:normal; font-size:14px;">
							Desarrollado por: <a href="http://gopj.com.mx" style="color:#fff;" target="_blank">Gopycom</a> -->
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