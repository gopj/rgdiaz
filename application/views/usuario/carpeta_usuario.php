<div class="page-title">
	<h3 class="breadcrumb-header"> Carpeta Personal </h3>
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
									<form method='post' action="<?php echo site_url('usuario/versubcarpeta');?>">
										<input type="hidden" value="<?php echo $id_persona; ?>" name="id_persona"/>
										<input type="hidden" value="<?php echo $path; ?>" name="ruta_carpeta" >
										<input type="hidden" value="<?php echo $file->file_id; ?>" name="file_id" >
										<button type="submit" class="nombre-carpeta" ><?php echo $file->name ?></button>
									</form>
								</td>
								<td><?php echo $file->date; ?></td>   			
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
											<input type="hidden" value="<?php echo $file->file_id; ?>" name="file_id">
											<button class="btn btn-outline-primary btn-sm" type="submit"> <i class="fas fa-cloud-download-alt"></i> Descargar </button>
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