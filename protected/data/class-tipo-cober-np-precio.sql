-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-12-2014 a las 01:13:58
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rcv_db`
--
CREATE DATABASE IF NOT EXISTS `rcv_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `rcv_db`;

--
-- Volcado de datos para la tabla `clasevehiculo`
--

INSERT INTO `clasevehiculo` (`id`, `claseVehiculo`) VALUES
(1, 'MOTOCILETA'),
(2, 'AUTOMOVIL'),
(3, 'CAMIONETA'),
(4, 'RUSTICO');

--
-- Volcado de datos para la tabla `cobertura`
--

INSERT INTO `cobertura` (`id`, `cobertura`, `claseVehiculo_id`) VALUES
(1, '25000.00', 1),
(2, '40000.00', 1),
(3, '60000.00', 1),
(4, '80000.00', 1),
(6, '30000.00', 2),
(7, '40000.00', 2),
(8, '60000.00', 2),
(9, '80000.00', 2),
(10, '100000.00', 2),
(11, '25000.00', 3),
(12, '40000.00', 3),
(13, '60000.00', 3),
(14, '80000.00', 3),
(15, '100000.00', 3),
(16, '25000.00', 4),
(17, '40000.00', 4),
(18, '60000.00', 4),
(19, '80000.00', 4),
(20, '100000.00', 4);

--
-- Volcado de datos para la tabla `numpuesto`
--

INSERT INTO `numpuesto` (`id`, `numPuesto`, `tipoVehiculo_id`) VALUES
(1, '2', 1),
(2, '2', 2),
(3, '2', 3),
(4, '5', 4),
(5, '6', 4),
(6, '2', 5),
(7, '4', 5),
(8, '5', 5),
(9, '5', 6),
(10, '2', 7),
(11, '5', 7),
(12, '5', 8),
(13, '7', 8),
(14, '2', 9),
(15, '3', 9),
(16, '5', 9),
(17, '8', 10),
(18, '9', 10),
(19, '10', 10),
(20, '11', 10),
(21, '15', 11),
(22, '24', 11),
(23, '24', 10),
(24, '5', 12),
(25, '13', 12),
(26, '5', 13),
(27, '13', 13);

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`id`, `precio`, `numPuesto_id`, `cobertura_id`) VALUES
(1, '280.00', 1, 1),
(2, '450.00', 1, 2),
(3, '620.00', 1, 3),
(4, '790.00', 1, 4);

--
-- Volcado de datos para la tabla `tipovehiculo`
--

INSERT INTO `tipovehiculo` (`id`, `tipoVehiculo`, `claseVehiculo_id`) VALUES
(1, 'PASEO', 1),
(2, 'SCOOTER', 1),
(3, 'ENDURO', 1),
(4, 'SEDAN', 2),
(5, 'COUPE', 2),
(6, 'HATCHBACK', 2),
(7, 'CONVERTIBLE', 2),
(8, 'SPORT WAGON', 3),
(9, 'PICK UP', 3),
(10, 'VAN', 3),
(11, 'MINI BUS', 3),
(12, 'TECHO DURO', 4),
(13, 'TECHO LONA', 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
