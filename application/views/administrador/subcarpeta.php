<div class="container-fluid">
	<div class="card">
		<div class="row">
			<?php if($anterior == "administrador/") { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('administrador');?>">
						<button type="submit" class="btn " disabled><i class="icon-arrow-left"></i></button>
					</form>
				</div>
			<?php } else if($anterior == "clientes/") { ?>
				<div class="col-lg-3 " >
					<form method="post" action="<?php echo site_url('administrador/admin_clientes/' . $id_persona);?>">
						<button type="submit" class="btn " ><i class="icon-arrow-left"></i></button>
					</form>
				</div>
			<?php } else if($raiz==$anterior) { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('administrador/subir_archivo');?>">
						<button type="submit" class="btn " ><i class="icon-arrow-left"></i></button>
					</form>
				</div>
			<?php } else { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('administrador/versubcarpeta');?>">
						<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
						<input type="hidden" value="<?php echo $anterior; ?>" name="ruta_carpeta">
						<button type="submit" class="btn btn " ><i class="icon-arrow-left"></i></button>
					</form>
				</div> 
			<?php } ?> 
		</div>
		<h5>Administrar Carpetas</h5>
		<i>Ubicación: <?php echo $direccion_real; ?><br/></i>

		<div class="row justify-content-end">
				<button class="btn btn-outline-primary mx-2" href="#cate" data-toggle="modal" ><i class="icon-folder px-1"></i> Nueva Carpeta</button>
				<button class="btn btn-outline-primary" href="#upload" data-toggle="modal"><i class="icon-plus px-1"></i> Agregar Archivo(s)</button>
		</div>
	</div> 

	<div class="card">
		<table id="tabla" class="display">
			<thead>
				<tr>
					<th style="width:5%;"></th>
					<th style="width:55%;">Nombre</th>
					<th style="width:20%;">Fecha</th>
					<th style="width:30%;">Acciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($carpetas->result() as $carpe) { ?>
					<tr>
						<td><img src='img/iconos/folder.png'></td>
						<td>
							<form method='post' action="<?php echo site_url('administrador/versubcarpeta');?>">
								<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona"/>
								<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta" >
								<button type="submit" class="nombre-carpeta" ><?php echo $carpe->nombre?></button>
							</form>
						</td>
						<td><?php echo $carpe->fecha_creada; ?></td>
						<td align="center">
							<div class="row-fluid" style="margin-top:10px;">
								<?php if ( $carpe->nombre != "Documentos de RDiaz" ) { ?> 
									<div class="row">
										<div class="col-lg-6">
											<input type="hidden" value="<?php echo $carpe->id_carpeta.$carpe->nombre; ?>" id="id_formulario_renombra">                       
											<form id="<?php echo $carpe->id_carpeta.$carpe->nombre; ?>" method='post' action="<?php echo site_url('administrador/renombrar_carpeta'); ?>">
												<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
												<input type="hidden" value="<?php echo $carpe->nombre; ?>" name="nombre_carpeta">
												<input type="hidden" name="nombre_nuevo" id="<?php echo $carpe->nombre.$carpe->id_carpeta; ?>">
												<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta">
												<input type="hidden" value="<?php echo $carpe->ruta_anterior; ?>" name="ruta_anterior">
												<input type="button" class="btn btn-outline-secondary" onclick="abrir_modal('<?php echo $carpe->id_carpeta.$carpe->nombre; ?>', '<?php echo $carpe->nombre.$carpe->id_carpeta; ?>');" value="Renombrar">
											</form>
										</div>
										<div class="col-lg-6">
											<form id="form_eliminar_carpeta" method='post' action="<?php echo site_url('administrador/eliminar_carpeta'); ?>">
												<input type="hidden" value="<?php echo $carpe->id_persona; ?>" id="id_persona" name="id_persona">
												<input type="hidden" value="<?php echo $carpe->id_carpeta; ?>" id="id_carpeta" name="id_carpeta">
												<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" id="ruta_carpeta" name="ruta_carpeta">
												<input type="hidden" value="<?php echo $carpe->ruta_anterior; ?>" id="ruta_carpeta" name="ruta_anterior">
												<input class="btn btn-outline-danger" type="submit"  value="Eliminar">
											</form>
										</div>
									</div>
								<?php } ?>	
							</div>
						</td>        			
					</tr>
				<?php } ?>						
				<?php 
					foreach ($archivo->result() as $arch) {
						echo "<tr>";
							$ext = explode('.', $arch->nombre);
							$extencion = array_pop($ext);
							if($extencion=='pdf'){
								echo "<td><img src='img/iconos/pdf.png'></td>";
							}elseif($extencion=='xls' || $extencion=='xlsx'){
								echo "<td><img src='img/iconos/xls.png'></td>";
							}elseif($extencion=='doc'|| $extencion=='docx'){
								echo "<td><img src='img/iconos/doc.png'></td>";
							}elseif($extencion=='jpg' || $extencion=='JPG'){
								echo "<td><img src='img/iconos/jpg.png'></td>";
							}elseif($extencion=='jpeg' || $extencion=='JPEG'){
								echo "<td><img src='img/iconos/jpeg.png'></td>";
							}elseif($extencion=='png' || $extencion=='PNG'){
								echo "<td><img src='img/iconos/png.png'></td>";
							}elseif($extencion=='gif'){
								echo "<td><img src='img/iconos/gif.png'></td>";
							}elseif($extencion=='txt'){
								echo "<td><img src='img/iconos/txt.png'></td>";
							} else {
								echo "<td><img src='img/iconos/unk.png'></td>";
							}
							echo "<td>".$arch->nombre."</td>";
							echo "<td>".$arch->fecha_subida."</td>";
							$array_ruta = explode("/", $arch->ruta_archivo);
							$id_per_arc = $array_ruta[1]; ?>

							<td align="center">
								<div class="row-fluid" style="margin-top:10px;">
									<div class="span6">
										<form method='post' action="<?php echo site_url('administrador/descargar'); ?>">
											<input type="hidden" value="<?php echo $arch->nombre; ?>" name="nombre">
											<input type="hidden" value="<?php echo $arch->ruta_archivo; ?>" name="ruta_archivo">
											<input class="btn btn-mini btn-primary"  type="submit" value="Descargar">
										</form>
									</div>
									<div class="span6">
										<form id="form_eliminar" method='post' action="<?php echo site_url('administrador/eliminar_archivo');?>">
											<input type="hidden" value="<?php echo $id_per_arc; ?>" name="id_persona">
											<input type="hidden" value="<?php echo $arch->id_archivo; ?>" name="id_archivo">
											<input type="hidden" value="<?php echo $arch->ruta_archivo; ?>" name="ruta_archivo" >
											<input type="hidden" value="<?php echo $arch->ruta_carpeta_pertenece; ?>" name="ruta_carpeta_pertenece" >
											<input class="btn btn-mini btn-primary"  type="submit"  value="Eliminar">
										</form>
									</div>
								</div>
							</td>
						</tr>
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
				<form id="form_carp" action="<?php echo site_url('administrador/crearsubcarpeta');?>" method="post">
					<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
					<input type="hidden" value="<?php echo $direccion; ?>" name="direccion"/>
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
				<input type="button" class="btn btn-primary" onclick="valida_nom_carpeta()" value="Crear Carpeta">
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
				<form id="form_archivo" method="post" action="<?php echo site_url('administrador/subirarchivo');?>" enctype="multipart/form-data">
					Haz click en el boton para seleccionar archivo(s)
					<br>
					<input type="hidden" value="<?php echo $direccion; ?>" name="direccion"/>
					<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
					<input type="hidden" value="<?php echo $direccion; ?>" name="ruta_carpeta">
					<input id="name" class="input-file" readonly/>
					<label for="file" class="btn btn-primary" >Seleccionar</label>
					<input id="file" type="file" name="archivo[]" multiple="multiple">
				</form>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-primary" onclick="valida_archivo()" value="Guardar Archivos">
			</div>
		</div> 
	</div>
</div>
<!-- Modal Subir Archivos End-->

<!-- Modal Renombrar Carpeta Start-->
<div class="modal" id="renombrar">
	<div class="modal-dialog modal-md"> 
		<div class="modal-content"> 
			<div class="modal-header"> 
				<h5 class="modal-title" >Renombrar Carpeta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div> 
			<div class=modal-body>
				Nombre de la carpeta:
				<div class='input-prepend'>
					<span class='add-on'>
						<img src="img/glyphicons_144_folder_open.png" class="icon-form">
					</span>
					<input type="text" class="txt-modal" id="nuevo_nombre">
				</div>
			</div>
			<div class="modal-footer">
				<input type="button" class="btn btn-primary" onclick="renombrar_carpeta();" value="Cambiar">
			</div>
		</div> 
	</div>
</div>
<!-- Modal Renombrar Carpeta End-->

<script>
	var id_formulario_renombrar;
	var id_hidden_nuevo_nombre;

	function abrir_modal(id_formulario, id_hidden) {
		id_formulario_renombrar = id_formulario;
		id_hidden_nuevo_nombre = id_hidden;
		$('#renombrar').modal('show');
	}
	
	function renombrar_carpeta() {
		if(document.getElementById('nuevo_nombre').value == "")  {
			alert('EL CAMPO NOMBRE ES REQUERIDO');
			document.getElementById('nuevo_nombre').focus();
		} else {
			document.getElementById(id_hidden_nuevo_nombre).value = document.getElementById('nuevo_nombre').value;
			document.getElementById(id_formulario_renombrar).submit();
		}
	}
</script>