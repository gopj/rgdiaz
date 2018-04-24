<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content">Crear Manifiesto</h1></center>
	<hr>
	<div class="col-md-12">
		
		<div class="form-group">
			<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
			<select class="form-control" style="width: 100%;">
				<option value="">Selecciona empresa destino</option>
			</select>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label class="col-form-label" for="calle"> <center> Fecha de ingreso </center> </label>
				<input type="text" class="form-control form-control-lg" id="fecha_ingreso">
			</div>
			<div class="form-group col-md-6">
				<label class="col-form-label" for="numero"> <center> Fecha de Salida </center> </label>
				<input type="text" class="form-control form-control-lg" id="fecha_salida">
			</div>		
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label class="col-form-label" for="municipio"> <center> Municipio </center> </label>
				<input type="text" class="form-control form-control-lg" id="municipio" disabled>
			</div>
			<div class="form-group col-md-6">
				<label class="col-form-label" for="estado"> <center> Estado </center> </label>
				<input type="text" class="form-control form-control-lg" id="estado" disabled>
			</div>
		</div>	

		<div class="form-row">
			<div class="form-group col-md-6">
				<label class="col-form-label" for="telefono"> <center> Télefono </center> </label>
				<input type="text" class="form-control form-control-lg" id="telefono" disabled>
			</div>
			<div class="form-group col-md-6">
				<label class="col-form-label" for="email"> <center> Dirección de Email </center> </label>
				<input type="text" class="form-control form-control-lg" id="email" disabled>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
			</div>
		</div>


		<div class="form-row">
			<div class="form-group col-md-4">

			</div>
			<div class="form-group col-md-4">
				<button type="submit" class="btn btn-primary btn-lg btn-block" id="ver_manifiestos" disabled>Ver Manifiestos</button>
			</div>
			<div class="form-group col-md-4">

			</div>
		</div>

	</div>
</main>