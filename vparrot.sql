-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: vparrot
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `avis`
--

DROP TABLE IF EXISTS `avis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avis` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `commentaire` varchar(500) NOT NULL,
  `note` int NOT NULL,
  `valide` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F91ABF0A76ED395` (`user_id`),
  CONSTRAINT `FK_8F91ABF0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avis`
--

LOCK TABLES `avis` WRITE;
/*!40000 ALTER TABLE `avis` DISABLE KEYS */;
INSERT INTO `avis` VALUES (1,'LORD',2,'Sarah','Réparations effectuées dans les délais prévus, rendu très satisfaisant, relation clientèle très agréable.',5,1),(2,'ROCHE',2,'Gilles','Super gentil, travaille bien et dans les temps.',5,1),(3,'FAURE',2,'Aurianne','Vraiment top je conseille ce garage a tous. De bons conseils et pas de mauvaise surprise.',5,1),(35,'visiteur',NULL,'visiteur','visiteur',5,0);
/*!40000 ALTER TABLE `avis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `message` varchar(400) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C62E638A76ED395` (`user_id`),
  CONSTRAINT `FK_4C62E638A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (7,2,'DEV','Serap','sib@mail.com','0148474010','test'),(10,NULL,'DEV','Serr','email@mail.com','0148474010','test');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employes`
--

DROP TABLE IF EXISTS `employes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employes` (
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employes`
--

LOCK TABLES `employes` WRITE;
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horaires`
--

DROP TABLE IF EXISTS `horaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `jour` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `debut_matin` time DEFAULT NULL,
  `fin_matin` time DEFAULT NULL,
  `debut_apres_midi` time DEFAULT NULL,
  `fin_apres_midi` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_39B7118FA76ED395` (`user_id`),
  CONSTRAINT `FK_39B7118FA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horaires`
--

LOCK TABLES `horaires` WRITE;
/*!40000 ALTER TABLE `horaires` DISABLE KEYS */;
INSERT INTO `horaires` VALUES (1,2,'Lundi','08:45:00','12:00:00','14:00:00','18:00:00'),(2,2,'Mardi','08:45:00','12:00:00','14:00:00','18:00:00'),(21,2,'Mercredi','08:45:00','12:00:00','14:00:00','18:00:00'),(22,2,'Jeudi','08:45:00','12:00:00','14:00:00','18:00:00'),(23,2,'Vendredi','08:45:00','12:00:00','14:00:00','18:00:00'),(24,2,'Samedi','08:45:00','12:00:00','14:00:00','18:00:00'),(25,2,'Dimanche',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `horaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `roles` json NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'[\"ROLE_ADMIN\"]','PARROT','Vincent','vparrot@mail.com','$2y$13$Mzvq1mRGmEzbmZ878YbxeuVryuH2XxAoMkaobxC8gtWwpezdzaGWi','admin.jpg'),(2,'[\"ROLE_USER\"]','MARTIN','Louise','martin@mail.com','$2y$13$MdfJLHkK89sWo1MVO6xXfu5WfbrmXE.FQCxs5PVcSVjAagFz2Pe0y','1.jpeg'),(3,'[\"ROLE_USER\"]','PETIT','Leo','petit@mail.com','$2y$13$JpGLWpvItSyKbgzTSct6muzfTT1dYiCNZh2.V1UocnhubX94Y9F8y','2.webp'),(4,'[\"ROLE_USER\"]','DUBOIS','Alice','dubois@mail.com','$2y$13$YWFY4UsLaRiK8/X0shI2nO2j3jJR/RWVKvq1iVDIurWdbW9wd8Vue','2.jpg'),(5,'[\"ROLE_USER\"]','BERNARD','Gabriel','bernard@mail.com','$2y$13$SbjlsRoSjm6SaV9IMVZ.o.Z/i5xshvp.ZkHUBr2KUKe0gvBzjY6bu','3.jpg'),(6,'[\"ROLE_USER\"]','LEROY','Lina','leroy@mail.com','$2y$13$lBeY.7TDlVppMEoJ6yR29.UbnCzmswxnUjeu2ruABEIBThLLpfXVe','1.jpg'),(7,'[\"ROLE_USER\"]','SIMON','Oscar','simon@mail.com','$2y$13$bUBLfsx3flZ6MATGv5i34eaCPuIw7s5huSWuqrTaBnssCnpgFtyRi','4.jpg'),(8,'[\"ROLE_USER\"]','MICHEL','Rose','michel@mail.com','$2y$13$01l52vbdpxUhDDSg/9PSUuL1ImjVhr0S7cldTibWeYH/yr3yxHrGu','7.jpg'),(9,'[\"ROLE_USER\"]','PRUVOT','Cedric','pruvot@mail.com','$2y$13$Xlid37NM3bRTr7lFARGkMupp9fdNze4EMtaT.QX8iGtylsfdg29hO','5.jpg'),(10,'[\"ROLE_USER\"]','PRAGNOT','Sylvie','pragnot@mail.com','$2y$13$bz.up2gnkXubjt40hlu8UOQDEvDM8FYA8GMGY2wldoqcMwyyoa9SC','8.jpg'),(11,'[\"ROLE_USER\"]','PARIS','François',' paris@mail.com','$2y$13$DQGDLaureL6P00hMte6tJ.EaiOG1rDiEuSQINtS3NS478w28gZPh6','6.jpg'),(12,'[\"ROLE_USER\"]','SIGLY','Eliane','sigly@mail.com','$2y$13$S7TfkVvJN3EyWDg.n6haGOw6B.CcLWm.rTmdp7hk2.c7iH9WeGhyu','9.jpg'),(13,'[\"ROLE_USER\"]','PRESSE','Fabrice','presse@mail.com','$2y$13$wx5sSes2tXm1iD6pDmU92uFL/cmR0dEqtm98GfoRtLXgvlZViLEQG','11.jpg'),(14,'[\"ROLE_USER\"]','MOREL','Chloé','morel@mail.com','$2y$13$Ox1Va5l9AXxkZYUj5a0qCu42epLVHn3Mt.qwPH58hLbVXCMKiGBq6','10.jpg'),(15,'[\"ROLE_USER\"]','PY','Sylvain','py@mail.com','$2y$13$Xe8PoKwV.lvduDh0e8L2J.haj2sVmU8T.1wxKHDcGXnh/RoDLNxSq','12.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voitures`
--

DROP TABLE IF EXISTS `voitures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `voitures` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `marque` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `model` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `annee` int NOT NULL,
  `km` int NOT NULL,
  `energie` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `vitesse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `prix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `car1` varchar(255) DEFAULT NULL,
  `car2` varchar(255) DEFAULT NULL,
  `car3` varchar(255) DEFAULT NULL,
  `car4` varchar(255) DEFAULT NULL,
  `car5` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8B58301BA76ED395` (`user_id`),
  CONSTRAINT `FK_8B58301BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voitures`
--

LOCK TABLES `voitures` WRITE;
/*!40000 ALTER TABLE `voitures` DISABLE KEYS */;
INSERT INTO `voitures` VALUES (1,1,'FERRARI','F1',2023,15000,'Electrique','Automatique','ferrari1.avif','350 000','ferrari4.jpg','ferrari3.jpg','ferrari2.avif','ferrari6.webp','ferrari5.jpg'),(2,1,'ASTON MARTIN','DBS',2023,12300,'Electrique','Automatique','aston-martin.jpg','199 000','6-Aston-martin-DBS3.jpg','2-Aston-martin-DBS2.jpg','3-Aston-martin-DBS4.jpg','5-Aston-martin-DBS7.jpg','3-aston_martin_v8_vantage_1_aml_.jpg'),(3,1,'TESLA','S',2023,18000,'Electrique\r\n','Automatique\r\n','tesla1.jpg','255 000','tesla2.jpg','tesla3.jpg','tesla4.jpg','tesla5.jpg','tesla1.jpg'),(4,1,'AUDI','R8',2022,9000,'Essence\r\n','Manuelle\r\n','4-audi4.jpg','149 000','4-audi4.jpg','4-audi-r8-by-vf-engineering.webp','4-audi-r8-by-vf-engineering2.jpg','4-audi-r8-by-vf-engineering-3.jpg','4-audi-r8-by-vf-engineering5.jpg'),(5,1,'TOYOTA','GR86\r\n',2020,42000,'Diesel','Automatique\r\n','5-2023-toyota-gr86-uk-spec.webp','120 900','5-2023-toyota-gr86-uk-spec.webp','5-2023-toyota-gr86-uk-spec-1.jpg','5-2023-toyota-gr86-uk-spec-2.jpg','5-2023-toyota-gr86-uk-spec-3.jpg','5-2023-toyota-gr86-uk-spec-4.jpg'),(6,1,'DS7\r\n','Crossback\r\n',2015,34200,'Diesel','Manuelle\r\n','6-yeni-ds-7-turkiye-de.webp','54 000','6-yeni-ds-7-turkiye-de.webp','6-yeni-ds-7-turkiye-de-2.jpg','6-yeni-ds-7-turkiye-de-3.jpg','6-yeni-ds-7-turkiye-de-4.jpg','6-yeni-ds-7-turkiye-de-5.jpg'),(7,1,'TOGG','V10',2022,3500,'Electrique','Automatique','7-togg2.webp','250 000','1togg6.jpg','1togg3.webp','1Togg_T10X.jpg','1TOGG5(1).jpg','1TOGG7(1).jpg'),(8,1,'PORCHE','CAYMAN',2022,23200,'Diesel\r\n','Manuelle','8-porsche-718-cayman--3.jpg','115 000','8-porsche-718-cayman.jpg\r\n','8-porsche-718-cayman-5.jpg','8-porsche-718-cayman-bleu-2.jpg','8-modele--porsche-718-cayman.jpg','8-porsche-718-cayman-4.jpg'),(9,1,'RANGE ROVER','EVOQUE',2021,25680,'Diesel   \r\n','Manuelle\r\n','9-range-rover-evoque-2023-bleu-avd-mk_11.jpg','85 390','9-range-rover1.jpg','9-range-rover-evoque-2023-bleu-d.jpg','9-range-rover-evoque-2023-pdb-mk.jpg','9-range-rover-evoque-2021-pdb-mk.jpg','9-range-rover-evoque-2023-bleu-a.jpg'),(10,1,'JAGUAR','PEACE',2020,5600,'Diesel\r\n','Automatique\r\n','10-jaguar-f-pace-svr-2019-06.jpg','265 000','10-jaguar-f-pace-svr-2019-01.jpg','10-jaguar-f-pace-svr-2019-02.jpg','10-jaguar-f-pace-svr-2019-05.jpg','10-jaguar-f-pace-svr-2019-03.jpg','10-jaguar-f-pace-svr-2019-13.jpg'),(11,1,'MASERATI','GHIBLI\r\n',2021,15000,'Essence','Automatique\r\n','10-MaseratiGhibli3.webp','145 900','10-MaseratiGhibli4.webp','10-MaseratiGhibli3.webp','10-MaseratiGhibli2.webp','10-Maserati Ghibli.webp','10-MaseratiGhibli4.webp'),(12,1,'BENTLEY\r\n','CONTINENTAL\r\n',2018,22300,'Essence','Automatique\r\n','11-bentley-continental-gt-w12-2018-01_1.jpg','32 540','11-bentley-continental-gt-w1.jpg','11-bentley-continental-gt-w2.jpg','11-bentley-continental-gt-w12-20 (8).jpg','11-bentley-continental-gt-w2.jpg\r\n','11-bentley-continental-gt-w3.jpg'),(13,1,'PEUGEOT 308','Render',2021,25345,'Essence','Automatique','1-peugeot-308.webp','18 970','1-peugeot-308-2021.jpg','1-peugeot-308-2021-2.jpg','1-peugeot-308-2021-3.jpg','1-peugeot-308-2021-4.jpg','1-peugeot-308-2021-5.jpg'),(14,1,'MERCEDES','CLASSE E',2016,41200,'Diesel','Manuelle','2-mercedes-classe-e-all-terrain-2023.jpg','28 490','2-mercedes-classe-e-all-terrain-2023.jpg','2-mercedes-classe-e-all-terrain-2023-2.jpg','2-mercedes-classe-e-all-terrain-2023-3.jpg','2-mercedes-classe-e-all-terrain-2023-4.jpg','2-mercedes-classe-e-all-terrain-2023-5.jpg'),(15,1,'BMW X5 ','PROTECTION',2017,87900,'Diesel   \r\n','Automatique\r\n','3-bmw-x5-protection-vr6.webp','51 900','3-bmw-x5-protection-vr6-3.jpg','3-bmw-x5-protection-vr6-2.jpg','3-bmw-x5-protection-vr6-4.jpg','3-bmw-x5-protection-vr6-5.jpg','3-bmw-x5-protection-vr6-6.jpg'),(28,2,'test','test',1980,200,'Diesel','Automatique',NULL,'200',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `voitures` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-17 19:33:13
