<main role="main" class="container col-md-10">
	<form class="form-inline" role="form" autocomplete="off" method='post' id='form_bitacora' action="<?php echo site_url('administrador/recolector_bitacora');?>">
		<div class="form-row">

			<div class="form-group col-md-4">
				<h2 class="bd-title">Bitacora</h2>
			</div>


			<div class="form-group col-md-3">

				<label for="fecha_embarque">Fecha</label>
				<input class="form-control form-control-sm" id="fecha_embarque" name="fecha_embarque" style="text-align: center;">
			</div>

			<div class="form-group col-md-4">

				<label for="fecha">Otro</label>
				<input class="form-control form-control-sm">
			</div>
			
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