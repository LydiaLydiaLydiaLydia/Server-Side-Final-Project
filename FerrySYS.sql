-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: FerrySYS
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `departures`
--

DROP TABLE IF EXISTS `departures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departures` (
  `DepID` int(11) NOT NULL AUTO_INCREMENT,
  `DepTime` time NOT NULL,
  `ArrTime` time NOT NULL,
  `DepPort` char(1) DEFAULT NULL,
  `Capacity` tinyint(2) DEFAULT NULL,
  `DepStatus` enum('A','I') DEFAULT 'A',
  `Date` date NOT NULL,
  PRIMARY KEY (`DepID`),
  KEY `DepPort` (`DepPort`),
  CONSTRAINT `departures_ibfk_1` FOREIGN KEY (`DepPort`) REFERENCES `ports` (`PCode`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departures`
--

LOCK TABLES `departures` WRITE;
/*!40000 ALTER TABLE `departures` DISABLE KEYS */;
INSERT INTO `departures` VALUES (1,'09:00:00','09:30:00','M',30,'A','2024-04-29'),(2,'09:40:00','10:10:00','I',30,'A','2024-04-29'),(3,'10:20:00','10:50:00','M',30,'A','2024-04-29'),(4,'11:00:00','11:30:00','I',30,'A','2024-04-29'),(5,'11:40:00','12:10:00','M',30,'A','2024-04-29'),(6,'12:20:00','12:50:00','I',30,'A','2024-04-29'),(7,'14:00:00','14:30:00','M',30,'A','2024-04-29'),(8,'14:40:00','15:10:00','I',30,'A','2024-04-29'),(9,'15:20:00','15:50:00','M',30,'A','2024-04-29'),(10,'16:00:00','16:30:00','I',30,'A','2024-04-29'),(11,'16:40:00','17:10:00','M',30,'A','2024-04-29'),(12,'17:20:00','17:50:00','I',30,'A','2024-04-29'),(13,'09:00:00','09:30:00','M',30,'A','2024-04-30'),(14,'09:40:00','10:10:00','I',30,'A','2024-04-30'),(15,'10:20:00','10:50:00','M',30,'A','2024-04-30'),(16,'11:00:00','11:30:00','I',30,'A','2024-04-30'),(17,'11:40:00','12:10:00','M',30,'A','2024-04-30'),(18,'12:20:00','12:50:00','I',30,'A','2024-04-30'),(19,'14:00:00','14:30:00','M',30,'A','2024-04-30'),(20,'14:40:00','15:10:00','I',30,'A','2024-04-30'),(21,'15:20:00','15:50:00','M',30,'A','2024-04-30'),(22,'16:00:00','16:30:00','I',30,'A','2024-04-30'),(23,'16:40:00','17:10:00','M',30,'A','2024-04-30'),(24,'17:20:00','17:50:00','I',30,'A','2024-04-30'),(25,'09:00:00','09:30:00','M',30,'A','2024-05-01'),(26,'09:40:00','10:10:00','I',30,'A','2024-05-01'),(27,'10:20:00','10:50:00','M',30,'A','2024-05-01'),(28,'11:00:00','11:30:00','I',30,'A','2024-05-01'),(29,'11:40:00','12:10:00','M',30,'A','2024-05-01'),(30,'12:20:00','12:50:00','I',30,'A','2024-05-01'),(31,'14:00:00','14:30:00','M',30,'A','2024-05-01'),(32,'14:40:00','15:10:00','I',30,'A','2024-05-01'),(33,'15:20:00','15:50:00','M',30,'A','2024-05-01'),(34,'16:00:00','16:30:00','I',30,'A','2024-05-01'),(35,'16:40:00','17:10:00','M',30,'A','2024-05-01'),(36,'17:20:00','17:50:00','I',30,'A','2024-05-01'),(37,'09:00:00','09:30:00','M',30,'A','2024-05-02'),(38,'09:40:00','10:10:00','I',30,'A','2024-05-02'),(39,'10:20:00','10:50:00','M',30,'A','2024-05-02'),(40,'11:00:00','11:30:00','I',30,'A','2024-05-02'),(41,'11:40:00','12:10:00','M',30,'A','2024-05-02'),(42,'12:20:00','12:50:00','I',30,'A','2024-05-02'),(43,'14:00:00','14:30:00','M',30,'A','2024-05-02'),(44,'14:40:00','15:10:00','I',30,'A','2024-05-02'),(45,'15:20:00','15:50:00','M',30,'A','2024-05-02'),(46,'16:00:00','16:30:00','I',30,'A','2024-05-02'),(47,'16:40:00','17:10:00','M',30,'A','2024-05-02'),(48,'17:20:00','17:50:00','I',30,'A','2024-05-02'),(49,'09:00:00','09:30:00','M',30,'A','2024-05-03'),(50,'09:40:00','10:10:00','I',30,'A','2024-05-03'),(51,'10:20:00','10:50:00','M',30,'A','2024-05-03'),(52,'11:00:00','11:30:00','I',30,'A','2024-05-03'),(53,'11:40:00','12:10:00','M',30,'A','2024-05-03'),(54,'12:20:00','12:50:00','I',30,'A','2024-05-03'),(55,'14:00:00','14:30:00','M',30,'A','2024-05-03'),(56,'14:40:00','15:10:00','I',30,'A','2024-05-03'),(57,'15:20:00','15:50:00','M',30,'A','2024-05-03'),(58,'16:00:00','16:30:00','I',30,'A','2024-05-03'),(59,'16:40:00','17:10:00','M',30,'A','2024-05-03'),(60,'17:20:00','17:50:00','I',30,'A','2024-05-03'),(61,'09:00:00','09:30:00','M',30,'A','2024-05-04'),(62,'09:40:00','10:10:00','I',30,'A','2024-05-04'),(63,'10:20:00','10:50:00','M',30,'A','2024-05-04'),(64,'11:00:00','11:30:00','I',30,'A','2024-05-04'),(65,'11:40:00','12:10:00','M',30,'A','2024-05-04'),(66,'12:20:00','12:50:00','I',30,'A','2024-05-04'),(67,'14:00:00','14:30:00','M',30,'A','2024-05-04'),(68,'14:40:00','15:10:00','I',30,'A','2024-05-04'),(69,'15:20:00','15:50:00','M',30,'A','2024-05-04'),(70,'16:00:00','16:30:00','I',30,'A','2024-05-04'),(71,'16:40:00','17:10:00','M',30,'A','2024-05-04'),(72,'17:20:00','17:50:00','I',30,'A','2024-05-04'),(73,'09:00:00','09:30:00','M',30,'A','2024-05-05'),(74,'09:40:00','10:10:00','I',30,'A','2024-05-05'),(75,'10:20:00','10:50:00','M',30,'A','2024-05-05'),(76,'11:00:00','11:30:00','I',30,'A','2024-05-05'),(77,'11:40:00','12:10:00','M',30,'A','2024-05-05'),(78,'12:20:00','12:50:00','I',30,'A','2024-05-05'),(79,'14:00:00','14:30:00','M',30,'A','2024-05-05'),(80,'14:40:00','15:10:00','I',30,'A','2024-05-05'),(81,'15:20:00','15:50:00','M',30,'A','2024-05-05'),(82,'16:00:00','16:30:00','I',30,'A','2024-05-05'),(83,'16:40:00','17:10:00','M',30,'A','2024-05-05'),(84,'17:20:00','17:50:00','I',30,'A','2024-05-05');
/*!40000 ALTER TABLE `departures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ports`
--

DROP TABLE IF EXISTS `ports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ports` (
  `PCode` char(1) NOT NULL,
  `PName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`PCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ports`
--

LOCK TABLES `ports` WRITE;
/*!40000 ALTER TABLE `ports` DISABLE KEYS */;
INSERT INTO `ports` VALUES ('I','Island'),('M','Mainland');
/*!40000 ALTER TABLE `ports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tickets` (
  `TCode` int(11) NOT NULL AUTO_INCREMENT,
  `TDate` date NOT NULL,
  `TTime` time NOT NULL,
  `VCode` char(2) NOT NULL,
  `SalePrice` decimal(5,2) DEFAULT NULL,
  `DepID` int(11) NOT NULL,
  PRIMARY KEY (`TCode`),
  KEY `VCode` (`VCode`),
  KEY `DepID` (`DepID`),
  CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`VCode`) REFERENCES `vehicletypes` (`VCode`),
  CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`DepID`) REFERENCES `departures` (`DepID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicletypes`
--

DROP TABLE IF EXISTS `vehicletypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicletypes` (
  `VCode` char(2) NOT NULL,
  `VDescription` varchar(25) NOT NULL,
  `Price` decimal(5,2) DEFAULT NULL CHECK (`Price` >= 0.00),
  `Units` tinyint(4) NOT NULL,
  `VStatus` enum('A','U') NOT NULL,
  PRIMARY KEY (`VCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicletypes`
--

LOCK TABLES `vehicletypes` WRITE;
/*!40000 ALTER TABLE `vehicletypes` DISABLE KEYS */;
INSERT INTO `vehicletypes` VALUES ('CH','Coach',12.00,3,'A'),('CR','Car',70.00,1,'A'),('LR','Lorry',95.00,3,'A'),('VN','Van',75.50,2,'A');
/*!40000 ALTER TABLE `vehicletypes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-29 20:13:51
