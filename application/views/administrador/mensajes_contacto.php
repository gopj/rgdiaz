<main role="main" class="container col-md-12">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Mensajes de Contacto </h3>
	</div>
	<div class="card card-white">
		<!-- start page main wrapper -->
		<div id="main-wrapper">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<div class="input-group email-search">
							<div class="input-group mb-2 mr-sm-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Buscar</div>
								</div>
								<input type="text" class="form-control" placeholder="" id="input_busca_mensaje">
							</div>
						</div>
					</div>
				</div>
				<!-- Row -->
				<div class="cross-page-line"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="email-list">
							<ul class="list-unstyled" id="message_list">
								<?php foreach ($todosmensajes as $men) {
									$fecha = explode(" ", $men->fecha);
								?>
								<li id="card-list">
									<a onclick="get_message_info(<?=$men->numero?>)">
										<div class="email-list-item" onclick="get_message_info(<?=$men->numero?>)">
											<div class="email-author">
													<span class="author-name"> <?=$men->nombre?> 
														<?php if ($men->status == 'no leido') {
															echo "&nbsp; <span id='" . $men->numero . "' class='fas fa-eye-slash' style='color: #86BC42'></span>";
														}?>
													</span>
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
							<button type="button" class="btn btn-success" id="mark_read"><i class="fas fa-check-double"></i> Marcar como leido</button>
							<button type="button" class="btn btn-danger" id="delete_message" data-toggle="modal" data-target="#modal_elimina_mensaje"><i class="fas fa-trash-alt" ></i> Borrar</button>
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
						</div>
					</div>
				</div>
				<!-- Row -->
			</div>	
		</div>
	</div>
</main>
<!-- end page inner -->

<!-- Modal Baja Cliente Start-->
<div class="modal" id="modal_elimina_mensaje">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title" >Eliminar Mensaje</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				<div class="form-group col-md-12">
					¿Deseas eliminar el mensaje No. <span id="id_contacto"></span>?
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<a href="" id='mensaje_delete' class='btn btn-danger' role='button'> Eliminar</a>
			</div>
		</div> 
	</div>
</div>
<!-- Modal Baja Cliente End-->



