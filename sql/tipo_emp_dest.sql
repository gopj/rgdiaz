tipo_emp_destino
******************************************

select 
	d.id_tipo_emp_destino, r.id_residuo_peligroso
from 
	residuos_peligrosos r,
    tipo_emp_destino d
    
Where
	d.nombre_destino = r.dest_final
;


SELECT emp_tran, no_aut_transp FROM rgdiaz.residuos_peligrosos group by emp_tran;

UPDATE residuos_peligrosos SET id_tipo_emp_transportista=1 WHERE id_residuo_peligroso=1;



SELECT 
	r.id_residuo_peligroso,
	tr.residuo as residuo,
	tr.clave as clave,
	r.cantidad as cantidad,
	r.unidad as unidad,
	r.caracteristica as caracteristica,
	a.area as area_generacion,
	r.fecha_ingreso as fecha_ingreso,
	r.fecha_salida as fecha_salida,
	m.modalidad as sig_manejo,
	et.nombre_empresa as emp_tran,
	ed.nombre_destino as dest_final,
	r.resp_tec as resp_tec,
	et.no_autorizacion_transportista as no_aut_transp,
	ed.no_autorizacion_destino as no_aut_dest_final,
	r.folio_manifiesto as folio,
	b.id_persona as id_persona
FROM
	residuos_peligrosos as r, 
	bitacora as b, 
	tipo_residuos as tr, 
	areas as a, 
	tipo_modalidad as m, 
	tipo_emp_transportista as et, 
	tipo_emp_destino as ed
WHERE 
	r.id_residuo_peligroso = b.folio  and 
	r.id_tipo_residuo = tr.id_tipo_residuo and
	r.id_area = a.id_area   and
	r.id_tipo_modalidad = m.id_tipo_modalidad and
	r.id_tipo_emp_transportista = et.id_tipo_emp_transportista and
	r.id_tipo_emp_destino = ed.id_tipo_emp_destino and
	b.id_persona = 2;



	works

	SELECT 
	r.id_residuo_peligroso,
	tr.residuo as residuo,
	tr.clave as clave,
	r.cantidad as cantidad,
	r.unidad as unidad,
	r.caracteristica as caracteristica,
	a.area as area_generacion,
	r.fecha_ingreso as fecha_ingreso,
	r.fecha_salida as fecha_salida,
    m.modalidad as sig_manejo,
	--r.emp_tran as emp_tran,
	et.nombre_empresa as emp_tran,
	r.dest_final as dest_final,
	r.resp_tec as resp_tec,
	--r.no_aut_transp as no_aut_transp,
	et.no_autorizacion_transportista as no_aut_transp,
	r.no_aut_dest_final as no_aut_dest_final,
	r.folio_manifiesto as folio,
	b.id_persona as id_persona
FROM
	residuos_peligrosos as r, bitacora as b, tipo_residuos as tr, areas as a, tipo_modalidad as m, tipo_emp_transportista as et
WHERE 
	r.id_residuo_peligroso = b.folio  and 
	r.id_tipo_residuo = tr.id_tipo_residuo and
	r.id_area = a.id_area   and
    r.id_tipo_modalidad = m.id_tipo_modalidad and
    r.id_tipo_emp_transportista = et.id_tipo_emp_transportista and
	b.id_persona = 2;
