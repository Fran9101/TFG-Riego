CREATE DATABASE  IF NOT EXISTS `ardureg` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ardureg`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ardureg
-- ------------------------------------------------------
-- Server version	5.7.17-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `arduino`
--

DROP TABLE IF EXISTS `arduino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arduino` (
  `IDArduino` varchar(1) NOT NULL,
  `Zona` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`IDArduino`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arduino`
--

LOCK TABLES `arduino` WRITE;
/*!40000 ALTER TABLE `arduino` DISABLE KEYS */;
INSERT INTO `arduino` VALUES ('A','Default'),('B','Default'),('C','Default'),('D','Default');
/*!40000 ALTER TABLE `arduino` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `arduino_programacion`
--

DROP TABLE IF EXISTS `arduino_programacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `arduino_programacion` (
  `Arduino_IDArduino` varchar(1) NOT NULL,
  `Programacion_IDProg` int(11) NOT NULL,
  PRIMARY KEY (`Arduino_IDArduino`,`Programacion_IDProg`),
  KEY `fk_Arduino_has_Programacion_Programacion1_idx` (`Programacion_IDProg`),
  KEY `fk_Arduino_has_Programacion_Arduino_idx` (`Arduino_IDArduino`),
  CONSTRAINT `fk_Arduino_has_Programacion_Arduino` FOREIGN KEY (`Arduino_IDArduino`) REFERENCES `arduino` (`IDArduino`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Arduino_has_Programacion_Programacion1` FOREIGN KEY (`Programacion_IDProg`) REFERENCES `programacion` (`IDProg`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arduino_programacion`
--

LOCK TABLES `arduino_programacion` WRITE;
/*!40000 ALTER TABLE `arduino_programacion` DISABLE KEYS */;
INSERT INTO `arduino_programacion` VALUES ('A',1),('B',2),('C',3),('D',4);
/*!40000 ALTER TABLE `arduino_programacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estadisticas`
--

DROP TABLE IF EXISTS `estadisticas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estadisticas` (
  `IDEstadistica` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` datetime NOT NULL,
  `Temperatura` float NOT NULL,
  `Hum_Aire` float NOT NULL,
  `Litros` float NOT NULL,
  `Arduino_IDArduino` varchar(1) NOT NULL,
  PRIMARY KEY (`IDEstadistica`,`Arduino_IDArduino`),
  KEY `fk_Estadisticas_Arduino1_idx` (`Arduino_IDArduino`),
  CONSTRAINT `fk_Estadisticas_Arduino1` FOREIGN KEY (`Arduino_IDArduino`) REFERENCES `arduino` (`IDArduino`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estadisticas`
--

LOCK TABLES `estadisticas` WRITE;
/*!40000 ALTER TABLE `estadisticas` DISABLE KEYS */;
INSERT INTO `estadisticas` VALUES (1,'2017-04-24 12:40:27',23,66,50,'A'),(2,'2017-04-24 12:41:21',23,66.5,50,'A');
/*!40000 ALTER TABLE `estadisticas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lluvia`
--

DROP TABLE IF EXISTS `lluvia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lluvia` (
  `IDLluvia` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Arduino_IDArduino` varchar(1) NOT NULL,
  PRIMARY KEY (`IDLluvia`,`Arduino_IDArduino`),
  KEY `fk_Lluvia_Arduino1_idx` (`Arduino_IDArduino`),
  CONSTRAINT `fk_Lluvia_Arduino1` FOREIGN KEY (`Arduino_IDArduino`) REFERENCES `arduino` (`IDArduino`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lluvia`
--

LOCK TABLES `lluvia` WRITE;
/*!40000 ALTER TABLE `lluvia` DISABLE KEYS */;
/*!40000 ALTER TABLE `lluvia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programacion`
--

DROP TABLE IF EXISTS `programacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programacion` (
  `IDProg` int(11) NOT NULL,
  `Hora_ini` varchar(5) NOT NULL,
  `Hora_fin` varchar(5) NOT NULL,
  PRIMARY KEY (`IDProg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programacion`
--

LOCK TABLES `programacion` WRITE;
/*!40000 ALTER TABLE `programacion` DISABLE KEYS */;
INSERT INTO `programacion` VALUES (1,'00:00','00:00'),(2,'00:00','00:00'),(3,'00:00','00:00'),(4,'00:00','00:00');
/*!40000 ALTER TABLE `programacion` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-01 18:19:14
