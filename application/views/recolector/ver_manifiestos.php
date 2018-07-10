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
			<?php 
				foreach ($bitacora as $bit) { 
					$fecha =  date_create_from_format("Y-m-d", $bit->fecha_ingreso);
			?>			
				<tr>
					<td style="text-align: center;"> <?= $id_cliente . "-" . $bit->folio; ?> </td>
					<td> <?= $bit->empresa_destino; ?> </td>
					<td style="text-align: center;"> <?= date_format($fecha, "d/m/Y"); ?> </td>
					<?php if ($bit->status == 'R'){ ?>
						<td style="text-align: center;"> 
							<a href="<?=site_url('recolector/ver_manifiesto/' . $id_cliente . '/' . $bit->folio);?>" class="btn btn-primary btn-sm" role="button"> Ver </button> 

								<a href="<?=site_url('recolector/generar_manifiesto/' . $id_cliente . '/' . $bit->folio);?>" class="btn btn-danger btn-sm" role="button"> PDF </button>
						</td>
					<?php } elseif ($bit->status == 'W') {?>
						<td> 
							<a href="<?=site_url('recolector/crear_manifiestos/' . $id_cliente . '/' . $bit->folio);?>" class="btn btn-success btn-sm" role="button"> Terminar </button> &nbsp;&nbsp;&nbsp;
							<a href="#" class="btn btn-danger btn-sm" role="button" disabled> PDF </button>
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

	<a href="<?=site_url('recolector/crear_manifiesto/' . $id_cliente);?>" class="btn btn-primary" role="button"> Crear Manifiesto</a>
</main>