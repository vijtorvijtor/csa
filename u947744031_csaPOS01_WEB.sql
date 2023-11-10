-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-11-2023 a las 18:36:28
-- Versión del servidor: 10.5.19-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u947744031_csaPOS01`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesos`
--

CREATE TABLE `accesos` (
  `idAcceso` int(11) UNSIGNED NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `IP` varchar(16) DEFAULT NULL,
  `dispositivo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `accesos`
--

INSERT INTO `accesos` (`idAcceso`, `idUser`, `fecha`, `IP`, `dispositivo`) VALUES
(519, 1, '2023-11-03 18:28:00', '', '##'),
(520, 1, '2023-11-03 18:29:00', '', '##'),
(521, 1, '2023-11-03 19:20:00', '', '##'),
(522, 1, '2023-11-06 15:43:00', '', '##'),
(523, 1, '2023-11-06 15:57:00', '', '##'),
(524, 1, '2023-11-06 18:19:00', '', '##'),
(525, 1, '2023-11-06 19:55:00', '', '##'),
(526, 1, '2023-11-06 19:56:00', '', '##'),
(527, 1, '2023-11-07 14:14:00', '', '##'),
(528, 1, '2023-11-07 15:00:00', '', '##'),
(529, 1, '2023-11-07 16:01:00', '', '##'),
(530, 1, '2023-11-07 19:54:00', '', '##'),
(531, 1, '2023-11-07 20:20:00', '', '##'),
(532, 1, '2023-11-07 20:22:00', '', '##'),
(533, 1, '2023-11-08 06:20:00', '', '##');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catMovimiento`
--

CREATE TABLE `catMovimiento` (
  `idCatMovimiento` int(11) UNSIGNED NOT NULL,
  `descMovimiento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `catMovimiento`
--

INSERT INTO `catMovimiento` (`idCatMovimiento`, `descMovimiento`) VALUES
(1, 'Venta publico'),
(2, 'Entrada a almacen'),
(3, 'Ajuste/merma');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catProducto`
--

CREATE TABLE `catProducto` (
  `idCatProducto` int(11) UNSIGNED NOT NULL,
  `idCatTipo` int(11) UNSIGNED DEFAULT 0,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `unidad` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `catProducto`
--

INSERT INTO `catProducto` (`idCatProducto`, `idCatTipo`, `descripcion`, `unidad`) VALUES
(1, 1, 'Pino cremoso', 2),
(2, 1, 'Pino mata bichos rastreros', 2),
(3, 1, 'Lavanda', 2),
(4, 1, 'Mar fresco', 2),
(5, 1, 'Manzana canela', 2),
(6, 2, 'Manzana canela', 2),
(7, 2, 'Limon', 2),
(8, 2, 'Frambuesa', 2),
(9, 2, 'Chicle', 2),
(10, 2, 'Cerendia', 2),
(11, 2, 'Bebe', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catTipo`
--

CREATE TABLE `catTipo` (
  `idCatTipo` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `catTipo`
--

INSERT INTO `catTipo` (`idCatTipo`, `descripcion`) VALUES
(1, 'Multilimpiador'),
(2, 'Aromatizante'),
(3, 'Detergente ropa'),
(4, 'Prelavadores quitamanchas'),
(5, 'Suavizante de ropa'),
(6, 'Detergente ropa peroxidado'),
(7, 'Detergente de trastes'),
(8, 'Industriales'),
(9, 'Shampoo cuerpo y manos'),
(10, 'Shampoo capilar'),
(11, 'Shampoo mascotas'),
(12, 'Clorados'),
(13, 'Desinfectantes'),
(14, 'Automotriz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catUnidad`
--

CREATE TABLE `catUnidad` (
  `idUnidad` int(11) UNSIGNED NOT NULL,
  `descripcion` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `catUnidad`
--

INSERT INTO `catUnidad` (`idUnidad`, `descripcion`) VALUES
(1, 'Pesos'),
(2, 'Litro'),
(3, 'Kilo'),
(4, 'Pieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costo`
--

CREATE TABLE `costo` (
  `id` int(11) UNSIGNED NOT NULL,
  `idProducto` int(11) DEFAULT NULL,
  `idUnidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) UNSIGNED NOT NULL,
  `idProducto` int(11) UNSIGNED DEFAULT 0,
  `cantidad` decimal(7,0) DEFAULT 0,
  `unidad` int(11) UNSIGNED DEFAULT NULL,
  `movimiento` int(11) UNSIGNED DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precio`
--

CREATE TABLE `precio` (
  `id` int(11) UNSIGNED NOT NULL,
  `idCatProducto` int(11) UNSIGNED DEFAULT 0,
  `costo` int(11) UNSIGNED DEFAULT 0,
  `menudeo` int(11) UNSIGNED DEFAULT 0,
  `medio` int(11) UNSIGNED DEFAULT 0,
  `mayoreo` int(11) UNSIGNED DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `precio`
--

INSERT INTO `precio` (`id`, `idCatProducto`, `costo`, `menudeo`, `medio`, `mayoreo`) VALUES
(1, 1, 6, 18, 16, 14),
(2, 2, 10, 40, 37, 35),
(3, 3, 1, 2, 3, 4),
(4, 4, 5, 6, 7, 8),
(5, 5, 0, 0, 0, 0),
(6, 6, 0, 0, 0, 0),
(7, 7, 0, 0, 0, 0),
(8, 8, 0, 0, 0, 0),
(9, 9, 0, 0, 0, 0),
(10, 10, 0, 0, 0, 0),
(11, 11, 2, 4, 6, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUser` int(11) UNSIGNED NOT NULL,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nivel` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUser`, `nombre`, `user`, `pass`, `nivel`) VALUES
(1, 'VIctor Hernandez', 'VH', 'v', 1),
(2, 'Cinthya Olivares', 'CO', 'cinthyaO', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesos`
--
ALTER TABLE `accesos`
  ADD PRIMARY KEY (`idAcceso`);

--
-- Indices de la tabla `catMovimiento`
--
ALTER TABLE `catMovimiento`
  ADD PRIMARY KEY (`idCatMovimiento`);

--
-- Indices de la tabla `catProducto`
--
ALTER TABLE `catProducto`
  ADD PRIMARY KEY (`idCatProducto`);

--
-- Indices de la tabla `catTipo`
--
ALTER TABLE `catTipo`
  ADD PRIMARY KEY (`idCatTipo`);

--
-- Indices de la tabla `catUnidad`
--
ALTER TABLE `catUnidad`
  ADD PRIMARY KEY (`idUnidad`);

--
-- Indices de la tabla `costo`
--
ALTER TABLE `costo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precio`
--
ALTER TABLE `precio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesos`
--
ALTER TABLE `accesos`
  MODIFY `idAcceso` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=534;

--
-- AUTO_INCREMENT de la tabla `catMovimiento`
--
ALTER TABLE `catMovimiento`
  MODIFY `idCatMovimiento` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `catProducto`
--
ALTER TABLE `catProducto`
  MODIFY `idCatProducto` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `catTipo`
--
ALTER TABLE `catTipo`
  MODIFY `idCatTipo` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `catUnidad`
--
ALTER TABLE `catUnidad`
  MODIFY `idUnidad` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `costo`
--
ALTER TABLE `costo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `precio`
--
ALTER TABLE `precio`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUser` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
