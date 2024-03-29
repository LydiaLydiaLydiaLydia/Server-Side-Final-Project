-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: FerrySYS
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departures`
--

LOCK TABLES `departures` WRITE;
/*!40000 ALTER TABLE `departures` DISABLE KEYS */;
INSERT INTO `departures` VALUES (1,'09:00:00','09:30:00','M',30,'A','2024-02-04'),(2,'09:40:00','10:10:00','I',30,'A','2024-02-04'),(3,'10:20:00','10:50:00','M',30,'A','2024-02-04'),(4,'11:00:00','11:30:00','I',30,'A','2024-02-04'),(5,'11:40:00','12:10:00','M',30,'A','2024-02-04'),(6,'12:20:00','12:50:00','I',30,'A','2024-02-04'),(7,'14:00:00','14:30:00','M',30,'A','2024-02-04'),(8,'14:40:00','15:10:00','I',30,'A','2024-02-04'),(9,'15:20:00','15:50:00','M',30,'A','2024-02-04'),(10,'16:00:00','16:30:00','I',30,'A','2024-02-04'),(11,'16:40:00','17:10:00','M',30,'A','2024-02-04'),(12,'17:20:00','17:50:00','I',30,'A','2024-02-04');
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
INSERT INTO `vehicletypes` VALUES ('CH','Coach',12.00,3,'A'),('CR','Car',70.00,1,'A'),('LR','Lorry',95.00,3,'A'),('VN','Van',75.50,1,'A');
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

-- Dump completed on 2024-02-22 14:52:41
