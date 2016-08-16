tipo_emp_transportista
******************************************

select 
	t.id_tipo_emp_transportista, r.id_residuo_peligroso
from 
	residuos_peligrosos r,
    tipo_emp_transportista t
    
Where
	t.nombre_empresa = r.emp_tran
;


SELECT emp_tran, no_aut_transp FROM rgdiaz.residuos_peligrosos group by emp_tran;

UPDATE residuos_peligrosos SET id_tipo_emp_transportista=1 WHERE id_residuo_peligroso=1;

