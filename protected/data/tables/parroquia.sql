-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2014 a las 03:14:43
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
-- Volcado de datos para la tabla `parroquia`
--

INSERT INTO `parroquia` (`id`, `parroquia`, `municipio_id`) VALUES
(1, 'ALTO ORINOCO LA ESMERALDA ', 1),
(2, 'HUACHAMACARE ACANAÑA', 1),
(3, 'MARAWAKA TOKY SHAMANAÑA', 1),
(4, 'MAVAKA MAVAKA', 1),
(5, 'SIERRA PARIMA PARIMABÉ', 1),
(6, 'UCATA LAJA LISA', 3),
(7, 'YAPACANA MACURUCO', 3),
(8, 'CANAME GUARINUMA', 3),
(9, 'FERNANDO GIRÓN TOVAR', 4),
(10, 'LUIS ALBERTO GÓMEZ', 4),
(11, 'PAHUEÑA LIMÓN DE PARHUEÑA', 4),
(12, 'PLATANILLAL PLATANILLAS', 4),
(13, 'SAMARIAPO SAMARIAPO', 5),
(14, 'SIPAPO PENDARE', 5),
(15, 'MUNDUAPO MUNDUAPO', 5),
(16, 'GUAYAPO SAN PEDRO DEL ORINOCO', 5),
(17, 'ALTO VENTUARI CACURÍ', 6),
(18, 'MEDIO VENTUARI MANAMI', 6),
(19, 'BAJO VENTUARI MARUETA', 6),
(20, 'VICTORINO', 7),
(21, 'COMUNIDAD', 7),
(22, 'CASIQUIARE CURIMACARE', 8),
(23, 'COCUY', 8),
(24, 'SAN CARLOS DE RÍO NEGRO', 8),
(25, 'SOLANO SOLANO', 8),
(26, 'ANACO', 9),
(27, 'SAN JOAQUÍN', 9),
(28, 'CACHIPO', 10),
(29, 'ARAGUA DE BARCELONA', 10),
(30, 'BERGATÍN', 11),
(31, 'CAIGUA', 11),
(32, 'EL CARMEN', 11),
(33, 'EL PILAR', 11),
(34, 'NARICUAL', 11),
(35, 'SAN CRISTÓBAL', 11),
(36, 'CLARINES', 12),
(37, 'GUANAPE', 12),
(38, 'SABANA DE UCHIRE', 12),
(39, 'ONOTO', 13),
(40, 'SAN PABLO', 13),
(41, 'VALLE DE GUANAPE', 14),
(42, 'SANTA BÁRBARA', 14),
(43, 'CANTAURA', 15),
(44, 'LIBERTADOR', 15),
(45, 'SANTA ROSa', 15),
(46, 'URICA', 15),
(47, 'SAN JOSÉ DE GUANIPA', 16),
(48, 'GUANTA', 17),
(49, 'CHORRERÓN', 17),
(50, 'MAMO', 18),
(51, 'SOLEDAD', 18),
(52, 'SAN MATEO', 19),
(53, 'EL CARITO', 19),
(54, 'SANTA INÉS', 19),
(55, 'LA ROMEREÑA', 19),
(56, 'EL CHAPARRO', 20),
(57, 'TOMÁS ALFARO', 20),
(58, 'CALATRAVA', 20),
(59, 'ATAPIRIRE', 21),
(60, 'BOCA DEL PAO', 21),
(61, 'EL PAO', 21),
(62, 'PARIAGUÁN', 21),
(63, 'MAPIRE', 22),
(64, 'PIAR', 22),
(65, 'SANTA CLARA', 22),
(66, 'SAN DIEGO DE CABRUTICA', 22),
(67, 'UVERITO', 22),
(68, 'ZUATA', 22),
(69, 'PUERTO PÍRITU', 23),
(70, 'SAN MIGUEL', 23),
(71, 'SUCRE', 23),
(72, 'PÍRITU', 24),
(73, 'SAN FRANCISCO', 24),
(74, 'BOCA DE UCHIRE', 26),
(75, 'BOCA DE CHÁVEZ', 26),
(76, 'PUEBLO NUEVO', 27),
(77, 'SANTA ANA', 27),
(78, 'EDMUNDO BARRIOS', 28),
(79, 'MIGUEL OTERO SILVA', 28),
(80, 'PUERTO LA CRUZ', 29),
(81, 'POZUELOS', 29),
(82, 'LECHERÍA', 30),
(83, 'EL MORRO', 30),
(84, 'ACHAGUAS', 31),
(85, 'APURITO', 31),
(86, 'EL YAGUAL', 31),
(87, 'GUACHARA', 31),
(88, 'MUCURITAS', 31),
(89, 'QUESERAS DEL MEDIO', 31),
(90, 'BIRUACA', 32),
(91, 'SAN JUAN DE PAYARA', 33),
(92, 'CODAZZI', 33),
(93, 'CUNAVICHE', 33),
(94, 'BRUZUAL', 34),
(95, 'MANTECAL', 34),
(96, 'QUINTERO', 34),
(97, 'RINCÓN HONDO', 34),
(98, 'SAN VICENTE', 34),
(99, 'GUASDUALITO', 35),
(100, 'ARAMENDI', 35),
(101, 'EL AMPARO', 35),
(102, 'SAN CAMILO', 35),
(103, 'URDANETA', 35),
(104, 'ELORZA', 36),
(105, 'LA TRINIDAD', 36),
(106, 'SAN FERNANDO', 37),
(107, 'EL RECREO', 37),
(108, 'PEÑALVER', 37),
(109, 'SAN RAFAEL DE ATAMAICA', 37),
(110, 'SANTA RITA', 38),
(111, 'FRANCISCO DE MIRANDa', 38),
(112, 'MONSEÑOR FELICIANO GONZÁLEZ', 38),
(113, 'BOLÍVAR', 39),
(114, 'CAMATAGUA', 40),
(115, 'CARMEN DE CURA', 40),
(116, 'PEDRO JOSÉ OVALLES', 41),
(117, 'JOAQUIN CRESPO', 41),
(118, 'JOSÉ CASANOVA GODOY', 41),
(119, 'MADRE MARÍA DE SAN JOSÉ', 41),
(120, 'ANDRÉS ELOY BLANCO', 41),
(121, 'LOS TACARIGUA', 41),
(122, 'LAS DELICIAS', 41),
(123, 'CHORONÍ', 41),
(124, 'EL LIMÓN', 42),
(125, 'CAÑA DE AZÚCAR', 42),
(126, 'SANTA CRUZ', 43),
(127, 'PALO NEGRO', 44),
(128, 'SAN MARTÍN DE PORRES', 44),
(129, 'TURMERO', 45),
(130, 'ARÉVALO APONTE', 45),
(131, 'CHUAO', 45),
(132, 'SAMÁN DE GÜERE', 45),
(133, 'ALFREDO PACHECO MIRANDA', 45),
(134, 'SANTOS MICHELENA', 46),
(135, 'TIARA', 46),
(136, 'OCUMARE DE LA COSTA', 47),
(137, 'JOSÉ RAFAEL REVENGA', 48),
(138, 'JOSÉ FÉLIX RIBAS', 49),
(139, 'CASTOR NIEVES RÍOS', 49),
(140, 'LAS GUACAMAYAS', 49),
(141, 'PAO DE ZÁRATE', 49),
(142, 'ZUATA', 49),
(143, 'SAN CASIMIRO', 50),
(144, 'GÜIRIPA', 50),
(145, 'OLLAS DE CARAMACATE', 50),
(146, 'VALLE MORÍN', 50),
(147, 'SAN SEBASTIÁN', 51),
(148, 'CAGUA', 52),
(149, 'BELLA VISTA', 52),
(150, 'TOVAR', 53),
(151, 'URDANETA', 54),
(152, 'LAS PEÑITAS', 54),
(153, 'SAN FRANCISCO DE CARA', 54),
(154, 'TAGUAY', 54),
(155, 'VILLA DE CURA', 55),
(156, 'MAGDALENO', 55),
(157, 'SAN FRANCISCO DE ASÍS', 55),
(158, 'VALLES DE TUCUTUNEMO', 55),
(159, 'AUGUSTO MIJARES', 55),
(160, 'EL CANTÓN', 56),
(161, 'SANTA CRUZ DE GUACAS', 56),
(162, 'PUERTO VIVAS', 56),
(163, 'ARISMENDI', 57),
(164, 'GUADARRAMA', 57),
(165, 'LA UNIÓN', 57),
(166, 'SAN ANTONIO', 57),
(167, 'BARINAS', 58),
(168, 'ALBERTO ARVELO LARRIVA', 58),
(169, 'SAN SILVESTRE', 58),
(170, 'SANTA INÉS', 58),
(171, 'SANTA LUCÍA', 58),
(172, 'TORUNOS', 58),
(173, 'EL CARMEN', 58),
(174, 'RÓMULO BETANCOURT', 58),
(175, 'CORAZÓN DE JESÚS', 58),
(176, 'RAMÓN IGNACIO MÉNDEZ', 58),
(177, 'ALTO BARINAS', 58),
(178, 'MANUEL PALACIO FAJARDO', 58),
(179, 'JUAN ANTONIO RODRÍGUEZ DOMÍNGUEZ', 58),
(180, 'DOMINGA ORTÍZ DE PÁEZ', 58),
(181, 'BARINITAS', 59),
(182, 'ALTAMIRA DE CÁCERES', 59),
(183, 'CALDERAS', 59),
(184, 'BARRANCAS', 60),
(185, 'EL SOCORRO', 60),
(186, 'MAZPARRITO', 60),
(187, 'OBISPOS', 61),
(188, 'LOS GUASIMITOS', 61),
(189, 'EL REAL', 61),
(190, 'LA LUZ', 61),
(191, 'CIUDAD BOLIVIA', 62),
(192, 'JOSÉ IGNACIO BRICEÑO', 62),
(193, 'JOSÉ FÉLIX RIBAS', 62),
(194, 'PÁEZ', 62),
(195, 'LIBERTAD', 63),
(196, 'DOLORES', 63),
(197, 'SANTA ROSA', 63),
(198, 'PALACIO FAJARDO', 63),
(199, 'SIMÓN RODRÍGUEZ', 63),
(200, 'CIUDAD DE NUTRIAS', 64),
(201, 'EL REGALO', 64),
(202, 'PUERTO NUTRIAS', 64),
(203, 'SANTA CATALINA', 64),
(204, 'SIMÓN BOLÍVAR', 64),
(205, 'TICOPORO', 65),
(206, 'NICOLÁS PULIDO', 65),
(207, 'ANDRÉS BELLO', 65),
(208, 'SABANETA', 66),
(209, 'JUAN ANTONIO RODRÍGUEZ DOMÍNGUEZ', 66),
(210, 'SANTA BÁRBARA', 67),
(211, 'PEDRO BRICEÑO MÉNDEZ', 67),
(212, 'RAMÓN IGNACIO MÉNDEZ', 67),
(213, 'JOSÉ IGNACIO DEL PUMAR', 67),
(214, 'RAÚL LEONI', 68),
(215, 'BARCELONETA', 68),
(216, 'SANTA BÁRBARA', 68),
(217, 'SAN FRANCISCO', 68),
(218, 'CACHAMAY', 69),
(219, 'CHIRICA', 69),
(220, 'DALLA COSTA', 69),
(221, 'ONCE DE ABRIL', 69),
(222, 'SIMÓN BOLÍVAR', 69),
(223, 'UNARE', 69),
(224, 'UNIVERSIDAD', 69),
(225, 'VISTA AL SOL', 69),
(226, 'POZO VERDE', 69),
(227, 'YOCOIMA', 69),
(228, '5 DE JULIO', 69),
(229, 'CEDEÑO', 70),
(230, 'ALTAGRACIA', 70),
(231, 'ASCENSIÓN FARRERAS', 70),
(232, 'GUANIAMO', 70),
(233, 'LA URBANA', 70),
(234, 'PIJIGUAOS', 70),
(235, 'PADRE PEDRO CHIEN', 71),
(236, 'RÍO GRANDE', 71),
(237, 'EL CALLAO', 72),
(238, 'GRAN SABANA', 73),
(239, 'CATEDRAL', 74),
(240, 'ZEA', 74),
(241, 'ORINOCO', 74),
(242, 'JOSÉ ANTONIO PÁEZ', 74),
(243, 'MARHUANTA', 74),
(244, 'AGUA SALADA', 74),
(245, 'VISTA HERMOSA', 74),
(246, 'LA SABANITA', 74),
(247, 'PANAPANA', 74),
(248, 'ANDRÉS ELOY BLANCO', 75),
(249, 'PEDRO COVA', 75),
(250, 'ROSCIO', 76),
(251, 'SALÓM', 76),
(252, 'SIFONTES', 77),
(253, 'DALLA COSTA', 77),
(254, 'SAN ISIDRO', 77),
(255, 'SUCRE', 78),
(256, 'ARIPAO', 78),
(257, 'GUARATARO', 78),
(258, 'LAS MAJADAS', 78),
(259, 'MOITACO', 78),
(260, 'GÜIGÜE', 79),
(261, 'BELÉN', 79),
(262, 'TACARIGUA', 79),
(263, 'BEJUMA', 80),
(264, 'CANOABO', 80),
(265, 'SIMÓN BOLÍVAR', 80),
(266, 'CIUDAD ALIANZA', 81),
(267, 'GUACARA', 81),
(268, 'YAGUA', 81),
(269, 'MARIARA', 82),
(270, 'AGUAS CALIENTES', 82),
(271, 'TOCUYITO', 83),
(272, 'INDEPENDENCIA', 83),
(273, 'LOS GUAYOS', 84),
(274, 'MIRANDA', 85),
(275, 'MORÓN', 86),
(276, 'URAMA', 86),
(277, 'MONTALBÁN', 87),
(278, 'NAGUANAGUA', 88),
(279, 'BARTOLOMÉ SALÓM', 89),
(280, 'DEMOCRACIA', 89),
(281, 'FRATERNIDAD', 89),
(282, 'GOAIGOAZA', 89),
(283, 'JUAN JOSÉ FLORES', 89),
(284, 'UNIÓN', 89),
(285, 'BORBURATA', 89),
(286, 'PATANEMO', 89),
(287, 'SAN DIEGO', 90),
(288, 'SAN JOAQUÍN', 92),
(289, 'URBANA CANDELARIA', 93),
(290, 'URBANA CATEDRAL', 93),
(291, 'URBANA EL SOCORRO', 93),
(292, 'URBANA MIGUEL PEÑA', 93),
(293, 'URBANA RAFAEL URDANETA', 93),
(294, 'URBANA SAN BLÁS', 93),
(295, 'URBANA SAN JOSÉ', 93),
(296, 'URBANA SANTA ROSA', 93),
(297, 'NO URBANA NEGRO PRIMERO', 93),
(298, 'COJEDES', 94),
(299, 'JUAN DE MATA SUÁREZ', 94),
(300, 'TINAQUILLO', 95),
(301, 'EL BAÚL', 96),
(302, 'SUCRE', 96),
(303, 'LA AGUADITA', 97),
(304, 'MACAPO', 97),
(305, 'EL PAO', 98),
(306, 'EL AMPARO', 99),
(307, 'LIBERTAD DE COJEDES', 99),
(308, 'RÓMULO GALLEGOS', 100),
(309, 'SAN CARLOS DE AUSTRIA', 101),
(310, 'JUAN ÁNGEL BRAVO', 101),
(311, 'MANUEL MANRIQUE', 101),
(312, 'GENERAL EN JEFE JOSÉ LAURENCIO SILVA', 102),
(313, 'CURIAPO', 103),
(314, 'ALMIRANTE LUIS BRIÓN', 103),
(315, 'FRANCISCO ANICETO LUGO BOCA DE CUYUBINI', 103),
(316, 'MANUEL RENAUD', 103),
(317, 'PADRE BARRAL', 103),
(318, 'SANTOS DE ABELGAS', 103),
(319, 'IMATACA MORUCA', 104),
(320, 'CINCO DE JULIO PIACOA', 104),
(321, 'JUAN BAUTISTA ARISMENDI', 104),
(322, 'MANUEL PIAR SANTA CATALINA', 104),
(323, 'RÓMULO GALLEGOS', 104),
(324, 'PEDERNALES', 105),
(325, 'LUIS BELTRÁN PRIETO FIGUEROA', 105),
(326, 'SAN JOSÉ (DELTA AMACURO) HACIENDA DEL MEDIO', 106),
(327, 'JOSÉ VIDAL MARCANO CAPARAL DE GUARA', 106),
(328, 'JUAN MILLÁN URB. LEONARDO RUIZ PINEDA', 106),
(329, 'LEONARDO RUIZ PINEDA PALOMA', 106),
(330, 'MARISCAL ANTONIO JOSÉ DE SUCRE URB. DELFÍN MENDOZA', 106),
(331, 'MONSEÑOR ARGIMIRO GARCÍA SAN RAFAEL', 106),
(332, 'SAN RAFAEL LA HORQUETA', 106),
(333, 'VIRGEN DEL VALLE', 106),
(334, '23 DE ENERO', 107),
(335, 'ALTAGRACIA', 107),
(336, 'ANTÍMANO', 107),
(337, 'CARICUAO', 107),
(338, 'CATEDRAL', 107),
(339, 'COCHE', 107),
(340, 'EL JUNQUITO', 107),
(341, 'EL PARAÍSO', 107),
(342, 'EL PARAÍSO', 107),
(343, 'EL RECREO', 107),
(344, 'EL VALLE', 107),
(345, 'CANDELARIA', 107),
(346, 'LA PASTORA', 107),
(347, 'LA VEGA', 107),
(348, 'MACARAO', 107),
(349, 'SAN AGUSTÍN', 107),
(350, 'SAN BERNARDINO', 107),
(351, 'SAN JOSÉ', 107),
(352, 'SAN JUAN', 107),
(353, 'SAN PEDRO', 107),
(354, 'SANTA ROSALÍA', 107),
(355, 'SANTA TERESA', 107),
(356, 'SUCRE (CATIA)', 107),
(357, 'CAPADARE', 108),
(358, 'LA PASTORA', 108),
(359, 'LIBERTADOR', 108),
(360, 'SAN JUAN DE LOS CAYOS', 108),
(361, 'ARACUA', 109),
(362, 'LA PEÑA', 109),
(363, 'SAN LUIS', 109),
(364, 'BARIRO', 110),
(365, 'BOROJÓ', 110),
(366, 'CAPATÁRIDA', 110),
(367, 'GUAJIRO', 110),
(368, 'SEQUE', 110),
(369, 'ZAZÁRIDA', 110),
(370, 'VALLE DE EROA', 110),
(371, 'NORTE', 111),
(372, 'CARIRUBANA', 111),
(373, 'SANTA ANA', 111),
(374, 'PUNTA CARDÓN', 111),
(375, 'LA VELA DE CORO', 112),
(376, 'ACURIGUA', 112),
(377, 'GUAIBACOA', 112),
(378, 'LAS CALDERAS', 112),
(379, 'MACORUCA', 112),
(380, 'DABAJURO', 113),
(381, 'AGUA CLARA', 114),
(382, 'AVARIA', 114),
(383, 'PEDREGAL', 114),
(384, 'PIEDRA GRANDE', 114),
(385, 'PURURECHE', 114),
(386, 'ADAURE', 115),
(387, 'ADÍCORa', 115),
(388, 'BARAIVED', 115),
(389, 'BUENA VISTA', 115),
(390, 'JADACAQUIVA', 115),
(391, 'EL VÍNCULO', 115),
(392, 'EL HATO', 115),
(393, 'MORUY', 115),
(394, 'PUEBLO NUEVO', 115),
(395, 'AGUA LARGA', 116),
(396, 'CHURUGUARA', 116),
(397, 'EL PAUJÍ', 116),
(398, 'INDEPENDENCIA', 116),
(399, 'MAPARARÍ', 116),
(400, 'BOCA DEL TOCUYO', 117),
(401, 'CHICHIRIVICHE', 117),
(402, 'TOCUYO DE LA COSTA', 117),
(403, 'AGUA LINDa', 118),
(404, 'ARAURIMA', 118),
(405, 'JACURA', 118),
(406, 'LOS TAQUES', 119),
(407, 'JUDIBANA', 119),
(408, 'CACIQUE MANAURE (YARACAL)', 120),
(409, 'MENE DE MAUROA', 121),
(410, 'SAN FÉLIX', 121),
(411, 'CASIGUA', 121),
(412, 'GUZMÁN GUILLERMO', 122),
(413, 'MITARE', 122),
(414, 'RÍO SECO', 122),
(415, 'SABANETA', 122),
(416, 'SAN ANTONIO', 122),
(417, 'SAN GABRIEL', 122),
(418, 'SANTA ANA', 122),
(419, 'PALMASOLA', 123),
(420, 'CABURE', 124),
(421, 'COLINA', 124),
(422, 'CURIMAGUA', 124),
(423, 'SAN JOSÉ DE LA COSTA', 125),
(424, 'PÍRITU', 125),
(425, 'SAN FRANCISCO', 126),
(426, 'SUCRE', 127),
(427, 'PECAYA', 127),
(428, 'TUCACAS', 128),
(429, 'BOCA DE AROA', 128),
(430, 'TOCÓPERO', 129),
(431, 'EL CHARAL', 130),
(432, 'LAS VEGAS DEL TUY', 130),
(433, 'SANTA CRUZ DE BUCARAL', 130),
(434, 'BRUZUAL', 131),
(435, 'URUMACO', 131),
(436, 'PUERTO CUMAREBO', 132),
(437, 'LA CIÉNAGA', 132),
(438, 'LA SOLEDAD', 132),
(439, 'PUEBLO CUMAREBO', 132),
(440, 'ZAZÁRIDA', 132),
(441, 'CAMAGUÁN', 133),
(442, 'PUERTO MIRANDA', 133),
(443, 'UVERITO', 133),
(444, 'CHAGUARAMAS', 134),
(445, 'EL SOCORRO', 135),
(446, 'VALLE DE LA PASCUA', 136),
(447, 'ESPINO', 136),
(448, 'LAS MERCEDES', 137),
(449, 'CABRUTA', 137),
(450, 'SANTA RITA DE MANAPIRE', 137),
(451, 'EL SOMBRERO', 138),
(452, 'SOSA', 138),
(453, 'EL CALVARIO', 139),
(454, 'EL RASTRO', 139),
(455, 'GUARDATINAJAS', 139),
(456, 'CALABOZO', 139),
(457, 'ALTAGRACIA DE ORITUCO', 140),
(458, 'SAN RAFAEL DE ORITUCO', 140),
(459, 'SAN FRANCISCO JAVIER DE LEZAMA', 140),
(460, 'PASO REAL DE MACAIRA', 140),
(461, 'CARLOS SOUBLETTE', 140),
(462, 'SAN FRANCISCO DE MACAIRA', 140),
(463, 'LIBERTAD DE ORITUCO', 140),
(464, 'SAN JOSÉ DE TIZNADOS', 141),
(465, 'SAN FRANCISCO DE TIZNADOS', 141),
(466, 'SAN LORENZO DE TIZNADOS', 141),
(467, 'ORTÍZ', 141),
(468, 'TUCUPIDO', 142),
(469, 'SAN RAFAEL DE LAYA', 142),
(470, 'CANTAGALLO', 143),
(471, 'SAN JUAN DE LOS MORROS', 143),
(472, 'PARAPARA', 143),
(473, 'GUAYABAL', 144),
(474, 'CAZORLA', 144),
(475, 'SAN JOSÉ DE GUARIBE', 145),
(476, 'UVERAL', 145),
(477, 'SANTA MARIA DE IPIRE', 146),
(478, 'ALTAMIRA', 146),
(479, 'SAN JOSÉ DE UNARE', 147),
(480, 'ZARAZA', 147),
(481, 'QUEBRADA HONDA DE GUACHE', 148),
(482, 'PÍO TAMAYO', 148),
(483, 'YACAMBÚ', 148),
(484, 'FREITEZ', 149),
(485, 'JOSÉ MARÍA BLANCO', 149),
(486, 'PRESIDENTE BETANCOURT', 157),
(487, 'PRESIDENTE PÁEZ', 157),
(488, 'PRESIDENTE RÓMULO GALLEGOS', 157),
(489, 'GABRIEL PICÓN GONZÁLEZ', 157),
(490, 'HÉCTOR AMABLE MORA', 157),
(491, 'JOSÉ NUCETE SARDI', 157),
(492, 'PULIDO MÉNDEZ', 157),
(493, 'LA AZULITA', 158),
(494, 'ARICAGUA', 159),
(495, 'SAN ANTONIO (CAMPO ELÍAS)', 159),
(496, 'SAN CRISTÓBAL DE TORONDOY', 160),
(497, 'TORONDOY', 160),
(498, 'CANAGUA', 161),
(499, 'CAPURÍ', 161),
(500, 'CHACANTÁ', 161),
(501, 'EL MOLINO', 161),
(502, 'GUAIMARAL', 161),
(503, 'MUCUTUY', 161),
(504, 'MUCUCHACHÍ', 161),
(505, 'FERNÁNDEZ PEÑA', 162),
(506, 'MATRIZ', 162),
(507, 'MONTALBÁN', 162),
(508, 'ACEQUIAS', 162),
(509, 'JAJÍ', 162),
(510, 'LA MESa', 162),
(511, 'SAN JOSÉ DEL SUR', 162),
(512, 'GERÓNIMO MALDONADO', 163),
(513, 'BAILADORES', 163),
(514, 'INDEPENDENCIA', 164),
(515, 'MARÍA DE LA CONCEPCIÓN PALACIOS BLANCO', 164),
(516, 'NUEVA BOLIVIA', 164),
(517, 'SANTA APOLONIA', 164),
(518, 'GUARAQUE', 165),
(519, 'MESA DE QUINTERO', 165),
(520, 'RÍO NEGRO', 165),
(521, 'ANTONIO SPINETTI DINI', 166),
(522, 'ARIAs', 166),
(523, 'CARACCIOLO PARRA PÉREZ', 166),
(524, 'DOMINGO PEÑa', 166),
(525, 'EL LLANO', 166),
(526, 'GONZALO PICÓN FEBREs', 166),
(527, 'JACINTO PLAZa', 166),
(528, 'JUAN RODRÍGUEZ SUÁREZ', 166),
(529, 'LASSO DE LA VEGA', 166),
(530, 'MARIANO PICÓN SALAS', 166),
(531, 'MILLA', 166),
(532, 'OSUNA RODRÍGUEZ', 166),
(533, 'SAGRARIO', 166),
(534, 'EL MORRO', 166),
(535, 'LOS NEVADOS', 166),
(536, 'ANDRÉS ELOY BLANCO', 167),
(537, 'LA VENTA', 167),
(538, 'PIÑANGO', 167),
(539, 'TIMOTEs', 167),
(540, 'SANTA MARÍA DE CAPARO', 168),
(541, 'TUCANÍ', 169),
(542, 'FLORENCIO RAMÍREZ', 169),
(543, 'SANTA CRUZ DE MORA', 170),
(544, 'MESA SOLÍVAR', 170),
(545, 'MESA DE LAS PALMAs', 170),
(546, 'PUEBLO LLANO', 171),
(547, 'SANTO DOMINGO', 172),
(548, 'LAS PIEDRAS', 172),
(549, 'CACUTE', 173),
(550, 'LA TOMA', 173),
(551, 'MUCUCHÍES', 173),
(552, 'MUCURUBÁ', 173),
(553, 'SAN RAFAEL', 173),
(554, 'ELOY PAREDES', 174),
(555, 'SAN RAFAEL DE ALCÁZAR', 174),
(556, 'SANTA ELENA DE ARENALES', 174),
(557, 'ARAPUEY', 175),
(558, 'PALMIRA', 175),
(559, 'ARAGÜITA', 180),
(560, 'ARÉVALO GONZÁLEZ', 180),
(561, 'CAPAYA', 180),
(562, 'CAUCAGUA', 180),
(563, 'PANAQUIRe', 180),
(564, 'RIBAs', 180),
(565, 'EL CAFÉ', 180),
(566, 'MARIZAPA', 180),
(567, 'CUMBO', 181),
(568, 'SAN JOSÉ DE BARLOVENTO', 181),
(569, 'EL CAFETAL', 182),
(570, 'LAS MINAS', 182),
(571, 'NUESTRA SEÑORA DEL ROSARIO', 182),
(572, 'HIGUEROTE', 183),
(573, 'CURIEPE', 183),
(574, 'TACARIGUA DE BRIÓN', 183),
(575, 'SAN ANTONIO DE YARE', 184),
(576, 'SAN FRANCISCO DE YARE', 184),
(577, 'MAMPORAL', 185),
(578, 'CARRIZAL', 186),
(579, 'CHACAO', 187),
(580, 'CHARALLAVE', 188),
(581, 'LAS BRISAS', 188),
(582, 'EL HATILLO', 189),
(583, 'ALTAGRACIA DE LA MONTAÑA', 190),
(584, 'CECILIO ACOSTA', 190),
(585, 'LOS TEQUES', 190),
(586, 'EL JARILLO', 190),
(587, 'SAN PEDRO', 190),
(588, 'TÁCATA', 190),
(589, 'PARACOTOS', 190),
(590, 'CÚPIRA', 191),
(591, 'MACHURUCUTO', 191),
(592, 'CARTANAL', 192),
(593, 'SANTA TERESA DEL TUY', 192),
(594, 'LA DEMOCRACIA', 193),
(595, 'OCUMARE DEL TUY', 193),
(596, 'SANTA BÁRBARA', 193),
(597, 'SAN ANTONIO DE LOS ALTOS', 194),
(598, 'RÍO CHICO', 195),
(599, 'EL GUAPO', 195),
(600, 'TACARIGUA DE LA LAGUNA', 195),
(601, 'PAPARO', 195),
(602, 'SAN FERNANDO DEL GUAPO', 195),
(603, 'SANTA LUCÍA DEL TUY', 196),
(604, 'GUARENAs', 197),
(605, 'LEONCIO MARTÍNEZ ', 198),
(606, 'PETARE', 198),
(607, 'CAUCAGÜITA', 198),
(608, 'FILAS DE MARICHE', 198),
(609, 'LA DOLORITA', 198),
(610, 'CÚA', 199),
(611, 'NUEVA CÚA', 199),
(612, 'GUATIRE', 200),
(613, 'BOLÍVAR', 200),
(614, 'SAN ANTONIO DE MATURÍN', 201),
(615, 'SAN FRANCISCO DE MATURÍN', 201),
(616, 'AGUASAY', 202),
(617, 'CARIPITO', 203),
(618, 'EL GUÁCHARO', 204),
(619, 'LA GUANOTA', 204),
(620, 'SABANA DE PIEDRA', 204),
(621, 'SAN AGUSTÍN', 204),
(622, 'TERESEN', 204),
(623, 'CARIPE', 204),
(624, 'AREO', 205),
(625, 'CAPITAL CEDEÑO', 205),
(626, 'SAN FÉLIX DE CANTALICIO', 205),
(627, 'VIENTO FRESCO', 205),
(628, 'CHAGUARAMAS', 206),
(629, 'LAS ALHUACAS', 206),
(630, 'TABASCA', 206),
(631, 'TEMBLADOR', 206),
(632, 'ALTO DE LOS GODOS', 207),
(633, 'BOQUERÓN', 207),
(634, 'LAS COCUIZAS', 207),
(635, 'LA CRUZ', 207),
(636, 'SAN SIMÓN', 207),
(637, 'EL COROZO', 207),
(638, 'EL FURRIAL', 207),
(639, 'JUSEPÍN', 207),
(640, 'LA PICA', 207),
(641, 'SAN VICENTE', 207),
(642, 'APARICIO', 208),
(643, 'ARAGUA DE MATURÍN', 208),
(644, 'CHAGUAMAL', 208),
(645, 'EL PINTO', 208),
(646, 'GUANAGUANA', 208),
(647, 'LA TOSCANA', 208),
(648, 'TAGUAYA', 208),
(649, 'CACHIPO', 209),
(650, 'QUIRIQUIRE', 209),
(651, 'SANTA BÁRBARA', 210),
(652, 'BARRANCAS', 211),
(653, 'LOS BARRANCOS DE FAJARDO', 211),
(654, 'URACOA', 212),
(655, 'PUNTA DE MATA', 213),
(656, 'ANTOLÍN DEL CAMPO', 214),
(657, 'ARISMENDI', 215),
(658, 'SAN JUAN BAUTISTA', 216),
(659, 'ZABALA', 216),
(660, 'GARCÍA', 217),
(661, 'FRANCISCO FAJARDO', 217),
(662, 'BOLÍVAR', 218),
(663, 'GUEVARA', 218),
(664, 'CERRO DE MATASIETE', 218),
(665, 'SANTA ANA', 218),
(666, 'SUCRE', 218),
(667, 'SAN FRANCISCO DE MACANAO', 219),
(668, 'BOCA DE RÍO', 219),
(669, 'AGUIRRE', 220),
(670, 'MANEIRO', 220),
(671, 'ADRIÁN', 221),
(672, 'JUAN GRIEGO', 221),
(673, 'YAGUARAPARO', 221),
(674, 'PORLAMAR', 222),
(675, 'TUBORES', 223),
(676, 'LOS BARALES', 223),
(677, 'VICENTE FUENTES', 224),
(678, 'VILLALBA', 224),
(679, 'AGUA BLANCA', 225),
(680, 'ARAURE', 226),
(681, 'RÍO ACARIGUA', 226),
(682, 'PÍRITU', 227),
(683, 'UVERAL', 227),
(684, 'CORDOVA', 228),
(685, 'GUANARE', 228),
(686, 'SAN JOSÉ DE LA MONTAÑA', 228),
(687, 'SAN JUAN DE GUANAGUANARE', 228),
(688, 'VIRGEN DE COROMOTO', 228),
(689, 'GUANARITO', 229),
(690, 'TRINIDAD DE LA CAPILLA', 229),
(691, 'DIVINA PASTORA', 229),
(692, 'APARICIÓN', 230),
(693, 'LA ESTACIÓN', 230),
(694, 'OSPINO', 230),
(695, 'ACARIGUA', 231),
(696, 'PAYARA', 231),
(697, 'PIMPINELA', 231),
(698, 'RAMÓN PERAZA', 231),
(699, 'CAÑO DELGADITO', 232),
(700, 'PAPELÓN', 232),
(701, 'ANTOLÍN TOVAR ANQUINO', 233),
(702, 'BOCONOÍTO', 233),
(703, 'SANTA FÉ', 234),
(704, 'SAN RAFAEL DE ONOTO', 234),
(705, 'THERMO MORALES', 234),
(706, 'FLORIDA', 235),
(707, 'EL PLAYÓN', 235),
(708, 'BISCUCUY', 236),
(709, 'CONCEPCIÓN', 235),
(710, 'SAN JOSÉ DE SAGUAZ', 236),
(711, 'SAN RAFAEL DE PALO ALZADO', 236),
(712, 'UVENCIO ANTONIO VELÁSQUEZ', 236),
(713, 'VILLA ROSA', 236),
(714, 'CANELONES', 237),
(715, 'SANTA CRUZ', 237),
(716, 'SAN ISIDRO LABRADOR', 237),
(717, 'RÍO CARIBE', 239),
(718, 'ANTONIO JOSÉ DE SUCRE', 239),
(719, 'EL MORRO DE PUERTO SANTO', 239),
(720, 'PUERTO SANTO', 239),
(721, 'SAN JUAN DE LAS GALDONAS', 239),
(722, 'EL PILAR', 240),
(723, 'EL RINCÓN', 240),
(724, 'GENERAL FRANCISCO ANTONIO VÁSQUEZ', 240),
(725, 'GUARAÚNOS', 240),
(726, 'TUNAPUICITO', 240),
(727, 'UNIÓN', 240),
(728, 'SANTA CATALINA', 241),
(729, 'SANTA ROSA', 241),
(730, 'SANTA TERESA', 241),
(731, 'BOLÍVAR', 241),
(732, 'MARACAPANA', 241),
(733, 'MARIÑO', 242),
(734, 'RÓMULO GALLEGOS', 242),
(735, 'LIBERTAD', 244),
(736, 'EL PAUJIL', 244),
(737, 'YAGUARAPARO', 244),
(738, 'CRUZ SALMERÓN ACOSTA', 245),
(739, 'CHACOPATA', 245),
(740, 'MANICUARE', 245),
(741, 'TUNAPUY', 246),
(742, 'CAMPO ELÍAS', 246),
(743, 'IRAPA', 247),
(744, 'CAMPO CLARO', 247),
(745, 'MARAVAL', 247),
(746, 'SAN ANTONIO DE IRAPA', 247),
(747, 'SORO', 247),
(748, 'SAN JOSÉ DE AEROCUAR', 248),
(749, 'TAVERA ACOSTA', 248),
(750, 'MEJÍA', 249),
(751, 'CIMANACOA', 250),
(752, 'ARENAs', 250),
(753, 'ARICAGUA', 250),
(754, 'COCOLLAR', 250),
(755, 'SAN FERNANDO', 250),
(756, 'SAN FERNANDO', 250),
(757, 'SAN LORENZO', 250),
(758, 'VILLA FRONTADO (MUELLE DE CARIACO)', 251),
(759, 'CATUARO', 251),
(760, 'RENDÓN', 251),
(761, 'SAN CRUZ', 251),
(762, 'SANTA MARÍA', 251),
(763, 'CRISTÓBAL COLÓN', 253),
(764, 'BIDEAU', 253),
(765, 'PUNTA DE PIEDRAS', 253),
(766, 'GÜIRIA', 253),
(767, 'ANDRÉS BELLO', 254),
(768, 'AYACUCHO', 255),
(769, 'RIVAS BERTI', 255),
(770, 'SAN PEDRO DEL RÍO', 255),
(771, 'BOLÍVAR', 256),
(772, 'PALOTAL', 256),
(773, 'GENERAL JUAN VICENTE GÓMEZ', 256),
(774, 'ISAÍAS MEDINA ANGARITA', 256),
(775, 'CÁRDENAS', 257),
(776, 'AMENODORO RANGEL LAMUS', 257),
(777, 'LA FLORIDA', 257),
(778, 'GUÁSIMOS', 259),
(779, 'GARCÍA DE HEVIA', 260),
(780, 'BOCA DE GRITA', 260),
(781, 'JOSÉ ANTONIO PAÉZ', 260),
(782, 'INDEPENDENCIA', 261),
(783, 'JUAN GERMÁN ROSCIO', 261),
(784, 'ROMÁN CÁRDENAS', 261),
(785, 'LIBERTAD', 264),
(786, 'CIPRIANO CASTRO', 264),
(787, 'MANUEL FELIPE RUGELES', 264),
(788, 'PANAMERICANO', 270),
(789, 'LA PALMITA', 270),
(790, 'ANTONIO RÓMULO COSTA', 271),
(791, 'LA CONCORDIA', 272),
(792, 'SAN JUAN BAUTISTA', 272),
(793, 'PEDRO MARÍA MORANTES', 272),
(794, 'SAN SEBASTIÁN', 272),
(795, 'DR. FRANCISCO ROMERO LOBO', 272),
(796, 'SAN JUDAS TADEO', 273),
(797, 'SEBORUCO', 274),
(798, 'SIMÓN RODRÍGUEZ', 275),
(799, 'SUCRE', 276),
(800, 'ELEAZAR LÓPEZ CONTRERAS', 276),
(801, 'SAN PABLO', 276),
(802, 'SAN JOSÉ OBRERO', 277),
(803, 'SAN JUAN EUDES', 277),
(804, 'DELICIAS', 278),
(805, 'PECAYA', 278),
(806, 'PEDRO MARÍA UREÑA', 279),
(807, 'NUEVA ARCADIA', 279),
(808, 'URIBANTE', 280),
(809, 'CÁRDENAS', 280),
(810, 'JUAN PABLO PEÑALOSA', 280),
(811, 'POTOSÍ', 280),
(812, 'CARABALLEDA', 302),
(813, 'CARAYACA', 302),
(814, 'CARLOS SOUBLETTE', 302),
(815, 'CARUAO', 302),
(816, 'CHUSPA', 302),
(817, 'CATIA LA MAR', 302),
(818, 'EL JUNKO', 302),
(819, 'LA GUAIRA', 302),
(820, 'MACUTO', 302),
(821, 'MAIQUETÍA', 302),
(822, 'NAIGUATÁ', 302),
(823, 'URIMARE', 302),
(824, 'ARAGUANEY', 282),
(825, 'EL JAGUITO', 282),
(826, 'LA ESPERANZA', 282),
(827, 'SANTA ISABEL', 282),
(828, 'BOCONÓ', 283),
(829, 'EL CARMEN', 283),
(830, 'MOSQUEY', 283),
(831, 'AYACUCHO', 283),
(832, 'BURBUSAY', 283),
(833, 'GENERAL RIBAS', 283),
(834, 'GUARAMACAL', 283),
(835, 'VEGA DE GUARAMACAL', 283),
(836, 'MONSEÑOR JÁUREGUI', 283),
(837, 'RAFAEL RANGEL', 283),
(838, 'SAN MIGUEL', 283),
(839, 'SAN JOSÉ', 283),
(840, 'SABANA GRANDe', 284),
(841, 'CHEREGÜE', 284),
(842, 'GRANADOS', 284),
(843, 'ARNOLDO GABALDÓN', 285),
(844, 'BOLIVIA', 285),
(845, 'CARRILLO', 285),
(846, 'CEGARRA', 285),
(847, 'CHEJENDÉ', 285),
(848, 'MANUEL SALVADOR ULLOA', 285),
(849, 'SAN JOSÉ', 285),
(850, 'CARACHE', 286),
(851, 'LA CONCEPCIÓN', 286),
(852, 'CUICAS', 286),
(853, 'PANAMERICANA', 286),
(854, 'SANTA CRUZ', 286),
(855, 'CAMPO ELÍAS', 287),
(856, 'ARNOLDO GABALDÓN', 287),
(857, 'CARVAJAL', 288),
(858, 'CAMPO ALEGRE', 288),
(859, 'ANTONIO NICOLÁS BRICEÑO', 288),
(860, 'JOSÉ LEONARDO SUÁREZ', 288),
(861, 'ESCUQUE', 289),
(862, 'LA UNIÓN (EL ALTO ESCUQUE)', 289),
(863, 'SANTA RITA', 289),
(864, 'SABANA LIBRE', 289),
(865, 'SANTA APOLONIA', 290),
(866, 'EL PROGRESO', 290),
(867, 'LA CEIBA', 290),
(868, 'TRES DE FEBRERO', 290),
(869, 'EL SOCORRO', 291),
(870, 'LOS CAPRICHOS', 291),
(871, 'ANTONIO JOSÉ DE SUCRE', 291),
(872, 'EL DIVIDIVE', 292),
(873, 'AGUA SANTA', 292),
(874, 'AGUA CALIENTE', 292),
(875, 'EL CENIZO', 292),
(876, 'VALERITA', 292),
(877, 'MONTE CARMELO', 293),
(878, 'BUENA VISTA', 293),
(879, 'SANTA MARÍA DEL HORCÓN', 293),
(880, 'MOTATÁN', 294),
(881, 'EL BAÑO', 294),
(882, 'JALISCO', 294),
(883, 'PAMPÁN', 295),
(884, 'FLOR DE PATRIA', 295),
(885, 'LA PAZ', 295),
(886, 'SANTA ANA', 295),
(887, 'PAMPANITO', 296),
(888, 'LA CONCEPCIÓN', 296),
(889, 'PAMPANITO II', 296),
(890, 'BETIJOQUE', 297),
(891, 'JOSÉ GREGORIO HERNÁNDEZ', 297),
(892, 'LA PUEBLITA', 297),
(893, 'LOS CEDROS', 297),
(894, 'SABANA DE MENDOZA', 298),
(895, 'JUNÍN', 298),
(896, 'VALMORE RODRÍGUEZ', 298),
(897, 'EL PARAÍSO', 298),
(898, 'ANDRÉS LINARES', 299),
(899, 'CHIQUINQUIRÁ', 299),
(900, 'CRITÓBAL MENDOZA', 299),
(901, 'CRUZ CARRILLO', 299),
(902, 'MATRIZ', 299),
(903, 'MONSEÑOR CARRILLO', 299),
(904, 'TRES ESQUINAS', 299),
(905, 'CABIMBÚ', 300),
(906, 'JAJÓ', 300),
(907, 'LA MESA DE ESNUJAQUE', 300),
(908, 'SANTIAGO', 300),
(909, 'TUÑAME', 300),
(910, 'LA QUEBRADA', 300),
(911, 'JUAN IGNACIO MONTILLA', 301),
(912, 'LA BEATRIZ', 301),
(913, 'LA PUERTA', 301),
(914, 'MENDOZA DEL VALLE DE MOMBOY', 301),
(915, 'MERCEDES DÍAZ', 301),
(916, 'SAN LUIS', 301),
(917, 'ARÍSTIDES BASTIDAS', 303),
(918, 'BOLÍVAR', 304),
(919, 'CHIVACOA', 305),
(920, 'CAMPO ELÍAS', 305),
(921, 'COCOROTE', 306),
(922, 'INDEPENDENCIA', 307),
(923, 'LA TRINIDAD', 308),
(924, 'MANUEL MONGE', 309),
(925, 'SALÓM', 310),
(926, 'TEMERLA', 310),
(927, 'NIRGUA', 310),
(928, 'JOSÉ ANTONIO PÁEZ', 311),
(929, 'SAN ANDRÉS', 312),
(930, 'YARITAGUA', 312),
(931, 'SAN JAVIER', 313),
(932, 'ALBARICO', 313),
(933, 'SAN FELIPE', 313),
(934, 'SAN FELIPE', 313),
(935, 'SUCRE', 314),
(936, 'URACHICHE', 315),
(937, 'EL GUAYABO', 316),
(938, 'FARRIAR', 316),
(939, 'RAFAEL MARÍA BARALT', 317),
(940, 'MANUEL MANRIQUE', 317),
(941, 'RAFAEL URDANETA', 317),
(942, 'SAN TIMOTEO', 318),
(943, 'GENERAL URDANETA', 318),
(944, 'LIBERTADOR', 318),
(945, 'MARCELINO BRICEÑO', 318),
(946, 'PUEBLO NUEVO', 318),
(947, 'MANUEL GUANIPA MATOS', 318),
(948, 'AMBROSIO', 319),
(949, 'CARMEN HERRERA', 319),
(950, 'LA ROSa', 319),
(951, 'GERMÁN RÍOS LINARES', 319),
(952, 'SAN BENITO', 319),
(953, 'RÓMULO BETANCOURT', 319),
(954, 'JORGE HERNÁNDEZ', 319),
(955, 'PUNTA GORDA', 319),
(956, 'ARÍSTIDES CALVANI', 319),
(957, 'ENCONTRADOS', 320),
(958, 'UDÓN PÉREZ', 320),
(959, 'MORALITO', 321),
(960, 'CAPITAL SAN CARLOS DEL ZULIA', 321),
(961, 'SANTA CRUZ DEL ZULIA', 321),
(962, 'SANTA BÁRBARA', 321),
(963, 'URRIBARRI', 321),
(964, 'CARLOS QUEVEDO', 324),
(965, 'FRANCISCO JAVIER PULGAR', 324),
(966, 'SIMÓN RODRÍGUEZ', 324),
(967, 'GUAMO-GAVILANES', 324),
(968, 'LA CONCEPCIÓN', 325),
(969, 'SAN JOSÉ', 325),
(970, 'MARIANO PARRA LEÓN', 325),
(971, 'JOSÉ RAMÓN YÉPEZ', 325),
(972, 'JESÚS MARÍA SEMPRÚN', 326),
(973, 'BARI', 326),
(974, 'CONCEPCIÓN', 327),
(975, 'ANDRÉS BELLO', 327),
(976, 'CHIQUINQUIRÁ', 327),
(977, 'EL CARMELO', 327),
(978, 'POTRERITOS', 327),
(979, 'LIBERTAD', 328),
(980, 'ALONSO DE OJEDA', 328),
(981, 'VENEZUELA', 328),
(982, 'ELAZAR LÓPEZ CONTRERAS', 328),
(983, 'CAMPO LARA', 328),
(984, 'BARTOLOMÉ DE LAS CASAS', 329),
(985, 'LIBERTAD', 329),
(986, 'RÍO NEGRO', 329),
(987, 'SAN JOSÉ DE PERIJÁ', 329),
(988, 'SAN RAFAEL', 330),
(989, 'LA SIERRITA', 330),
(990, 'LAS PARCELAS', 330),
(991, 'LUIS DE VICENTE', 330),
(992, 'MONSEÑOR MARCOS SERGIO GODOY', 330),
(993, 'RICAURTE', 330),
(994, 'TAMARE', 330),
(995, 'ANTONIO BORJAS ROMERO', 331),
(996, 'BOLÍVAR', 331),
(997, 'CACIQUE MARA', 331),
(998, 'CARRACCIOLO PARRA PÉREZ', 331),
(999, 'CECILIO ACOSTA', 331),
(1000, 'CRISTO DE ARANZA', 331),
(1001, 'COQUIVACOA', 331),
(1002, 'CHIQUINQUIRÁ', 331),
(1003, 'FRANCISCO EUGENIO BUSTAMANTE', 331),
(1004, 'IDELFONSO VÁSQUEZ', 331),
(1005, 'JUANA DE ÁVILA', 331),
(1006, 'LUIS HURTADO HIGUERA', 331),
(1007, 'MANUEL DAGNINO', 331),
(1008, 'OLEGARIO VILLALOBOS', 331),
(1009, 'RAÚL LEONI', 331),
(1010, 'SANTA LUCÍA', 331),
(1011, 'VENANCIO PULGAR', 331),
(1012, 'SAN ISIDRO', 331),
(1013, 'ALTAGRACIA', 332),
(1014, 'FARÍA', 332),
(1015, 'ANA MARÍA CAMPOS', 332),
(1016, 'SAN ANTONIO', 332),
(1017, 'SAN JOSÉ', 332),
(1018, 'DONALDO GARCÍA', 333),
(1019, 'EL ROSARIO', 333),
(1020, 'SIXTO ZAMBRANO', 333),
(1021, 'SAN FRANCISCO', 334),
(1022, 'EL BAJO', 334),
(1023, 'DOMITILA FLORES', 334),
(1024, 'FRANCISCO OCHOA', 334),
(1025, 'LOS CORTIJOS', 334),
(1026, 'MARCIAL HERNÁNDEZ', 334),
(1027, 'SANTA RITA', 335),
(1028, 'EL MENE', 335),
(1029, 'PEDRO LUCAS URRIBARRI', 335),
(1030, 'JOSÉ CENOBIO URRIBARRI', 335),
(1031, 'BOBURES', 336),
(1032, 'GIBRALTAR', 336),
(1033, 'HERAs', 336),
(1034, 'MONSEÑOR ARTURO ÁLVAREZ', 336),
(1035, 'RÓMULO GALLEGOS', 336),
(1036, 'EL BATEY', 336),
(1037, 'RAFAEL URDANETA', 337),
(1038, 'LA VICTORIa', 337),
(1039, 'RAÚL CUENCA', 337),
(1040, 'BUENA VISTA', 150),
(1041, 'CATEDRAL', 150),
(1042, 'CONCEPCIÓN', 150),
(1043, 'FELIPE ALVARADO', 150),
(1044, 'JUAN DE VILLEGAs', 150),
(1045, 'JUÁREZ', 150),
(1046, 'SANTA ROSA', 150),
(1047, 'TAMACA', 150),
(1048, 'UNIÓN', 150),
(1049, 'CORONEL MARIANO PERAZA', 151),
(1050, 'CUARA', 151),
(1051, 'DIEGO DE LOZADA', 151),
(1052, 'JOSÉ BERNARDO DORANTE', 151),
(1053, 'JUAN BAUTISTA RODRÍGUEZ', 151),
(1054, 'PARAÍSO DE SAN JOSÉ', 151),
(1055, 'QUIBOR', 151),
(1056, 'SAN MIGUEL', 151),
(1057, 'TINTORERO', 151),
(1058, 'SAN JOSÉ DE AEROCUAR', 248),
(1059, 'TAVERA ACOSTA', 248),
(1060, 'CÓRDOBA', 338),
(1061, 'FERNÁNDEZ FEO', 339),
(1062, 'ALBERTO ADRIANI', 339),
(1063, 'SANTO DOMINGO', 339),
(1064, 'FRANCISCO DE MIRANDa', 340),
(1065, 'JÁUREGUI', 341),
(1066, 'EMILIO CONSTANTINO GUERRERO', 341),
(1067, 'MONSEÑOR MIGUEL ANTONIO SALAS', 341),
(1068, 'JUNÍN', 342),
(1069, 'LA PETRÓLEA', 342),
(1070, 'QUINIMARI', 342),
(1071, 'BRAMÓN', 342),
(1072, 'CAPITAL LIBERTADOR', 343),
(1073, 'DORADAS', 343),
(1074, 'EMETERIO OCHOA', 343),
(1075, 'SAN JOAQUIN DE NAVAY', 343),
(1076, 'LOBATERA', 344),
(1077, 'CONSTITUCIÓN', 344),
(1078, 'MICHELENA', 345),
(1079, 'SAMUEL DARÍO MALDONADO', 346),
(1080, 'BOCONÓ', 346),
(1081, 'HERNÁNDEZ', 346);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
