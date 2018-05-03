<main role="main" class="container" style="padding-top:-10px;">
	<center><h2 class="bd-title" id="content">Crear Manifiesto</h1></center>
	<hr>
	<div class="col-md-12">

		<div class="form-row">
			<div class="form-group col-md-9">
				<label class="col-form-label" for="nombre_empresa"> <center> Empresa Destino </center> </label>
				<select class="form-control" style="width: 100%;">
					<option value="">Selecciona empresa destino</option>
				</select>
			</div>
			<div class="form-group col-md-3">
				<label class="col-form-label" for="numero"> <center> Fecha de Embarque </center> </label>
				<input type="text" class="form-control" id="fecha_salida">
			</div>		
		</div>

		<div class="form-row">
			<div class="form-group col-md-9">
				<label class="col-form-label" for="responsable_tecnico"> <center> Nombre del Responable Técnico</center> </label>
				<input type="text" class="form-control" id="responsable_tecnico">
			</div>		
		</div>


		<div class="form-row">
			<div class="form-group col-md-12">

				<center><h2 class="bd-title" id="content">Recolección de Residuos</h1></center>
				<hr>
				<table id="tabla_residuos" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th style="width: 390px;">Folio</th>
							<th>Nombre residuo</th>
							<th>CRETI</th>
							<th>Contenedor Cantidad</th>
							<th>Contenedor Tipo</th>
							<th>Cantidad Total</th>
							<th>Unidad Vol/Peso</th>
							<th>Area de Generación</th>
							<th>Modalidad</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td> 1 </td>
								<td> sadddddddddddddddddddddddddddd asd asda sd asd sad sad asd asd asd sad asd asd</td>
								<td> T </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
								<td> </td>
							</tr>
					</tbody>
					
				</table>

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