<?php 

$this->session->set_userdata('url', 'from_bitacora'); 

echo "<pre>";
print_r($todos_residuos);
echo "</pre>";

?>

<div class="page-title">
<div class="row">
		<div class="col-md-6">
			<h3 class="breadcrumb-header"> Inventario </h3>
		</div>
		<div class="col-md-6 d-flex flex-row-reverse ">
			<div class="row">
				<button class="btn "><a href="<?=base_url('admin/recolector_consulta')?>" > Consultas</a></button>		
				<button class="btn "><a href="<?=base_url('admin')?>"> Manifiestos</a></button>
				<button class="btn "> <a href="<?=base_url('admin/recolector_bitacora')?>"> Bítacora</a></button>
                <button class="btn "> <a href="<?=base_url('admin/inventario')?>"> Inventario</a></button>
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

					<div class="form-group col-md-1">	
						<input class="btn btn-primary btn-sm" type="submit" name="submit_form_bitacora" value="Buscar">
					</div>

                    <div class="form-group col-md-1">	
						<input class="btn btn-primary btn-sm" type="submit" name="submit_form_salidas" id="submit_form_salidas" value="Registrar Salidas" disabled>
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
                                        <th></th>
                                        <th># Manifiesto</th>
                                        <th>Nombre residuo</th>
                                        <th>CRETI</th>
                                        <th>Contenedor Cantidad</th>
                                        <th>Contenedor Tipo</th>
                                        <th>Contenedor Capacidad</th>
                                        <th>Cantidad (KG)</th>
                                        <th>Etiqueta</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $x = 1;
                                        foreach ($todos_residuos as $key) { 
                                    ?>
                                        <tr>
                                            <th> <input type="checkbox" onclick="enable_fields_inventario()" name="salidas_selected[]" value="<?php echo $key->id_tran_residuo; ?>"> </th>
                                            <td> <?= $key->folio ?></td>
                                            <td> <?= $key->residuo ?> </td>
                                            <td> <?= $key->caracteristica ?> </td>
                                            <td> <?= $key->contenedor_cantidad ?> </td>
                                            <td> <?= $key->contenedor_tipo ?> </td>
                                            <td> <?= $key->contenedor_capacidad ?> </td>
                                            <td> <?= $key->residuo_cantidad ?> </td>
                                            <td> <?= $key->etiqueta ?> </td>
                                            <td> <?= $key->fecha_insercion ?> </td>
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