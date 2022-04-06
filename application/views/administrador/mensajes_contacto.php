<main role="main" class="container col-md-10">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Mensajes de Contacto </h3>
	</div>
	<div class="card card-white">
		<!-- start page main wrapper -->
		<div id="main-wrapper">
			<div class="row">
				<div class="col-md-12">
					<div class="input-group email-search">
						<input type="text" class="form-control" placeholder="Busca mensaje" id="input_busca_mensaje">
						<span class="input-group-prepend last">
							<button class="btn btn-primary" type="button">Buscar</button>
						</span>
					</div>
				</div>
			</div>
			<!-- Row -->
			<div class="cross-page-line"></div>
			<div class="row">
				<div class="col-md-4">
					<div class="email-list">
						<ul class="list-unstyled" id="messaje_list">
							<?php foreach ($todosmensajes as $men) {
								$fecha = explode(" ", $men->fecha);
							?>
							<li id="<?=$men->numero?>">
								<a onclick="get_message_info(<?=$men->numero?>)">
									<div class="email-list-item" onclick="get_message_info(<?=$men->numero?>)">
										<div class="email-author">
											<span class="author-name"><?=$men->nombre?></span>
											<span class="email-date"><?=$fecha[0]?></span>
										</div>
										<div class="email-info">
											<span class="email-subject">
												<?=$men->asunto?>
											</span>
											<span class="email-text">
												<?=$men->mensaje?>
											</span>
										</div>
									</div>
								</a>
							</li>
							<?php }?>                                 
						</ul>
					</div>
				</div>
				<div class="col-md-8">
					<div class="email-actions">
						<a href="#" class="btn btn-primary"><i class="fas fa-reply"></i> Responder</a>
						<a href="#" class="btn btn-secondary"><i class="fas fa-forward"></i>Reenviar</a>
						<a href="#" class="btn btn-success"><i class="fas fa-check-double"></i> Marcar como leido</a>
						<a class="btn btn-danger" id="delete_message" data-toggle='modal' data-target='.modal-del-mensaje'><i class="fas fa-trash-alt" ></i> Borrar</a>

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
						</div>
						<div class="email-body">
							<span id="email_message" name="email_message"></span>
						</div>
					</div>
				</div>
			</div>
			<!-- Row -->
		</div>
	</div>
</main>
<!-- end page inner -->
	
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