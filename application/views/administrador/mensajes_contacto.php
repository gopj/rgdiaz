<main role="main" class="container col-md-10">
	<div class="page-title">
		<h3 class="breadcrumb-header"> Mensajes de Contacto </h3>
	</div>
	<div class="col-md-12">
		<div class="card card-white">
			<div class="card-body">

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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<!-- start page inner -->
<div class="page-inner">
	<div class="page-title">
		<h3 class="breadcrumb-header">Mensajes de Contacto</h3>
	</div>
	<!-- start page main wrapper -->
	<div id="main-wrapper">
		<div class="row">
			<div class="col-md-12">
				<div class="input-group email-search">
					<input type="text" class="form-control" placeholder="Busca mensaje">
					<span class="input-group-prepend last">
							<button class="btn btn-primary" type="button">Buscar</button>
						</span>
				</div>
			</div>
		</div>
		<!-- Row -->
		<div class="cross-page-line"></div>
		<div class="row">
			<div class="col-md-5">
				<div class="email-list">
					<ul class="list-unstyled">
						<li class="active">
							<a href="#">
								<div class="email-list-item">
									<div class="email-author">
										<img src="img/email/1.jpg" alt="">
										<span class="author-name">Jamara Karle</span>
										<span class="email-date">8m ago</span>
									</div>
									<div class="email-info">
										<span class="email-subject">
												Eque porro quisquam est, qui dolorem ipsum quia posuere eget
											</span>
										<span class="email-text">
												Tempora incidunt ut labore et dolore magnam aliquam quaerat
											</span>
									</div>
								</div>
							</a>
						</li>
						<li>
							<a href="#">
								<div class="email-list-item">
									<div class="email-author">
										<img src="img/email/2.jpg" alt="">
										<span class="author-name">Keir Prestonly</span>
										<span class="email-date">5:55pm</span>
									</div>
									<div class="email-info">
										<span class="email-subject">
												Mollit anim id est laborum perspiciatis unde
											</span>
										<span class="email-text">
											   Voluptate velit esse cillum dolore eu fugiat nulla
											</span>
									</div>
								</div>
							</a>
						</li>                                    
					</ul>
				</div>
			</div>
			<div class="col-md-7">
				<div class="email-actions">
					<a href="#" class="btn btn-primary"><i class="fas fa-reply"></i> Reply</a>
					<a href="#" class="btn btn-secondary"><i class="fas fa-forward"></i> Forward</a>
					<a href="#" class="btn btn-success"><i class="fas fa-check-double"></i> Mark as read</a>
					<a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
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
		<!-- Row -->
	</div>
	<!-- end page main wrapper -->
	<div class="page-footer">
		<p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Crizal All rights reserved.</p>
	</div>
</div>
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