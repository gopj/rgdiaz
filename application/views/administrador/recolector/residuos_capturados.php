<?php $this->session->set_userdata('url', 'from_bitacora'); ?>

<div class="page-title">
<div class="row">
		<div class="col-md-6">
			<h3 class="breadcrumb-header"> Bitacora </h3>
		</div>
		<div class="col-md-6 d-flex flex-row-reverse ">
			<div class="row">
				<button class="btn "><a href="<?=base_url('admin/recolector_consulta')?>" > Consultas</a></button>		
				<button class="btn "><a href="<?=base_url('admin')?>"> Manifiestos</a></button>
				<button class="btn "> <a href="<?=base_url('admin/recolector_bitacora')?>"> Bítacora</a></button>
			</div>
		</div>
</div>
</div>
	<div class="card card-white">
		<div id="main-wrapper">
			<div class="card-body">
				<form class="form-inline col-md-12" role="form" autocomplete="off" method='post' id='form_bitacora' action="<?= site_url('admin/recolector_bitacora');?>">
					
					<div class="form-group col-md-4">
						<label class="col-md-2" for="fecha_embarque">Fecha</label>
						<input type="text" class="form-control date-picker col-md-6" id="fecha_embarque" name="fecha_embarque" style="text-align: center;" value="<?= @$fecha_embarque ?>">
					</div>

					<div class="form-group col-md-4">
						<label class="col-md-2" for="fecha">Tipo</label>
						<select class="form-control col-md-6" name="tipo" id="tipo">
							<option value=""> Todos </option>
							<option value="W" <?php if(@$tipo=='W'){echo "selected";}?>> Pendientes </option>
							<option value="R" <?php if(@$tipo=='R'){echo "selected";}?>> Completados </option>
						</select>

					</div>

					<div class="form-group col-md-1">	
						<input class="btn btn-primary btn-sm" type="submit" name="submit_form_bitacora" value="Buscar">
					</div>

					<div class="form-group col-md-1">	
						
						<a href="<?=base_url('admin/residuos_capturados/')?>" id="btn_residuos_capturados" class="btn btn-primary btn-sm" role="button"> Residuos </a>
					</div>
					
				</form>
				
				<hr>
				<div class="table-responsive">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <h3 class="bd-title" id="content">Recolección de Residuos</h3>
                            <hr>
                            <table id="tabla_residuos" class="table table-striped table-bordered table-sm" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre residuo</th>
                                        <th>CRETI</th>
                                        <th>Contenedor Cantidad</th>
                                        <th>Contenedor Tipo</th>
                                        <th>Contenedor Capacidad</th>
                                        <th>Cantidad (KG)</th>
                                        <th>Etiqueta</th>
                                        <th>Opcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $x = 1;
                                        foreach ($bitacora_manifiesto as $key) { 
                                    ?>
                                        <tr>
                                            <td> <?= $x++ ?></td>
                                            <td> <?= $key->residuo ?> </td>
                                            <td> <?= $key->caracteristica ?> </td>
                                            <td> <?= $key->contenedor_cantidad ?> </td>
                                            <td> <?= $key->contenedor_tipo ?> </td>
                                            <td> <?= $key->contenedor_capacidad ?> </td>
                                            <td> <?= $key->residuo_cantidad ?> </td>
                                            <td> <?= $key->etiqueta ?> </td>
                                            <td> <button class="btn btn-danger btn-sm" disabled> <i class="fa fa-trash"></i> Borrar </button> </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>