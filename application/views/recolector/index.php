<main role="main" class="container">
	<center><h2 class="bd-title" id="content">Manifiestos</h1></center>
	<hr>

	<div class="row">
		<div class="col-md-4 order-md-1">

			<h4 class="mb-3"> <img src="img/iconos_bt4/person-4x.png" /> Selecciona Cliente</h4> <hr>
				
			<select class="form-control" onclick="tran_get_bitacora(this.value)" multiple id="id_persona" name="id_persona" size="22" style="width: 100%;">
				<option value="">-</option>

				<?php foreach($tclientes->result() as $row){ ?>
					<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa; ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-md-8 order-md-2">
			<h4 class="mb-3"> <img src="img/iconos_bt4/spreadsheet-4x.png" /> Datos de la empresa</h4> <hr>
			
			<div class="form-group">
				<label class="col-form-label" for="nombre_empresa"> <center> Nombre o Razón Social </center> </label>
				<input type="text" class="form-control form-control-lg" id="nombre_empresa" >
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="col-form-label" for="calle"> <center> Calle </center> </label>
					<input type="text" class="form-control form-control-lg" id="calle" >
				</div>
				<div class="form-group col-md-2">
					<label class="col-form-label" for="numero"> <center> Número </center> </label>
					<input type="text" class="form-control form-control-lg" id="numero" >
				</div>
				<div class="form-group col-md-4">
					<label class="col-form-label" for="cp"> <center> Código Postal </center> </label>
					<input type="text" class="form-control form-control-lg" id="cp" >
				</div>				
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="col-form-label" for="municipio"> <center> Municipio </center> </label>
					<input type="text" class="form-control form-control-lg" id="municipio" >
				</div>
				<div class="form-group col-md-6">
					<label class="col-form-label" for="estado"> <center> Estado </center> </label>
					<input type="text" class="form-control form-control-lg" id="estado" >
				</div>
			</div>	

			<div class="form-row">
				<div class="form-group col-md-6">
					<label class="col-form-label" for="telefono"> <center> Télefono </center> </label>
					<input type="text" class="form-control form-control-lg" id="telefono" >
				</div>
				<div class="form-group col-md-6">
					<label class="col-form-label" for="email"> <center> Dirección de Email </center> </label>
					<input type="text" class="form-control form-control-lg" id="email" >
				</div>
			</div>	

		</div>
	</div>		
			
</main>

<script type="text/javascript">
$('#id_persona').multiSelect()

</script>

