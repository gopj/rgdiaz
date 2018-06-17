<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content">Manifiestos</h1></center>
	<hr>
	<table id="tabla_manifiestos" class="table table-striped table-bordered" style="width:100%">
		<thead>
			<tr>
				<th>Folio</th>
				<th>Empresa Destino</th>
				<th>Fecha de Embarque</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($bitacora as $bit) { ?>			
				<tr>
					<td> <?= $bit->folio; ?> </td>
					<td> <?= $bit->empresa_destino; ?> </td>
					<td> <?= $bit->fecha_ingreso; ?> </td>
					<?php if ($bit->status == 'R'){ ?>
						<td style="text-align: center;"> <a href="<?=site_url('recolector/ver_manifiesto/' . $id_cliente . '/' . $bit->folio);?>" class="btn btn-primary btn-sm btn-block" role="button"> Ver </button> </td>
					<?php } elseif ($bit->status == 'W') {?>
						<td> <a href="<?=site_url('recolector/crear_manifiestos/' . $id_cliente . '/' . $bit->folio);?>" class="btn btn-success btn-sm btn-block" role="button"> Terminar </button> </td>
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

	<a href="<?=site_url('recolector/crear_manifiesto/' . $id_cliente);?>" class="btn btn-primary" role="button"> Crear Manifiesto</a>
</main>