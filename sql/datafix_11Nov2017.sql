-- Residuos peligrosos
-- Agregar campos de cantidad contenedor y tipo contenedor

ALTER TABLE rdiaz.residuos_peligrosos
ADD COLUMN cantidad_contenedor INT(11) NOT NULL AFTER unidad,
ADD COLUMN tipo_contenedor VARCHAR(100) NOT NULL AFTER cantidad_contenedor;

UPDATE rdiaz.residuos_peligrosos SET cantidad_contenedor="1", tipo_contenedor="Bolsa" WHERE status="R";

UPDATE rdiaz.residuos_peligrosos SET cantidad_contenedor="1", tipo_contenedor="Bolsa" WHERE status="W";

-- Transportistas
-- Agregar Campo de Domicilio

ALTER TABLE rdiaz.tipo_emp_transportista
ADD COLUMN no_autorizacion_sct VARCHAR(45) NULL AFTER no_autorizacion_transportista,
ADD COLUMN domicilio VARCHAR(100) NULL AFTER no_autorizacion_sct,
ADD COLUMN telefono VARCHAR(45) NULL AFTER domicilio;

-- Destinos
-- Agregar campo de Domicilio,

ALTER TABLE rdiaz.tipo_emp_destino
ADD COLUMN domicilio VARCHAR(80) NULL AFTER no_autorizacion_destino,
ADD COLUMN municipio VARCHAR(45) NULL AFTER domicilio,
ADD COLUMN estado VARCHAR(45) NULL AFTER municipio;
