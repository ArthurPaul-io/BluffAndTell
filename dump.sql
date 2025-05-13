-- MariaDB dump 10.19  Distrib 10.11.6-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: BluffAndTell
-- ------------------------------------------------------
-- Server version	10.11.6-MariaDB-0+deb12u1

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
-- Table structure for table `appartenir`
--

DROP TABLE IF EXISTS `appartenir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appartenir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `game_id` int(11) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `ready` tinyint(1) DEFAULT NULL,
  `point_joueur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A2A0D90CA76ED395` (`user_id`),
  KEY `IDX_A2A0D90CE48FD905` (`game_id`),
  CONSTRAINT `FK_A2A0D90CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_A2A0D90CE48FD905` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appartenir`
--

LOCK TABLES `appartenir` WRITE;
/*!40000 ALTER TABLE `appartenir` DISABLE KEYS */;
INSERT INTO `appartenir` VALUES
(338,15,138,'Bluffeur',1,NULL),
(339,1,139,'Bluffeur',1,NULL);
/*!40000 ALTER TABLE `appartenir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lutilisateur_id` int(11) NOT NULL,
  `contenu` varchar(255) NOT NULL,
  `senddate` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_659DF2AAFA2B7768` (`lutilisateur_id`),
  CONSTRAINT `FK_659DF2AAFA2B7768` FOREIGN KEY (`lutilisateur_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES
('DoctrineMigrations\\Version20241113121130','2024-11-13 12:15:33',417),
('DoctrineMigrations\\Version20241217142925','2024-12-17 14:29:56',195),
('DoctrineMigrations\\Version20250303140840','2025-03-03 14:26:58',77),
('DoctrineMigrations\\Version20250304132149','2025-03-04 13:22:59',166),
('DoctrineMigrations\\Version20250318132052','2025-03-18 13:21:53',92),
('DoctrineMigrations\\Version20250324163033','2025-03-24 16:44:20',95),
('DoctrineMigrations\\Version20250324164545','2025-03-24 16:45:49',46),
('DoctrineMigrations\\Version20250325092050','2025-03-25 09:20:57',155),
('DoctrineMigrations\\Version20250325103500','2025-03-25 10:35:08',22),
('DoctrineMigrations\\Version20250325132345','2025-03-25 13:23:50',108),
('DoctrineMigrations\\Version20250331102704','2025-03-31 10:27:16',94),
('DoctrineMigrations\\Version20250331130733','2025-03-31 13:07:44',129),
('DoctrineMigrations\\Version20250422075854','2025-04-22 08:00:06',96),
('DoctrineMigrations\\Version20250430144403','2025-04-30 14:44:16',88),
('DoctrineMigrations\\Version20250505075922','2025-05-05 07:59:28',140);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ecrire`
--

DROP TABLE IF EXISTS `ecrire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ecrire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` longtext DEFAULT NULL,
  `bluffoutell` tinyint(1) DEFAULT NULL,
  `id_round_id` int(11) NOT NULL,
  `ecrivain_id` int(11) DEFAULT NULL,
  `nb_point` int(11) DEFAULT NULL,
  `roundready` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_918824CCF6DBB035` (`id_round_id`),
  KEY `IDX_918824CCFBEED4E6` (`ecrivain_id`),
  CONSTRAINT `FK_918824CCF6DBB035` FOREIGN KEY (`id_round_id`) REFERENCES `rounds` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_918824CCFBEED4E6` FOREIGN KEY (`ecrivain_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ecrire`
--

LOCK TABLES `ecrire` WRITE;
/*!40000 ALTER TABLE `ecrire` DISABLE KEYS */;
INSERT INTO `ecrire` VALUES
(122,NULL,NULL,1262,15,NULL,0),
(123,'gtgtg',1,1263,1,NULL,1),
(124,NULL,NULL,1263,1,NULL,0);
/*!40000 ALTER TABLE `ecrire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `round_count` int(11) NOT NULL,
  `game_statut` varchar(255) NOT NULL,
  `created_by_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FF232B31B03A8386` (`created_by_id`),
  CONSTRAINT `FK_FF232B31B03A8386` FOREIGN KEY (`created_by_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

LOCK TABLES `games` WRITE;
/*!40000 ALTER TABLE `games` DISABLE KEYS */;
INSERT INTO `games` VALUES
(138,1,'started',15),
(139,1,'started',1);
/*!40000 ALTER TABLE `games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rounds`
--

DROP TABLE IF EXISTS `rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letheme_id` int(11) NOT NULL,
  `lapartie_id` int(11) DEFAULT NULL,
  `rounds_number` int(11) NOT NULL,
  `finished` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3A7FD554285E38D` (`letheme_id`),
  KEY `IDX_3A7FD5549103957` (`lapartie_id`),
  CONSTRAINT `FK_3A7FD554285E38D` FOREIGN KEY (`letheme_id`) REFERENCES `theme` (`id`),
  CONSTRAINT `FK_3A7FD5549103957` FOREIGN KEY (`lapartie_id`) REFERENCES `games` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1264 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rounds`
--

LOCK TABLES `rounds` WRITE;
/*!40000 ALTER TABLE `rounds` DISABLE KEYS */;
INSERT INTO `rounds` VALUES
(1262,29,138,1,0),
(1263,29,139,1,0);
/*!40000 ALTER TABLE `rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `theme`
--

DROP TABLE IF EXISTS `theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `createur_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9775E70873A201E5` (`createur_id`),
  CONSTRAINT `FK_9775E70873A201E5` FOREIGN KEY (`createur_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `theme`
--

LOCK TABLES `theme` WRITE;
/*!40000 ALTER TABLE `theme` DISABLE KEYS */;
INSERT INTO `theme` VALUES
(22,1,'Parc'),
(23,1,'Soirées'),
(24,1,'École'),
(26,1,'Animaux'),
(27,1,'Alcool'),
(28,1,'Musique'),
(29,1,'Famille'),
(30,1,'Aéroport'),
(31,1,'Amour'),
(32,1,'Amitié'),
(33,1,'Danger'),
(34,1,'Moment gênant'),
(35,1,'Transports');
/*!40000 ALTER TABLE `theme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `createdaccount` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES
(1,'arthur.pannozzo@gmail.com','[]','$2y$13$Hr0W771BBNJeLFzdsQlaW.BF1KgPjszn56IPTxQFgJ/Vnpu5tD6P2','Arthur',NULL),
(2,'arthur25.pannozzo@gmail.com','[]','$2y$13$woRI1FtnhRsEjycre/XU/OeOC/jPpkjE4P/UT5j7feFuTe1PP3sa.',NULL,NULL),
(3,'HFAZ@mail.com','[]','$2y$13$kH8IKlRchkh9otALhxbdYOBQmU2Zz9hhYReIbYCoraIqfqlDADDkC',NULL,NULL),
(4,'tgrgji@gmail.com','[]','$2y$13$627pXf0iL86PWlU351Gy5.v3yEclba63TOzlSnKKJYqIhEj.j/01u',NULL,NULL),
(5,'arthur.pannozfrfrfrzo@gmail.com','[]','$2y$13$L.2Ar0RUgtPq3Hyc0nkQLOvxGgncbwPKQVlg7qQstnmJXNdC/ZE5y',NULL,NULL),
(6,'zgrzuighrofihuz','[]','$2y$13$SjaM4Wr.yT9W2sNAVQcCa.Hsfy53BM/EFeXphDOntDurWYPbnzdQO',NULL,NULL),
(7,'<strong>Test</strong>@gmail.com','[]','$2y$13$7AHvYSmtCRoC6L5NKmDnY.xup5aT1U68jlTrQov.VRzbrioS0nK42',NULL,NULL),
(8,'zuizi@gmail.com','[]','$2y$13$hAUrb0j0HB1YdDNLdZHvt.yLd95JM9Sio5q8UlT6MvPB6PKuPexri',NULL,NULL),
(9,'azeaeazeaze@gmail.com','[]','$2y$13$g8gL68ceLdpEuBTMwddsguDvp8iBf0Sa8g/Lh3sNpacaoJcqtx/P.','arthur',NULL),
(10,'arthur.pannoozzo@gmail.com','[]','$2y$13$skdmncyx9M9YosPlthFh/O5pzgryO1t755ICkK2A1KpUULeFcw1Na',NULL,NULL),
(11,'arthur.paaaannozzo@gmail.com','[]','$2y$13$9VFRvDom5k68QBupbarW4O8Hj9PRTXR1XnsYcXpu0azBkJtuzvSNS',NULL,NULL),
(12,'haroun@negro@gmail.com','[]','$2y$13$6v25P0X5BpQ01NriFgX8t.OptHQLlOJYlEnPYBC13JkYTYU505oKi',NULL,NULL),
(13,'haroun@gmail.com','[]','$2y$13$D2HI1mPVE5RCL9dAp/ppwuBNSI4qnvAQwcxMHOysEgLxvdtu6i2iW',NULL,NULL),
(14,'zizi@gmail.com','[]','$2y$13$QeJQgTwbrzhi8YmOoqLyju33aNejoYOSLsZE9OmRUwEQLlpJvFKze',NULL,NULL),
(15,'noah@gmgmgmg.com','[]','$2y$13$UdbGn75E335HKin8Wulgt.FSXrDAHApAHRghkskRq5Z6aZ2OC3dVW','Killian',NULL),
(16,'vraiadressemail@gmail.com','[]','$2y$13$nXh9bFZYO9aDEUE4xEbR2eDGLdIa0pc9zAjn1Eo2Mvqyrz3GHgS2u',NULL,NULL),
(17,'Azerty@gmail.com','[]','$2y$13$tQvipwzIWeVKJ6Ty/KTTlOSpzNd4urExJQYDhtiUf4mnMIq58rbte','Killiann',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-07 16:47:06
