-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: txotx
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.12.04.1

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
-- Table structure for table `erabiltzaileak`
--

DROP TABLE IF EXISTS `erabiltzaileak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `erabiltzaileak` (
  `iderabiltzaileak` int(11) NOT NULL AUTO_INCREMENT,
  `erabiltzailea` varchar(45) DEFAULT NULL,
  `pasahitza` varchar(45) DEFAULT NULL,
  `izena` varchar(45) DEFAULT NULL,
  `abizena` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`iderabiltzaileak`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erabiltzaileak`
--

LOCK TABLES `erabiltzaileak` WRITE;
/*!40000 ALTER TABLE `erabiltzaileak` DISABLE KEYS */;
INSERT INTO `erabiltzaileak` VALUES (1,'etx_aritz','aritz','Aritz','Etxegia','etx_aritz@gmail.com'),(2,'7rufo7','ruben','Ruben','Aparicio','7rufo7@gmail.com'),(3,'jimtxo','alvaro','Alvaro','Jimenez','jimtxo@gmail.com');
/*!40000 ALTER TABLE `erabiltzaileak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `herriak`
--

DROP TABLE IF EXISTS `herriak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `herriak` (
  `idherriak` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(45) DEFAULT NULL,
  `sagardotegi_kop` varchar(45) DEFAULT NULL,
  `probintzia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idherriak`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herriak`
--

LOCK TABLES `herriak` WRITE;
/*!40000 ALTER TABLE `herriak` DISABLE KEYS */;
INSERT INTO `herriak` VALUES (1,'Abaltzisketa','3','1'),(2,'Aduna','4','1'),(3,'Aia','4','1'),(4,'Aizarnazabal','1','1'),(5,'Alegia','1','1'),(6,'Altzaga','1','1'),(7,'Amezketa','2','1'),(8,'Andoain','3','1'),(9,'Anoeta','1','1'),(10,'Asteasu','2','1'),(11,'Astigarraga','25','1'),(12,'Ataun','1','1'),(13,'Azpeitia','3','1'),(14,'Beasain','2','1'),(15,'Deba','2','1'),(16,'Donostia','19','1'),(17,'Eibar','1','1'),(18,'Errenteria','3','1'),(19,'Gabiria','1','1'),(20,'Gaintza','1','1'),(21,'Hernani','14','1'),(22,'Hondarribia','4','1'),(23,'Ikaztegieta','1','1'),(24,'Irun','2','1'),(25,'Irura','1','1'),(26,'Lasarte','2','1'),(27,'Lazkao','1','1'),(28,'Leaburu','1','1'),(29,'Legorreta','1','1'),(30,'Lezo','2','1'),(31,'Lizartza','1','1'),(32,'Oiartzun','8','1'),(33,'Olaberria','1','1'),(34,'Ordizia','1','1'),(35,'Orio','2','1'),(36,'Tolosa','6','1'),(37,'Urnieta','11','1'),(38,'Usurbil','8','1'),(39,'Zarautz','1','1'),(40,'Zerain','2','1'),(41,'Zizurkil','2','1'),(42,'Zubieta','2','1'),(43,'Zumaia','1','1'),(44,'Zumarraga','1','1'),(45,'Abadino','1','2'),(46,'Amorebieta-Etxano','2','2'),(47,'Arrigorriaga','1','2'),(48,'Barakaldo','1','2'),(49,'Barrika','1','2'),(50,'Berriatua','2','2'),(51,'Bilbao','11','2'),(52,'Derio','1','2'),(53,'Aoiz','1','3'),(54,'Arbizu','1','3'),(55,'Barañain','3','3'),(56,'Basaburua','2','3'),(57,'Baztan-Lekaroz','1','3'),(58,'Amurrio','1','4'),(59,'Aramaio','1','4'),(60,'Ascain','1','5'),(61,'Baiona','1','5');
/*!40000 ALTER TABLE `herriak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `probintzia`
--

DROP TABLE IF EXISTS `probintzia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `probintzia` (
  `idprobintzia` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idprobintzia`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `probintzia`
--

LOCK TABLES `probintzia` WRITE;
/*!40000 ALTER TABLE `probintzia` DISABLE KEYS */;
INSERT INTO `probintzia` VALUES (1,'Gipuzkoa'),(2,'Bizkaia'),(3,'Nafarroa'),(4,'Araba'),(5,'Iparraldea');
/*!40000 ALTER TABLE `probintzia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sagardotegiak`
--

DROP TABLE IF EXISTS `sagardotegiak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sagardotegiak` (
  `idsagardotegiak` int(11) NOT NULL AUTO_INCREMENT,
  `izena` varchar(45) DEFAULT NULL,
  `herria` int(11) DEFAULT NULL,
  `deskribapena` varchar(100) DEFAULT NULL,
  `probintzia` int(11) DEFAULT NULL,
  `telefonoa` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `web` varchar(45) DEFAULT NULL,
  `balorazioa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsagardotegiak`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sagardotegiak`
--

LOCK TABLES `sagardotegiak` WRITE;
/*!40000 ALTER TABLE `sagardotegiak` DISABLE KEYS */;
INSERT INTO `sagardotegiak` VALUES (1,'Baleio',32,'Aran eder bidea 16, 20180 Oiartzun',1,'943 49 13 40',NULL,NULL,NULL),(2,'Ordo-zelai',32,'Ordo-zelai bidea 3, Ergoien auzoa. 20180 Oiartzun',1,'943 49 16 86',NULL,NULL,NULL),(3,'Zalbide',1,'Zalbide baserria, 20269 Abaltzisketa',1,'943 65 21 76',NULL,NULL,NULL),(4,'Zabala',2,'Goiburu auzoa 5, 20150 Aduna',1,'943 69 07 74','info@rzabala.com','http://www.rzabala.com/',NULL),(5,'Aburuza',2,'Goiburu auzoa 8, 20150 Aduna',1,'943 69 24 52','aburuza@sidrasaburuza.net','http://www.sidrasaburuza.net',NULL),(6,'Beleku',1,'Larraitz auzoa, z/g, 20269 Abaltzisketa',1,'943 65 30 68',NULL,NULL,NULL),(7,'Ñañarri',1,'Larraitz auzoa 5, 20269 Abaltzisketa',1,'943 65 40 05',NULL,NULL,NULL),(8,'Uparan',2,'Uparan industrialdea 4, 20150	Aduna',1,'943 69 12 53',NULL,NULL,NULL),(9,'Urritza',2,'Urtaki industrialdea, z/g, 20150 Aduna',1,'943 69 33 96',NULL,NULL,NULL),(10,'Errota-Etxea',3,'Diseminado Laurgain 16, 20809 Aia',1,'943 89 01 25',NULL,NULL,NULL),(11,'Izeta',3,'Elkano auzoa 4, 20809 Aia',1,'943 13 16 93',NULL,NULL,NULL),(12,'Satxota',3,'Santio erreka auzoa 3, 20809 Aia',1,'943 83 57 38',NULL,'http://www.sidreriasatxota.com',NULL),(13,'Zingira',3,'Ubegun auzoa, 20809 Aia',1,'943 13 20 79',NULL,NULL,NULL),(14,'Uztarri',4,'Herriko plaza 3, 20749 Aizarnazabal',1,'943 14 83 21',NULL,NULL,NULL),(15,'Txintxarri',5,'Amezketako bide-gurutzearen parean, 20260 Alegia',1,'943 65 07 21',NULL,NULL,NULL),(16,'Olagi',6,'Altzaga bidea 1, 20248 Altzaga',1,'943 88 77 26',NULL,'',NULL),(17,'Garmendia',7,'Josean Tolosa 3, Ugarte auzoa, 20268 Amezketa',1,'943 65 10 99',NULL,NULL,NULL),(18,'Larreta',7,'Laturu Etxea, 20268 Amezketa',1,'943 65 21 27',NULL,NULL,NULL),(19,'Gaztañaga',8,'Buruntza auzoa, 20140 Andoain',1,'943 59 19 68','info@sidreriagaztanaga.com ','http://www.sidreriagaztanaga.com',NULL),(20,'Mizpiradi',8,'Leizotz auzoa 14, 20140 Andoain',1,'943 59 39 54','mizpiradisagardotegia@gmail.com','http://www.mizpiradisagardotegia.com',NULL),(21,'Txertota',8,'San Esteban auzoa z/g, 20140 Andoain',1,'943 59 07 21',NULL,'http://www.txertota.com',NULL),(22,'Benta-Aldea',9,'Benta Aldea Industrialdea, 20270 Anoeta',1,'943 65 40 79',NULL,NULL,NULL),(23,'Martxeta-Haundi',10,'Asteasu auzoa, 20159 Asteasu',1,'943 69 22 22',NULL,NULL,NULL),(24,'Sarasola',10,'Beballara, z/g, 20159 Asteasu',1,'943 69 02 83',NULL,NULL,NULL),(25,'Akelenea',11,'Oialume bidea 57, 20115 Astigarraga',1,'943 33 33 33','info@sidreriaakelenea.com','http://www.sidreriaakelenea.com',NULL),(26,'Uxarte',46,'Montorra kalea 6, 48340 Amorebieta-Etxano',2,'946 30 88 15','uxarte@uxarte.com','http://www.uxarte.com',NULL),(27,'Ibarra',46,'Ibarra baserria-Ibarra auzoa s/n, 48340 Amorebieta',2,'946 731 100','info@ibarra-sagardotegi.com','http://www.ibarra-sagardotegi.com/',NULL),(28,'El Molino Errota',53,'Errota bidea z/g, 31430 Aoiz/Agoitz',3,'948 336 302',NULL,NULL,NULL),(29,'Iarritu',58,'Arrotegui auzoa 114, 01450 Amurrio',4,'945 38 61 31',NULL,NULL,NULL),(30,'Txopinondo',60,'Lan Zelai, 64122 Ascain',5,'+33 5 59 54 62 34','txopinondo@wanadoo.fr','http://www.txopinondo.com/',NULL);
/*!40000 ALTER TABLE `sagardotegiak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-27 11:43:18
