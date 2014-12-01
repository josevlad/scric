-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2014 at 01:06 AM
-- Server version: 5.5.40
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rcv_db`
--

--
-- Dumping data for table `agencias`
--

INSERT INTO `agencias` (`id`, `nombre_ag`, `identificador`) VALUES
(1, 'SAN BERNARDINO', 'SB'),
(2, 'EL CUARTEL', 'EC');

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id`, `estado`) VALUES
(1, 'AMAZONAS'),
(2, 'ANZOÁTEGUI'),
(3, 'APURE'),
(4, 'ARAGUA'),
(5, 'BARINAS'),
(6, 'BOLÍVAR'),
(7, 'CARABOBO'),
(8, 'COJEDES'),
(9, 'DELTA AMACURO'),
(10, 'DISTRITO CAPITAL');

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`id`, `marca`) VALUES
(1, 'Chevrolet'),
(2, 'Fiat'),
(3, 'Ford'),
(4, 'Jeep'),
(5, 'Toyota'),
(6, 'Bera'),
(7, 'Empire'),
(8, 'Kawasaki');

--
-- Dumping data for table `modelo`
--

INSERT INTO `modelo` (`id`, `modelo`, `marca_id`) VALUES
(1, 'Aveo', 1),
(2, 'MalibÚ', 1),
(3, 'R1', 6),
(4, 'DT', 6);

--
-- Dumping data for table `municipio`
--

INSERT INTO `municipio` (`id`, `municipio`, `estado_id`) VALUES
(1, 'Libertador', 10),
(2, 'Alto Orinoco', 1),
(3, 'Atabapo', 1),
(4, 'Atures ', 1),
(5, 'Autana ', 1),
(6, 'Manapiare', 1),
(7, 'Maroa', 1),
(8, 'Rí­o Negro', 1);

--
-- Dumping data for table `parroquia`
--

INSERT INTO `parroquia` (`id`, `parroquia`, `municipio_id`) VALUES
(1, '23 de enero', 1),
(2, 'Altagracia', 1),
(3, 'Antí­mano ', 1),
(4, 'Caricuao', 1),
(5, 'Catedral', 1),
(6, 'Coche', 1),
(7, 'El Junquito', 1),
(8, 'El Paraí­so', 1),
(9, 'El Recreo', 1),
(10, 'El Valle', 1),
(11, 'Candelaria', 1),
(12, 'La Pastora', 1),
(13, 'La Vega', 1),
(14, 'Macarao', 1),
(15, 'San Agustín', 1),
(16, 'San Bernardino', 1),
(17, 'San José', 1),
(18, 'San Juan', 1),
(19, 'San Pedro', 1),
(20, 'Santa Rosalí­a', 1),
(21, 'Santa Teresa', 1),
(22, 'Sucre (Catia)', 1);

--
-- Dumping data for table `perfilusuario`
--

INSERT INTO `perfilusuario` (`id`, `perfilUsuario`) VALUES
(1, 'ADMIN_DB'),
(2, 'ASESOR'),
(3, 'AUDITOR');

--
-- Dumping data for table `pregunta`
--

INSERT INTO `pregunta` (`id`, `pregunta`) VALUES
(1, '¿CUAL FUE EL NOMBRE DE TU PRIMERA MASCOTA?'),
(2, '¿CUAL EL ES SEGUNDO NOMBRE DE TU PADRE?'),
(3, '¿DONDE CONOCISTES A TU PAREJA?');

--
-- Dumping data for table `statususuarios`
--

INSERT INTO `statususuarios` (`id`, `statusUsuarios`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

--
-- Dumping data for table `tipopersona`
--

INSERT INTO `tipopersona` (`id`, `tipoPersona`) VALUES
(1, 'PERSONA NATURAL'),
(2, 'PERSONA JURIDICA'),
(3, 'ENTE GUBERNAMENTAL');

--
-- Dumping data for table `tipotelf`
--

INSERT INTO `tipotelf` (`id`, `tipoTelf`) VALUES
(1, 'PERSONAL'),
(2, 'TRABAJO'),
(3, 'HABITACIÓN'),
(4, 'FAX');

--
-- Dumping data for table `tipotrans`
--

INSERT INTO `tipotrans` (`id`, `tipoTrans`) VALUES
(1, 'AUTOMATICA'),
(2, 'SINCRONICA'),
(3, 'DUAL');

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `nick`, `clave`, `respuesta`, `agencias_id`, `perfilUsuario_id`, `statusUsuarios_id`, `pregunta_id`) VALUES
(1, 'VLADIMIR J', 'CASTAÑEDA G', 'josevlad', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 1, 1, 1),
(2, 'ZURAIMA J', 'RUIZ DE CASTAÑEDA', 'zoro2002', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 2, 1, 1),
(3, 'ALVARO G', 'HERNANDEZ R', 'alvaro_g', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 3, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
