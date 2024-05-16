-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.17-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para pedidos
CREATE DATABASE IF NOT EXISTS `pedidos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `pedidos`;

-- Volcando estructura para tabla pedidos.carrito
CREATE TABLE IF NOT EXISTS `carrito` (
  `CodCarr` int(11) NOT NULL AUTO_INCREMENT,
  `CodProduct` int(11) NOT NULL,
  `CodRes` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  PRIMARY KEY (`CodCarr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.carrito: ~0 rows (aproximadamente)
DELETE FROM `carrito`;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `CodCat` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) NOT NULL,
  `Descripcion` varchar(150) NOT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CodCat`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.categorias: ~3 rows (aproximadamente)
DELETE FROM `categorias`;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` (`CodCat`, `Nombre`, `Descripcion`, `Activo`) VALUES
	(1, 'Comida', 'Platos e ingredientes', 1),
	(2, 'Bebidas sin', 'Bebidas sin alcohol', 1),
	(3, 'Bebidas con', 'Bebidas con alcohol', 1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `Cod_Estado` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(90) NOT NULL,
  PRIMARY KEY (`Cod_Estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.estados: ~3 rows (aproximadamente)
DELETE FROM `estados`;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` (`Cod_Estado`, `Descripcion`) VALUES
	(1, 'Enviado'),
	(2, 'Entregado'),
	(3, 'Cancelado');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;


-- Volcando estructura para tabla pedidos.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `CodPed` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime DEFAULT current_timestamp(),
  `Precio_Total` decimal(10,2) NOT NULL,
  `Cod_Estado` int(11) NOT NULL,
  `CodRes` int(11) NOT NULL,
  PRIMARY KEY (`CodPed`),
  KEY `CodRes` (`CodRes`),
  KEY `Cod_Estado` (`Cod_Estado`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`CodRes`) REFERENCES `restaurantes` (`CodRes`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`Cod_Estado`) REFERENCES `estados` (`Cod_Estado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.pedidos: ~3 rows (aproximadamente)
DELETE FROM `pedidos`;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` (`CodPed`, `Fecha`, `Precio_Total`, `Cod_Estado`, `CodRes`) VALUES
	(1, '2022-11-27 00:00:00', 130.00, 1, 2),
	(2, '2022-11-28 00:00:00', 30.00, 1, 2),
	(3, '2022-11-29 00:00:00', 50.00, 2, 2);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.pedidosproductos
CREATE TABLE IF NOT EXISTS `pedidosproductos` (
  `CodPedProduct` int(11) NOT NULL AUTO_INCREMENT,
  `CodPed` int(11) NOT NULL,
  `CodProduct` int(11) NOT NULL,
  `Unidades` int(11) NOT NULL,
  PRIMARY KEY (`CodPedProduct`),
  KEY `CodProduct` (`CodProduct`),
  KEY `CodPed` (`CodPed`),
  CONSTRAINT `pedidosproductos_ibfk_1` FOREIGN KEY (`CodProduct`) REFERENCES `productos` (`CodProduct`),
  CONSTRAINT `pedidosproductos_ibfk_2` FOREIGN KEY (`CodPed`) REFERENCES `pedidos` (`CodPed`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.pedidosproductos: ~5 rows (aproximadamente)
DELETE FROM `pedidosproductos`;
/*!40000 ALTER TABLE `pedidosproductos` DISABLE KEYS */;
INSERT INTO `pedidosproductos` (`CodPedProduct`, `CodPed`, `CodProduct`, `Unidades`) VALUES
	(1, 1, 1, 2),
	(2, 2, 3, 3),
	(3, 2, 1, 5),
	(4, 2, 2, 4),
	(5, 3, 4, 3);
/*!40000 ALTER TABLE `pedidosproductos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `CodProduct` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(150) NOT NULL,
  `Descripcion` varchar(150) NOT NULL,
  `Peso` int(11) DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `CodCat` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CodProduct`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `CodCat` (`CodCat`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`CodCat`) REFERENCES `categorias` (`CodCat`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.productos: ~6 rows (aproximadamente)
DELETE FROM `productos`;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`CodProduct`, `Nombre`, `Descripcion`, `Peso`, `Stock`, `CodCat`, `Precio`, `Activo`) VALUES
	(1, 'Harina', '8 paquetes de 1kg de harina cada uno', NULL, 100, 1, 10.00, 1),
	(2, 'Azúcar', '20 paquetes de 1kg cada uno', NULL, 3, 1, 8.00, 1),
	(3, 'Agua 0.5', '100 botellas de 0.5 litros cada una', NULL, 100, 2, 5.00, 1),
	(4, 'Agua 1.5', '20 botellas de 1.5 litros cada una', NULL, 50, 2, 7.00, 1),
	(5, 'Cerveza Alhambra tercio', '24 botellas de 33cl', NULL, 0, 3, 12.00, 1),
	(6, 'Vino tinto Rioja 0.75', '6 botellas de 0.75', NULL, 10, 3, 20.00, 1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.restaurantes
CREATE TABLE IF NOT EXISTS `restaurantes` (
  `CodRes` int(11) NOT NULL AUTO_INCREMENT,
  `Cod_Rol` int(11) NOT NULL,
  `Nombre` varchar(150) NOT NULL,
  `Clave` varchar(100) NOT NULL,
  `Pais` varchar(150) NOT NULL,
  `CP` int(11) NOT NULL,
  `Ciudad` varchar(150) NOT NULL,
  `Direccion` varchar(150) NOT NULL,
  `Activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`CodRes`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `Cod_Rol` (`Cod_Rol`),
  CONSTRAINT `restaurantes_ibfk_1` FOREIGN KEY (`Cod_Rol`) REFERENCES `rol` (`Cod_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.restaurantes: ~3 rows (aproximadamente)
DELETE FROM `restaurantes`;
/*!40000 ALTER TABLE `restaurantes` DISABLE KEYS */;
INSERT INTO `restaurantes` (`CodRes`, `Cod_Rol`, `Nombre`, `Clave`, `Pais`, `CP`, `Ciudad`, `Direccion`, `Activo`) VALUES
	(1, 1, 'cliente1', '$2y$10$Xh5kBBad61Vog5PbvvLxceJeqvM/8aUfNZNfIrhB5mcJO/67okpoy', 'España', 28002, 'Madrid', 'C/ Padre Claret, 8', 1),
	(2, 2, 'cliente2', '$2y$10$Xh5kBBad61Vog5PbvvLxceJeqvM/8aUfNZNfIrhB5mcJO/67okpoy', 'España', 11001, 'Cádiz', 'C/ Portales, 2', 1),
	(3, 2, 'root', '$2y$10$Xh5kBBad61Vog5PbvvLxceJeqvM/8aUfNZNfIrhB5mcJO/67okpoy', 'Galicia', 15555, 'Laxe', 'Villamparo, 14', 1);
/*!40000 ALTER TABLE `restaurantes` ENABLE KEYS */;

-- Volcando estructura para tabla pedidos.rol
CREATE TABLE IF NOT EXISTS `rol` (
  `Cod_Rol` int(11) NOT NULL AUTO_INCREMENT,
  `Rol` varchar(90) NOT NULL,
  PRIMARY KEY (`Cod_Rol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla pedidos.rol: ~2 rows (aproximadamente)
DELETE FROM `rol`;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`Cod_Rol`, `Rol`) VALUES
	(1, 'Cliente'),
	(2, 'Administrador');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
