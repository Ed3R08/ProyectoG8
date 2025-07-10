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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Servicios','https://i.imgur.com/ZFt2HRb.jpg',1),(2,'Químicos','https://i.imgur.com/ZFt2HRb.jpg',1),(3,'Accesorios','https://i.imgur.com/mj0gYIx.jpg',1),(4,'Equipos','https://i.imgur.com/qV97892.jpg',1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,1,'Mantenimiento','Servicio integral de mantenimiento de piscinas, incluyendo revisión y limpieza profunda de equipos y estructuras.',150.00,10,'https://i.imgur.com/ZFt2HRb.jpg',1),(2,1,'Limpieza','Servicio regular de limpieza para mantener el agua cristalina y libre de impurezas.',100.00,15,'https://i.imgur.com/CB2H0XY.jpg',1),(3,1,'Visita Técnica','Visita técnica para diagnóstico y solución de problemas en el sistema de la piscina.',200.00,5,'https://i.imgur.com/sisEdjN.jpg',1),(4,2,'Cloro Granulado','Cloro granulado para desinfección rápida y efectiva del agua de la piscina.',50.00,100,'https://i.imgur.com/yUnRO97.jpg',1),(5,2,'Cloro en Tabletas','Tabletas de cloro de liberación controlada para el mantenimiento diario.',80.00,80,'https://i.imgur.com/A7MS0u3.jpg',1),(6,2,'Alguicida','Producto para eliminar y prevenir el crecimiento de algas en la piscina.',30.00,120,'https://i.imgur.com/qmNhWJ2.jpg',1),(7,2,'Clarificador','Producto que mejora la claridad del agua eliminando partículas en suspensión.',25.00,150,'https://i.imgur.com/qP0Ew8p.jpg',1),(8,3,'Boquillas de Retorno','Boquillas para un óptimo retorno del agua en piscinas.',35.00,50,'https://i.imgur.com/0AloD4A.jpg',1),(9,3,'Hidrojets','Sistemas de hidrojets para masaje y mejor circulación del agua.',120.00,30,'https://i.imgur.com/7jaExhD.jpg',1),(10,3,'Parrillas de Fondo','Parrillas que facilitan el drenaje y la limpieza del fondo de la piscina.',45.00,40,'https://i.imgur.com/PcKDLFI.jpg',1),(11,3,'Skimmer','Skimmer para recoger hojas y residuos en la superficie del agua.',60.00,25,'https://i.imgur.com/AnYNpT6.jpg',1),(12,3,'Rebalse','Sistema de rebalse para evitar el sobrellenado de la piscina.',55.00,20,'https://i.imgur.com/JX0BtQH.jpg',1),(13,4,'Bomba de Agua','Bomba de alta eficiencia para la circulación y recirculación del agua de la piscina.',300.00,10,'https://i.imgur.com/dhjw4Cm.jpg',1),(14,4,'Filtro de Piscina','Filtro de alta capacidad para mantener el agua limpia y libre de impurezas.',400.00,8,'https://i.imgur.com/0WqE6yU.jpg',1),(15,4,'Clorinador','Sistema automático que dosifica cloro en la piscina para garantizar la desinfección continua.',250.00,12,'https://i.imgur.com/y5qAZYw.jpg',1),(16,3,'Goku','Prueba de producto placeholder.',100.00,5,NULL,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terror`
--

LOCK TABLES `terror` WRITE;
/*!40000 ALTER TABLE `terror` DISABLE KEYS */;
INSERT INTO `terror` VALUES (1,'PROCEDURE mndatabase.ValidarInicioSesion2 does not exist','2025-06-18 19:49:23'),(2,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:23'),(3,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:29'),(4,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:30'),(5,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:30'),(6,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:30'),(7,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:31'),(8,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:31'),(9,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:32'),(10,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:32'),(11,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:32'),(12,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:33'),(13,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:33'),(14,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:08:33'),(15,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:10:39'),(16,'Unknown column \'Identificacion2\' in \'field list\'','2025-06-18 20:14:00'),(17,'Unknown column \'pCorreo\' in \'field list\'','2025-07-09 19:01:06');
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
INSERT INTO `tusuario` VALUES (1,'Eder Serrano Valerio','eserrano00695@ufide.ac.cr','114300695','01234',1),(2,'Fernanda Ramirez Acuña','framirez00198@ufide.ac.cr','114300198','56789',2);
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

-- Dump completed on 2025-07-10 17:03:50
