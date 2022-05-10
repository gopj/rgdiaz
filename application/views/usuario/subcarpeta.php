<?php 
	$dir = explode('/', $direccion_real);
?>
<div class="container-fluid">
	<div class="card">
		<div class="row">
			<?php if($anterior == "cliente/") { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('usuario/index');?>">
						<button type="submit" class="btn"><i class="icon-arrow-left"></i></button>
					</form>
				</div>
			<?php } else if($anterior == "clientes/") { ?>
				<div class="col-lg-3 " >
					<form method="post" action="<?php echo site_url('usuario/admin_clientes/' . $id_persona);?>">
						<button type="submit" class="btn" ><i class="icon-arrow-left"></i></button>
					</form>
				</div>
			<?php } else if($raiz==$anterior) { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('usuario/subir_archivo');?>">
						<button type="submit" class="btn" ><i class="icon-arrow-left"></i></button>
					</form>
				</div>
			<?php } else { ?>
				<div class="col-lg-3" >
					<form method="post" action="<?php echo site_url('usuario/versubcarpeta');?>">
						<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona">
						<input type="hidden" value="<?php echo $anterior; ?>" name="ruta_carpeta">
						<button type="submit" class="btn btn" ><i class="icon-arrow-left"></i></button>
					</form>
				</div> 
			<?php } ?> 
		</div>
		<h5>Ver Carpetas</h5>
		<?php if ($dir[0] != 'administrador') { ?>
			<i>Ubicación: <?=$direccion_real;?><br/></i>
		<?php } ?>	
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
				<?php foreach ($carpetas->result() as $carpe) { ?>
					<tr>
						<td><img src='img/iconos/folder.png'></td>
						<td>
							<form method='post' action="<?php echo site_url('usuario/versubcarpeta');?>">
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
										<div class="col-lg-12">
											<input type="hidden" value="<?php echo $carpe->id_carpeta.$carpe->nombre; ?>" id="id_formulario_renombra">
											<form id="<?php echo $carpe->id_carpeta.$carpe->nombre; ?>" method='post' action="<?php echo site_url('usuario/versubcarpeta'); ?>">
												<input type="hidden" value="<?php echo $carpe->id_persona; ?>" name="id_persona">
												<input type="hidden" value="<?php echo $carpe->nombre; ?>" name="nombre_carpeta">
												<input type="hidden" name="nombre_nuevo" id="<?php echo $carpe->nombre.$carpe->id_carpeta; ?>">
												<input type="hidden" value="<?php echo $carpe->ruta_carpeta; ?>" name="ruta_carpeta">
												<input type="hidden" value="<?php echo $carpe->ruta_anterior; ?>" name="ruta_anterior">
												<button class="btn btn-primary btn-sm" type="submit" class="btn btn-outline-secondary"> <i class="fas fa-eye"></i> Ver Carpeta </button>
											</form>
										</div>
								
									</div>
								<?php } ?>	
							</div>
						</td>        			
					</tr>
				<?php } ?>						
				<?php foreach ($archivo->result() as $arch) { ?>
						<tr>
						<?php 
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
								<div class="row">
									<div class="col-lg-12">
										<form method='post' action="<?php echo site_url('usuario/descargar'); ?>">
											<input type="hidden" value="<?php echo $arch->nombre; ?>" name="nombre">
											<input type="hidden" value="<?php echo $arch->ruta_archivo; ?>" name="ruta_archivo">
											<button class="btn btn-outline-primary btn-sm" type="submit"> <i class="fas fa-cloud-download-alt"></i> Descargar </button>
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
				<form id="form_carp" action="<?php echo site_url('usuario/crearsubcarpeta');?>" method="post">
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
				<form id="form_archivo" class="form-inline" method="post" action="<?php echo site_url('usuario/subirarchivo');?>" enctype="multipart/form-data">
					Haz click en el boton para seleccionar archivo(s)
					<br>
					<input type="hidden" value="<?php echo $direccion; ?>" name="direccion"/>
					<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
					<input type="hidden" value="<?php echo $direccion; ?>" name="ruta_carpeta">

					<div class="custom-file">
						<input type="file" class="custom-file-input" id="file" multiple="multiple" name="archivo[]">
						<label class="custom-file-label" for="customFile">Selecciona Archivos</label>
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