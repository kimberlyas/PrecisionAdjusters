CREATE DATABASE  IF NOT EXISTS `PA_Database` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `PA_Database`;
-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: PA_Database
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `accinfo`
--

DROP TABLE IF EXISTS `accinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accinfo` (
  `accidentNo` int(11) NOT NULL COMMENT 'A sequencial number serving as the primary key for an accident',
  `location` varchar(45) NOT NULL COMMENT 'Accident''s location of where it occured',
  `time` varchar(45) NOT NULL COMMENT 'Accident''s time of when it occured',
  `date` varchar(45) NOT NULL COMMENT 'Accident''s date of when it occured',
  `eyewitnessDetails` varchar(100) NOT NULL COMMENT 'Accident''s eye witness detailed account',
  `sceneDescription` varchar(100) NOT NULL COMMENT 'Accident''s scene description',
  PRIMARY KEY (`accidentNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accinfo`
--

LOCK TABLES `accinfo` WRITE;
/*!40000 ALTER TABLE `accinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `accinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insurance_cominfo`
--

DROP TABLE IF EXISTS `insurance_cominfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insurance_cominfo` (
  `icname` varchar(45) NOT NULL COMMENT 'Insurance Company''s name',
  `address1_ic` varchar(45) NOT NULL COMMENT 'Insurance Company''s address - 1st Line (Street or Plaza Number/Street or Plaza Name)',
  `address2_ic` varchar(45) NOT NULL COMMENT 'Insurance Company''s address - 2nd Line (City/Parish/Zipcode)',
  `email` varchar(45) NOT NULL COMMENT 'Insurance Company''s email',
  `phone` varchar(45) NOT NULL COMMENT 'Insurance Company''s phone number',
  `fax` varchar(45) NOT NULL COMMENT 'Insurance Company''s fax',
  PRIMARY KEY (`icname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insurance_cominfo`
--

LOCK TABLES `insurance_cominfo` WRITE;
/*!40000 ALTER TABLE `insurance_cominfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `insurance_cominfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_accinfo`
--

DROP TABLE IF EXISTS `vehicle_accinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle_accinfo` (
  `vin` varchar(45) NOT NULL COMMENT 'Unique identifier for a vehicle',
  `plateNo` varchar(45) NOT NULL COMMENT 'Vehicle''s license plate number',
  `type` varchar(45) NOT NULL COMMENT 'Vehicle''s type',
  `make` varchar(45) NOT NULL COMMENT 'Vehicle''s make',
  `model` varchar(45) NOT NULL COMMENT 'Victim''s model',
  `year` varchar(45) NOT NULL COMMENT 'Vehicle''s year',
  `damages` varchar(100) NOT NULL COMMENT 'Description of the damages sustained',
  `accidentNo` int(11) NOT NULL COMMENT 'A sequencial number serving as the primary key for an accident',
  PRIMARY KEY (`vin`),
  KEY `fk_vehicle_accinfo_1_idx` (`accidentNo`),
  CONSTRAINT `fk_vehicle_accinfo_1` FOREIGN KEY (`accidentNo`) REFERENCES `accinfo` (`accidentNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_accinfo`
--

LOCK TABLES `vehicle_accinfo` WRITE;
/*!40000 ALTER TABLE `vehicle_accinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_accinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicleowner_icinfo`
--

DROP TABLE IF EXISTS `vehicleowner_icinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicleowner_icinfo` (
  `policyNo` varchar(45) NOT NULL COMMENT 'Owner''s insurance policy number of the vehicle involved in the accident',
  `lname_ic` varchar(45) NOT NULL COMMENT 'Owner''s last name of the vehicle involved in the accident',
  `fname_ic` varchar(45) NOT NULL COMMENT 'Owner''s first name of the vehicle involved in the accident',
  `mname_ic` varchar(45) NOT NULL COMMENT 'Owner''s middle name of the vehicle involved in the accident',
  `dlicense` varchar(45) NOT NULL COMMENT 'Owner''s tax registration/driver''s license number of the vehicle involved in the accident',
  `icname` varchar(45) NOT NULL COMMENT 'Links with record of information on the insurance company the vehicle involved in the accident\n',
  `vin` varchar(45) NOT NULL COMMENT 'Unique identifier for a vehicle',
  PRIMARY KEY (`policyNo`),
  KEY `fk_vehicleowner_icinfo_1_idx` (`icname`),
  KEY `fk_vehicleowner_icinfo_2_idx` (`vin`),
  CONSTRAINT `fk_vehicleowner_icinfo_1` FOREIGN KEY (`icname`) REFERENCES `insurance_cominfo` (`icname`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_vehicleowner_icinfo_2` FOREIGN KEY (`vin`) REFERENCES `vehicle_accinfo` (`vin`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicleowner_icinfo`
--

LOCK TABLES `vehicleowner_icinfo` WRITE;
/*!40000 ALTER TABLE `vehicleowner_icinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicleowner_icinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `victim_accinfo`
--

DROP TABLE IF EXISTS `victim_accinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `victim_accinfo` (
  `trn` varchar(45) NOT NULL COMMENT 'Victim''s tax registration number (TRN)',
  `lname_acc` varchar(45) NOT NULL COMMENT 'Victim''s lastname',
  `fname_acc` varchar(45) NOT NULL COMMENT 'Victim''s first name',
  `mname` varchar(45) NOT NULL COMMENT 'Victim''s middle name',
  `address1_acc` varchar(45) NOT NULL COMMENT 'Victim''s home address - 1st Line (Street or Apartment Number/Street or Apartment Name)',
  `address2_acc` varchar(45) NOT NULL COMMENT 'Victim''s home address - 2nd Line (City/Parish/Zipcode)',
  `email` varchar(45) NOT NULL COMMENT 'Victim''s email address',
  `home` varchar(45) NOT NULL COMMENT 'Victim''s home phone number',
  `cell` varchar(45) NOT NULL COMMENT 'Victim''s cell phone number',
  `work` varchar(45) NOT NULL COMMENT 'Victim''s work phone number',
  `dob` varchar(45) NOT NULL COMMENT 'Victim''s dob',
  `occupation` varchar(45) NOT NULL COMMENT 'Victim''s occupation',
  `mortalStatus` varchar(45) NOT NULL COMMENT 'Stores whether the victim is alive or not ',
  `accidentNo` int(11) NOT NULL COMMENT 'Links with record of information on victim''s accident details',
  PRIMARY KEY (`trn`),
  KEY `fk_victim_accinfo_1_idx` (`accidentNo`),
  CONSTRAINT `fk_victim_accinfo_1` FOREIGN KEY (`accidentNo`) REFERENCES `accinfo` (`accidentNo`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `victim_accinfo`
--

LOCK TABLES `victim_accinfo` WRITE;
/*!40000 ALTER TABLE `victim_accinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `victim_accinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-20 18:12:13
