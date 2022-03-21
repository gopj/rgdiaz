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
							<li class="active"><a href="#"><i class="icon-inbox"></i><span>Recibidos</span></a></li>
							<li><a href="#"><i class="icon-send"></i><span>Enviados</span></a></li>
							<li><a href="#"><i class="icon-mail_outline"></i><span>Borradores</span></a></li>
							<li><a href="#"><i class="icon-error"></i><span>No deseados</span></a></li>
							<li class="divider"></li>
							<li><a href="#"><i class="icon-delete"></i><span>Papelera</span></a></li>
						</ul>
					</div>
				</div>
			<div class="col-md-4">
				<div class="email-list">
					<ul class=list-unstyle>
						<li class="active">
							<?php foreach ($todosmensajes as $men) {
								$fecha_completa = $men->fecha;
								$fecha = explode(" ", $fecha_completa);
								echo "<div class=\"card\">";
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
														<input type="hidden" value="<?php echo base64_encode($men->numero); ?>" name="id_contacto"/>
														<button type="submit" class="btn btn-link link-primary" name="detalles" title="Ver Detalles"> <i class="fas fa-envelope-open-text"></i></button>
													</form> 
												</div>
												<div class="col-md-2">	
													<?php $url_delete = site_url('administrador/eliminar_mensaje') . "/" . $men->numero ; ?>
													<button id="del_mensaje" type="button" class="btn btn-link link-danger" name="eliminar" title="Eliminar" data-toggle='modal' data-target='.modal-del-mensaje' onclick='delete_mensaje(<?= $men->numero ?>, <?= "\"$url_delete\"" ?>)'><i class="far fa-trash-alt" ></i> </button>
												</div>
											</div>
										<?php   echo "</div>";
												 echo "</div>"; } ?>
									
						</li>
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
                            <p>Eque porro quisquam est, qui dolorem ipsum quia posuere eget</p>
                        </div>
                        <span class="divider"></span>
                        <div class="email-author">
                            <img src="img/email/1.jpg" alt="">
                            <span class="author-name">Jamara.karle@test.com</span>
                            <span class="email-date">4:14pm</span>
                        </div>
                        <span class="divider"></span>
                    </div>
                    <div class="email-body">
                        <span>
                                Dear Sir/Madam,<br><br>
                                Exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore.<br><br>
                                Waiting your reply ASAP,<br>
                                Thanks in advance.
                            </span>
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