<div class="container">
	<div class="card card-white">
		<div class="page-title">
			<h3 class="breadcrumb-header">Correo electrónico</h3>
		</div>

		<div class="row">
				<div class="col-md-2">
					<div class="email-actions">
						<a href="#" class="btn btn-primary compose">Nuevo</a>
					</div>
					<div class="email-menu">
						<ul class="list-unstyled">
							<li class="active"><a href=""><i class="icon-inbox"></i><span>Recibidos</span></a></li>
							<li><a href=""><i class="icon-send"></i><span>Enviados</span></a></li>
							<li><a href=""><i class="icon-mail_outline"></i><span>Borradores</span></a></li>
							<li><a href=""><i class="icon-error"></i><span>No deseados</span></a></li>
							<li class="divider"></li>
							<li><a href=""><i class="icon-delete"></i><span>Papelera</span></a></li>
						</ul>
					</div>
				</div>
			<div class="col-md-4">
				<div class="email-list">
					<ul class=list-unstyle>
						<?php foreach ($todosmensajes as $men) {
							$fecha_completa = $men->fecha;
							$fecha = explode(" ", $fecha_completa);
							echo "<li>";
							echo "<div class=\"card\" onclick=\"get_message_info(" . $men->numero . ")\">";
								echo "<div class= \"email-list-item\">";
									echo "<div class=\"email-author\">";
										echo "<span class=\"email-date\">".$fecha[0]."</span>";
										echo "<span class=\"author-name\" >".$men->nombre."</span>";
										echo "<div class=\"email-info \">";
											echo "<span class=\"email-subject \">".$men->asunto."</span>";
										echo "</div>";
									echo "</div>";
									?>
									<div class="row" >
										<div class="col-md-2">
											<form method='get' action="<?php echo site_url('administrador/mensaje_completo');?>">
												<input type="hidden" value="<?=$men->numero?>" name="id_contacto" id="id_contacto"/>
												<button type="button" class="btn btn-link link-primary" name="detalles" title="Ver Detalles" onclick="get_message_info(<?=$men->numero?>)"> <i class="fas fa-envelope-open-text"></i></button>
											</form> 
										</div>
										<div class="col-md-2">	
											<?php $url_delete = site_url('administrador/eliminar_mensaje') . "/" . $men->numero ; ?>
											<button id="del_mensaje" type="button" class="btn btn-link link-danger" name="eliminar" title="Eliminar" data-toggle='modal' data-target='.modal-del-mensaje' onclick='delete_mensaje(<?= $men->numero ?>, <?= "\"$url_delete\"" ?>)'><i class="far fa-trash-alt" ></i> </button>
										</div>
									</div>
								<?php   
								echo "</div>";
							echo "</div>"; 
						echo "</li>";
						} ?>	
					</ul>
				</div>
			</div>
			<div class="col-md-6">
                <div class="email-actions">
                    <a href="#" class="btn btn-primary"><i class="fas fa-reply"></i> Responder</a>
                    <a href="#" class="btn btn-secondary"><i class="fas fa-forward"></i> Reenviar</a>
                    <a href="#" class="btn btn-success"><i class="fas fa-check-double"></i> Archivar</a>
                    <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Eliminar</a>
                </div>
                <div class="email">
                    <div class="email-header">
                        <div class="email-title">
                            <span id="email_subject" name="email_subject"></p></span>
                        </div>
                        <span class="divider"></span>
                        <div class="email-author">
                            <span class="email-author" id="email" name="email"></span>
                            <span class="email-date" id="email_date" name="email_date"></span>
                        </div>
                        <span class="divider"></span>
                        <div class="email-author">
                        	<span class="email-author" id="email_phone" name="email_phone"></span>
                        </div>	
                        <span class="divider"></span>
                    </div>
                    <div class="email-body">
                        <span id="email_message" name="email_message"></span>
                    </div>
                    <div class="email-reply">
                        <div class="summernote"></div>
                    </div>
                </div>
            </div>

	
		
		
			
		
	
</div>
</div>

<div class="modal fade modal-del-mensaje" tabindex=-1 role=dialog aria-labelledby=delete_mensaje_modal> <!-- modal bs-modal-del-mensaje -->
	<div class="modal-dialog modal-sm"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button> <h5 class="modal-title" id="delete_mensaje_modal">Eliminar Mensaje </h5>
			</div> 
			<div class=modal-body>
				¿Deseas eliminar el mensaje No. <span id="id_contacto"></span>?
			</div>
			<div class=modal-footer>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
				<a href="" id='mensaje_delete' class='btn btn-danger' role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div>