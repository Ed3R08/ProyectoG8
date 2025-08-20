CREATE DATABASE  IF NOT EXISTS `octaviusdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `octaviusdb`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: octaviusdb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `carrito`
--

DROP TABLE IF EXISTS `carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `fecha_agregado` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `tusuario` (`IdUsuario`),
  CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrito`
--

LOCK TABLES `carrito` WRITE;
/*!40000 ALTER TABLE `carrito` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id_categoria` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `ruta_imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Servicios','https://i.imgur.com/ZFt2HRb.jpg',1),(2,'Químicos','https://tse2.mm.bing.net/th/id/OIP.jMoGD8Lyva_yjGV5kxX_yAHaHa?rs=1&pid=ImgDetMain&o=7&rm=3',1),(3,'Accesorios','https://i.imgur.com/mj0gYIx.jpg',1),(4,'Equipos','https://i.imgur.com/qV97892.jpg',1),(5,'Prueba','C:\\Users\\XPC\\OneDrive\\Imágenes\\Goku2',0),(6,'Goku','https://imgur.com/a/QHfsAod',0),(7,'Prueba f1oioi','https://i.imgur.com/ZFt2HRb.jpg',0),(8,'Prueba f2','https://i.imgur.com/ZFt2HRb.jpg',0),(9,'Prueba f3','https://i.imgur.com/ZFt2HRb.jpg',0),(10,'Prueba f3','https://imgur.com/a/QHfsAod',0),(11,'Prueba Goku','https://i.imgur.com/hdqrHAx.png',0),(12,'Prueba Goku','https://i.imgur.com/hdqrHAx.png',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_compras`
--

DROP TABLE IF EXISTS `historial_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_compras` (
  `id_compra` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_compra`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `historial_compras_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tusuario` (`IdUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_compras`
--

LOCK TABLES `historial_compras` WRITE;
/*!40000 ALTER TABLE `historial_compras` DISABLE KEYS */;
INSERT INTO `historial_compras` VALUES (1,1,730.00,'2025-07-23 11:10:04'),(2,1,30.00,'2025-07-23 11:10:29'),(3,1,30.00,'2025-07-23 16:36:37'),(4,1,30.00,'2025-07-23 16:52:16'),(5,1,30.00,'2025-07-23 16:53:08'),(6,1,600.00,'2025-08-12 15:44:51'),(7,1,30.00,'2025-08-12 16:12:25'),(8,1,90.00,'2025-08-12 16:27:07'),(9,1,90.00,'2025-08-19 15:20:35'),(10,1,80.00,'2025-08-19 15:34:04'),(11,1,810.00,'2025-08-20 12:23:11'),(12,1,1910.00,'2025-08-20 13:44:43'),(13,1,2965.00,'2025-08-20 13:54:02'),(14,1,2565.00,'2025-08-20 14:08:15'),(15,1,60.00,'2025-08-20 14:12:01'),(16,1,5405.00,'2025-08-20 14:12:35'),(17,1,390.00,'2025-08-20 14:16:04');
/*!40000 ALTER TABLE `historial_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_detalle`
--

DROP TABLE IF EXISTS `historial_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial_detalle` (
  `id_detalle` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_compra` bigint(20) NOT NULL,
  `producto_id` bigint(20) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `id_compra` (`id_compra`),
  KEY `producto_id` (`producto_id`),
  CONSTRAINT `historial_detalle_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `historial_compras` (`id_compra`) ON DELETE CASCADE,
  CONSTRAINT `historial_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_detalle`
--

LOCK TABLES `historial_detalle` WRITE;
/*!40000 ALTER TABLE `historial_detalle` DISABLE KEYS */;
INSERT INTO `historial_detalle` VALUES (1,1,13,1,300.00),(2,1,6,6,30.00),(3,1,15,1,250.00),(4,2,6,1,30.00),(5,3,6,1,30.00),(6,4,6,1,30.00),(7,5,6,1,30.00),(8,6,13,2,300.00),(9,7,6,1,30.00),(10,8,6,3,30.00),(11,9,6,3,30.00),(12,10,5,1,80.00),(13,11,6,2,30.00),(14,11,15,3,250.00),(16,12,6,6,30.00),(17,12,13,3,300.00),(18,12,11,1,60.00),(19,12,2,1,100.00),(20,12,9,1,120.00),(21,12,14,1,400.00),(22,12,1,1,150.00),(23,13,6,2,30.00),(24,13,13,1,300.00),(25,13,7,1,25.00),(26,13,15,1,2500.00),(27,13,5,1,80.00),(30,14,6,1,30.00),(31,14,8,1,35.00),(32,14,15,1,2500.00),(33,15,6,2,30.00),(34,16,6,1,30.00),(35,16,13,1,300.00),(36,16,7,1,25.00),(37,16,15,2,2500.00),(38,16,4,1,50.00),(41,17,6,1,30.00),(42,17,13,1,300.00),(43,17,8,1,35.00),(44,17,7,1,25.00);
/*!40000 ALTER TABLE `historial_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `id_producto` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_categoria` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `detalle` text DEFAULT NULL,
  `precio` decimal(12,2) NOT NULL,
  `existencias` int(11) NOT NULL DEFAULT 0,
  `ruta_imagen` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_producto`),
  KEY `fk_producto_categoria` (`id_categoria`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,1,'Mantenimiento','Servicio integral de mantenimiento de piscinas, incluyendo revisión y limpieza profunda de equipos y estructuras.',150.00,10,'https://i.imgur.com/ZFt2HRb.jpg',1),(2,1,'Limpieza','Servicio regular de limpieza para mantener el agua cristalina y libre de impurezas.',100.00,15,'https://i.imgur.com/CB2H0XY.jpg',1),(3,1,'Visita Técnica','Visita técnica para diagnóstico y solución de problemas en el sistema de la piscina.',200.00,5,'https://i.imgur.com/sisEdjN.jpg',1),(4,2,'Cloro Granulado','Cloro granulado para desinfección rápida y efectiva del agua de la piscina.',50.00,100,'https://i.imgur.com/yUnRO97.jpg',1),(5,2,'Cloro en Tabletas','Tabletas de cloro de liberación controlada para el mantenimiento diario.',80.00,80,'https://i.imgur.com/A7MS0u3.jpg',1),(6,3,'Alguicida','Producto para eliminar y prevenir el crecimiento d',30.00,15,'https://i.imgur.com/qmNhWJ2.jpg',1),(7,2,'Clarificador','Producto que mejora la claridad del agua eliminando partículas en suspensión.',25.00,150,'https://i.imgur.com/qP0Ew8p.jpg',1),(8,3,'Boquillas de Retorno','Boquillas para un óptimo retorno del agua en piscinas.',35.00,50,'https://i.imgur.com/0AloD4A.jpg',1),(9,3,'Hidrojets','Sistemas de hidrojets para masaje y mejor circulación del agua.',120.00,30,'https://i.imgur.com/7jaExhD.jpg',1),(10,3,'Parrillas de Fondo','Parrillas que facilitan el drenaje y la limpieza del fondo de la piscina.',45.00,40,'https://i.imgur.com/PcKDLFI.jpg',1),(11,3,'Skimmer','Skimmer para recoger hojas y residuos en la superficie del agua.',60.00,25,'https://i.imgur.com/AnYNpT6.jpg',1),(12,3,'Rebalse','Sistema de rebalse para evitar el sobrellenado de la piscina.',55.00,20,'https://i.imgur.com/JX0BtQH.jpg',1),(13,4,'Bomba de Agua','Bomba de alta eficiencia para la circulación y recirculación del agua de la piscina.',300.00,10,'https://i.imgur.com/dhjw4Cm.jpg',1),(14,4,'Filtro de Piscina','Filtro de alta capacidad para mantener el agua limpia y libre de impurezas.',400.00,8,'https://i.imgur.com/0WqE6yU.jpg',1),(15,3,'Clorinador','Sistema automático que dosifica cloro en la piscin',2500.00,14,'https://i.imgur.com/y5qAZYw.jpg',1),(20,12,'Eder','prueba',100.00,10,'https://i.imgur.com/5S1OuYL_d.jpeg?maxwidth=520&shape=thumb&fidelity=high',1);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terror`
--

DROP TABLE IF EXISTS `terror`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terror` (
  `IdError` bigint(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(5000) NOT NULL,
  `FechaHora` datetime NOT NULL,
  PRIMARY KEY (`IdError`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terror`
--

LOCK TABLES `terror` WRITE;
/*!40000 ALTER TABLE `terror` DISABLE KEYS */;
INSERT INTO `terror` VALUES (1,'PROCEDURE mndatabase.ValidarInicioSesion2 does not exist','2025-06-18 19:49:23'),(2,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:23'),(3,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:29'),(4,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:30'),(5,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:30'),(6,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:30'),(7,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:31'),(8,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:31'),(9,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:32'),(10,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:32'),(11,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:32'),(12,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:33'),(13,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:33'),(14,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:33'),(15,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:10:39'),(16,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:14:00'),(17,'Unknown column \'pCorreo\' in \'field list\'','2025-07-09 19:01:06'),(18,'You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\\\'Quimicos\\\', \\\'\\\')\' at line 1','2025-07-11 10:26:29'),(19,'You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\\\'Quimicos\\\', \\\'https://i.imgur.com/ZFt2HRb.jpg\\\')\' at line 1','2025-07-11 10:27:05'),(20,'You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\\\'Prueba\\\', \\\'C:\\\\Users\\\\XPC\\\\OneDrive\\\\Imágenes\\\\Goku2\\\')\' at line 1','2025-07-11 10:29:09'),(21,'You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near \'\\\'Prueba\\\', \\\'C:\\\\Users\\\\XPC\\\\OneDrive\\\\Imágenes\\\\Goku2\\\')\' at line 1','2025-07-11 11:06:04'),(22,'PROCEDURE octaviusdb.EliminarProducto does not exist','2025-07-23 09:57:07'),(23,'PROCEDURE octaviusdb.EliminarProducto does not exist','2025-07-23 09:58:08'),(24,'PROCEDURE octaviusdb.EditarProducto does not exist','2025-07-23 09:58:34'),(25,'PROCEDURE octaviusdb.EliminarProducto does not exist','2025-07-23 10:10:46'),(26,'PROCEDURE octaviusdb.EditarProducto does not exist','2025-07-23 10:11:23'),(27,'PROCEDURE octaviusdb.EditarProducto does not exist','2025-07-23 16:40:11'),(28,'PROCEDURE octaviusdb.EliminarProducto does not exist','2025-07-23 16:41:01'),(29,'PROCEDURE octaviusdb.EditarProducto does not exist','2025-07-23 16:59:15'),(30,'PROCEDURE octaviusdb.EditarProducto does not exist','2025-07-23 17:01:26'),(31,'PROCEDURE octaviusdb.EliminarProducto does not exist','2025-07-23 17:03:26'),(32,'PROCEDURE octaviusdb.EliminarCategoria does not exist','2025-08-19 15:09:20'),(33,'PROCEDURE octaviusdb.EditarCategoria does not exist','2025-08-19 15:09:44'),(34,'PROCEDURE octaviusdb.EliminarCategoria does not exist','2025-08-19 15:10:46'),(35,'PROCEDURE octaviusdb.EditarCategoria does not exist','2025-08-19 15:18:09'),(36,'PROCEDURE octaviusdb.EliminarCategoria does not exist','2025-08-19 15:36:07'),(37,'PROCEDURE octaviusdb.EditarCategoria does not exist','2025-08-19 15:37:05');
/*!40000 ALTER TABLE `terror` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_servicio` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
INSERT INTO `tipo_servicio` VALUES (1,'Mantenimiento general'),(2,'Visita técnica'),(3,'Limpieza profunda');
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tproducto`
--

DROP TABLE IF EXISTS `tproducto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tproducto` (
  `IdProducto` bigint(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Descripcion` varchar(1000) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Estado` bit(1) NOT NULL,
  `Imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`IdProducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tproducto`
--

LOCK TABLES `tproducto` WRITE;
/*!40000 ALTER TABLE `tproducto` DISABLE KEYS */;
/*!40000 ALTER TABLE `tproducto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trol`
--

DROP TABLE IF EXISTS `trol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trol` (
  `IdRol` int(11) NOT NULL AUTO_INCREMENT,
  `NombreRol` varchar(50) NOT NULL,
  PRIMARY KEY (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trol`
--

LOCK TABLES `trol` WRITE;
/*!40000 ALTER TABLE `trol` DISABLE KEYS */;
INSERT INTO `trol` VALUES (1,'Usuario Regular'),(2,'Usuario Administrador');
/*!40000 ALTER TABLE `trol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tusuario`
--

DROP TABLE IF EXISTS `tusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tusuario` (
  `IdUsuario` bigint(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(255) NOT NULL,
  `Correo` varchar(100) NOT NULL,
  `Identificacion` varchar(20) NOT NULL,
  `Contrasenna` varchar(10) NOT NULL,
  `IdRol` int(11) NOT NULL,
  PRIMARY KEY (`IdUsuario`),
  KEY `FK_tusuario_trol` (`IdRol`),
  CONSTRAINT `FK_tusuario_trol` FOREIGN KEY (`IdRol`) REFERENCES `trol` (`IdRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tusuario`
--

LOCK TABLES `tusuario` WRITE;
/*!40000 ALTER TABLE `tusuario` DISABLE KEYS */;
INSERT INTO `tusuario` VALUES (1,'Eder Serrano Valerio','eserrano00695@ufide.ac.cr','114300695','01234',1),(2,'Fernanda Ramirez Acuña','framirez00198@ufide.ac.cr','114300198','98765',2);
/*!40000 ALTER TABLE `tusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visita_tecnica`
--

DROP TABLE IF EXISTS `visita_tecnica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visita_tecnica` (
  `id_visita` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_usuario` bigint(20) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `comentarios` text DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`id_visita`),
  KEY `fk_visita_usuario` (`id_usuario`),
  KEY `fk_visita_tipo` (`id_tipo`),
  CONSTRAINT `fk_visita_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_servicio` (`id_tipo`) ON DELETE CASCADE,
  CONSTRAINT `fk_visita_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `tusuario` (`IdUsuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visita_tecnica`
--

LOCK TABLES `visita_tecnica` WRITE;
/*!40000 ALTER TABLE `visita_tecnica` DISABLE KEYS */;
/*!40000 ALTER TABLE `visita_tecnica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'octaviusdb'
--
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarContrasenna` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarContrasenna`(pIdUsuario bigint(11),
     pContrasenna varchar(10))
BEGIN

	UPDATE 	tusuario
	SET 	Contrasenna = pContrasenna
    WHERE 	IdUsuario = pIdUsuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ActualizarPerfilUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarPerfilUsuario`(pIdUsuario bigint(11),
	 pNombre varchar(255),
	 pCorreo varchar(100),
     pIdentificacion varchar(20))
BEGIN

	UPDATE tusuario
    SET Nombre = pNombre,
        Correo = pCorreo,
        Identificacion = pIdentificacion
	WHERE IdUsuario = pIdUsuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ConsultarInfoUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarInfoUsuario`(pIdUsuario bigint(11))
BEGIN

	SELECT	IdUsuario,
			Nombre,
            Correo,
            Identificacion,
            Contrasenna
	FROM 	tusuario
	WHERE 	IdUsuario = pIdUsuario;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EditarCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EditarCategoria`(
    IN pId       BIGINT,
    IN pDesc     VARCHAR(255),
    IN pImagen   VARCHAR(255),
    IN pActivo   TINYINT
)
BEGIN
    UPDATE categoria
       SET descripcion = pDesc,
           -- Si te llega cadena vacía, guarda NULL
           ruta_imagen = NULLIF(pImagen, ''),
           activo      = pActivo
     WHERE id_categoria = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EditarProducto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EditarProducto`(
    IN pId_producto BIGINT,
    IN pIdCategoria INT,
    IN pNombre VARCHAR(100),
    IN pDetalle VARCHAR(50),
    IN pPrecio DECIMAL(12,2),
    IN pExistencias INT,
    IN pRutaImagen VARCHAR(255)
)
BEGIN
    UPDATE producto
    SET id_categoria = pIdCategoria,
        nombre = pNombre,
        detalle = pDetalle,
        precio = pPrecio,
        existencias = pExistencias,
        ruta_imagen = pRutaImagen
    WHERE id_producto = pId_producto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EliminarCategoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarCategoria`(
    IN pId BIGINT
)
BEGIN
    -- Desactivar la categoría
    UPDATE categoria
       SET activo = 0
     WHERE id_categoria = pId;

    -- (Opcional pero recomendado) Desactivar también productos de esa categoría
    UPDATE producto
       SET activo = 0
     WHERE id_categoria = pId;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `EliminarProducto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarProducto`(
    IN pId_producto BIGINT
)
BEGIN
    DELETE FROM producto
    WHERE id_producto = pId_producto;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RegistrarError` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarError`(pDescripcion varchar(5000))
BEGIN

	INSERT INTO terror(Descripcion,FechaHora)
	VALUES (pDescripcion,NOW());

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `RegistrarUsuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `RegistrarUsuario`(pNombre varchar(255),
	 pCorreo varchar(100),
     pIdentificacion varchar(20),
     pContrasenna varchar(10))
BEGIN

	INSERT INTO tusuario(Nombre,Correo,Identificacion,Contrasenna,IdRol)
	VALUES (pNombre,pCorreo,pIdentificacion,pContrasenna,1);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_actualizar_carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_actualizar_carrito`(
  IN p_carrito_id    INT,
  IN p_nueva_cantidad INT
)
BEGIN
  UPDATE carrito
     SET cantidad = p_nueva_cantidad
   WHERE id = p_carrito_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_agregar_carrito1` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_agregar_carrito1`(
  IN p_usuario_id  BIGINT,
  IN p_producto_id BIGINT,
  IN p_cantidad    INT
)
BEGIN
  DECLARE existe INT DEFAULT 0;

  SELECT COUNT(*) 
    INTO existe
    FROM carrito
   WHERE usuario_id  = p_usuario_id
     AND producto_id = p_producto_id;

  IF existe = 0 THEN
    INSERT INTO carrito(usuario_id, producto_id, cantidad)
    VALUES(p_usuario_id, p_producto_id, p_cantidad);
  ELSE
    UPDATE carrito
       SET cantidad = cantidad + p_cantidad
     WHERE usuario_id  = p_usuario_id
       AND producto_id = p_producto_id;
  END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_consulta_categorias` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consulta_categorias`()
BEGIN
  SELECT id_categoria, descripcion, ruta_imagen
    FROM categoria
   WHERE activo = 1
   ORDER BY descripcion;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_consulta_productos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consulta_productos`(
  IN pCat BIGINT
)
BEGIN
  SELECT 
    id_producto, nombre, detalle, precio, existencias, ruta_imagen
  FROM producto
  WHERE id_categoria = pCat
    AND activo = 1
  ORDER BY nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_consulta_productos_all` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consulta_productos_all`()
BEGIN
  SELECT id_producto, nombre, detalle, precio, existencias, ruta_imagen
    FROM producto
   WHERE activo = 1
   ORDER BY nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_consulta_visitas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_consulta_visitas`(
  IN pUser BIGINT
)
BEGIN
  SELECT
    v.id_visita,
    v.fecha_hora,
    ts.descripcion AS tipo_servicio,
    v.comentarios,
    v.estado
  FROM visita_tecnica v
  JOIN tipo_servicio ts ON v.id_tipo = ts.id_tipo
  WHERE v.id_usuario = pUser
  ORDER BY v.fecha_hora DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_detalle_compra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_detalle_compra`(IN p_id_compra BIGINT)
BEGIN
  SELECT d.cantidad,
         d.precio,
         p.nombre AS producto,
         (d.cantidad * d.precio) AS subtotal
  FROM historial_detalle d
  JOIN producto p ON p.id_producto = d.producto_id
  WHERE d.id_compra = p_id_compra;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_eliminar_carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_eliminar_carrito`(
  IN p_carrito_id INT
)
BEGIN
  DELETE FROM carrito
   WHERE id = p_carrito_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_finalizar_compra` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_finalizar_compra`(
    IN p_usuario_id BIGINT
)
BEGIN
    DECLARE v_total DECIMAL(12,2);

    -- Calcular total del carrito
    SELECT SUM(p.precio * c.cantidad) INTO v_total
    FROM carrito c
    JOIN producto p ON p.id_producto = c.producto_id
    WHERE c.usuario_id = p_usuario_id;

    -- Insertar en historial_compras
    INSERT INTO historial_compras(id_usuario, total)
    VALUES (p_usuario_id, v_total);

    -- Insertar cada producto del carrito en historial_detalle
    INSERT INTO historial_detalle(id_compra, producto_id, cantidad, precio)
    SELECT LAST_INSERT_ID(), c.producto_id, c.cantidad, p.precio
    FROM carrito c
    JOIN producto p ON p.id_producto = c.producto_id
    WHERE c.usuario_id = p_usuario_id;

    -- Vaciar carrito
    DELETE FROM carrito WHERE usuario_id = p_usuario_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_historial_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_historial_usuario`(IN p_usuario_id BIGINT)
BEGIN
  SELECT 
      hc.id_compra,
      hc.fecha,
      hc.total,
      hd.producto_id,
      p.nombre AS producto,
      hd.cantidad,
      hd.precio
  FROM historial_compras hc
  JOIN historial_detalle hd ON hc.id_compra = hd.id_compra
  JOIN producto p          ON p.id_producto = hd.producto_id
  WHERE hc.id_usuario = p_usuario_id
  ORDER BY hc.fecha DESC, hc.id_compra DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insert_categoria` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_categoria`(
  IN pDesc   VARCHAR(255),
  IN pImagen VARCHAR(255)
)
BEGIN
  INSERT INTO `categoria` (descripcion, ruta_imagen)
  VALUES (pDesc, pImagen);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insert_producto` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_producto`(
  IN pCat    BIGINT,
  IN pNombre VARCHAR(255),
  IN pDetalle TEXT,
  IN pPrecio DECIMAL(12,2),
  IN pStock  INT,
  IN pImagen VARCHAR(255)
)
BEGIN
  INSERT INTO `producto` (
    id_categoria, nombre, detalle, precio, existencias, ruta_imagen
  ) VALUES (
    pCat, pNombre, pDetalle, pPrecio, pStock, pImagen
  );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_insert_visita` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_insert_visita`(
  IN pUser      BIGINT,
  IN pTipo      INT,
  IN pFechaHora DATETIME,
  IN pComentarios TEXT
)
BEGIN
  INSERT INTO `visita_tecnica` (
    id_usuario, id_tipo, fecha_hora, comentarios
  ) VALUES (
    pUser, pTipo, pFechaHora, pComentarios
  );
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_listar_usuarios` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_usuarios`()
BEGIN
  SELECT IdUsuario, Nombre
    FROM tusuario
   ORDER BY Nombre;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ultima_compra_por_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ultima_compra_por_usuario`(IN p_usuario_id BIGINT)
BEGIN
  SELECT c.id_compra, c.fecha, u.Nombre AS cliente
  FROM historial_compras c
  JOIN tusuario u ON u.IdUsuario = c.id_usuario
  WHERE c.id_usuario = p_usuario_id
  ORDER BY c.id_compra DESC
  LIMIT 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_ver_carrito` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_ver_carrito`(
  IN p_usuario_id BIGINT
)
BEGIN
  SELECT
    c.id,
    p.nombre,
    p.precio,
    c.cantidad,
    (p.precio * c.cantidad) AS subtotal,
    c.fecha_agregado
  FROM carrito c
  JOIN producto p ON p.id_producto = c.producto_id
  WHERE c.usuario_id = p_usuario_id
  ORDER BY c.fecha_agregado DESC;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ValidarCorreo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidarCorreo`(pCorreo varchar(100))
BEGIN

	SELECT	Nombre,
            IdUsuario
	FROM 	tusuario
	WHERE 	Correo = pCorreo;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `ValidarInicioSesion` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `ValidarInicioSesion`(pCorreo varchar(100),
     pContrasenna varchar(10))
BEGIN

	SELECT	IdUsuario,
			Nombre,
			Correo,
			Identificacion,
            Contrasenna,
            U.IdRol,
            NombreRol
	FROM 	tusuario U
    INNER JOIN trol R ON U.IdRol = R.IdRol
	WHERE 	Correo = pCorreo
		AND Contrasenna = pContrasenna;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-20 14:21:48
