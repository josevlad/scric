INSERT INTO `agencias` (`id`, `nombre_ag`, `identificador`) VALUES
(1, 'SAN BERNARDINO', 'SB'),
(2, 'EL CUARTEL', 'EC');

INSERT INTO `perfilusuario` (`id`, `perfilUsuario`) VALUES
(1, 'ADMIN_DB'),
(2, 'ASESOR'),
(3, 'AUDITOR');

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