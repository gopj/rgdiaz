-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2018 at 11:11 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rdiaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tran_residuos`
--

CREATE TABLE `tran_residuos` (
  `id_tran_residuo` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_tipo_residuo` int(11) NOT NULL,
  `id_tipo_emp_destino` int(11) NOT NULL,
  `id_tipo_emp_transportista` int(11) NOT NULL,
  `folio` varchar(45) NOT NULL,
  `caracteristica` varchar(45) DEFAULT NULL,
  `contenedor_cantidad` int(11) DEFAULT NULL,
  `contenedor_tipo` varchar(45) DEFAULT NULL,
  `residuo_cantidad` decimal(10,0) DEFAULT NULL,
  `unidad` varchar(15) NOT NULL,
  `responsable_tecnico` varchar(60) NOT NULL,
  `fecha_insercion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tran_residuos`
--

INSERT INTO `tran_residuos` (`id_tran_residuo`, `id_persona`, `id_tipo_residuo`, `id_tipo_emp_destino`, `id_tipo_emp_transportista`, `folio`, `caracteristica`, `contenedor_cantidad`, `contenedor_tipo`, `residuo_cantidad`, `unidad`, `responsable_tecnico`, `fecha_insercion`, `fecha_ingreso`, `fecha_salida`, `status`) VALUES
(1, 21, 1, 2, 1, '21-1', 'Toxico', 1, 'Cubeta', '12', 'Kg', 'Jesus Gonzalez', '2018-04-08 00:00:00', '0000-00-00', '0000-00-00', 0),
(2, 21, 2, 2, 1, '21-1', 'Toxico', 1, 'Cubeta', '12', 'Kg', 'Jesus Gonzalez', '2018-04-08 18:17:52', '0000-00-00', '0000-00-00', 0),
(3, 21, 1, 2, 1, '21-2', 'Toxico', 1, 'Cubeta', '12', 'Kg', 'Jesus Gonzalez', '2018-04-08 18:22:36', '0000-00-00', '0000-00-00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tran_residuos`
--
ALTER TABLE `tran_residuos`
  ADD PRIMARY KEY (`id_tran_residuo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tran_residuos`
--
ALTER TABLE `tran_residuos`
  MODIFY `id_tran_residuo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
