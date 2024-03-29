<div class="page-title">
	<h3 class="breadcrumb-header"> <a href="<?=base_url().'administrador/bitacora/' . $id_persona?>"> Bitacora > </a> Reportes - <?= $nombre_empresa; ?> </h3>
</div>
<input type="hidden" id="id_persona" name="id_persona" value="<?=$id_persona;?>">
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">
			<div class="row">

				<div class="col-md-12">
					<div class="card-body">
						<div class="card-heading clearfix">
							<h4 class="card-title">Fechas</h4>
						</div>
					</div>
				</div>

				<div class="form-inline col-md-12">
					<div class="form-row align-items-center">
						<div class="col-auto">
							<label for="date_start" class="col-form-label">Inicio</label>
							<input type="text" class="form-control" id="date_start" name="date_start" placeholder="AAAA/MM/DD" data-date-format="yyyy-mm-dd" value="2018-01-01">
						</div>
						<div class="col-auto">
							<label for="date_end" class="col-form-label">Final</label>
							<input type="text" class="form-control" id="date_end" name="date_end" placeholder="AAAA/MM/DD" data-date-format="yyyy-mm-dd" value="2018-12-01">
						</div>
						<div class="col-auto">
							<button type="submit" class="btn btn-primary" onclick="get_chart()"> Buscar </button>
						</div>	
					</div>	
				</div>

				<div class="col-md-12" style="padding-top: 63px">
					<div class="card-body">
						<div class="card-heading clearfix">
							<h3 class="card-title">Residuos Peligrosos - Cantidad</h4>
						</div>
						<canvas id="hazardous_waste_monthly">
						</canvas>
					</div>
				</div>

			</div>	
		</div>
	</div>
</div>

