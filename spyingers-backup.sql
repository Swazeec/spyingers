-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: spyingers
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creationDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Sile','Altham','saltham0@cloudflare.com','$2y$10$7q0J0LbnKWu6IkgDqfX3QOCh2gLaM0tjFYaTD/TFBCdsNDqYUgDE2','2021-04-24'),(2,'Christye','Paschke','cpaschke1@theglobeandmail.com','$2y$10$UMBXxDdjAP4mvQTxnR4q1urwEu4vVJrQ4KBQ370Q8gWl2zv8X.qki','2021-05-11'),(3,'Sollie','Hallstone','shallstone2@simplemachines.org','$2y$10$Yv/5cw0OiaVFFtDrDqpEJOpboxG5WgxgOReMTJs.ULI2r7S9TCg8e','2021-09-14'),(4,'Barnard','Spellard','bspellard3@fastcompany.com','$2y$10$32/BsAOXsJS9ctIU1ONhvO3oorPCss0Si5MrRZcTtDrK5ThnEEr8.','2021-07-31'),(5,'Vitoria','Abramovitch','vabramovitch4@psu.edu','$2y$10$W1wtFnpzW9yIPGKNiZX9dekKxM6S29MVy1SjzEem4UtPzBQVQfdDq','2021-07-11');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents`
--

DROP TABLE IF EXISTS `agents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcode` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `nationality_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nationality_id` (`nationality_id`),
  CONSTRAINT `agents_ibfk_1` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents`
--

LOCK TABLES `agents` WRITE;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
INSERT INTO `agents` VALUES (1,'8408373e-8fe8-11ec-a068-089798ca30ba','Louise','Attaque','1998-06-01',1),(2,'8408e050-8fe8-11ec-a068-089798ca30ba','Til','Lindermann','1999-01-12',2),(3,'84092c54-8fe8-11ec-a068-089798ca30ba','Tino','Roussi','1950-08-12',3),(4,'84096cba-8fe8-11ec-a068-089798ca30ba','Edouard','Khil','1934-09-04',4),(5,'8409b652-8fe8-11ec-a068-089798ca30ba','Xu','Yi','1980-02-12',5),(6,'840a0a7e-8fe8-11ec-a068-089798ca30ba','Dave','Grohl','1969-05-05',6),(7,'840a59fc-8fe8-11ec-a068-089798ca30ba','Ska','P','1978-04-10',8),(8,'840aa3e0-8fe8-11ec-a068-089798ca30ba','Frank','Turner','1981-07-19',9),(9,'840aeb44-8fe8-11ec-a068-089798ca30ba','Monsieur','Roux','1988-11-12',1),(10,'840b3240-8fe8-11ec-a068-089798ca30ba','Paul','Landers','1978-05-22',2),(11,'840b88b1-8fe8-11ec-a068-089798ca30ba','Paolo','Conte','1937-01-06',3),(12,'840bea2d-8fe8-11ec-a068-089798ca30ba','Devin','Townsend','1977-04-12',7),(13,'840c2e67-8fe8-11ec-a068-089798ca30ba','Ben','Lloyd','1981-10-12',9),(14,'840c8886-8fe8-11ec-a068-089798ca30ba','Jon','Snodgrass','1972-07-16',6),(15,'840cc85b-8fe8-11ec-a068-089798ca30ba','Tarrant','Anderson','1980-08-02',9),(16,'840d06b0-8fe8-11ec-a068-089798ca30ba','Gaëtan','Roussel','1972-05-19',1),(17,'840d457d-8fe8-11ec-a068-089798ca30ba','Zhao','Jing','2000-05-12',5),(18,'840d8acb-8fe8-11ec-a068-089798ca30ba','Oscar','Cea','1995-01-25',8),(19,'840dcacc-8fe8-11ec-a068-089798ca30ba','Robin','Feix','1975-11-20',1),(20,'840e350e-8fe8-11ec-a068-089798ca30ba','Matt','Smith','1982-10-28',9),(21,'840e7796-8fe8-11ec-a068-089798ca30ba','Barbara','Gourde','1991-09-28',1),(22,'999717d7-94c7-11ec-a6f7-089798ca30ba','Capitaine','Haddock','1998-06-01',3),(23,'e299c731-94ee-11ec-a6f7-089798ca30ba','Louis','Armstrong','1950-06-01',5),(24,'4bb7e744-95b5-11ec-a6f7-089798ca30ba','Chandler','Bing','1950-06-01',5),(27,'8e84f682-a05c-11ec-9fca-089798ca30ba','Toucâlin','Le Bisounours','2003-04-12',6);
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents_missions`
--

DROP TABLE IF EXISTS `agents_missions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agents_missions` (
  `agent_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  PRIMARY KEY (`agent_id`,`mission_id`),
  KEY `mission_id` (`mission_id`),
  CONSTRAINT `agents_missions_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`),
  CONSTRAINT `agents_missions_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents_missions`
--

LOCK TABLES `agents_missions` WRITE;
/*!40000 ALTER TABLE `agents_missions` DISABLE KEYS */;
INSERT INTO `agents_missions` VALUES (1,1),(1,8),(2,2),(3,3),(4,4),(5,5),(6,6),(6,24),(7,7),(7,24),(8,8),(8,39),(9,9),(10,10),(11,11),(12,12),(13,13),(14,14),(15,15),(16,16),(17,17),(18,18),(19,19),(20,20),(20,49),(21,1),(22,8),(23,39),(24,24);
/*!40000 ALTER TABLE `agents_missions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agents_specialities`
--

DROP TABLE IF EXISTS `agents_specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agents_specialities` (
  `agent_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  PRIMARY KEY (`agent_id`,`speciality_id`),
  KEY `speciality_id` (`speciality_id`),
  CONSTRAINT `agents_specialities_ibfk_1` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`),
  CONSTRAINT `agents_specialities_ibfk_2` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agents_specialities`
--

LOCK TABLES `agents_specialities` WRITE;
/*!40000 ALTER TABLE `agents_specialities` DISABLE KEYS */;
INSERT INTO `agents_specialities` VALUES (1,4),(1,5),(2,3),(2,6),(3,2),(3,6),(4,4),(5,6),(6,1),(7,6),(8,3),(9,4),(10,1),(10,4),(11,4),(12,4),(12,5),(13,6),(14,1),(15,4),(16,5),(17,6),(18,4),(19,1),(20,4),(20,5),(21,2),(22,1),(23,1),(23,2),(24,5),(27,1);
/*!40000 ALTER TABLE `agents_specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nationality_id` (`nationality_id`),
  CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'Liza','Emery','Agate',5),(2,'Bobby','Paulin','Amazonite',1),(3,'Rina','Sidney','Ambre',1),(4,'Davidde','Rishworth','Rubis',1),(5,'Ester','Bridge','Émeraude',6),(6,'Aidan','Shrimpling','Saphir',1),(7,'Loise','De Lorenzo','Diament',4),(8,'Germain','Oakenfull','Jade',7),(9,'Kaine','Kleinsmuntz','Lapis-Lazuli',8),(10,'Carolyne','Belasco','Obsidienne',4),(11,'Olivia','Elderton','Onyx',2),(12,'Maegan','Dabbs','Opale',5),(13,'Tybi','Hall','Pierre de Lune',8),(14,'Lexine','McSkeagan','Quartz rose',2),(15,'Dell','Shirrell','Zircon',2),(16,'Alfy','Wehden','Serpentine',3),(17,'Kienan','Allwood','Pyrite',3),(18,'Deny','Dagger','Oeil de Tigre',1),(19,'Noland','Buxsy','Jaspe rouge',4),(20,'Claudel','Vaggs','Iris',2),(21,'Eliot','Guion','Grenat',5),(22,'Roze','Braisby','Cristal',1),(23,'Jedd','Brisbane','Azurite',7),(24,'Vikki','Kalinsky','Malachite',2),(25,'Berny','Cecere','Améthyste',1),(27,'Les Trois','Fromages','Drôle\'n\'roll',1);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts_missions`
--

DROP TABLE IF EXISTS `contacts_missions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts_missions` (
  `contact_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  PRIMARY KEY (`contact_id`,`mission_id`),
  KEY `mission_id` (`mission_id`),
  CONSTRAINT `contacts_missions_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  CONSTRAINT `contacts_missions_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts_missions`
--

LOCK TABLES `contacts_missions` WRITE;
/*!40000 ALTER TABLE `contacts_missions` DISABLE KEYS */;
INSERT INTO `contacts_missions` VALUES (1,1),(2,2),(2,24),(3,3),(3,24),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12),(13,13),(14,14),(15,15),(16,16),(17,17),(18,18),(19,19),(20,20),(21,1),(22,3),(22,39),(23,8),(24,11),(25,3),(27,49);
/*!40000 ALTER TABLE `contacts_missions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'France'),(2,'Allemagne'),(3,'Italie'),(4,'Russie'),(5,'Chine'),(6,'USA'),(7,'Canada'),(8,'Espagne'),(9,'Angleterre');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missions`
--

DROP TABLE IF EXISTS `missions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `missions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `codename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `missionType_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `speciality_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `missionType_id` (`missionType_id`),
  KEY `status_id` (`status_id`),
  KEY `country_id` (`country_id`),
  KEY `speciality_id` (`speciality_id`),
  CONSTRAINT `missions_ibfk_1` FOREIGN KEY (`missionType_id`) REFERENCES `missiontypes` (`id`),
  CONSTRAINT `missions_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `missions_ibfk_3` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `missions_ibfk_4` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missions`
--

LOCK TABLES `missions` WRITE;
/*!40000 ALTER TABLE `missions` DISABLE KEYS */;
INSERT INTO `missions` VALUES (1,'Recruter un indic','pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit','Ours polaire','2022-02-15','2022-02-20',7,3,5,5),(2,'Sauver la cible !','leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices','Renard des neiges','2021-07-30','2022-12-21',6,2,1,3),(3,'Voler les bijoux de la Castafiore','penatibus et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis','Marmotte','2021-07-27','2021-10-18',8,4,1,2),(4,'Saboter les plans','interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et','Loupiot','2021-04-03','2022-12-01',5,2,1,4),(5,'Sauver la loutre','vestibulum rutrum rutrum neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean','Papillon caniche','2021-02-24','2022-12-14',6,2,6,6),(6,'Filer le mouton','elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus','Ornithorynque','2022-04-03','2022-12-27',3,3,1,1),(7,'Convaincre la mule','neque libero convallis eget eleifend luctus ultricies eu nibh quisque id','Fourmi panda','2021-05-17','2021-10-26',7,3,4,6),(8,'Surveiller le caméléon','Pour cette mission, vous devrez traiter les données recueillies en surveillant &quot;le caméléon&quot;. Attention, la cible est douée d\'une intelligence supra normale ; c\'est un génie qui possède entre autres la faculté d\'assumer n\'importe quelle identité...','Okapi','2021-07-10','2021-12-18',1,4,7,3),(9,'Suivre le lémurien','posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec','Tatou','2021-08-09','2022-01-01',3,3,8,4),(10,'Exfiltrer l\'éléphant discrètement','accumsan felis ut at dolor quis odio consequat varius integer','Rat-taupe nu','2021-02-19','2022-02-02',6,4,4,1),(11,'Assassiner le hibou grand Duc','habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat','Blobfish','2022-11-30','2023-01-24',4,1,2,4),(12,'Mettre sur écoute le loup','nec nisi volutpat eleifend donec ut dolor morbi vel lectus','Tortue','2022-11-29','2023-03-05',2,1,5,5),(13,'Mettre sur écoute le renard','in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit','Poisson chauve-souris','2022-09-11','2022-11-17',2,1,8,6),(14,'Saboter les nains saboteurs','mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis','Requin-lutin','2021-07-28','2022-07-08',5,2,2,1),(15,'Ocean\'s eleven','ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices','Morosphinx','2021-07-10','2022-02-16',8,4,2,4),(16,'Par pitié, sabotez Jul','ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi','Pacu','2022-12-09','2023-05-04',5,1,3,5),(17,'Mettre sur écoute la belette','ut nulla sed accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis','Saïga','2021-07-03','2021-08-25',2,4,3,6),(18,'Suivre discrètement la puce','ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec','Atheris','2021-09-23','2021-12-08',3,4,1,4),(19,'Voler le vautour','pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc','Moloch hérissé','2021-02-15','2021-06-20',8,3,4,1),(20,'Exfiltrer un anaconda','risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh','Scotoplane','2021-07-05','2021-12-12',6,3,2,5),(22,'Il faut sauver Willy','Le but de cette mission est de sauver Willy. Jamais un orque ne devrait être détenu en captivité, c\'est un scandale ! Il doit impérativement retourner à la vie sauvage, c\'est primordial !','Killer whale','2022-02-23','2022-03-06',1,1,1,1),(24,'Sauver Noël !','Vite ! Il faut saboter les plans de Jack Skelligton pour sauver Noël ! Quelle drôle d\'idée a-t-il eu de vouloir changer de fête, il est le pumpkin king, grand maître d\'Halloween, Roi de l\'épouvante ! Chacun à sa place et les moutons seront bien gardés.','Étrange Noël','2022-10-31','2022-12-24',5,1,1,1),(39,'Surveiller le Kaloulou malade','Alerte ! Le Kaloulou a attrapé le coronavirus. Votre mission est de le surveiller et jouer avec lui pendant quelques jours.','Tomate','2022-03-06','2022-03-11',1,2,1,1),(49,'Squizer l\'éponge pour obtenir des infos','Trouvez Bob l\'éponge et interrogez le pour obtenir les informations dont vous avez besoin pour voler le magnifique short de Patrick l\'étoile de mer.','Vaisselle','2022-03-10','2022-03-13',8,1,1,5);
/*!40000 ALTER TABLE `missions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `missiontypes`
--

DROP TABLE IF EXISTS `missiontypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `missiontypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `missiontypes`
--

LOCK TABLES `missiontypes` WRITE;
/*!40000 ALTER TABLE `missiontypes` DISABLE KEYS */;
INSERT INTO `missiontypes` VALUES (1,'Surveillance'),(2,'Écoute'),(3,'Filature'),(4,'Assassinat'),(5,'Sabotage'),(6,'Exfiltration'),(7,'Manipulation'),(8,'Vol');
/*!40000 ALTER TABLE `missiontypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nationalities`
--

DROP TABLE IF EXISTS `nationalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nationalities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country_id` (`country_id`),
  CONSTRAINT `nationalities_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nationalities`
--

LOCK TABLES `nationalities` WRITE;
/*!40000 ALTER TABLE `nationalities` DISABLE KEYS */;
INSERT INTO `nationalities` VALUES (1,'Française',1),(2,'Allemande',2),(3,'Italienne',3),(4,'Russe',4),(5,'Chinoise',5),(6,'Américaine',6),(7,'Canadienne',7),(8,'Espagnole',8),(9,'Anglaise',9);
/*!40000 ALTER TABLE `nationalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `safehouses`
--

DROP TABLE IF EXISTS `safehouses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `safehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postalCode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SHType_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `mission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SHType_id` (`SHType_id`),
  KEY `country_id` (`country_id`),
  KEY `mission_id` (`mission_id`),
  CONSTRAINT `safehouses_ibfk_1` FOREIGN KEY (`SHType_id`) REFERENCES `safehousetypes` (`id`),
  CONSTRAINT `safehouses_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `safehouses_ibfk_3` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `safehouses`
--

LOCK TABLES `safehouses` WRITE;
/*!40000 ALTER TABLE `safehouses` DISABLE KEYS */;
INSERT INTO `safehouses` VALUES (1,'Pastèque','1 rue de la République','75004','Paris',3,1,3),(2,'Mandarine','Rathausstrasse 15','10178','Berlin',4,2,15),(3,'Kaki','Spiridon-Louis-Ring 21','80809','Munich',1,2,20),(4,'Orange','Theater square, 1','125009','Moscou',3,4,7),(5,'Clémentine','5 Place du corbeau','56300','Pontivy',2,1,24),(6,'Litchi','Piazza Nazarion Sauro; 25/r','50124','Florence',4,3,16),(7,'Pomme','45 Rockfellere Plaza, New York','10111','New York',1,6,5),(8,'Poire','C. San Jorge, 12','50001','Saragosse',1,8,9),(9,'Citron','177 Robson St','BC V6B 2A8','Vancouver',2,7,8),(10,'Kiwi','2 avenue Saint Laurent','44000','Nantes',1,1,4),(11,'Banane','6216 Archer Ave','IL 60638','Chicago',2,6,5),(12,'Fraise','Via della Chiera','00193','Rome',3,3,17),(14,'Pêche','Heumarkt 20','50667','Cologne',2,2,15),(15,'Abricot','1006 Spring St','WA 98104','Seattle',1,6,5),(16,'Cerise','Piazza della Stazione, 2','56125','Pise',1,3,17),(17,'Prune','60, Tianze Lu Chaoyang District','100600','Pékin',1,5,1),(18,'Myrtille','15 quai de la Moïka','191186','Saint Pétersbourg',1,4,10),(19,'Cassis','20 impasse de la motte','35000','Rennes',2,1,18),(20,'Mangue','Piazza Navona, 12','80100','Naples',3,3,16),(21,'Framboise','123 Queen Street','ON M5H 2M9','Toronto',2,7,NULL),(22,'Carotte','18 rue du Désespoir','20000','Ajaccio',3,1,NULL),(23,'Ananas','2 rue Barry Lyndon','35250','Chevaigné',1,1,39);
/*!40000 ALTER TABLE `safehouses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `safehousetypes`
--

DROP TABLE IF EXISTS `safehousetypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `safehousetypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `safehousetypes`
--

LOCK TABLES `safehousetypes` WRITE;
/*!40000 ALTER TABLE `safehousetypes` DISABLE KEYS */;
INSERT INTO `safehousetypes` VALUES (1,'maison'),(2,'appartement'),(3,'abri atomique'),(4,'chalet');
/*!40000 ALTER TABLE `safehousetypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialities`
--

DROP TABLE IF EXISTS `specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialities`
--

LOCK TABLES `specialities` WRITE;
/*!40000 ALTER TABLE `specialities` DISABLE KEYS */;
INSERT INTO `specialities` VALUES (1,'Infiltration'),(2,'Cyber-renseignement'),(3,'Décryptage et analyse de données'),(4,'Traduction'),(5,'Interrogatoire'),(6,'Piratage');
/*!40000 ALTER TABLE `specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'En préparation'),(2,'En cours'),(3,'Terminé'),(4,'Échec');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `targets`
--

DROP TABLE IF EXISTS `targets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `targets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `codename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `mission_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nationality_id` (`nationality_id`),
  KEY `mission_id` (`mission_id`),
  CONSTRAINT `targets_ibfk_1` FOREIGN KEY (`nationality_id`) REFERENCES `nationalities` (`id`),
  CONSTRAINT `targets_ibfk_2` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `targets`
--

LOCK TABLES `targets` WRITE;
/*!40000 ALTER TABLE `targets` DISABLE KEYS */;
INSERT INTO `targets` VALUES (1,'Chen','Lin','1950-01-01','Mercure',5,1),(2,'François','Dupont','1981-12-28','Vénus',1,2),(3,'Jeanne','Ancel','1970-06-28','Terre',1,3),(4,'Alphonse','Marchand','1970-07-02','Mars et ça repart',1,4),(5,'Richard','McGee','1970-05-06','Jupiter',6,5),(6,'Eli','Curley','1969-01-14','Saturne',6,5),(7,'Julien','Gaumont','1981-12-28','Uranus',1,6),(8,'Jaromir','Stepanovich','1956-08-28','Neptune',4,7),(9,'Aiden','Boyd','1972-05-05','Pluton',7,8),(10,'Domingo','Muniz','1990-10-28','Amateru',8,9),(11,'Igor','Yurigovich','1950-10-18','Halla',4,10),(12,'Karl','Herr','1996-10-03','Quichotte',2,11),(13,'Xia','Long','1997-11-15','Dulcinée',5,12),(14,'Bruno','Agramonte','1990-05-10','Rossinante',8,13),(15,'Maria','Waldstein','1969-01-14','Sancho',2,14),(16,'Timon','Körver','1970-05-06','Taphao Thong',2,15),(17,'Vito','Luchini','1987-03-04','Janssen',3,16),(18,'Anna','Lo Nigro','1992-09-05','Galilée',3,17),(19,'Françoise','Couturier','1999-02-28','Brahe',1,18),(20,'Nikitin','Igorevich','2002-08-28','Harriot',4,19),(21,'Mathias','Flügel','1996-10-06','Lipperhey',2,20),(23,'Willy','Wonka','1996-10-06','Chocolat',2,22),(24,'Jack','Skellington','1998-10-06','Nightmare before Christmas',2,24),(25,'Mona','Lisa','1996-10-06','Joconde',1,24),(26,'Bob','L\'éponge','1996-10-06','Océan',2,49),(31,'Elliot','Venel','2014-11-13','Kaloulou',1,39),(32,'Robin','Venel','2018-03-14','Doudou',1,NULL);
/*!40000 ALTER TABLE `targets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-11 12:30:01
