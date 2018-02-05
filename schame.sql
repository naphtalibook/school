-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: school
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.25-MariaDB

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Family_name` varchar(45) NOT NULL,
  `User_name` varchar(45) NOT NULL,
  `Role` int(11) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Image_path` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `User_name_UNIQUE` (`User_name`),
  UNIQUE KEY `Phone_UNIQUE` (`Phone`),
  KEY `role-value_idx` (`Role`),
  CONSTRAINT `role-value` FOREIGN KEY (`Role`) REFERENCES `values` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,'naphtali','isaacs','admin',1,'0525116375','naphtalibook@gmail.com','0000','img/Dmen.jpg'),(2,'orly','issacs','orly',2,'0526511618','orly@orly.com','0000','img/Dwomen.jpg'),(3,'ari','issacs','ari',3,'0528361518','ari@ari.com','0000','img/Dmen.jpg'),(14,'adi','lachiani','adi',3,'0528014540','dai@wwww','0000','uploads/Dwomen.jpg'),(25,'judy','isaacs','judy',2,'052575727','judyi@hhh','0000','uploads/Dwomen.jpg');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Description` varchar(90) NOT NULL,
  `Price` int(11) DEFAULT NULL,
  `Image_path` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,'full stack','web developer cours',1000,'uploads/images (1).png'),(2,'java','java developer',2000,'img/cours.jpg'),(3,'DBA','',1000,'uploads/cours.jpg'),(4,'photoshop','photoshop',3000,'uploads/cours.jpg'),(7,'.net','',12000,'uploads/cours.jpg'),(8,'ui','ui course',14000,'uploads/cours.jpg');
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_student`
--

DROP TABLE IF EXISTS `course_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_student` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Course_id` int(11) NOT NULL,
  `Student_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `student_idx` (`Student_id`),
  KEY `course_idx` (`Course_id`),
  CONSTRAINT `course` FOREIGN KEY (`Course_id`) REFERENCES `course` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `student` FOREIGN KEY (`Student_id`) REFERENCES `student` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_student`
--

LOCK TABLES `course_student` WRITE;
/*!40000 ALTER TABLE `course_student` DISABLE KEYS */;
INSERT INTO `course_student` VALUES (40,7,1),(59,2,2),(60,3,2),(62,1,1),(63,1,2),(64,8,18);
/*!40000 ALTER TABLE `course_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Family_name` varchar(45) NOT NULL,
  `Phone` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Image_path` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Phone_UNIQUE` (`Phone`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,'faf','isa','05251163875','naph@gmail.com','uploads/Dmen.jpg'),(2,'www','wwww','1111111','www@www','uploads/defalt.png'),(3,'gfdgfd','bfdbdfb','254254254245','fdfdbd@bdtbdtg','img/Dwomen.jpg'),(4,'ari','isaacs','0552525252','adi@gmail.com','uploads/Dmen.jpg'),(18,'dan','cohen','05255454','dan@dadda','uploads/Dmen.jpg');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `values`
--

DROP TABLE IF EXISTS `values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `values` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Value` varchar(45) NOT NULL,
  `Type` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `values`
--

LOCK TABLES `values` WRITE;
/*!40000 ALTER TABLE `values` DISABLE KEYS */;
INSERT INTO `values` VALUES (1,'owner','role'),(2,'manager','role'),(3,'sales','role');
/*!40000 ALTER TABLE `values` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-30 18:59:44
