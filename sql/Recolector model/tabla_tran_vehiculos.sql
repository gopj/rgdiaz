### Tabla de Vehículos


CREATE TABLE `rdiaz`.`tran_vehiculos` (
  `id_vehiculo` INT NOT NULL AUTO_INCREMENT,
  `tipo_vehiculo` VARCHAR(45) NOT NULL,
  `numero_placa` VARCHAR(12) NOT NULL,
  PRIMARY KEY (`id_vehiculo`));

  