<li><a href="#alta" data-toggle="modal">Dar de alta</a></li>
<li><a href="#baja" data-toggle="modal">Dar de baja</a></li>

<div style="inline:block;">
   <img src="img/glyphicons_010_envelope.png" style="float:left; margin-top:2px; height:18; width:18;"> 
   <span style="float:left; margin-left:10px;">Enviar Correo</span>
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


	<!-- The Modal -->
	<div class="modal" id="modal_nuevo_cliente">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Nuevo cliente</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-9">
							<label class="col-form-label" for="nombre_residuo"> Residuo Peligroso </label>
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
							<div class="invalid-feedback">
								Selecciona residuo peligroso.
							</div>
						</div>	

						<div class="form-group col-md-3">
							<label class="col-form-label" for="clave"> Clave </label>
							<input type="text" class="form-control" id="clave" name="clave" value="Clave" disabled> 
						</div>	
						
					</div>
				</div>
			</div>
			<!-- Body end -->
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>

		</div>
	</div> <!-- Modal end -->

		<!-- The Modal -->
	<div class="modal" id="modal_baja_cliente">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title"> Baja de Cliente </h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<!-- Modal body -->
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-md-9">
							<label class="col-form-label" for="nombre_residuo"> Residuo Peligroso </label>
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
							<div class="invalid-feedback">
								Selecciona residuo peligroso.
							</div>
						</div>	

						<div class="form-group col-md-3">
							<label class="col-form-label" for="clave"> Clave </label>
							<input type="text" class="form-control" id="clave" name="clave" value="Clave" disabled> 
						</div>	
						
					</div>
				</div>
			</div>
			<!-- Body end -->
			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>

		</div>
	</div> <!-- Modal end -->



      <!-- The Modal -->
   <div class="modal" id="modal_baja_cliente">
      <div class="modal-dialog modal-md">
         <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
               <h4 class="modal-title"> Baja de Cliente </h4>
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <div class="form-row">
                  <div class="form-group col-md-8">
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
               </div>

               <!-- Modal footer -->
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <a href="<?=site_url('recolector/eliminar_ultimo_residuo/' . $id_cliente . '/' . $key->id_tran_residuo);?>" class="btn btn-danger" role="button"> Eliminar </a>
               </div>

            </div>
         </div>
      </div>
   </div>