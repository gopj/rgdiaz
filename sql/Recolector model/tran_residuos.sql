-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2018 at 08:35 PM
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
  `id_tran_residuos` int(11) NOT NULL,
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
  `responsable_tecnico` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tran_residuos`
--
ALTER TABLE `tran_residuos`
  ADD PRIMARY KEY (`id_tran_residuos`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tran_residuos`
--
ALTER TABLE `tran_residuos`
  MODIFY `id_tran_residuos` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
