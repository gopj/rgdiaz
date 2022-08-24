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

				<div class="col-md-12">
					<div class="card-body">
						<div class="card-heading clearfix">
							<h4 class="card-title">Hazardous waste chart per month</h4>
						</div>
						<canvas id="hazardous_waste_monthly">
						</canvas>
					</div>
				</div>

			</div>	
		</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function () {
				
		var hwm = $("#hazardous_waste_monthly");

		var lineChart = new Chart(hwm, {
			type: 'line',
			data: {
				labels: ["2018-01", "2018-02", "2018-03", "2018-04", "2018-05", "2018-06", "2018-07", "2018-08", "2018-09", "2018-10", "2018-11"],
				datasets: [{
					label: "Aceites lubricantes usados",
					data: [0, 0, 3, 3, 0, 0, 0, 4, 0, 0, 0],
					fill: true,
					backgroundColor: "rgba(236, 94, 105, 0.2)",
					borderColor: "rgb(236, 94, 105)",
					pointBackgroundColor: "rgb(236, 94, 105)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgb(236, 94, 105)"
				}, {
					label: "Aceites lubricantes usados",
					data: [0, 0, 3, 2, 0, 0, 0, 4, 0, 0, 0],
					fill: true,
					backgroundColor: "rgba(0, 112, 224, 0.2)",
					borderColor: "rgb(0, 112, 224)",
					pointBackgroundColor: "rgb(0, 112, 224)",
					pointBorderColor: "#fff",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderColor: "rgb(0, 112, 224)"
				}]
			}
		})
	}

</script>