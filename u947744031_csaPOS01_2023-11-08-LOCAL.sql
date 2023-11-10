# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.10.2-MariaDB)
# Base de datos: u947744031_csaPOS01
# Tiempo de Generación: 2023-11-08 23:37:07 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla accesos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `accesos`;

CREATE TABLE `accesos` (
  `idAcceso` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `IP` varchar(16) DEFAULT NULL,
  `dispositivo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idAcceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;

INSERT INTO `accesos` (`idAcceso`, `idUser`, `fecha`, `IP`, `dispositivo`)
VALUES
	(519,1,'2023-11-03 18:28:00','','##'),
	(520,1,'2023-11-03 18:29:00','','##'),
	(521,1,'2023-11-03 19:20:00','','##'),
	(522,1,'2023-11-06 15:43:00','','##'),
	(523,1,'2023-11-06 15:57:00','','##'),
	(524,1,'2023-11-06 18:19:00','','##'),
	(525,1,'2023-11-06 19:55:00','','##'),
	(526,1,'2023-11-06 19:56:00','','##'),
	(527,1,'2023-11-07 14:14:00','','##'),
	(528,1,'2023-11-07 15:00:00','','##'),
	(529,1,'2023-11-07 16:01:00','','##'),
	(530,1,'2023-11-07 19:54:00','','##'),
	(531,1,'2023-11-07 20:20:00','','##'),
	(532,1,'2023-11-07 20:22:00','','##'),
	(533,1,'2023-11-08 06:20:00','','##'),
	(534,1,'2023-11-08 12:41:00','','##'),
	(535,1,'2023-11-08 15:02:00','','##'),
	(536,1,'2023-11-08 15:55:00','','##');

/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla catMovimiento
# ------------------------------------------------------------

DROP TABLE IF EXISTS `catMovimiento`;

CREATE TABLE `catMovimiento` (
  `idCatMovimiento` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descMovimiento` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  PRIMARY KEY (`idCatMovimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `catMovimiento` WRITE;
/*!40000 ALTER TABLE `catMovimiento` DISABLE KEYS */;

INSERT INTO `catMovimiento` (`idCatMovimiento`, `descMovimiento`)
VALUES
	(1,'Venta publico'),
	(2,'Entrada a almacen'),
	(3,'Ajuste/merma');

/*!40000 ALTER TABLE `catMovimiento` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla catProducto
# ------------------------------------------------------------

DROP TABLE IF EXISTS `catProducto`;

CREATE TABLE `catProducto` (
  `idCatProducto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idCatTipo` int(11) unsigned DEFAULT 0,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '',
  `unidad` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idCatProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `catProducto` WRITE;
/*!40000 ALTER TABLE `catProducto` DISABLE KEYS */;

INSERT INTO `catProducto` (`idCatProducto`, `idCatTipo`, `descripcion`, `unidad`)
VALUES
	(1,1,'Pino cremoso',2),
	(2,1,'Pino mata bichos rastreros',2),
	(3,1,'Lavanda',2),
	(4,1,'Mar fresco',2),
	(5,1,'Manzana canela',2),
	(6,2,'Manzana canela',2),
	(7,2,'Limon',2),
	(8,2,'Frambuesa',2),
	(9,2,'Chicle',2),
	(10,2,'Cerendia',2),
	(11,2,'Bebe',2);

/*!40000 ALTER TABLE `catProducto` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla catTipo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `catTipo`;

CREATE TABLE `catTipo` (
  `idCatTipo` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT ' ',
  PRIMARY KEY (`idCatTipo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `catTipo` WRITE;
/*!40000 ALTER TABLE `catTipo` DISABLE KEYS */;

INSERT INTO `catTipo` (`idCatTipo`, `descripcion`)
VALUES
	(1,'Multilimpiador'),
	(2,'Aromatizante'),
	(3,'Detergente ropa'),
	(4,'Prelavadores quitamanchas'),
	(5,'Suavizante de ropa'),
	(6,'Detergente ropa peroxidado'),
	(7,'Detergente de trastes'),
	(8,'Industriales'),
	(9,'Shampoo cuerpo y manos'),
	(10,'Shampoo capilar'),
	(11,'Shampoo mascotas'),
	(12,'Clorados'),
	(13,'Desinfectantes'),
	(14,'Automotriz');

/*!40000 ALTER TABLE `catTipo` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla catUnidad
# ------------------------------------------------------------

DROP TABLE IF EXISTS `catUnidad`;

CREATE TABLE `catUnidad` (
  `idUnidad` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idUnidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `catUnidad` WRITE;
/*!40000 ALTER TABLE `catUnidad` DISABLE KEYS */;

INSERT INTO `catUnidad` (`idUnidad`, `descripcion`)
VALUES
	(1,'$'),
	(2,'Lt'),
	(3,'Kg'),
	(4,'Pz');

/*!40000 ALTER TABLE `catUnidad` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla costo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `costo`;

CREATE TABLE `costo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idProducto` int(11) DEFAULT NULL,
  `idUnidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Volcado de tabla inventario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventario`;

CREATE TABLE `inventario` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `user` int(11) unsigned DEFAULT NULL,
  `idProducto` int(11) unsigned DEFAULT 0,
  `cantidad` decimal(7,0) DEFAULT 0,
  `movimiento` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;

INSERT INTO `inventario` (`id`, `fecha`, `user`, `idProducto`, `cantidad`, `movimiento`)
VALUES
	(1,'0000-00-00 00:00:00',0,1,2,1),
	(2,'0000-00-00 00:00:00',0,1,2,1),
	(3,'0000-00-00 00:00:00',0,1,2,1),
	(4,'2023-11-08 17:25:00',1,1,2,1),
	(5,'2023-11-08 17:29:00',1,1,3,1),
	(6,NULL,NULL,0,0,NULL);

/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla partida
# ------------------------------------------------------------

DROP TABLE IF EXISTS `partida`;

CREATE TABLE `partida` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ticket` int(11) DEFAULT 0,
  `producto` int(11) unsigned DEFAULT NULL,
  `cantidad` decimal(10,0) DEFAULT NULL,
  `precio` decimal(11,0) DEFAULT 0,
  `total` decimal(11,0) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `partida` WRITE;
/*!40000 ALTER TABLE `partida` DISABLE KEYS */;

INSERT INTO `partida` (`id`, `ticket`, `producto`, `cantidad`, `precio`, `total`)
VALUES
	(1,11,1,4,18,72),
	(2,12,1,1,18,18),
	(3,12,2,2,40,80),
	(4,12,3,3,2,6),
	(5,0,NULL,NULL,0,0),
	(6,13,1,3,18,54),
	(7,14,1,2,18,36),
	(8,15,1,3,18,54),
	(9,16,0,233,0,0),
	(10,16,1,3,18,54),
	(11,17,1,3,18,54),
	(12,18,1,2,18,36),
	(13,19,1,3,18,54);

/*!40000 ALTER TABLE `partida` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla precio
# ------------------------------------------------------------

DROP TABLE IF EXISTS `precio`;

CREATE TABLE `precio` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idCatProducto` int(11) unsigned DEFAULT 0,
  `costo` int(11) unsigned DEFAULT 0,
  `menudeo` int(11) unsigned DEFAULT 0,
  `medio` int(11) unsigned DEFAULT 0,
  `mayoreo` int(11) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `precio` WRITE;
/*!40000 ALTER TABLE `precio` DISABLE KEYS */;

INSERT INTO `precio` (`id`, `idCatProducto`, `costo`, `menudeo`, `medio`, `mayoreo`)
VALUES
	(1,1,6,18,16,14),
	(2,2,10,40,37,35),
	(3,3,1,2,3,4),
	(4,4,5,6,7,8),
	(5,5,0,0,0,0),
	(6,6,0,0,0,0),
	(7,7,0,0,0,0),
	(8,8,0,0,0,0),
	(9,9,0,0,0,0),
	(10,10,0,0,0,0),
	(11,11,2,4,6,8);

/*!40000 ALTER TABLE `precio` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla ticket
# ------------------------------------------------------------

DROP TABLE IF EXISTS `ticket`;

CREATE TABLE `ticket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) unsigned DEFAULT NULL,
  `estado` int(11) unsigned DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` float unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;

INSERT INTO `ticket` (`id`, `user`, `estado`, `fecha`, `total`)
VALUES
	(1,1,1,'2023-11-08 22:41:08',72),
	(2,1,1,'2023-11-08 16:51:00',36),
	(3,1,1,'2023-11-08 16:53:00',54),
	(4,1,1,'2023-11-08 16:54:00',54),
	(5,1,1,'2023-11-08 16:55:00',54),
	(6,1,1,'2023-11-08 16:56:00',54),
	(7,1,1,'2023-11-08 17:00:00',72),
	(8,1,1,'2023-11-08 17:07:00',54),
	(9,1,1,'2023-11-08 17:10:00',36),
	(10,1,1,'2023-11-08 17:11:00',36),
	(11,1,1,'2023-11-08 17:11:00',72),
	(12,1,1,'2023-11-08 17:12:00',104),
	(13,1,1,'2023-11-08 17:17:00',214),
	(14,1,1,'2023-11-08 17:20:00',36),
	(15,1,1,'2023-11-08 17:20:00',54),
	(16,1,1,'2023-11-08 17:21:00',54),
	(17,1,1,'2023-11-08 17:22:00',54),
	(18,1,1,'2023-11-08 17:25:00',36),
	(19,1,1,'2023-11-08 17:29:00',54);

/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idUser` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pass` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nivel` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;

INSERT INTO `usuario` (`idUser`, `nombre`, `user`, `pass`, `nivel`)
VALUES
	(1,'VIctor Hernandez','VH','v',1),
	(2,'Cinthya Olivares','CO','cinthyaO',1);

/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
