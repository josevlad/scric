INSERT INTO `agencias` (`id`, `nombre_ag`, `identificador`) VALUES
(1, 'SAN BERNARDINO', 'SB'),
(2, 'EL CUARTEL', 'EC');

INSERT INTO `perfilusuario` (`id`, `perfilUsuario`) VALUES
(1, 'SUPER_U'),
(2, 'ADMIN_DB'),
(3, 'ASESOR');

INSERT INTO `pregunta` (`id`, `pregunta`) VALUES
(1, '¿CUAL FUE EL NOMBRE DE TU PRIMERA MASCOTA?'),
(2, '¿CUAL EL ES SEGUNDO NOMBRE DE TU PADRE?'),
(3, '¿DONDE CONOCISTES A TU PAREJA?');

INSERT INTO `statususuarios` (`id`, `statusUsuarios`) VALUES
(1, 'ACTIVO'),
(2, 'INACTIVO');

INSERT INTO `tipopersona` (`id`, `tipoPersona`) VALUES
(1, 'PERSONA NATURAL'),
(2, 'PERSONA JURIDICA'),
(3, 'ENTE GUBERNAMENTAL');

INSERT INTO `tipotelf` (`id`, `tipoTelf`) VALUES
(1, 'PERSONAL'),
(2, 'TRABAJO'),
(3, 'HABITACIÓN'),
(4, 'FAX');

INSERT INTO `tipotrans` (`id`, `tipoTrans`) VALUES
(1, 'AUTOMATICA'),
(2, 'SINCRONICA'),
(3, 'DUAL');

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `nick`, `clave`, `respuesta`, `agencias_id`, `perfilUsuario_id`, `statusUsuarios_id`, `pregunta_id`) VALUES
(1, 'VLADIMIR J', 'CASTAÑEDA G', 'josevlad', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 1, 1, 1),
(2, 'ZURAIMA J', 'RUIZ DE CASTAÑEDA', 'zoro2002', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 2, 1, 1),
(3, 'ALVARO G', 'HERNANDEZ R', 'alvaro_g', '202cb962ac59075b964b07152d234b70', 'PERRO', 1, 3, 1, 1);


INSERT INTO `marca` (`id`, `marca`) VALUES
(1, 'CHEVROLET'),
(2, 'FIAT'),
(3, 'FORD'),
(4, 'JEEP'),
(5, 'TOYOTA');

INSERT INTO `modelo` (`id`, `modelo`, `marca_id`) VALUES
(1, 'AVEO', 1),
(2, 'CORSA', 1),
(3, 'MALIBÚ', 1),
(4, 'OPTRA', 1),
(5, 'SILVERADO', 1),
(6, 'PALIO', 2),
(7, 'PREMIO', 2),
(8, 'SIENA', 2),
(9, 'SPAZIO', 2),
(10, 'UNO', 2),
(11, 'EXPLORER', 3),
(12, 'F-150', 3),
(13, 'FIESTA', 3),
(14, 'KA', 3),
(15, 'MUSTANG', 3),
(16, 'CHEROKEE', 4),
(17, 'CJ', 4),
(18, 'GRAND CHEROKEE', 4),
(19, 'WAGONEER', 4),
(20, 'WRANGLER', 4),
(21, '4RUNNER', 5),
(22, 'COROLLA', 5),
(23, 'HILUX', 5),
(24, 'MACHO', 5),
(25, 'YARIS', 5);


INSERT INTO `tipopago` (`id`, `tipoPago`) VALUES
(1, 'EFECTIVO'),
(2, 'DEBITO'),
(3, 'CHEQUE'),
(4, 'CREDITO');
