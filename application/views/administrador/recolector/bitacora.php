<main role="main" class="container col-md-10">
	<form class="form-inline">
		<div class="form-row">
			<h2 class="bd-title" id="content">Bitacora</h2>
			<input class="form-control col-md-6" id="fecha_embarque" name="fecha_embarque">
		</div>
		
	</form>
	
	<hr>
	<table id="tabla_manifiestos" class="table table-striped table-bordered table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Folio</th>
				<th>Nombre del Generador</th>
				<!-- <th>Empresa Destino</th> -->
				<th>Recolector</th>
				<th>Placa</th>
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
					<td style="text-align: center;"> <?= $bit->nombre_generador; ?> </td>
					<!-- <td> <?= $bit->nombre_destino; ?> </td> -->
					<td style="text-align: center;"> <?= $bit->nombre ?> </td>
					<td style="text-align: center;"> <?= $bit->numero_placa ?> </td>
					<td style="text-align: center;"> <?= date_format($fecha, "d/m/Y"); ?> </td>
					<td style="text-align: center;">  <a href="<?=site_url('administrador/recolector_ver_manifiesto/' . $bit->id_persona . '/' . $bit->id_tran_folio);?>" class="btn btn-primary btn-sm" role="button"> Ver </a> </td>
				</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th>Folio</th>
				<th>Nombre del Generador</th>
				<!-- <th>Empresa Destino</th> -->
				<th>Recolector</th>
				<th>Placa</th>
				<th>Fecha de Embarque</th>
				<th>Opciones</th>
			</tr>
		</tfoot>
	</table>
</main>