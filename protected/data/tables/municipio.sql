-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2014 a las 03:13:43
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

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `municipio`, `estado_id`) VALUES
(1, 'ALTO ORINOCO (LA ESMERALDA)', 1),
(3, 'ATABAPO (SAN FERNANDO DE ATABAPO)', 1),
(4, 'ATURES (PUERTO AYACUCHO)', 1),
(5, 'AUTANA (ISLA RATON)', 1),
(6, 'MANAPIARE (SAN JUAN DE MANAPIARE)', 1),
(7, 'MAROA (MAROA)', 1),
(8, 'RIO NEGRO (SAN CARLOS DE RIO NEGRO)', 1),
(9, 'ANACO (ANACO)', 2),
(10, 'ARAGUA (ARAGUA DE BARCELONA)', 2),
(11, 'BOLIVAR (BARCELONA)', 2),
(12, 'BRUZUAL (CLARINES)', 2),
(13, 'CAJIGAL (ONOTO)', 2),
(14, 'CARVAJAL (VALLE DE GUANAPE)', 2),
(15, 'FREITES (CANTAURA)', 2),
(16, 'GUANIPA (SAN JOSE DE GUANIPA)', 2),
(17, 'GUANTA (GUANTA)', 2),
(18, 'INDEPENDENCIA (SOLEDAD)', 2),
(19, 'LIBERTAD (SAN MATEO)', 2),
(20, 'MCGREGOR (EL CHAPARRO)', 2),
(21, 'MIRANDA (PARIAGUAN)', 2),
(22, 'MONAGAS (MAPIRE)', 2),
(23, 'PEÑALVER (PUERTO PÍRITU)', 2),
(24, 'PÍRITU (PÍRITU)', 2),
(26, 'SAN JUAN DE CAPISTRANO (BOCA DE UCHIRE)', 2),
(27, 'SANTA ANA (SANTA ANA)', 2),
(28, 'SIMÓN RODRÍGUEZ (EL TIGRE)', 2),
(29, 'SOTILLO (PUERTO LA CRUZ)', 2),
(30, 'URBANEJA (LECHERÍA)', 2),
(31, 'ACHAGUAS (ACHAGUAS)', 3),
(32, 'BIRUACA (BIRUACA)', 3),
(33, 'CAMEJO (SAN JUAN DE PAYARA)', 3),
(34, 'MUÑOZ (BRUZUAL)', 3),
(35, 'PAÉZ (GUASDUALITO)', 3),
(36, 'RÓMULO GALLEGOS (ELORZA)', 3),
(37, 'SAN FERNANDO (SAN FERNANDO DE APURE)', 3),
(38, 'ALCÁNTARA (SANTA RITA)', 4),
(39, 'BOLÍVAR (SAN MATEO)', 4),
(40, 'CAMATAGUA (CAMATAGUA)', 4),
(41, 'GIRARDOT (MARACAY)', 4),
(42, 'IRAGORRY (EL LIMÓN)', 4),
(43, 'LAMAS (SANTA CRUZ DE ARAGUA)', 4),
(44, 'LIBERTADOR (PALO NEGRO)', 4),
(45, 'MARIÑO (TURMERO)', 4),
(46, 'MICHELENA (LAS TEJERÍAS)', 4),
(47, 'OCUMARE (OCUMARE DE LA COSTA DE ORO)', 4),
(48, 'REVENGA (EL CONSEJO)', 4),
(49, 'RIBAS (LA VICTORIA)', 4),
(50, 'SAN CASIMIRO (SAN CASIMIRO)', 4),
(51, 'SAN SEBASTIÁN (SAN SEBASTIÁN DE LOS REYES)', 4),
(52, 'SUCRE (CAGUA)', 4),
(53, 'TOVAR (COLONIA TOVAR)', 4),
(54, 'URDANETA (BARBACOAS)', 4),
(55, 'ZAMORA (VILLA DE CURA)', 4),
(56, 'BLANCO (EL CANTÓN)', 5),
(57, 'ARISMENDI (ARISMENDI)', 5),
(58, 'BARINAS (BARINAS)', 5),
(59, 'BOLÍVAR (BARINITAS)', 5),
(60, 'CRUZ PAREDES (BARRANCAS)', 5),
(61, 'OBISPOS (OBISPOS)', 5),
(62, 'PEDRAZA (CIUDAD BOLIVIA)', 5),
(63, 'ROJAS (LIBERTAD)', 5),
(64, 'SOSA (CIUDAD DE NUTRIAS)', 5),
(65, 'SUCRE (SOCOPÓ)', 5),
(66, 'TORREALBA (SABANETA)', 5),
(67, 'ZAMORA (SANTA BÁRBARA)', 5),
(68, 'ANGOSTURA (CIUDAD PIAR)', 6),
(69, 'CARONÍ (CIUDAD GUAYANA)', 6),
(70, 'CEDEÑO (CAICARA DEL ORINOCO)', 6),
(71, 'CHIEN (EL PALMAR)', 6),
(72, 'EL CALLAO (EL CALLAO)', 6),
(73, 'GRAN SABANA (SANTA ELENA DE UAIRÉN)', 6),
(74, 'HERES (CIUDAD BOLÍVAR)', 6),
(75, 'PIAR (UPATA)', 6),
(76, 'ROSCIO (GUASIPATI)', 6),
(77, 'SIFONTES ( EL DORADO)', 6),
(78, 'SUCRE (MARIPA)', 6),
(79, 'ARVELO (GÜIGÜE)', 7),
(80, 'BEJUMA (BEJUMA)', 7),
(81, 'GUACARA (GUACARA)', 7),
(82, 'IBARRA (MARIARA)', 7),
(83, 'LIBERTADOR (TOCUYITO)', 7),
(84, 'LOS GUAYOS (LOS GUAYOS)', 7),
(85, 'MIRANDA (MIRANDA)', 7),
(86, 'MORA (MORÓN)', 7),
(87, 'MONTALBÁN (MONTALBÁN)', 7),
(88, 'NAGUANAGUA (NAGUANAGUA)', 7),
(89, 'PUERTO CABELLO (PUERTO CABELLO)', 7),
(90, 'SAN DIEGO (SAN DIEGO)', 7),
(92, 'SAN JOAQUÍN (SAN JOAQUÍN)', 7),
(93, 'VALENCIA (VALENCIA)', 7),
(94, 'ANZOÁTEGUI (COJEDES)', 8),
(95, 'TINAQUILLO (TINAQUILLO)', 8),
(96, 'GIRARDOT (EL BAÚL)', 8),
(97, 'LIMA BLANCO (MACAPO)', 8),
(98, 'PAO DE SAN JUAN BAUTISTA (EL PAO)', 8),
(99, 'RICAURTE (LIBERTAD)', 8),
(100, 'RÓMULO GALLEGOS (LAS VEGAS)', 8),
(101, 'SAN CARLOS (SAN CARLOS)', 8),
(102, 'TINACO (TINACO)', 8),
(103, 'ANTONIO DÍAZ (CURIAPO)', 9),
(104, 'CASACOIMA ( SIERRA IMATACA)', 9),
(105, 'PEDERNALES (PEDERNALES)', 9),
(106, 'TUCUPITA (TUCUPITA)', 9),
(107, 'LIBERTADOR (CARACAS)', 11),
(108, 'ACOSTA (SAN JUAN DE LOS CAYOS)', 12),
(109, 'BOLÍVAR (SAN LUIS)', 12),
(110, 'BUCHIVACOA (CAPATÁRIDA)', 12),
(111, 'CARIRUBANA (PUNTO FIJO)', 12),
(112, 'COLINA (LA VELA DE CORO)', 12),
(113, 'DABAJURO (DABAJURO)', 12),
(114, 'DEMOCRACIA (PEDREGAL)', 12),
(115, 'FALCÓN (PUEBLO NUEVO)', 12),
(116, 'FEDERACIÓN (CHURUGUARA)', 12),
(117, 'ITURRIZA (CHICHIRIVICHE)', 12),
(118, 'JACURA (JACURA)', 12),
(119, 'LOS TAQUES (SANTA CRUZ DE LOS TAQUES)', 12),
(120, 'MANAURE (YARACAL)', 12),
(121, 'MAUROA (MENE DE MAUROA)', 12),
(122, 'MIRANDA (SANTA ANA DE CORO)', 12),
(123, 'PALMASOLA (PALMASOLA)', 12),
(124, 'PETIT (CABURE)', 12),
(125, 'PÍRITU (PÍRITU)', 12),
(126, 'SAN FRANCISCO (MIRIMIRE)', 12),
(127, 'SUCRE (LA CRUZ DE TARATARA)', 12),
(128, 'SILVA (TUCACAS)', 12),
(129, 'TOCÓPERO (TOCÓPERO)', 12),
(130, 'UNIÓN (SANTA CRUZ DE BUCARAL)', 12),
(131, 'URUMACO (URUMACO)', 12),
(132, 'ZAMORA (PUERTO CUMAREBO)', 12),
(133, 'CAMAGUÁN (CAMAGUÁN)', 13),
(134, 'CHAGUARAMAS (CHAGUARAMAS)', 13),
(135, 'EL SOCORRO (EL SOCORRO)', 13),
(136, 'INFANTE (VALLE DE LA PASCUA)', 13),
(137, 'LAS MERCEDES (LAS MERCEDES)', 13),
(138, 'MELLADO (EL SOMBRERO)', 13),
(139, 'MIRANDA (CALABOZO)', 13),
(140, 'MONAGAS (ALTAGRACIA DE ORITUCO)', 13),
(141, 'ORTÍZ (ORTÍZ)', 13),
(142, 'RIBAS (TUCUPIDO)', 13),
(143, 'ROSCIO (SAN JUAN DE LOS MORROS)', 13),
(144, 'SAN GERÓNIMO DE GUAYABAL (GUAYABAL)', 13),
(145, 'SAN JOSÉ DE GUARIBE (SAN JOSÉ DE GUARIBE)', 13),
(146, 'SANTA MARÍA DE IPIRE (SANTA MARÍA DE IPIRE)', 13),
(147, 'ZARAZA (ZARAZA)', 13),
(148, 'BLANCO (SANARE)', 15),
(149, 'CRESPO (DUACA)', 15),
(150, 'IRIBARREN (BARQUISIMETO)', 15),
(151, 'JIMÉNEZ (QUIBOR)', 15),
(152, 'MORÁN (EL TOCUYO)', 15),
(153, 'PALAVECINO (CABUDARE)', 15),
(154, 'PLANAS (SARARE)', 15),
(155, 'TORRES (CARORA)', 15),
(156, 'URDANETA (SIQUISIQUE)', 15),
(157, 'ADRIANI (EL VIGÍA)', 16),
(158, 'ANDRÉS BELLO (LA AZULITA)', 16),
(159, 'ARICAGUA (ARICAGUA)', 16),
(160, 'BRICEÑO (TORONDOY)', 16),
(161, 'CHACÓN (CANAGUÁ)', 16),
(162, 'CAMPO ELÍAS (EJIDO)', 16),
(163, 'DÁVILA (BAILADORES)', 16),
(164, 'FEBRES CORDERO (NUEVA BOLIVIA)', 16),
(165, 'GUARAQUE (GUARAQUE)', 16),
(166, 'LIBERTADOR (MÉRIDA)', 16),
(167, 'MIRANDA (TIMOTES)', 16),
(168, 'NOGUERA (SANTA MARÍA DE CAPARO)', 16),
(169, 'PARRA OLMEDO (TUCANÍ)', 16),
(170, 'PINTO SALINAS (SANTA CRUZ DE MORA)', 16),
(171, 'PUEBLO LLANO (PUEBLO LLANO)', 16),
(172, 'QUINTERO (SANTO DOMINGO)', 16),
(173, 'RANGEL (MUCUCHÍES)', 16),
(174, 'RAMOS DE LORA (SANTA ELENA DE ARENALES)', 16),
(175, 'SALAS (ARAPUEY)', 16),
(176, 'MARQUINA (TABAY)', 16),
(177, 'SUCRE (LAGUNILLAS)', 16),
(178, 'TOVAR (TOVAR)', 16),
(179, 'ZEA (ZEA)', 16),
(180, 'ACEVEDO (CAUCAGUA)', 17),
(181, 'ANDRÉS BELLO (SAN JOSÉ DE BARLOVENTO)', 17),
(182, 'BARUTA (BARUTA)', 17),
(183, 'BRIÓN (HIGUEROTE)', 17),
(184, 'BOLÍVAR (SAN FRANCISCO DE YARE)', 17),
(185, 'BURÓZ (MAMPORAL)', 17),
(186, 'CARRIZAL (CARRIZAL)', 17),
(187, 'CHACAO (CHACAO)', 17),
(188, 'CRISTÓBAL ROJAS (CHARALLAVE)', 17),
(189, 'EL HATILLO (SANTA ROSALÍA DE PALERMO)', 17),
(190, 'GUACAIPURO (LOS TEQUES)', 17),
(191, 'GUAL (CÚPIRA)', 17),
(192, 'INDEPENDENCIA (SANTA TERESA DEL TUY)', 17),
(193, 'LANDER (OCUMARE DEL TUY)', 17),
(194, 'LOS SALIAS (SAN ANTONIO DE LOS ALTOS)', 17),
(195, 'PAÉZ (RÍO CHICO)', 17),
(196, 'PAZ CASTILLO (SANTA LUCÍA)', 17),
(197, 'PLAZA (GUARENAS)', 17),
(198, 'SUCRE (PETARE)', 17),
(199, 'URDANETA (CÚA)', 17),
(200, 'ZAMORA (GUATIRE)', 17),
(201, 'ACOSTA (SAN ANTONIO DE CAPAYACUAR)', 18),
(202, 'AGUASAY (AGUASAY)', 18),
(203, 'BOLÍVAR (CARIPITO)', 18),
(204, 'CARIPE ( CARIPE)', 18),
(205, 'CEDEÑO ( CAICARA DE MATURÍN)', 18),
(206, 'LIBERTADOR ( TEMBLADOR)', 18),
(207, 'MATURÍN (MATURÍN)', 18),
(208, 'PIAR (ARAGUA DE MATURÍN)', 18),
(209, 'PUNCERES (QUIRIQUIRE)', 18),
(210, 'SANTA BÁRBARA (SANTA BÁRBARA)', 18),
(211, 'SOTILLO (BARRANCAS DEL ORINOCO)', 18),
(212, 'URACOA (URACOA)', 18),
(213, 'ZAMORA (PUNTA DE MATA)', 18),
(214, 'ANTOLÍN DEL CAMPO (PARAGUACHÍ)', 19),
(215, 'ARISMENDI (LA ASUNCIÓN)', 19),
(216, 'DÍAZ (SAN JUAN BAUTISTA)', 19),
(217, 'GARCÍA (EL VALLE)', 19),
(218, 'GÓMEZ (SANTA ANA)', 19),
(219, 'MACANAO (BOCA DE RÍO)', 19),
(220, 'MANEIRO (PAMPATAR)', 19),
(221, 'MARCANO (JUAN GRIEGO)', 19),
(222, 'MARIÑO (PORLAMAR)', 19),
(223, 'TUBORES ( PUNTA DE PIEDRAS)', 19),
(224, 'VILLALBA ( SAN PEDRO DE COCHE)', 19),
(225, 'AGUA BLANCA ( AGUA BLANCA)', 20),
(226, 'ARAURE (ARAURE)', 20),
(227, 'ESTELLER (PÍRITU)', 20),
(228, 'GUANARE (GUANARE)', 20),
(229, 'GUANARITO (GUANARITO)', 20),
(230, 'OSPINO (OSPINO)', 20),
(231, 'PÁEZ (ACARIGUA)', 20),
(232, 'PAPELÓN (PAPELÓN)', 20),
(233, 'SAN GENARO DE BOCONOITO (BOCONOITO)', 20),
(234, 'SAN RAFAEL DE ONOTO (SAN RAFAEL DE ONOTO)', 20),
(235, 'SANTA ROSALÍA ( EL PLAYÓN)', 20),
(236, 'SUCRE (BISCUCUY)', 20),
(237, 'TURÉN (VILLA BRUZUAL)', 20),
(238, 'UNDA (CHABASQUÉN)', 20),
(239, 'ARISMENDI (RÍO CARIBE)', 21),
(240, 'BENÍTEZ (EL PILAR)', 21),
(241, 'BERMÚDEZ  (CARÚPANO)', 21),
(242, 'BLANCO (CASANAY)', 21),
(243, 'BOLÍVAR (MARIGÜITAR)', 21),
(244, 'CAJIGAL (YAGUARAPARO)', 21),
(245, 'CRUZ SALMERÓN ACOSTA (ARAYA)', 21),
(246, 'LIBERTADOR (TUNAPUY)', 21),
(247, 'MARIÑO (IRAPA)', 21),
(248, 'MATA ( SAN JOSÉ DE AEROCUAR)', 21),
(249, 'MEJÍA ( SAN ANTONIO DEL GOLFO)', 21),
(250, 'MONTES (CUMANACOA)', 21),
(251, 'RIBERO (CARIACO)', 21),
(252, 'SUCRE (CUMANÁ)', 21),
(253, 'VALDEZ ( GÜIRIA)', 21),
(254, 'ANDRÉS BELLO (CORDERO)', 22),
(255, 'AYACUCHO ( COLÓN)', 22),
(256, 'BOLÍVAR (SAN ANTONIO DEL TÁCHIRA)', 22),
(257, 'CÁRDENAS (SANTA ANA DE TÁCHIRA)', 22),
(259, 'GUÁSIMOS (PALMIRA)', 22),
(260, 'HEVIA (LA FRÍA)', 22),
(261, 'INDEPENDENCIA (CAPACHO NUEVO)', 22),
(264, 'LIBERTAD (CAPACHO VIEJO)', 22),
(266, 'LOBATERA (LOBATERA)', 21),
(267, 'MALDONADO (LA TENDIDA)', 21),
(268, 'MICHELENA (MICHELENA)', 21),
(269, 'MIRANDA (SAN JOSÉ DE BOLÍVAR)', 21),
(270, 'PANAMERICANO (COLONCITO)', 22),
(271, 'RÓMULO COSTA (LAS MESAS)', 22),
(272, 'SAN CRISTÓBAL (SAN CRISTÓBAL)', 22),
(273, 'SAN JUDAS TADEO (UMUQUENA)', 22),
(274, 'SEBORUCO (SEBORUCO)', 22),
(275, 'SIMÓN RODRÍGUEZ (SAN SIMÓN)', 22),
(276, 'SUCRE (QUENIQUEA)', 22),
(277, 'TORBES (SAN JOSECITO)', 22),
(278, 'URDANETA (DELICIAS)', 22),
(279, 'UREÑA (UREÑA)', 22),
(280, 'URIBANTE (PREGONERO)', 22),
(281, 'VARGAS (EL COBRE)', 22),
(282, 'ANDRÉS BELLO (SANTA ISABEL)', 23),
(283, 'BOCONÓ (BOCONÓ)', 23),
(284, 'BOLÍVAR (SABANA GRANDE)', 23),
(285, 'CANDELARIA (CHEJENDÉ)', 23),
(286, 'CARACHE  (CARACHE)', 23),
(287, 'CAMPOS ELÍAS ( CAMPO ELÍAS)', 23),
(288, 'CARVAJAL (CARVAJAL)', 23),
(289, 'ESCUQUE (ESCUQUE)', 23),
(290, 'LA CEIBA (SANTA APOLONIA)', 23),
(291, 'MARQUEZ CAÑIZALES  ( EL PARADERO)', 23),
(292, 'MIRANDA  (EL DIVIDIVE)', 23),
(293, 'MONTE CARMELO  (MONTE CARMELO)', 23),
(294, 'MOTATÁN (MOTATÁN)', 23),
(295, 'PAMPÁN (PAMPÁN)', 23),
(296, 'PAMPANITO (PAMPANITO)', 23),
(297, 'RANGEL (BETIJOQUE)', 23),
(298, 'SUCRE  (SABANA DE MENDOZA)', 23),
(299, 'TRUJILLO  (TRUJILLO)', 23),
(300, 'URDANETA  (LA QUEBRADA)', 23),
(301, 'VALERA  (VALERA)', 23),
(302, 'VARGAS  (LA GUAIRA)', 24),
(303, 'BASTIDAS  (SAN PABLO)', 25),
(304, 'BOLÍVAR (AROA)', 25),
(305, 'BRUZUAL  (CHIVACOA)', 25),
(306, 'COCOROTE  (COCOROTE)', 25),
(307, 'INDEPENDENCIA  (INDEPENDENCIA)', 25),
(308, 'LA TRINIDAD  (BORAURE)', 25),
(309, 'MONGE  ( YUMARE)', 25),
(310, 'NIRGUA (NIRGUA)', 25),
(311, 'PÁEZ (SABANA DE PARRA)', 25),
(312, 'PEÑA (YARITAGUA)', 25),
(313, 'SAN FELIPE  (SAN FELIPE)', 25),
(314, 'SUCRE  (GUAMA)', 25),
(315, 'URACHICHE  (URACHICHE)', 25),
(316, 'VEROES  (FARRIAR)', 25),
(317, 'BOLIVAR (TIA JUANA)', 26),
(318, 'BARALT  (SAN TIMOTEO)', 26),
(319, 'CABIMAS  (CABIMAS)', 26),
(320, 'CATATUMBO  (ENCONTRADOS)', 26),
(321, 'COLÓN (SAN CARLOS DEL ZULIA)', 26),
(322, 'GUAJIRA  (SINAMAICA)', 26),
(324, 'PULGAR  (PUEBLO NUEVO-EL CHIVO)', 26),
(325, 'LOSADA  (LA CONCEPCIÓN)', 26),
(326, 'SEMPRÚN (CASIGUA EL CUBO)', 26),
(327, 'LA CAÑADA  (CONCEPCIÓN)', 26),
(328, 'LAGUNILLAS  (CIUDAD OJEDA)', 26),
(329, 'MACHIQUES  (MACHIQUES)', 26),
(330, 'MARA  (SAN RAFAEL DEL MOJÁN)', 26),
(331, 'MARACAIBO  (MARACAIBO)', 26),
(332, 'MIRANDA  (LOS PUERTOS DE ALTAGRACIA)', 26),
(333, 'ROSARIO  (LA VILLA DEL ROSARIO)', 26),
(334, 'SAN FRANCISCO  (SAN FRANCISCO)', 26),
(335, 'SANTA RITA  (SANTA RITA)', 26),
(336, 'SUCRE  (BOBURES)', 26),
(337, 'RODRÍGUEZ  (BACHAQUERO)', 26),
(338, 'CÓRDOBA', 22),
(339, 'FERNÁNDEZ FEO', 22),
(340, 'FRANCISCO DE MIRANDA', 22),
(341, 'JÁUREGUI', 22),
(342, 'JUNÍN', 22),
(343, 'LIBERTADOR', 22),
(344, 'LOBATERA', 22),
(345, 'MICHELENA', 22),
(346, 'MALDONADO', 22);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
