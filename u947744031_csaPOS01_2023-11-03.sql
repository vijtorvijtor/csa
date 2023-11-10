# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.10.2-MariaDB)
# Base de datos: u947744031_csaPOS01
# Tiempo de Generación: 2023-11-03 21:16:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


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
	(1,'Pesos'),
	(2,'Litro'),
	(3,'Kilo'),
	(4,'Pieza');

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
  `idProducto` int(11) unsigned DEFAULT 0,
  `cantidad` decimal(7,0) DEFAULT 0,
  `unidad` int(11) unsigned DEFAULT NULL,
  `movimiento` int(11) unsigned DEFAULT NULL,
  `fecha` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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
	(4,4,0,0,0,0),
	(5,5,0,0,0,0),
	(6,6,0,0,0,0),
	(7,7,0,0,0,0),
	(8,8,0,0,0,0),
	(9,9,0,0,0,0),
	(10,10,0,0,0,0),
	(11,11,2,4,6,8);

/*!40000 ALTER TABLE `precio` ENABLE KEYS */;
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
