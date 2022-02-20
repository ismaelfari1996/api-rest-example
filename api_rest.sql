CREATE DATABASE  IF NOT EXISTS `api_rest` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `api_rest`;
-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: api_rest
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

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
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order` (
  `idorder` int NOT NULL AUTO_INCREMENT,
  `codproduct` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`idorder`),
  KEY `fk` (`codproduct`),
  CONSTRAINT `fk` FOREIGN KEY (`codproduct`) REFERENCES `products` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `cod` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `product` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES ('h001','oil',10,10.34),('h002','banana',20,2.34),('h003','rice',49,1.34),('h004','tuna',30,1.54),('h005','sardine',40,2.34),('h006','toothpaste',10,10.34),('h011','test',20,1.45),('h012','test',20,1.45),('h013','test',20,1.45),('h014','test',20,1.45),('h020','Prueba',12,0.12),('h021','Prueba',12,0.12),('h022','Prueba',12,0.12);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `user` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ismael','1234',''),(8,'admin','21232f297a57a5a743894a0e4a801fc3','active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_token`
--

DROP TABLE IF EXISTS `users_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_token` (
  `tokenid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `token` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `status` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`tokenid`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_token`
--

LOCK TABLES `users_token` WRITE;
/*!40000 ALTER TABLE `users_token` DISABLE KEYS */;
INSERT INTO `users_token` VALUES (22,8,'b0f90bbd1092328f2075b521f62d752f','active','2022-01-25');
/*!40000 ALTER TABLE `users_token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-20 17:41:56
