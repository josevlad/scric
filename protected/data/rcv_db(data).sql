-- phpMyAdmin SQL Dump
-- version 4.2.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2014 at 03:51 AM
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

INSERT INTO `agencias` (`id`, `nombre_ag`, `identificador`) VALUES
(1, 'SAN BERNARDINO', 'SB'),
(2, 'EL CUARTEL', 'EC');

INSERT INTO `estados` (`id`, `estado`) VALUES
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

INSERT INTO `marcas` (`id`, `marca`) VALUES
(1, 'Chevrolet'),
(2, 'Fiat'),
(3, 'Ford'),
(4, 'Jeep'),
(5, 'Toyota'),
(6, 'Bera'),
(7, 'Empire'),
(8, 'Kawasaki');

INSERT INTO `modelos` (`id`, `modelo`, `marcas_id`) VALUES
(1, 'Aveo', 1),
(2, 'Malibú', 1),
(3, 'R1', 6),
(4, 'DT', 6);

INSERT INTO `municipios` (`id`, `municipio`, `estados_id`) VALUES
(1, 'Libertador', 10),
(2, 'Alto Orinoco', 1),
(3, 'Atabapo', 1),
(4, 'Atures ', 1),
(5, 'Autana ', 1),
(6, 'Manapiare', 1),
(7, 'Maroa', 1),
(8, 'Rí­o Negro', 1);

INSERT INTO `parroquias` (`id`, `parroquia`, `municipios_id`) VALUES
(1, '23 de enero', 1),
(2, 'Altagracia', 1),
(3, 'Antí­mano ', 1),
(4, 'Caricuao', 1),
(5, 'Catedral', 1),
(6, 'Coche', 1),
(7, 'El Junquito', 1),
(8, 'El Paraíso', 1),
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
(20, 'Santa Rosalía', 1),
(21, 'Santa Teresa', 1),
(22, 'Sucre (Catia)', 1);

INSERT INTO `perfil` (`id`, `perfil`) VALUES
(1, 'ADMIN_DB'),
(2, 'ASESOR'),
(3, 'AUDITOR');

INSERT INTO `preguntas` (`id`, `pregunta`) VALUES
(1, '¿CUAL FUE EL NOMBRE DE TU PRIMERA MASCOTA?'),
(2, '¿CUAL EL ES SEGUNDO NOMBRE DE TU PADRE?'),
(3, '¿DONDE CONOCISTES A TU PAREJA?');

INSERT INTO `stusuarios` (`id`, `status`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

INSERT INTO `tipotelf` (`id`, `tpTelf`) VALUES
(1, 'PERSONAL'),
(2, 'TRABAJO'),
(3, 'HABITACIÓN'),
(4, 'FAX');

INSERT INTO `tppersona` (`id`, `tpPersona`) VALUES
(1, 'PERSONA NATURAL'),
(2, 'PERSONA JURIDICA'),
(3, 'ENTE GUBERNAMENTAL');

INSERT INTO `trans` (`id`, `trans`) VALUES
(1, 'AUTOMATICA'),
(2, 'SINCRONICA'),
(3, 'DUAL');


INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `nick`, `clave`, `respuesta`, `perfil_id`, `agencias_id`, `preguntas_id`, `stUsuarios_id`) VALUES
(1, 'VLADIMIR J', 'CASTAÑEDA G', 'josevlad', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 1, 1, 1),
(2, 'ZURAIMA J', 'RUIZ DE CASTAÑEDA', 'zoro2002', '202cb962ac59075b964b07152d234b70', 'PERRO', 2, 1, 1, 1),
(3, 'ALVARO G', 'HERNANDEZ R', 'alvaro_g', '202cb962ac59075b964b07152d234b70', 'PERRO', 3, 1, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
