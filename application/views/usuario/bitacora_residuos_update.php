			<?php
				print_r($bitacora);
			?>

			<div class="span9">
				<legend><center>Actualizar Registro</center></legend>
				<form id="form_bitacora_residuo_peligroso" action="<?php echo site_url('cliente/update_bitacora_cliente'); ?>" method="post">
				<div class="well">
					<br>
					<div class="form-horizontal">
						<div class="control-group">
							<label for="" class="control-label">Residuo peligoso:</label>
							<div class="controls">
								<div class="form-inline" style="margin-bottom:10px;">
									<select id="residuo" class="txt"  style="width:60%;" name="residuo" type="text" onchange="otro_residuo_peligroso(this.value);" required>
										<option value="O1" <?php {if($bitacora->clave == "O1"){ echo "selected";}} ?> >Aceite dieléctricos gastados</option>
										<option value="O2" <?php {if($bitacora->clave == "O2"){ echo "selected";}} ?> >Aceites hidráulicos gastados</option>
										<option value="RPM/01" <?php {if($bitacora->clave == "RPM/01"){ echo "selected";}} ?> >Aceites lubricantes usados</option>
										<option value="RPM/04" <?php {if($bitacora->clave == "RPM/04"){ echo "selected";}} ?> >Acumuladores de vehículos automotrices conteniendo plomo </option>
										<option value="RPM/07" <?php {if($bitacora->clave == "RPM/07"){ echo "selected";}} ?> >Aditamentos que contengan mercurio, cadmio plomo</option>
										<option value="RPM/05" <?php {if($bitacora->clave == "RPM/05"){ echo "selected";}} ?> >Baterías eléctricas a base de mercurio o de níquel-cadmio</option>
										<option value="O-1" <?php {if($bitacora->clave == "O-1"){ echo "selected";}} ?> >Combustóleo contaminado</option>
										<option value="O-2" <?php {if($bitacora->clave == "O-2"){ echo "selected";}} ?> >Diesel contaminado</option>
										<option value="RPM/02" <?php {if($bitacora->clave == "RPM/02"){ echo "selected";}} ?> >Disolventes orgánicos usados</option>
										<option value="RPM/08" <?php {if($bitacora->clave == "RPM/08"){ echo "selected";}} ?> >Fármacos</option>
										<option value="RPM/06" <?php {if($bitacora->clave == "RPM/06"){ echo "selected";}} ?> >Lámparas fluorescentes y de vapor de mercurio</option>
										<option value="L6" <?php {if($bitacora->clave == "L6"){ echo "selected";}} ?> >Lodos aceitosos</option>
										<option value="RPM/09" <?php {if($bitacora->clave == "RPM/09"){ echo "selected";}} ?> >Plaguicidas y sus envases que contengan remanentes de los mismos</option>
										<option value="SO5" <?php {if($bitacora->clave == "SO5"){ echo "selected";}} ?> >Sólidos con metales pesados</option>
										<option value="SO2" <?php {if($bitacora->clave == "SO2"){ echo "selected";}} ?> >Sólidos de mantenimiento automotriz</option>
										<option value="SO4-1" <?php {if($bitacora->clave == "SO4-1"){ echo "selected";}} ?> >Sólidos impregnados con pintura</option>
										<option value="SO4-2" <?php {if($bitacora->clave == "SO4-2"){ echo "selected";}} ?> >Sólidos impregnados con sustancias químicas</option>
										<option value="S1" <?php {if($bitacora->clave == "S1"){ echo "selected";}} ?> >Solventes orgánicos</option>
										<option value="C1" <?php {if($bitacora->clave == "C1"){ echo "selected";}} ?> >Sustancias corrosivas  ácidos</option>
										<option value="C2" <?php {if($bitacora->clave == "C2"){ echo "selected";}} ?> >Sustancias corrosivas  álcalis</option>
										<option value="SO1" <?php {if($bitacora->clave == "SO1"){ echo "selected";}} ?> >Telas o pieles impregnadas de residuos peligrosos</option>
										<option value="Otro" <?php {if($bitacora->clave == "Otro"){ echo "selected";}} ?> >Otro</option>
									</select>
									&nbsp;
									<label for="">Clave:</label>
									<label style="width:15%;" id="lb_clave"> <?= $bitacora->clave ?></label>
								</div>
								<div class="form-inline">
									<label for="">Otro:</label>
									<input type="text" class="txt" style="width:52%" name="otro_residuo" id="otro_residuo" disabled>
									&nbsp;
									<label for="">Clave:</label>
									<input type="text" class="txt" style="width:10%" name="clave" id="clave" disabled>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Cantidad:</label>
							<div class="controls">
								<div class="form-inline">
									<input type="number" id="cantidad" class="txt" style="width:20%;" value="<?php echo $bitacora->cantidad;?>" name="cantidad" >
									&nbsp;
									<label for="radio1" class="radio">
										<input type="radio" id="radio1" name="unidad" value="Kg" <?php if($bitacora->unidad == "Kg"){echo "checked";} ?> >Kg
									</label>
									&nbsp;
									<label for="radio2" class="radio">
										<input type="radio" id="radio2" name="unidad" value="Ton" <?php if($bitacora->unidad == "Ton"){echo "checked";} ?> >Ton
									</label>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Característica de peligrosidad:</label>
							<div class="controls">
								<div class="form-inline">
									<label for="check1" class="checkbox">
										<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico" <?php foreach ($peligrosidad as $row ){if($row == "Toxico"){ echo "checked";}} ?> > Toxico
									</label>
									&nbsp;&nbsp;
									<label for="check2" class="checkbox">
										<input type="checkbox" id="check2" name="caracteristica[]" value="Inflamable" <?php foreach ($peligrosidad as $row ){if($row == "Inflamable"){ echo "checked";}} ?> >Inflamable
									</label>
									&nbsp;&nbsp;
									<label for="check3" class="checkbox">
										<input type="checkbox" id="check3" name="caracteristica[]" value="Corrosivo" <?php foreach ($peligrosidad as $row ){if($row == "Corrosivo"){ echo "checked";}} ?> >Corrosivo
									</label>
									&nbsp;&nbsp;
									<label for="check4" class="checkbox">
										<input type="checkbox" id="check4" name="caracteristica[]" value="Reactivo" <?php foreach ($peligrosidad as $row ){if($row == "Reactivo"){ echo "checked";}} ?> >Reactivo
									</label>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Area de generacion:</label>
							<div class="controls">
								<div class="form-inline">
									<select id="area_generacion" class="txt" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:40%" required>
										
										<option value="Mantenimiento" <?php {if($bitacora->area_generacion == "Mantenimiento"){ echo "selected";}} ?>>Mantenimiento</option>
										<option value="Laboratorio" <?php {if($bitacora->area_generacion == "Laboratorio"){ echo "selected";}} ?>>Laboratorio</option>
										<option value="Otro" <?php {if($bitacora->area_generacion == "Otro"){ echo "selected";}} ?>>Otro</option>
									</select>
									&nbsp;
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_area" name="otro_area" style="width:40%" disabled>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Fecha en el almacen:</label>
							<div class="controls">
								<div class="form-inline">
									<label for="fecha_ingreso">Entrada:</label>
									<input class="txt" style="width:15%" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?= $bitacora->fecha_ingreso ?>">
									&nbsp;
									<label for="">Salida:</label>
									<input class="txt" style="width:15%" name="fecha_salida" id="fecha_salida" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Nombre y Número de Autorización del Transportista:</label>
							<div class="controls">
								<div class="form-inline" style="margin-bottom:10px;">
									<select class="txt" name="emp_tran" onchange="otra_empresa_transportista(this.value);" style="width:30%" required>
										<option value="" required>Seleccione una opción</option>
										<option value="06-10-PS-I-01-2011" <?php {if($bitacora->no_aut_transp == "06-10-PS-I-01-2011"){ echo "selected";}} ?> >Ricardo Díaz Virgen</option>
										<option value="014-002-682-95" <?php {if($bitacora->no_aut_transp == "014-002-682-95"){ echo "selected";}} ?> >Alicia Huerta Rodríguez</option>
										<option value="21-015-PS-I-02-07" <?php {if($bitacora->no_aut_transp == "21-015-PS-I-02-07"){ echo "selected";}} ?> >Ecoltec S.A. de C.V.</option>
										<option value="09-I-20-11" <?php {if($bitacora->no_aut_transp == "21-015-PS-I-02-07"){ echo "selected";}} ?> >EK Ambiental S.A. de C.V.</option>
										<option value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">No. de Aut.:</label>
									<label for="" id="lb_autorizacion"> <?= $bitacora->no_aut_transp ?> </label>
								</div>
								<div class="form-inline">
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_empresa" name="otro_emp" style="width:30%" disabled required>
									&nbsp;
									<label for="">No. Aut.:</label>
									<input type="text" class="txt" id="no_auto" name="no_auto" style="width:25%" disabled required>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Folio del Manifiesto:</label>
							<div class="controls">
								<input type="text" name="folio" class="txt" value="<?= $bitacora->folio_manifiesto ?>" required>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>
							<div class="controls">
								<div class="form-inline" style="margin-bottom:10px;">
									<select class="txt" name="dest_final" onchange="otra_destino(this.value);" required>
										<option value="06-09-ll-01-2011" <?php {if($bitacora->no_aut_dest_final == "06-10-PS-I-01-2011"){ echo "selected";}} ?> >Ecoltec S.A de C.V.</option>
										<option value="14-030B-PS-ll-43-07" <?php {if($bitacora->no_aut_dest_final == "14-030B-PS-ll-43-07"){ echo "selected";}} ?>>Francisco Serrano Lomeli</option>
										<option value="14-98B-PS-ll-18-03" <?php {if($bitacora->no_aut_dest_final == "14-98B-PS-ll-18-03"){ echo "selected";}} ?>>Alicia Huerta Rodriguez</option>
										<option value="14-II-06-11" <?php {if($bitacora->no_aut_dest_final == "14-II-06-11"){ echo "selected";}} ?>>EK Ambiental S.A. de C.V.</option>
										<option value="11-V-86-09" <?php {if($bitacora->no_aut_dest_final == "11-V-86-09"){ echo "selected";}} ?>>Sistema de Tratamiento Ambiental S.A. de C.V.</option>
										<option value="19-IV-78-11" <?php {if($bitacora->no_aut_dest_final == "19-IV-78-11"){ echo "selected";}} ?>>Enertec Exports S. de R.L. de C.V.</option>
										<option value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">No. Aut.:</label>
									<label for="" id="lb_autorizacion_dest"> <?= $bitacora->no_aut_dest_final ?> </label>
								</div>
								<div class="form-inline">
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_dest" name="otro_dest" style="width:30%" disabled required>
									&nbsp;
									<label for="">No. Aut.:</label>
									<input type="text" class="txt" id="no_auto_dest" name="no_auto_dest" style="width:25%" disabled required>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Modalidad de manejo:</label>
							<div class="controls">
								<div class="form-inline">
									<select class="txt" name="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" style="width:40%" required>
										<option value="Coprocesamiento" <?php {if($bitacora->sig_manejo == "Coprocesamiento"){ echo "selected";}} ?>>Coprocesamiento</option>
										<option value="Confinamiento controlado" <?php {if($bitacora->sig_manejo == "Confinamiento controlado"){ echo "selected";}} ?>>Confinamiento controlado</option>
										<option value="Formulación de combustibles alternos" <?php {if($bitacora->sig_manejo == "Formulación de combustibles alternos"){ echo "selected";}} ?>>Formulación de combustibles alternos</option>
										<option value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_modalidad" name="otro_modalidad" style="width:40%" disabled required>
								</div>
								
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Nombre del responsable técnico:</label>
							<div class="controls">
								<input class="txt" name="resp_tec" type="text" value="<?= $bitacora->resp_tec ?>" required>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="id_persona" value="<?php echo $id; ?>">
				<input type="hidden" name="id_residuo_peligroso" value="<?php echo $bitacora->id_residuo_peligroso;?>"/>
				<input type="submit" onclick="reg_bit_new();" class="btn btn-primary pull-right" value="Guardar">
				</form>
			</div>
			<script type="text/javascript">
				$('#fecha_ingreso').datepicker();
				$('#fecha_salida').datepicker();
			</script>