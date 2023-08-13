<div class="container-fluid">
	<div class="card">
		<div class="row">
			<?php if ($old_parent_id == 0) { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('administrador/admin_clientes/' . $path);?>">
						<button type="submit" class="btn btn" ><i class="icon-arrow-left"></i></button>
					</form>
				</div> 
			<?php } else { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('administrador/versubcarpeta');?>">
						<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
						<input type="hidden" value="<?php echo $old_parent_id; ?>" name="file_id">
						<button type="submit" class="btn btn" ><i class="icon-arrow-left"></i></button>
					</form>
				</div> 
			<?php } ?>
		</div>
		<h5>Administrar Carpetas</h5>
		<i>Ubicación: <?php echo 'clientes/' . $path; ?><br/></i>

		<div class="row justify-content-end">
				<button class="btn btn-outline-primary mx-2" href="#cate" data-toggle="modal" ><i class="icon-folder px-1"></i> Nueva Carpeta</button>
				<button class="btn btn-outline-primary" href="#upload" data-toggle="modal"><i class="icon-plus px-1"></i> Agregar Archivo(s)</button>
		</div>
	</div> 

	<div class="card">
		<table id="generic_table" class="display table table-striped table-bordered">
			<thead class="thead-dark">
				<tr>
					<th style="width:5%;"></th>
					<th style="width:55%;">Nombre</th>
					<th style="width:20%;">Fecha</th>
					<th style="width:30%;">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($subfolder as $file) { ?>
					<?php if ($file->type == 'folder') { ?>
							<tr>
								<td><img src='img/iconos/folder.png'></td>
								<td>
									<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
										<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
										<input type="hidden" value="<?php echo $path; ?>" name="ruta_carpeta" >
										<input type="hidden" value="<?php echo $file->file_id; ?>" name="file_id" >
										<button type="submit" class="nombre-carpeta" ><?php echo $file->name ?></button>
									</form>
								</td>
								<td><?php echo $file->date; ?></td>
								<td align="center">
									<div class="row-fluid" style="margin-top:10px;">
										<?php if ( $file->name != "Documentos de RDiaz" ) { ?> 
											<div class="row">
												<div class="col-lg-6">
													<input type="hidden" value="<?php echo $path; ?>" name="ruta_carpeta">
													<button class="btn btn-outline-secondary btn-sm" type="button" class="btn btn-outline-secondary" href="#rename" data-toggle="modal" onclick="send_file_id(<?=$file->file_id?>, '<?=$file->name?>')"> <i class="fas fa-edit"></i> Renombrar </button>
												</div>
												<div class="col-lg-6">
													<form id="form_eliminar_carpeta" method='post' action="<?php echo site_url('administrador/eliminar_carpeta'); ?>">
														<input type="hidden" value="<?php echo $file->file_id; ?>" id="id_carpeta" name="id_carpeta">
														<input type="hidden" value="<?php echo $path; ?>" id="ruta_carpeta" name="ruta_carpeta">
														<button class="btn btn-outline-danger btn-sm" type="submit"> <i class="fas fa-trash"></i> Eliminar </button>
													</form>
												</div>
											</div>
										<?php } ?>	
									</div>
								</td>        			
							</tr>
					<?php } elseif ($file->type == 'file') {
						# code...
							echo '<tr>';
							$ext = explode('.', $file->name);
							$extension = array_pop($ext);
							if($extension=='pdf'){
								echo "<td><img src='img/iconos/pdf.png'></td>";
							}elseif($extension=='xls' || $extension=='xlsx'){
								echo "<td><img src='img/iconos/xls.png'></td>";
							}elseif($extension=='doc'|| $extension=='docx'){
								echo "<td><img src='img/iconos/doc.png'></td>";
							}elseif($extension=='jpg' || $extension=='JPG'){
								echo "<td><img src='img/iconos/jpg.png'></td>";
							}elseif($extension=='jpeg' || $extension=='JPEG'){
								echo "<td><img src='img/iconos/jpeg.png'></td>";
							}elseif($extension=='png' || $extension=='PNG'){
								echo "<td><img src='img/iconos/png.png'></td>";
							}elseif($extension=='gif'){
								echo "<td><img src='img/iconos/gif.png'></td>";
							}elseif($extension=='txt'){
								echo "<td><img src='img/iconos/txt.png'></td>";
							} else {
								echo "<td><img src='img/iconos/unk.png'></td>";
							}
							echo "<td>".$file->name."</td>";
							echo "<td>".$file->date."</td>";
						?>
					
							<td align="center">
								<div class="row">
									<div class="col-lg-6">
										<form method='post' action="<?php echo site_url('administrador/descargar'); ?>">
											<input type="hidden" value="<?php echo $file->name; ?>" name="nombre">
											<input type="hidden" value="<?php echo $path; ?>" name="ruta_archivo">
											<button class="btn btn-outline-primary btn-sm" type="submit"> <i class="fas fa-cloud-download-alt"></i> Descargar </button>
										</form>
									</div>
									<div class="col-lg-6">
										<form id="form_eliminar" method='post' action="<?php echo site_url('administrador/eliminar_archivo');?>">
											<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
											<input type="hidden" value="<?php echo $file->file_id; ?>" name="id_archivo">
											<input type="hidden" value="<?php echo $path; ?>" name="ruta_archivo" >
											<input type="hidden" value="<?php echo $file->parent_id; ?>" name="ruta_carpeta_pertenece" >
											<button class="btn btn-outline-danger btn-sm" type="submit"> <i class="fas fa-trash"></i> Eliminar </button>
										</form>
									</div>
								</div>
							</td>
						</tr>
					<?php } ?>						
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Agregar Carpeta Start-->
<div class="modal" id="cate">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title">Agregar Carpeta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				<form id="form_nombrecarpeta" action="<?php echo site_url('administrador/crearsubcarpeta');?>" method="post">
					<input type="hidden" value="<?php echo $parent_id; ?>" name="file_id"/>
					<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
					Nombre de la carpeta:
					<div class='input-prepend'>
						<span class='add-on'>
								<img src="img/glyphicons_144_folder_open.png" class="icon-form">
						</span>
						<input id="nombrecarpeta" class="txt-modal" type='text' name="nombrecarpeta">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-primary" onclick="valida_nom_carpeta('nombrecarpeta')" value="Crear Carpeta">
			</div>
		</div> 
	</div>
</div>
<!-- Modal Agregar Carpeta End-->

<!-- Modal Renombrar Carpeta Start-->
<div class="modal" id="rename">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title" >Renombrar Carpeta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				<form id="form_rename_folder" action="<?php echo site_url('administrador/renombrar_carpeta');?>" method="post">
					<input type="hidden" value="" id="file_id_update" name="file_id"/>
					<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
					Nombre de la carpeta:
					<div class='input-prepend'>
						<span class='add-on'>
								<img src="img/glyphicons_144_folder_open.png" class="icon-form">
						</span>
						<input id="rename_folder" class="txt-modal" type='text' name="rename_folder">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-primary" onclick="valida_nom_carpeta('rename_folder')" value="Renombrar Carpeta">
			</div>
		</div> 
	</div>
</div>
<!-- Modal Agregar Carpeta End-->

<!-- Modal Subir Archivos Start-->
<div class="modal" id="upload">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title">Subir Archivo(s)</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				<form id="form_archivo" class="form-inline" method="post" enctype="multipart/form-data" action="<?php echo site_url('administrador/subir_archivos');?>">
					Haz click en el boton para seleccionar archivo(s)
					<br>
					<input type="hidden" value="<?php echo $old_parent_id; ?>" name="file_id"/>
					<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>

					<div class="custom-file">
						<input type="file" id="files" name="files[]" multiple>
						<label class="custom-file-label" for="files">Selecciona Archivos</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-primary" onclick="valida_archivo()" value="Guardar Archivos">
			</div>
		</div> 
	</div>
</div>
<!-- Modal Subir Archivos End-->