-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-08-2015 a las 09:42:43
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.9-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `singo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
`id` int(10) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `jefe` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id`, `nombre`, `jefe`) VALUES
(1, 'Tráfico', 'Felipe Castro García'),
(2, 'Despacho Eléctrico', 'Sergio Marín Gárate'),
(3, 'Programación y Optimización', 'David Polanco Bustos'),
(4, 'Tripulación', 'Jimmy Franz Sáez'),
(5, 'Operaciones y Servicios', 'Fernando Manríquez Amaro'),
(6, 'Vigilancia', 'Marcelo Palacios Toro'),
(7, 'Operaciones', 'Guillermo Ramírez Muñoz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_empresas`
--

CREATE TABLE IF NOT EXISTS `despacho_empresas` (
`id` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `despacho_empresas`
--

INSERT INTO `despacho_empresas` (`id`, `nombre`) VALUES
(1, 'BESALCO'),
(2, 'ASSIGNIA'),
(3, 'SSEC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_libro`
--

CREATE TABLE IF NOT EXISTS `despacho_libro` (
`id` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `id_ct` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `den_des` varchar(250) NOT NULL,
  `ncortada` varchar(250) NOT NULL,
  `despachador` varchar(250) NOT NULL,
  `cortador` varchar(250) NOT NULL,
  `inspector_turno` varchar(250) NOT NULL,
  `notificador` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fecha_sistema` date NOT NULL,
  `estado` varchar(250) NOT NULL,
  `despachador_solicitud` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `despacho_libro`
--

INSERT INTO `despacho_libro` (`id`, `id_solicitud`, `id_ct`, `fecha`, `hora`, `den_des`, `ncortada`, `despachador`, `cortador`, `inspector_turno`, `notificador`, `descripcion`, `usuario`, `nombre`, `fecha_sistema`, `estado`, `despachador_solicitud`) VALUES
(7, 1, '1234', '2015-06-23', '12:56:00', 'D.E.S.', '#DES 121', 'DESPACHADOR 1', 'JUAN PÉREZ', 'JUAN PÉREZ', 'JUAN PÉREZ', 'INSPECCIÓN DE CATENARIAS, DESMONTAJE DE: PÓRTICOS, POSTES, TRIÁNGULO, MOVER TORRECILLA, , INSTALACIÓN DE TRIÁNGULO, POSICIONADO DE CATENARIA. TENDIDO DE CATENARIA NUEVA, PENDOLADO DE CATENARIA.', 'SMARIN', 'SERGIO MARÍN', '2015-06-22', 'ABIERTO', 'DESPACHADOR 2'),
(8, 0, '12345', '2015-06-24', '00:00:00', 'D.E.N.', '#DEN 122', 'DESPACHADOR 1', 'JUAN PÉREZ', 'JUAN PÉREZ', 'JUAN PÉREZ', 'CORTE 3000V, CORTE DE VÍA ENTRE PK 20,6 Y 21,5 AMBAS VÍAS', 'SMARIN', 'SERGIO MARÍN', '2015-06-24', 'ABIERTO', 'DESPACHADOR 6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_solicitud`
--

CREATE TABLE IF NOT EXISTS `despacho_solicitud` (
`id` int(100) NOT NULL,
  `desde_fecha` date NOT NULL,
  `desde_hora` time NOT NULL,
  `hasta_fecha` date NOT NULL,
  `hasta_hora` time NOT NULL,
  `block` varchar(250) NOT NULL,
  `tipo` varchar(250) NOT NULL,
  `circulacion_trenes` varchar(250) NOT NULL,
  `vias` varchar(250) NOT NULL,
  `desde_sector` varchar(250) NOT NULL,
  `hasta_sector` varchar(250) NOT NULL,
  `empresa` varchar(250) NOT NULL,
  `encargados` varchar(250) NOT NULL,
  `telefonos` varchar(250) NOT NULL,
  `descripcion` longtext NOT NULL,
  `aprobacion` varchar(10) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `despachador` varchar(250) NOT NULL,
  `estado` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `despacho_solicitud`
--

INSERT INTO `despacho_solicitud` (`id`, `desde_fecha`, `desde_hora`, `hasta_fecha`, `hasta_hora`, `block`, `tipo`, `circulacion_trenes`, `vias`, `desde_sector`, `hasta_sector`, `empresa`, `encargados`, `telefonos`, `descripcion`, `aprobacion`, `fecha_ingreso`, `despachador`, `estado`) VALUES
(17, '2015-07-13', '11:00:00', '2015-07-15', '16:00:00', 'SAN FRANCISCO  - GRANEROS ', 'VIA, 3.000V  ', 'SIN PASADA DE TRENES ', 'DOBLE VÃA PONIENTE  ', '60P12', '70P2', 'SSEC', 'GRUPO CATENARIA PAINE ', '42495455', 'REVISION GEOMETRICA DE LA CATENARIA ', 'APROBADO', '2015-07-30 03:26:55', '', 'ABIERTO'),
(18, '2015-07-16', '11:00:00', '2015-07-16', '16:00:00', 'GRANEROS - RANCAGUA', 'VIA, 3.000V  y 2,3kV.', 'SIN PASADA DE TRENES ', 'DOBLE VÃA ORIENTE ', '70P2', '79P13', 'SSEC', 'GRUPO CATENARIA PAINE ', '42495453', 'TENSIONAMIENTO LÃNEAS ANCLADAS', 'APROBADO', '2015-07-30 03:26:57', '', 'ABIERTO'),
(19, '2015-07-17', '11:00:00', '2015-07-18', '16:00:00', 'REQUINOA - RENGO ', 'VIA, 3.000V  y 2,3kV.', 'SIN PASADA DE TRENES ', 'DOBLE VÃA ORIENTE ', '96P2', '110P12', 'SSEC', 'GRUPO CATENARIA PAINE ', '42495453', 'MANTENCIÃ“N DE CATENARIA, CAMBIO  DE EQUIPOS TENSORES ', 'APROBADO', '2015-07-30 03:26:58', '', 'ABIERTO'),
(20, '2015-07-13', '12:30:00', '2015-07-13', '14:30:00', 'SAN JAVIER - VILLA ALEGRE', 'VIA, 3.000V  y 2,3kV.', 'SIN PASADA DE TRENES ', 'SIMPLE VÃA', '268P3', '279P4', 'SSEC', 'GRUPO CATENARIA CURICO ', '42495457', 'MANTENCIÃ“N DE CATENARIA, CAMBIO  DE EQUIPOS TENSORES ', 'APROBADO', '2015-07-30 03:27:00', '', 'ABIERTO'),
(21, '2015-07-13', '15:20:00', '2015-07-13', '18:40:00', 'SAN JAVIER - VILLA ALEGRE', 'VIA, 3.000V  y 2,3kV.', 'SIN PASADA DE TRENES ', 'SIMPLE VÃA', '268P3', '279P4', 'SSEC', 'GRUPO CATENARIA CURICO ', '42495457', 'MANTENCIÃ“N DE CATENARIA, CAMBIO  DE EQUIPOS TENSORES ', 'APROBADO', '2015-07-30 03:27:01', '', 'ABIERTO'),
(22, '2015-07-18', '09:00:00', '2015-07-18', '12:00:00', 'RETIRO - PARRAL', 'VIA, 3.000V  y 2,3kV.', 'SIN PASADA DE TRENES ', 'SIMPLE VÃA', '323P4', '339P12', 'SSEC', 'GRUPO CATENARIA  PARRAL', '42495456', 'MANTENCIÃ“N DE CATENARIA, CAMBIO  DE EQUIPOS TENSORES ', 'APROBADO', '2015-07-30 03:27:02', '', 'ABIERTO'),
(23, '2015-07-18', '15:00:00', '2015-07-18', '18:00:00', 'RETIRO - PARRAL', 'VIA, 3.000V  y 2,3kV.', 'SIN PASADA DE TRENES ', 'SIMPLE VÃA', '323P4', '339P12', 'SSEC', 'GRUPO CATENARIA  PARRAL', '42495456', 'MANTENCIÃ“N DE CATENARIA, CAMBIO  DE EQUIPOS TENSORES ', 'APROBADO', '2015-07-30 03:27:03', '', 'ABIERTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho_solicitud_temp`
--

CREATE TABLE IF NOT EXISTS `despacho_solicitud_temp` (
`id` int(100) NOT NULL,
  `desde_fecha` date NOT NULL,
  `desde_hora` time NOT NULL,
  `hasta_fecha` date NOT NULL,
  `hasta_hora` time NOT NULL,
  `block` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `circulacion_trenes` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `vias` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `desde_sector` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `hasta_sector` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `empresa` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `encargados` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `telefonos` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `descripcion` longtext CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(100) NOT NULL,
  `nombre` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_recorridos`
--

CREATE TABLE IF NOT EXISTS `servicios_recorridos` (
`id` int(11) NOT NULL,
  `porteador` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tren` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `prog_especial` int(10) NOT NULL,
  `circulacion` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `tipo_equipo` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `num_equipo` int(11) NOT NULL,
  `km_prog` decimal(11,3) NOT NULL,
  `km_reales` decimal(11,3) NOT NULL,
  `est_origen_real` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `est_destino_real` varchar(250) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `h_salida_prog` datetime NOT NULL,
  `h_salida_real` datetime NOT NULL,
  `h_llegada_prog` datetime NOT NULL,
  `h_llegada_real` datetime NOT NULL,
  `dif_minutos` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios_recorridos`
--

INSERT INTO `servicios_recorridos` (`id`, `porteador`, `tren`, `prog_especial`, `circulacion`, `tipo_equipo`, `num_equipo`, `km_prog`, `km_reales`, `est_origen_real`, `est_destino_real`, `h_salida_prog`, `h_salida_real`, `h_llegada_prog`, `h_llegada_real`, `dif_minutos`) VALUES
(1, 'T.MET-Metrotren', '20508', 0, 'YES', 'UT', 202, '82.389', '82.389', 'RANCAGUA', 'ALAMEDA', '2015-06-12 06:40:00', '2015-06-12 06:40:00', '2015-06-12 08:12:00', '2015-06-12 08:14:00', 2),
(2, 'T.MET-Metrotren', '20508', 0, 'YES', 'UT', 203, '82.389', '82.389', 'RANCAGUA', 'ALAMEDA', '2015-06-13 06:40:00', '2015-06-13 06:42:00', '2015-06-13 08:12:00', '2015-06-13 08:12:00', 0),
(3, 'T.MET-Metrotren', '20508', 0, 'YES', 'UT', 127, '82.389', '82.389', 'RANCAGUA', 'ALAMEDA', '2015-06-14 06:40:00', '2015-06-14 06:40:00', '2015-06-14 08:12:00', '2015-06-14 08:13:00', 1),
(4, 'T.MET-Metrotren', '20508', 0, 'YES', 'UT', 127, '82.389', '82.389', 'RANCAGUA', 'ALAMEDA', '2015-06-15 06:40:00', '2015-06-15 06:40:00', '2015-06-15 08:12:00', '2015-06-15 08:19:00', 7),
(5, 'T.MET-Metrotren', '20509', 0, 'YES', 'UT', 204, '82.389', '82.389', 'ALAMEDA', 'RANCAGUA', '2015-06-02 12:30:00', '2015-06-02 12:32:00', '2015-06-02 14:02:00', '2015-06-02 14:10:00', 8),
(6, 'T.MET-Metrotren', '20509', 0, 'YES', 'UT', 204, '82.389', '82.389', 'ALAMEDA', 'RANCAGUA', '2015-06-03 12:30:00', '2015-06-03 12:31:00', '2015-06-03 14:02:00', '2015-06-03 14:02:00', 0),
(7, 'T.MET-Metrotren', '20511', 0, 'YES', 'UT', 104, '82.389', '82.389', 'ALAMEDA', 'RANCAGUA', '2015-06-24 13:30:00', '2015-06-24 13:34:00', '2015-06-24 15:02:00', '2015-06-24 15:04:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE IF NOT EXISTS `tareas` (
`id` int(100) NOT NULL,
  `usuario_id` int(100) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fecha_limite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trafico_libro`
--

CREATE TABLE IF NOT EXISTS `trafico_libro` (
`id` int(100) NOT NULL,
  `id_despacho_solicitud` int(100) NOT NULL,
  `fecha_autorizacion` date NOT NULL,
  `hora_autorizacion` time NOT NULL,
  `numero_ct` int(100) NOT NULL,
  `nombre_it` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `usuario` varchar(250) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `trafico_libro`
--

INSERT INTO `trafico_libro` (`id`, `id_despacho_solicitud`, `fecha_autorizacion`, `hora_autorizacion`, `numero_ct`, `nombre_it`, `usuario`) VALUES
(13, 17, '2015-08-06', '14:13:48', 1, 'ALFREDO PÃREZ', 'IV&AACUTE;N CARO'),
(14, 20, '2015-08-06', '14:21:26', 62606219, 'ALFREDO PÃƒÂ‰REZ', 'IV&AACUTE;N CARO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(100) NOT NULL,
  `nombre` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_pat` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_mat` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cargo` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(250) CHARACTER SET latin1 NOT NULL,
  `user` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `area` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido_pat`, `apellido_mat`, `cargo`, `email`, `user`, `password`, `rol`, `area`, `foto`) VALUES
(1, 'Guillermo', 'Ramírez', 'Muñoz', 'Gerente de Operaciones', 'guillermo.ramirez@trencentral.cl', 'gramirez', '3b7523b92474628b33d3b22bcea3c0b4', 'Usuario', 'Operaciones', 'guillermo.jpg'),
(2, 'Sergio', 'Marín', 'Gárate', 'Jefe Despacho Eléctrico', 'sergio.marin@trencentral.cl', 'smarin', 'ffab8e9ae12553aa080f6a6ef9fb4cec', 'Usuario', 'Despacho Eléctrico', 'sergio.jpg'),
(3, 'Marcelo', 'Palacios', 'Toro', 'Jefe Vigilancia', 'marcelo.palacios@trencentral.cl', 'mpalacios', '087aca5b4e439e2a4d3b5a3a783a2b22', 'Usuario', 'Vigilancia', ''),
(4, 'Carlos', 'Barraza', 'Apellido', 'Despachador', 'carlos.barraza@efe.cl', 'cbarraza', '0c86e8adb3660b8ca910e24520760a7d', 'Usuario', 'Despacho Eléctrico', ''),
(5, 'Jaime', 'Flores', 'Apellido', 'Despachador', 'jaime.flores@efe.cl', 'jflores', '17bad393d23b06ee1f542eb2a1d2758a', 'Usuario', 'Despacho Eléctrico', ''),
(6, 'Luis', 'Zamorano', 'Apellido', 'Despachador', 'luis.zamorano@efe.cl', 'lzamorano', '5948597b5d2e6c9bf32bc4066f9e888e', 'Usuario', 'Despacho Eléctrico', ''),
(7, 'Carlos', 'Bugueño', 'Apellido', 'Despachador', 'carlos.bugueno@efe.cl', 'cbugueno', '9357aad135afde649a18781b72856922', 'Usuario', 'Despacho Eléctrico', ''),
(8, 'Fabián', 'Díaz', 'Apellido', 'Despachador', 'fabian.diaz@efe.cl', 'fdiaz', '33c8f572d28610b8f4b352aa52a5eaa1', 'Usuario', 'Despacho Eléctrico', ''),
(9, 'Bastián', 'Ruiz', 'Apellido', 'Despachador', 'bastian.ruiz@trencentral.cl', 'bruiz', '1e6f26b504f9b8bf727d8a24cb688672', 'Usuario', 'Despacho Eléctrico', ''),
(10, 'Cristian', 'Carter', 'Apellido', 'Despachador', 'cristian.carter@efe.cl', 'ccarter', '3837220cc11e6709c12ee2c409c2a20c', 'Usuario', 'Despacho Eléctrico', ''),
(11, 'Felipe', 'Castro', 'García', 'Jefe Tráfico', 'felipe.castro@efe.cl', 'fcastro', '78ae73963a93baae0d1b3a62c7f573df', 'Usuario', 'Tráfico', 'fcastro.png'),
(12, 'Iván', 'Caro', 'Alarcón', 'Ingeniero Soporte Tráfico', 'ivan.caro@efe.cl', 'icaro', '443e41d6c89eddc57b47e7f1630b43cf', 'Usuario', 'Tráfico', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `despacho_empresas`
--
ALTER TABLE `despacho_empresas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho_libro`
--
ALTER TABLE `despacho_libro`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho_solicitud`
--
ALTER TABLE `despacho_solicitud`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho_solicitud_temp`
--
ALTER TABLE `despacho_solicitud_temp`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios_recorridos`
--
ALTER TABLE `servicios_recorridos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trafico_libro`
--
ALTER TABLE `trafico_libro`
 ADD PRIMARY KEY (`id`), ADD KEY `id_despacho_solicitud` (`id_despacho_solicitud`), ADD KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `despacho_empresas`
--
ALTER TABLE `despacho_empresas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `despacho_libro`
--
ALTER TABLE `despacho_libro`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `despacho_solicitud`
--
ALTER TABLE `despacho_solicitud`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `despacho_solicitud_temp`
--
ALTER TABLE `despacho_solicitud_temp`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `servicios_recorridos`
--
ALTER TABLE `servicios_recorridos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `trafico_libro`
--
ALTER TABLE `trafico_libro`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
