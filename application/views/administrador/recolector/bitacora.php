<?php $this->session->set_userdata('url', 'from_bitacora'); ?>
<main role="main" class="container col-md-10">

	<div class="form-group col-md-4">
		<h2 class="bd-title">Bitacora</h2>
	</div>

	<form class="form-inline col-md-12" role="form" autocomplete="off" method='post' id='form_bitacora' action="<?= site_url('admin/recolector_bitacora');?>">
		
		<div class="form-group col-md-3">
			<label for="fecha_embarque">Fecha</label>
			<input class="form-control " id="fecha_embarque" name="fecha_embarque" style="text-align: center;" value="<?= @$fecha_embarque ?>">
		</div>

		<div class="form-group col-md-2">
			<label for="fecha">Tipo</label>
			<select class="form-control" name="tipo" id="tipo">
				<option value=""> Todos </option>
				<option value="W" <?php if(@$tipo=='W'){echo "selected";}?>> Pendientes </option>
				<option value="R" <?php if(@$tipo=='R'){echo "selected";}?>> Completados </option>
			</select>

		</div>

		<div class="form-group col-md-1">	
			<input class="btn-sm btn-primary" type="submit" name="submit_form_bitacora" value="Buscar">
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
					<?php if ($bit->status == 'W'){ ?>
						<td style="text-align: center;">  <a href="<?=site_url('admin/recolector_crear_manifiestos/' . $bit->id_persona . '/' . $bit->id_tran_folio);?>" class="btn btn-success btn-sm" role="button"> Terminar </a> </td>
					<?php } else { ?>
						<td style="text-align: center;">  <a href="<?=site_url('admin/recolector_ver_manifiesto/' . $bit->id_persona . '/' . $bit->id_tran_folio);?>" class="btn btn-primary btn-sm" role="button"> Ver </a> </td>
					<?php }?>
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