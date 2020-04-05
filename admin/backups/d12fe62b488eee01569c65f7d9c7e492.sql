-- MariaDB dump 10.17  Distrib 10.4.11-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	10.4.11-MariaDB

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'english'),(2,'arabic'),(3,'science'),(4,'social studies');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disease_symptoms`
--

DROP TABLE IF EXISTS `disease_symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disease_symptoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `disease` varchar(200) DEFAULT NULL,
  `symptom` int(10) unsigned NOT NULL,
  `expected_probability` varchar(40) DEFAULT NULL,
  `minimum` varchar(40) DEFAULT NULL,
  `maximum` varchar(40) DEFAULT NULL,
  `reading_other_value` varchar(40) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `symptoms` text DEFAULT NULL,
  `reference` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `disease` (`disease`),
  KEY `symptom` (`symptom`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disease_symptoms`
--

LOCK TABLES `disease_symptoms` WRITE;
/*!40000 ALTER TABLE `disease_symptoms` DISABLE KEYS */;
/*!40000 ALTER TABLE `disease_symptoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diseases`
--

DROP TABLE IF EXISTS `diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diseases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `short_name` varchar(40) NOT NULL,
  `latin_name` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `other_details` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diseases`
--

LOCK TABLES `diseases` WRITE;
/*!40000 ALTER TABLE `diseases` DISABLE KEYS */;
INSERT INTO `diseases` VALUES (1,'flu','cold','bbbb<br>','n nbnbnbnbn<br>','<br>'),(2,'skin illness','skin','c cbc<br>','bcbcbc<br>','<br>');
/*!40000 ALTER TABLE `diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(40) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` varchar(40) NOT NULL,
  `name_patient` int(10) unsigned DEFAULT NULL,
  `time` time DEFAULT '12:00:00',
  `prescription` varchar(40) DEFAULT NULL,
  `diagnosis` varchar(40) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name_patient` (`name_patient`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'gfgfgf','2018-12-14','Active',2,'22:00:00','fhf','hfhfh','fhfhfhfhfh<br>'),(2,'vdvdvd','2019-02-02','Active',1,'12:00:00','bfhfh','hfhf','hfhfhf<br>'),(3,'cbcbcb','1913-11-13','Active',3,'12:00:00','bcbc','cbcb','cbcbcb<br>');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_docs`
--

DROP TABLE IF EXISTS `medical_docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_docs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient` int(10) unsigned DEFAULT NULL,
  `doc` varchar(40) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient` (`patient`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_docs`
--

LOCK TABLES `medical_docs` WRITE;
/*!40000 ALTER TABLE `medical_docs` DISABLE KEYS */;
INSERT INTO `medical_docs` VALUES (1,3,'9459f027b95cdbd47.txt','dd dbdb'),(2,3,'ebdd74ca215744b6c.txt','c c c cc c'),(3,1,'531bbd7122a9d307f.txt','v vnvnvnv'),(4,1,'5c9bc7e1584d79461.txt','b bbb'),(5,1,'5871d1a983a5a4362.txt','bb b b b');
/*!40000 ALTER TABLE `medical_docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medical_img`
--

DROP TABLE IF EXISTS `medical_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medical_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient` int(10) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient` (`patient`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medical_img`
--

LOCK TABLES `medical_img` WRITE;
/*!40000 ALTER TABLE `medical_img` DISABLE KEYS */;
INSERT INTO `medical_img` VALUES (1,2,'xdrhhdhh',NULL),(2,2,'thghggh',NULL),(3,1,'gnngg','5e79103fbf4930c2e.jpg'),(4,2,'gnhgjgjg',NULL),(5,3,'rgrgr','b89bac9d6bc5f46e7.jpg'),(6,3,'dvvd','014a071e8fdb04b01.jpg'),(7,1,'mhnnn','d14413c98a0a8f7da.jpg');
/*!40000 ALTER TABLE `medical_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_grouppermissions`
--

DROP TABLE IF EXISTS `membership_grouppermissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_grouppermissions` (
  `permissionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `groupID` int(10) unsigned DEFAULT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `allowInsert` tinyint(4) NOT NULL DEFAULT 0,
  `allowView` tinyint(4) NOT NULL DEFAULT 0,
  `allowEdit` tinyint(4) NOT NULL DEFAULT 0,
  `allowDelete` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `groupID_tableName` (`groupID`,`tableName`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_grouppermissions`
--

LOCK TABLES `membership_grouppermissions` WRITE;
/*!40000 ALTER TABLE `membership_grouppermissions` DISABLE KEYS */;
INSERT INTO `membership_grouppermissions` VALUES (1,2,'student',1,3,3,3),(2,2,'course',1,3,3,3),(3,2,'stud_course',1,3,3,3),(19,2,'diseases',1,3,3,3),(20,2,'patients',1,3,3,3),(21,2,'symptoms',1,3,3,3),(22,2,'disease_symptoms',1,3,3,3),(23,2,'patient_symptoms',1,3,3,3),(36,2,'medical_img',1,3,3,3),(37,2,'events',1,3,3,3),(50,2,'medical_docs',1,3,3,3);
/*!40000 ALTER TABLE `membership_grouppermissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_groups`
--

DROP TABLE IF EXISTS `membership_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_groups` (
  `groupID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `allowSignup` tinyint(4) DEFAULT NULL,
  `needsApproval` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`groupID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_groups`
--

LOCK TABLES `membership_groups` WRITE;
/*!40000 ALTER TABLE `membership_groups` DISABLE KEYS */;
INSERT INTO `membership_groups` VALUES (1,'anonymous','Anonymous group created automatically on 2020-03-22',0,0),(2,'Admins','Admin group created automatically on 2020-03-22',0,1);
/*!40000 ALTER TABLE `membership_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_userpermissions`
--

DROP TABLE IF EXISTS `membership_userpermissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_userpermissions` (
  `permissionID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `memberID` varchar(100) NOT NULL,
  `tableName` varchar(100) DEFAULT NULL,
  `allowInsert` tinyint(4) NOT NULL DEFAULT 0,
  `allowView` tinyint(4) NOT NULL DEFAULT 0,
  `allowEdit` tinyint(4) NOT NULL DEFAULT 0,
  `allowDelete` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`permissionID`),
  UNIQUE KEY `memberID_tableName` (`memberID`,`tableName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_userpermissions`
--

LOCK TABLES `membership_userpermissions` WRITE;
/*!40000 ALTER TABLE `membership_userpermissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `membership_userpermissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_userrecords`
--

DROP TABLE IF EXISTS `membership_userrecords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_userrecords` (
  `recID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tableName` varchar(100) DEFAULT NULL,
  `pkValue` varchar(255) DEFAULT NULL,
  `memberID` varchar(100) DEFAULT NULL,
  `dateAdded` bigint(20) unsigned DEFAULT NULL,
  `dateUpdated` bigint(20) unsigned DEFAULT NULL,
  `groupID` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`recID`),
  UNIQUE KEY `tableName_pkValue` (`tableName`,`pkValue`(150)),
  KEY `pkValue` (`pkValue`),
  KEY `tableName` (`tableName`),
  KEY `memberID` (`memberID`),
  KEY `groupID` (`groupID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_userrecords`
--

LOCK TABLES `membership_userrecords` WRITE;
/*!40000 ALTER TABLE `membership_userrecords` DISABLE KEYS */;
INSERT INTO `membership_userrecords` VALUES (1,'student','1','ahmed',1584919465,1584919469,2),(2,'student','2','ahmed',1584919480,1584919480,2),(3,'student','3','ahmed',1584919490,1584919490,2),(4,'course','1','ahmed',1584919556,1584919556,2),(5,'course','2','ahmed',1584919564,1584919564,2),(6,'course','3','ahmed',1584919576,1584919576,2),(7,'course','4','ahmed',1584919587,1584919587,2),(8,'stud_course','1','ahmed',1584919802,1584919802,2),(9,'stud_course','2','ahmed',1584919815,1584919815,2),(10,'stud_course','3','ahmed',1584919825,1584919825,2),(11,'stud_course','4','ahmed',1584919835,1584919835,2),(12,'stud_course','5','ahmed',1584919846,1584919846,2),(13,'stud_course','6','ahmed',1584919857,1584919857,2),(14,'diseases','1','ahmed',1585514139,1585514142,2),(15,'diseases','2','ahmed',1585514176,1585514189,2),(16,'patients','1','ahmed',1585514395,1585777451,2),(17,'symptoms','1','ahmed',1585515504,1585515507,2),(18,'symptoms','2','ahmed',1585515519,1585515519,2),(21,'patient_symptoms','1','ahmed',1585515638,1585515638,2),(22,'patients','2','ahmed',1585519974,1585771499,2),(23,'medical_img','1','ahmed',1585771327,1585771381,2),(24,'medical_img','2','ahmed',1585771400,1585771436,2),(25,'events','1','ahmed',1585771477,1585771482,2),(26,'medical_img','3','ahmed',1585771521,1585777406,2),(27,'events','2','ahmed',1585771554,1585771554,2),(28,'patients','3','ahmed',1585772125,1585772131,2),(29,'medical_img','4','ahmed',1585773551,1585773554,2),(30,'medical_docs','1','ahmed',1585776286,1585777259,2),(31,'medical_img','5','ahmed',1585776336,1585777199,2),(32,'medical_img','6','ahmed',1585777220,1585777221,2),(33,'medical_docs','2','ahmed',1585777304,1585777306,2),(34,'medical_img','7','ahmed',1585777424,1585777426,2),(35,'medical_docs','3','ahmed',1585777524,1585777524,2),(36,'medical_docs','4','ahmed',1585777537,1585777538,2),(37,'medical_docs','5','ahmed',1585777551,1585777551,2),(38,'events','3','ahmed',1585777595,1585777595,2);
/*!40000 ALTER TABLE `membership_userrecords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_users`
--

DROP TABLE IF EXISTS `membership_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_users` (
  `memberID` varchar(100) NOT NULL,
  `passMD5` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `signupDate` date DEFAULT NULL,
  `groupID` int(10) unsigned DEFAULT NULL,
  `isBanned` tinyint(4) DEFAULT NULL,
  `isApproved` tinyint(4) DEFAULT NULL,
  `custom1` text DEFAULT NULL,
  `custom2` text DEFAULT NULL,
  `custom3` text DEFAULT NULL,
  `custom4` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `pass_reset_key` varchar(100) DEFAULT NULL,
  `pass_reset_expiry` int(10) unsigned DEFAULT NULL,
  `flags` text DEFAULT NULL,
  PRIMARY KEY (`memberID`),
  KEY `groupID` (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_users`
--

LOCK TABLES `membership_users` WRITE;
/*!40000 ALTER TABLE `membership_users` DISABLE KEYS */;
INSERT INTO `membership_users` VALUES ('ahmed','$2y$10$6LIFHWMGYiYk46gqWHSlg.4lyeyfzNhJMU0KjKt1u.BOCFhXpQKgS','freelancerfromalex@gmail.com','2020-03-22',2,0,1,NULL,NULL,NULL,NULL,'Admin member created automatically on 2020-03-22',NULL,NULL,NULL),('guest',NULL,NULL,'2020-03-22',1,0,1,NULL,NULL,NULL,NULL,'Anonymous member created automatically on 2020-03-22',NULL,NULL,NULL);
/*!40000 ALTER TABLE `membership_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership_usersessions`
--

DROP TABLE IF EXISTS `membership_usersessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membership_usersessions` (
  `memberID` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `agent` varchar(100) NOT NULL,
  `expiry_ts` int(10) unsigned NOT NULL,
  UNIQUE KEY `memberID_token_agent` (`memberID`,`token`,`agent`),
  KEY `memberID` (`memberID`),
  KEY `expiry_ts` (`expiry_ts`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership_usersessions`
--

LOCK TABLES `membership_usersessions` WRITE;
/*!40000 ALTER TABLE `membership_usersessions` DISABLE KEYS */;
INSERT INTO `membership_usersessions` VALUES ('ahmed','fL0HlkfGd347wqdr111c65ITh6mSIV','pjqGBX53jsozTCDHiFBDCDcfJg8UYx',1588370282);
/*!40000 ALTER TABLE `membership_usersessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient_symptoms`
--

DROP TABLE IF EXISTS `patient_symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient_symptoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient` int(10) unsigned NOT NULL,
  `symptom` int(10) unsigned NOT NULL,
  `observation_date` date DEFAULT NULL,
  `observation_time` time DEFAULT NULL,
  `symptom_value` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `patient` (`patient`),
  KEY `symptom` (`symptom`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient_symptoms`
--

LOCK TABLES `patient_symptoms` WRITE;
/*!40000 ALTER TABLE `patient_symptoms` DISABLE KEYS */;
INSERT INTO `patient_symptoms` VALUES (1,1,2,'2020-03-29','01:00:00','5');
/*!40000 ALTER TABLE `patient_symptoms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `last_name` varchar(40) NOT NULL,
  `first_name` varchar(40) NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'Unknown',
  `birth_date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `state` varchar(15) DEFAULT NULL,
  `zip` char(8) DEFAULT NULL,
  `home_phone` varchar(40) DEFAULT NULL,
  `work_phone` varchar(40) DEFAULT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `other_details` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `filed` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `sexual_orientation` text NOT NULL,
  `image` varchar(40) DEFAULT NULL,
  `tobacco_usage` varchar(40) NOT NULL DEFAULT 'Unknown',
  `alcohol_intake` varchar(40) NOT NULL DEFAULT 'Unknown',
  `history` varchar(100) NOT NULL DEFAULT 'Unknown',
  `surgical_history` text DEFAULT NULL,
  `obstetric_history` text DEFAULT NULL,
  `genetic_diseases` text DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'saleh','ahmed','Male','1985-03-27',35,'alagami','alex','AL','mbmbmbmb','nnnbnbmbmbm','03hhggvfffdf','jgjgjgjgjgjgj','njnbnbn','bnbnbnbn<br>','2020-03-29 16:39:55','2020-04-01 17:44:11','Unknown','3d654fad95ef448a0.jpg','Non-smoker','Non-drinker','Unkown','ggngnn g','h  h hh h','nnmbmgmg','gmgmgmgmg'),(2,'VNVN','DVGDG','Male','1914-12-13',105,'VNVN','NVVN','VI','VNVN','NVNV','NVNV','NVNV','VNVN','VNVN<br>','2020-03-29 18:12:54','2020-04-01 16:04:59','Unknown',NULL,'Unknown','Unknown','Unkown','fdfd','fdfdfd','fdfd','fdfd'),(3,'ikuiui','iuiui','Male','2019-01-01',1,NULL,NULL,'WV',NULL,NULL,NULL,'ytytyty','ytyt','ytyty<br>','2020-04-01 16:15:25','2020-04-01 16:15:31','Same gender',NULL,'Non-smoker','Unknown','None','tyt','ytyt','ytyt','ytyt');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stud_course`
--

DROP TABLE IF EXISTS `stud_course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stud_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_id` int(10) unsigned DEFAULT NULL,
  `s_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `c_id` (`c_id`),
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stud_course`
--

LOCK TABLES `stud_course` WRITE;
/*!40000 ALTER TABLE `stud_course` DISABLE KEYS */;
INSERT INTO `stud_course` VALUES (1,2,1),(2,2,2),(3,2,3),(4,1,2),(5,3,3),(6,4,2);
/*!40000 ALTER TABLE `stud_course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'ahmed'),(2,'mohamed'),(3,'zaki');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `symptoms`
--

DROP TABLE IF EXISTS `symptoms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `symptoms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` text DEFAULT NULL,
  `comments` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `symptoms`
--

LOCK TABLES `symptoms` WRITE;
/*!40000 ALTER TABLE `symptoms` DISABLE KEYS */;
INSERT INTO `symptoms` VALUES (1,'temprature','hghg<br>','hghg<br>'),(2,'headache','hjg<br>','jgjgj<br>');
/*!40000 ALTER TABLE `symptoms` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-05  2:12:56
