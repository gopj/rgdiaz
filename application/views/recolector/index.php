<main role="main" class="container">
	<center><h2 class="bd-title" id="content">Manifiestos</h1></center>
	<hr>

	<div class="row">
		<div class="col-md-5 order-md-1">

			<h4 class="mb-3"> <img src="img/iconos_bt4/person-4x.png" /> Selecciona Cliente</h4> <hr>
				
			<select class="form-control" onclick="tran_get_bitacora(this.value)" multiple id="id_persona" name="id_persona" size="22" style="width: 100%;">
				<option value="">-</option>

				<?php foreach($tclientes->result() as $row){ ?>
					<option value="<?php echo $row->id_persona;?>"><?php echo $row->nombre_empresa; ?></option>
				<?php } ?>
			</select>
		</div>

		<div class="col-md-7 order-md-2">
			<h4 class="mb-3"> <img src="img/iconos_bt4/spreadsheet-4x.png" /> Datos de la empresa</h4> <hr>

		</div>
	</div>
			

		<center><legend>Datos de la empresa</legend></center>
		
				<div class="form-group">
					Nombre o Razón Social
					<div class='input-prepend'>
						<span class="add-on"><i class="icon-user"></i></span>
						<input class="txt-well span7" id="nombre_empresa" name="nombre_empresa" type='text' >
					</div>
				</div>
				
				<div class="form-group">
					Calle
					<div class='input-prepend'>
						<span class="add-on"><i class="icon-road"></i></span>
						<input class="txt-well span2" id="calle" name="calle" type='text' >
					</div>

					Calle
					<div class='input-prepend'>
						<span class="add-on"><i class="icon-road"></i></span>
						<input class="txt-well span2" id="calle" name="calle" type='text' >
					</div>
				</div>

	
			
			
</main>

<script type="text/javascript">
	

</script>

