			<div class="span9">
				<legend><center>Modificar Registro</center></legend>
				<form id="form_bitacora_residuo_peligroso" action="<?php echo site_url('administrador/actualizar_registro'); ?>" method="post">
				<div class="well">
					<br>
					<div class="form-horizontal">
						<div class="control-group">
							<label for="" class="control-label">Residuo peligoso:</label>
							<div class="controls">
								<div class="form-inline" style="margin-bottom:10px;">
									<select id="residuo" class="txt"  style="width:60%;" name="residuo" type="text" onchange="otro_residuo_peligroso(this.value);" required>
										<option value="">Seleccione una opción</option>
										<option <?php if($residuo->residuo == "Aceite dieléctricos gastados"){echo "selected";} ?> value="O1">Aceite dieléctricos gastados</option>
										<option <?php if($residuo->residuo == "Aceites hidráulicos gastados"){echo "selected";} ?> value="O2">Aceites hidráulicos gastados</option>
										<option <?php if($residuo->residuo == "Aceites lubricantes usados"){echo "selected";} ?> value="RPM/01">Aceites lubricantes usados</option>
										<option <?php if($residuo->residuo == "Acumuladores de vehículos automotrices conteniendo plomo "){echo "selected";} ?> value="RPM/04">Acumuladores de vehículos automotrices conteniendo plomo </option>
										<option <?php if($residuo->residuo == "Aditamentos que contengan mercurio, cadmio plomo"){echo "selected";} ?> value="RPM/07">Aditamentos que contengan mercurio, cadmio plomo</option>
										<option <?php if($residuo->residuo == "Baterías eléctricas a base de mercurio o de níquel-cadmio"){echo "selected";} ?> value="RPM/05">Baterías eléctricas a base de mercurio o de níquel-cadmio</option>
										<option <?php if($residuo->residuo == "Combustóleo contaminado"){echo "selected";} ?> value="O-1">Combustóleo contaminado</option>
										<option <?php if($residuo->residuo == "Diesel contaminado"){echo "selected";} ?> value="O-2">Diesel contaminado</option>
										<option <?php if($residuo->residuo == "Disolventes orgánicos usados"){echo "selected";} ?> value="RPM/02">Disolventes orgánicos usados</option>
										<option <?php if($residuo->residuo == "Fármacos"){echo "selected";} ?> value="RPM/08">Fármacos</option>
										<option <?php if($residuo->residuo == "Lámparas fluorescentes y de vapor de mercurio"){echo "selected";} ?> value="RPM/06">Lámparas fluorescentes y de vapor de mercurio</option>
										<option <?php if($residuo->residuo == "Lodos aceitosos"){echo "selected";} ?> value="L6">Lodos aceitosos</option>
										<option <?php if($residuo->residuo == "Plaguicidas y sus envases que contengan remanentes de los mismos"){echo "selected";} ?> value="RPM/09">Plaguicidas y sus envases que contengan remanentes de los mismos</option>
										<option <?php if($residuo->residuo == "Sólidos con metales pesados"){echo "selected";} ?> value="SO5">Sólidos con metales pesados</option>
										<option <?php if($residuo->residuo == "Sólidos de mantenimiento automotriz"){echo "selected";} ?> value="SO2">Sólidos de mantenimiento automotriz</option>
										<option <?php if($residuo->residuo == "Sólidos impregnados con pintura"){echo "selected";} ?> value="SO4-1">Sólidos impregnados con pintura</option>
										<option <?php if($residuo->residuo == "Sólidos impregnados con sustancias químicas"){echo "selected";} ?> value="SO4-2">Sólidos impregnados con sustancias químicas</option>
										<option <?php if($residuo->residuo == "Solventes orgánicos"){echo "selected";} ?> value="S1">Solventes orgánicos</option>
										<option <?php if($residuo->residuo == "Sustancias corrosivas  ácidos"){echo "selected";} ?> value="C1">Sustancias corrosivas  ácidos</option>
										<option <?php if($residuo->residuo == "Sustancias corrosivas  álcalis"){echo "selected";} ?> value="C2">Sustancias corrosivas  álcalis</option>
										<option <?php if($residuo->residuo == "Telas o pieles impregnadas de residuos peligrosos"){echo "selected";} ?> value="SO1">Telas o pieles impregnadas de residuos peligrosos</option>
										<option <?php if($residuo->residuo == "Otro"){echo "selected";} ?> value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">Clave:</label>
									<label style="width:15%;" id="lb_clave"><?php if($residuo->residuo != "Otro"){echo $residuo->clave;} ?></label>
								</div>
								<div class="form-inline">
									<label for="">Otro:</label>
									<input type="text" class="txt" style="width:52%" name="otro_residuo" id="otro_residuo" <?php if($residuo->residuo != "Otro"){echo "disabled";} ?> value="<?php if($residuo->residuo == 'Otro'){echo $otro_residuo;} ?>">
									&nbsp;
									<label for="">Clave:</label>
									<input type="text" class="txt" style="width:10%" name="clave" id="clave" <?php if($residuo->residuo != "Otro"){echo "disabled";} ?> value="<?php if($residuo->residuo == 'Otro'){echo $residuo->clave;} ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Cantidad:</label>
							<div class="controls">
								<div class="form-inline">
									<input type="number" class="txt" style="width:20%;" name="cantidad" value="<?php echo $residuo->cantidad; ?>">
									&nbsp;
									<label for="radio1" class="radio">
										<input type="radio" id="radio1" name="unidad" value="Kg" <?php if($residuo->unidad == "Kg"){echo "checked";} ?>>Kg
									</label>
									&nbsp;
									<label for="radio2" class="radio">
										<input type="radio" id="radio2" name="unidad" value="Ton" <?php if($residuo->unidad == "Ton"){echo "checked";} ?>>Ton
									</label>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Característica de peligrosidad:</label>
							<div class="controls">
								<div class="form-inline">
									<label for="check1" class="checkbox">
										<input type="checkbox" id="check1" name="caracteristica[]" value="Toxico" <?php foreach($caracteristicas as $row){if($row=="Toxico"){echo "checked";}} ?>>Toxico
									</label>
									&nbsp;&nbsp;
									<label for="check2" class="checkbox">
										<input type="checkbox" id="check2" name="caracteristica[]" value="Inflamable" <?php foreach($caracteristicas as $row){if($row=="Inflamable"){echo "checked";}} ?>>Inflamable
									</label>
									&nbsp;&nbsp;
									<label for="check3" class="checkbox">
										<input type="checkbox" id="check3" name="caracteristica[]" value="Corrosivo" <?php foreach($caracteristicas as $row){if($row=="Corrosivo"){echo "checked";}} ?>>Corrosivo
									</label>
									&nbsp;&nbsp;
									<label for="check4" class="checkbox">
										<input type="checkbox" id="check4" name="caracteristica[]" value="Reactivo" <?php foreach($caracteristicas as $row){if($row=="Reactivo"){echo "checked";}} ?>>Reactivo
									</label>
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Area de generacion:</label>
							<div class="controls">
								<div class="form-inline">
									<select id="area_generacion" class="txt" name="area_generacion" onchange="otra_area_generacion(this.value);" style="width:40%">
										<option value="">Seleccione una opción</option>
										<option <?php if($residuo->area_generacion == "Mantenimiento"){echo "selected";} ?> value="Mantenimiento">Mantenimiento</option>
										<option <?php if($residuo->area_generacion == "Laboratorio"){echo "selected";} ?> value="Laboratorio">Laboratorio</option>
										<option <?php if($residuo->area_generacion == "Otro"){echo "selected";} ?> value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_area" style="width:40%" name="otro_area" <?php if($residuo->area_generacion != "Otro"){echo "disabled";} ?> value="<?php if($residuo->area_generacion == 'Otro'){echo $otro_area;} ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Fecha en el almacen:</label>
							<div class="controls">
								<div class="form-inline">
									<label for="">Entrada:</label>
									<input class="txt" style="width:15%" name="fecha_ingreso" id="fecha_ingreso" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?php echo $residuo->fecha_ingreso; ?>">
									&nbsp;
									<label for="">Salida:</label>
									<input class="txt" style="width:15%" name="fecha_salida" id="fecha_salida" type="text" placeholder="aaaa/mm/dd" data-date-format="yyyy-mm-dd" value="<?php echo $residuo->fecha_salida;?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Nombre y Número de Autorización del Transportista:</label>
							<div class="controls">
								<div class="form-inline" style="margin-bottom:10px;">
									<select class="txt" name="emp_tran" onchange="otra_empresa_transportista(this.value);" style="width:30%">
										<option value=" ">Seleccione una opción</option>
										<option <?php if($residuo->emp_tran == "Ricardo Díaz Virgen"){echo "selected";} ?> value="06-10-PS-I-01-2011">Ricardo Díaz Virgen</option>
										<option <?php if($residuo->emp_tran == "Alicia Huerta Rodríguez"){echo "selected";} ?> value="014-002-682-95">Alicia Huerta Rodríguez</option>
										<option <?php if($residuo->emp_tran == "Ecoltec S.A. de C.V."){echo "selected";} ?> value="21-015-PS-I-02-07">Ecoltec S.A. de C.V.</option>
										<option <?php if($residuo->emp_tran == "EK Ambiental S.A. de C.V."){echo "selected";} ?> value="09-I-20-11">EK Ambiental S.A. de C.V.</option>
										<option <?php if($residuo->emp_tran == "Otro"){echo "selected";} ?> value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">Otro:</label>
									<label for="" id="lb_autorizacion"></label>
								</div>
								<div class="form-inline">
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_empresa" name="otro_emp" style="width:30%" <?php if($residuo->emp_tran != "Otro"){echo "disabled";} ?> value="<?php if($residuo->emp_tran == 'Otro'){echo $otro_empresa;} ?>">
									&nbsp;
									<label for="">No. Aut.:</label>
									<input type="text" class="txt" id="no_auto" name="no_auto" style="width:25%" <?php if($residuo->emp_tran != "Otro"){echo "disabled";} ?> value="<?php if($residuo->emp_tran == 'Otro'){echo $residuo->no_aut_transp;} ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Folio del Manifiesto:</label>
							<div class="controls">
								<input type="text" name="folio" class="txt" value="<?php echo $residuo->folio_manifiesto; ?>">
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Nombre y Número de Autorización de Centro de Acopio o Destino final:</label>
							<div class="controls">
								<div class="form-inline" style="margin-bottom:10px;">
									<select class="txt" name="dest_final" onchange="otra_destino(this.value);" style="width:30%">
										<option value="">Seleccione una opción</option>
										<option <?php if($residuo->dest_final == "Ecoltec S.A. de C.V. (acopio)"){echo "selected";} ?> value="06-09-ll-01-2011">Ecoltec S.A. de C.V. (acopio)</option>
										<option <?php if($residuo->dest_final == "Ecoltec S.A. de C.V. (destino final)"){echo "selected";} ?> value="6-IV-34-09">Ecoltec S.A. de C.V. (destino final)</option>
										<option <?php if($residuo->dest_final == "Francisco Serrano Lomeli"){echo "selected";} ?> value="14-030B-PS-ll-43-07">Francisco Serrano Lomeli</option>
										<option <?php if($residuo->dest_final == "Alicia Huerta Rodriguez"){echo "selected";} ?> value="14-98B-PS-ll-18-03">Alicia Huerta Rodriguez</option>
										<option <?php if($residuo->dest_final == "EK Ambiental S.A. de C.V."){echo "selected";} ?> value="14-II-06-11">EK Ambiental S.A. de C.V.</option>
										<option <?php if($residuo->dest_final == "Sistema de Tratamiento Ambiental S.A. de C.V."){echo "selected";} ?> value="11-V-86-09">Sistema de Tratamiento Ambiental S.A. de C.V.</option>
										<option <?php if($residuo->dest_final == "Enertec Exports S. de R.L. de C.V."){echo "selected";} ?> value="19-IV-78-11">Enertec Exports S. de R.L. de C.V.</option>
										<option <?php if($residuo->dest_final == "Otro"){echo "selected";} ?> value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">No. Aut.:</label>
									<label for="" id="lb_autorizacion_dest"></label>
								</div>
								<div class="form-inline">
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_dest" name="otro_dest" style="width:30%" <?php if($residuo->dest_final != "Otro"){echo "disabled";} ?> value="<?php if($residuo->dest_final == 'Otro'){echo $otro_destino;} ?>">
									&nbsp;
									<label for="">No. Aut.:</label>
									<input type="text" class="txt" id="no_auto_dest" name="no_auto_dest" style="width:25%" <?php if($residuo->dest_final != "Otro"){echo "disabled";} ?> value="<?php if($residuo->dest_final == 'Otro'){echo $residuo->no_aut_dest_final;} ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Modalidad de manejo:</label>
							<div class="controls">
								<div class="form-inline">
									<select class="txt" name="sig_manejo" onchange="otro_modalidad_trabajo(this.value);" style="width:40%">
										<option value="Seleccione una opción">Seleccione una opción</option>
										<option <?php if($residuo->sig_manejo == "Coprocesamiento"){echo "selected";} ?> value="Coprocesamiento">Coprocesamiento</option>
										<option <?php if($residuo->sig_manejo == "Confinamiento controlado"){echo "selected";} ?> value="Confinamiento controlado">Confinamiento controlado</option>
										<option <?php if($residuo->sig_manejo == "Formulación de combustibles alternos"){echo "selected";} ?> value="Formulación de combustibles alternos">Formulación de combustibles alternos</option>
										<option <?php if($residuo->sig_manejo == "Otro"){echo "selected";} ?> value="Otro">Otro</option>
									</select>
									&nbsp;
									<label for="">Otro:</label>
									<input type="text" class="txt" id="otro_modalidad" name="otro_modalidad" style="width:40%" <?php if($residuo->sig_manejo != "Otro"){echo "disabled";} ?> value="<?php if($residuo->sig_manejo == 'Otro'){echo $otro_manejo;} ?>">
								</div>
							</div>
						</div>
						<div class="control-group">
							<label for="" class="control-label">Nombre del responsable técnico:</label>
							<div class="controls">
								<input class="txt" name="resp_tec" type="text" value="<?php echo $residuo->resp_tec;?>">
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="id_persona" value="<?php echo $id_persona; ?>">
				<input type="hidden" name="id_bitacora"  value="<?php echo $residuos->id_residuo_peligroso; ?>">
				<input type="submit" onclick="reg_bit_new();" class="btn btn-primary pull-right" value="Guardar">
				</form>
			</div>
			<script type="text/javascript">
				$('#fecha_ingreso').datepicker();
				$('#fecha_salida').datepicker();
			</script>