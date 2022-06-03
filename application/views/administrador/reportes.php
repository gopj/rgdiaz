<div class="page-title">
	<h3 class="breadcrumb-header"> Reportes - <?= $nombre_empresa; ?> </h3>
</div>
<input type="hidden" id="prev_selected" name="prev_selected" value="<?=$id_persona;?>">
<div class="card card-white">
	<div id="main-wrapper">
		<div class="card-body">

			<div class="col-md-6">
				<div class="card-body">
					<div class="card-heading clearfix">
						<h4 class="card-title">Stacked Area Chart</h4>
					</div>
					<canvas id="chart1">
					</canvas>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card-body">
					<div class="card-heading clearfix">
						<h4 class="card-title">chart2</h4>
					</div>
					<canvas id="chart2">
					</canvas>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card-body">
					<div class="card-heading clearfix">
						<h4 class="card-title">chart3</h4>
					</div>
					<canvas id="chart3">
					</canvas>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card-body">
					<div class="card-heading clearfix">
						<h4 class="card-title">chart4</h4>
					</div>
					<canvas id="chart4">
					</canvas>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	window.onload = function () {
		var ctx = document.getElementById("stacked_area_chart");
		var lineChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
				datasets: [{
					label: "2015",
					data: [10, 8, 6, 5, 12, 8, 16, 17, 6, 7, 6, 10]
				}]
			}
		})
	}
</script>