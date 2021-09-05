<main role="main" class="container col-md-10" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content">Manifiestos</h1></center>
	<hr>
	<table id="tabla_manifiestos" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead class="thead-dark">
			<tr>
				<th>Folio</th>
				<th>Empresa Destino</th>
				<th>Fecha de Embarque</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach ($bitacora as $bit) { 
					$fecha =  date_create_from_format("Y-m-d", $bit->fecha_embarque);
			?>	<tr>
					<td style="text-align: center;"> <?= $bit->folio; ?> </td>
					<td> <?= $bit->empresa_destino; ?> </td>
					<td style="text-align: center;"> <?= date_format($fecha, "d/m/Y"); ?> </td>
					<?php if ($bit->status == 'R'){ ?>
						<td style="text-align: center;"> 
							<a href="<?=site_url('administrador/recolector_ver_manifiesto/' . $id_cliente . '/' . $bit->id_tran_folio);?>" class="btn btn-primary btn-sm" role="button"> Ver </a>
							<a href="<?=site_url('administrador/recolector_generar_manifiesto/' . $id_cliente . '/' . $bit->id_tran_folio);?>" class="btn btn-danger btn-sm" role="button"> PDF </a>
						</td>
					<?php } elseif ($bit->status == 'W') {?>
						<td style="text-align: center;"> 
							<a href="<?=site_url('administrador/recolector_crear_manifiestos/' . $id_cliente . '/' . $bit->id_tran_folio);?>" class="btn btn-success btn-sm" role="button"> Terminar </a> 
								
							<a href="<?=base_url('/administrador/recolector_ver_manifiestos/'.$id_cliente)?>" class="btn btn-danger btn-sm" role="button" disabled> PDF </a>
						</td>
					<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Folio</th>
				<th>Empresa Destino</th>
				<th>Fecha de Entrada</th>
				<th>Opciones</th>
			</tr>
		</tfoot>
	</table>

	<a href="<?=site_url('administrador/recolector_crear_manifiesto/' . $id_cliente);?>" class="btn btn-primary" role="button"> Crear Manifiesto</a>
</main>