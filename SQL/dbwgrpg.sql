-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 01:14 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

DROP DATABASE wgrpg;
CREATE DATABASE wgrpg;
USE wgrpg;

--
-- Database: `dbwgrpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterabilitystats`
--

CREATE TABLE IF NOT EXISTS `tblcharacterabilitystats` (
  `intCharacterAbilityStatID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL DEFAULT '0',
  `intIntelligence` int(11) NOT NULL DEFAULT '0',
  `intAgility` int(11) NOT NULL DEFAULT '0',
  `intVitality` int(11) NOT NULL DEFAULT '0',
  `intWillpower` int(11) NOT NULL DEFAULT '0',
  `intDexterity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intCharacterAbilityStatID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `tblcharacterabilitystats`
--

INSERT INTO `tblcharacterabilitystats` (`intCharacterAbilityStatID`, `intRPGCharacterID`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`) VALUES
(78, 79, 0, 0, 0, 0, 0, 0),
(79, 80, 10, 0, 0, 0, 0, 0),
(81, 82, 5, 0, 0, 0, 0, 0),
(82, 83, 20, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterbody`
--

CREATE TABLE IF NOT EXISTS `tblcharacterbody` (
  `intCharacterBodyID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL DEFAULT '0',
  `intBreasts` int(11) NOT NULL DEFAULT '0',
  `intBelly` int(11) NOT NULL DEFAULT '0',
  `intLegs` int(11) NOT NULL DEFAULT '0',
  `intButt` int(11) NOT NULL DEFAULT '0',
  `intArms` int(11) NOT NULL DEFAULT '0',
  `intFace` int(11) NOT NULL DEFAULT '0',
  `intBellyRipLevel` int(11) NOT NULL DEFAULT '0',
  `intButtRipLevel` int(11) NOT NULL DEFAULT '0',
  `intBreastsRipLevel` int(11) NOT NULL DEFAULT '0',
  `intArmsRipLevel` int(11) NOT NULL DEFAULT '0',
  `intLegsRipLevel` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intCharacterBodyID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblcharacterbody`
--

INSERT INTO `tblcharacterbody` (`intCharacterBodyID`, `intRPGCharacterID`, `intBreasts`, `intBelly`, `intLegs`, `intButt`, `intArms`, `intFace`, `intBellyRipLevel`, `intButtRipLevel`, `intBreastsRipLevel`, `intArmsRipLevel`, `intLegsRipLevel`) VALUES
(4, 79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 82, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 83, 0, 5, 3, 1, 0, 5, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharactereventxr`
--

CREATE TABLE IF NOT EXISTS `tblcharactereventxr` (
  `intCharacterEventXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intCharacterEventXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`,`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1392 ;

--
-- Dumping data for table `tblcharactereventxr`
--

INSERT INTO `tblcharactereventxr` (`intCharacterEventXRID`, `intRPGCharacterID`, `intEventID`, `dtmDateAdded`) VALUES
(1364, 79, 2, '2016-04-08 15:32:12'),
(1365, 79, 10, '2016-04-08 15:32:20'),
(1366, 79, 1, '2016-04-08 15:32:21'),
(1367, 79, 7, '2016-04-08 15:32:24'),
(1368, 79, 4, '2016-04-08 15:32:38'),
(1370, 79, 11, '2016-04-08 15:33:04'),
(1371, 79, 5, '2016-04-08 16:45:53'),
(1372, 80, 2, '2016-04-08 16:52:46'),
(1373, 80, 1, '2016-04-08 16:52:49'),
(1374, 80, 4, '2016-04-08 16:52:57'),
(1375, 80, 10, '2016-04-08 16:53:52'),
(1376, 80, 3, '2016-04-08 16:54:51'),
(1377, 80, 11, '2016-04-08 17:04:01'),
(1378, 80, 7, '2016-04-08 17:17:39'),
(1379, 82, 2, '2016-04-10 15:46:45'),
(1380, 82, 1, '2016-04-10 15:46:48'),
(1381, 82, 10, '2016-04-10 15:47:04'),
(1382, 82, 4, '2016-04-10 15:47:08'),
(1383, 82, 3, '2016-04-10 15:48:23'),
(1384, 82, 11, '2016-04-10 15:59:22'),
(1385, 83, 2, '2016-04-10 16:07:02'),
(1386, 83, 4, '2016-04-10 16:07:07'),
(1387, 83, 3, '2016-04-10 16:07:19'),
(1388, 83, 1, '2016-04-10 16:07:53'),
(1389, 83, 10, '2016-04-10 16:09:12'),
(1390, 83, 7, '2016-04-10 16:09:29'),
(1391, 83, 11, '2016-04-10 16:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacteritemxr`
--

CREATE TABLE IF NOT EXISTS `tblcharacteritemxr` (
  `intItemInstanceID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intCaloriesRemaining` int(11) DEFAULT NULL,
  `blnDigesting` tinyint(4) NOT NULL DEFAULT '0',
  `blnEquipped` tinyint(4) NOT NULL DEFAULT '0',
  `strSize` enum('XS','S','M','L','XL','XXL','XXXL','XXXXL','Stretch') DEFAULT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intItemInstanceID`),
  KEY `intCharacterID` (`intRPGCharacterID`,`intItemID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=582 ;

--
-- Dumping data for table `tblcharacteritemxr`
--

INSERT INTO `tblcharacteritemxr` (`intItemInstanceID`, `intRPGCharacterID`, `intItemID`, `intCaloriesRemaining`, `blnDigesting`, `blnEquipped`, `strSize`, `dtmDateAdded`) VALUES
(399, 79, 3, 0, 0, 1, '', '2016-04-08 15:31:24'),
(404, 79, 3, 0, 0, 0, '', '2016-04-08 15:33:01'),
(405, 79, 7, 0, 0, 1, 'M', '2016-04-08 15:34:45'),
(406, 79, 8, 0, 0, 1, 'M', '2016-04-08 15:34:45'),
(408, 80, 3, 0, 0, 1, '', '2016-04-08 16:46:44'),
(409, 80, 6, 0, 0, 0, 'M', '2016-04-08 16:46:48'),
(417, 80, 3, 0, 0, 0, '', '2016-04-08 17:03:59'),
(419, 80, 8, 0, 0, 0, 'L', '2016-04-08 17:04:18'),
(436, 80, 3, 0, 0, 0, '', '2016-04-08 17:18:36'),
(443, 80, 7, 0, 0, 0, 'XXL', '2016-04-08 17:35:55'),
(444, 80, 8, 0, 0, 0, 'XXL', '2016-04-08 17:35:55'),
(445, 82, 3, 0, 0, 1, '', '2016-04-10 15:46:12'),
(446, 82, 6, 0, 0, 0, 'M', '2016-04-10 15:46:20'),
(447, 82, 3, 0, 0, 0, '', '2016-04-10 15:47:04'),
(455, 82, 3, 0, 0, 0, '', '2016-04-10 15:50:14'),
(463, 82, 3, 0, 0, 0, '', '2016-04-10 15:58:27'),
(466, 82, 3, 0, 0, 0, '', '2016-04-10 15:59:10'),
(467, 82, 7, 0, 0, 0, 'L', '2016-04-10 15:59:32'),
(468, 82, 8, 0, 0, 0, 'L', '2016-04-10 15:59:32'),
(475, 82, 1, 250, 1, 0, '', '2016-04-10 16:00:16'),
(476, 82, 1, 500, 1, 0, '', '2016-04-10 16:00:16'),
(477, 82, 1, 750, 1, 0, '', '2016-04-10 16:00:16'),
(478, 82, 1, 1000, 1, 0, '', '2016-04-10 16:00:16'),
(479, 82, 1, 1250, 1, 0, '', '2016-04-10 16:00:16'),
(480, 82, 1, 1500, 1, 0, '', '2016-04-10 16:00:16'),
(481, 82, 1, 2500, 1, 0, '', '2016-04-10 16:00:16'),
(482, 82, 1, 2750, 1, 0, '', '2016-04-10 16:00:16'),
(483, 82, 1, 3000, 1, 0, '', '2016-04-10 16:00:16'),
(484, 82, 1, 3250, 1, 0, '', '2016-04-10 16:00:16'),
(485, 82, 1, 5000, 0, 0, '', '2016-04-10 16:00:16'),
(486, 82, 1, 5000, 0, 0, '', '2016-04-10 16:00:16'),
(487, 82, 1, 5000, 0, 0, '', '2016-04-10 16:00:16'),
(488, 82, 1, 5000, 0, 0, '', '2016-04-10 16:00:16'),
(489, 83, 3, 0, 0, 1, '', '2016-04-10 16:05:59'),
(490, 83, 6, 0, 0, 0, 'M', '2016-04-10 16:06:26'),
(508, 83, 7, 0, 0, 0, 'XL', '2016-04-10 16:11:50'),
(509, 83, 8, 0, 0, 0, 'XL', '2016-04-10 16:11:50'),
(536, 83, 3, 0, 0, 0, '', '2016-04-10 16:53:07'),
(567, 83, 3, 0, 0, 0, '', '2016-04-10 17:07:16'),
(571, 83, 3, 0, 0, 0, '', '2016-04-10 17:08:27'),
(572, 83, 3, 0, 0, 0, '', '2016-04-10 17:08:32'),
(576, 83, 3, 0, 0, 0, '', '2016-04-10 17:09:17'),
(580, 83, 1, 750, 1, 0, '', '2016-04-10 17:09:52'),
(581, 83, 1, 3000, 1, 0, '', '2016-04-10 17:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacteroverridexr`
--

CREATE TABLE IF NOT EXISTS `tblcharacteroverridexr` (
  `intCharacterOverrideXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intOverrideID` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterOverrideXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intRPGCharacterID_2` (`intRPGCharacterID`),
  KEY `intOverrideID` (`intOverrideID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=295 ;

--
-- Dumping data for table `tblcharacteroverridexr`
--

INSERT INTO `tblcharacteroverridexr` (`intCharacterOverrideXRID`, `intRPGCharacterID`, `intOverrideID`) VALUES
(279, 80, 4),
(284, 82, 4),
(293, 83, 4),
(294, 83, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterstats`
--

CREATE TABLE IF NOT EXISTS `tblcharacterstats` (
  `intCharacterStatsID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intMaxHP` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL,
  `intIntelligence` int(11) NOT NULL,
  `intAgility` int(11) NOT NULL,
  `intVitality` int(11) NOT NULL,
  `intWillpower` int(11) NOT NULL,
  `intDexterity` int(11) NOT NULL,
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterStatsID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `tblcharacterstats`
--

INSERT INTO `tblcharacterstats` (`intCharacterStatsID`, `intRPGCharacterID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES
(78, 79, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(79, 80, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(81, 82, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(82, 83, 10, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterstatuseffectxr`
--

CREATE TABLE IF NOT EXISTS `tblcharacterstatuseffectxr` (
  `intCharacterStatusEffectXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  `intItemInstanceID` int(11) DEFAULT NULL,
  `intTimeRemaining` int(11) DEFAULT NULL,
  PRIMARY KEY (`intCharacterStatusEffectXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intStatusEffectID` (`intStatusEffectID`),
  KEY `intItemInstanceID` (`intItemInstanceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `tblcharacterstatuseffectxr`
--

INSERT INTO `tblcharacterstatuseffectxr` (`intCharacterStatusEffectXRID`, `intRPGCharacterID`, `intStatusEffectID`, `intItemInstanceID`, `intTimeRemaining`) VALUES
(145, 80, 4, NULL, 9999),
(149, 82, 4, NULL, 9999),
(156, 83, 4, NULL, 9999);

-- --------------------------------------------------------

--
-- Table structure for table `tblclothingdesc`
--

CREATE TABLE IF NOT EXISTS `tblclothingdesc` (
  `intClothingDescID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemID` int(11) NOT NULL,
  `strXML` varchar(45) NOT NULL,
  PRIMARY KEY (`intClothingDescID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblclothingdesc`
--

INSERT INTO `tblclothingdesc` (`intClothingDescID`, `intItemID`, `strXML`) VALUES
(3, 6, 'Both/cuirass.xml'),
(4, 7, 'Tops/tanktop.xml'),
(5, 8, 'Bottoms/jeans.xml');

-- --------------------------------------------------------

--
-- Table structure for table `tblenchant`
--

CREATE TABLE IF NOT EXISTS `tblenchant` (
  `intEnchantID` int(11) NOT NULL AUTO_INCREMENT,
  `strEnchantName` varchar(45) NOT NULL,
  `strEnchantType` enum('Prefix','Suffix') NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblenchant`
--

INSERT INTO `tblenchant` (`intEnchantID`, `strEnchantName`, `strEnchantType`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Fattening', 'Prefix', '2014-11-04 21:26:02', 'akereliuk', NULL, NULL),
(2, 'Eternally Binding', 'Suffix', '2014-11-04 21:26:02', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblenchantstatchanges`
--

CREATE TABLE IF NOT EXISTS `tblenchantstatchanges` (
  `intEnchantStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intEnchantID` int(11) NOT NULL,
  `strStatName` varchar(45) DEFAULT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  PRIMARY KEY (`intEnchantStatChangeID`),
  KEY `intEnchantID` (`intEnchantID`),
  KEY `intStatusEffectID` (`intStatusEffectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tblenchantstatchanges`
--

INSERT INTO `tblenchantstatchanges` (`intEnchantStatChangeID`, `intEnchantID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intStatusEffectID`) VALUES
(1, 1, NULL, 0, 0, 1),
(2, 2, NULL, 0, 0, 2),
(3, 2, NULL, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

CREATE TABLE IF NOT EXISTS `tblevent` (
  `intEventID` int(11) NOT NULL AUTO_INCREMENT,
  `strEventName` varchar(45) NOT NULL,
  `txtEventDesc` text,
  `strXML` varchar(45) NOT NULL,
  `blnRepeating` tinyint(1) NOT NULL DEFAULT '1',
  `blnForcedEvent` tinyint(1) NOT NULL DEFAULT '0',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Standstill', 'No event', 'standstill.xml', 1, 0, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(2, 'Tutorial Fairy', 'Character gets to talk to Tutorial Fairy', 'tutorialFairy.xml', 0, 1, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(3, 'Weight Gain', 'Character gains weight', 'weightgain.xml', 1, 0, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(4, 'Eat Burger', 'Character eats burger', 'eatburger.xml', 1, 0, '2014-10-02 00:00:00', 'akereliuk', NULL, NULL),
(7, 'Goblin Battle', 'Battle with a goblin', 'battlegoblin.xml', 1, 0, '2014-10-25 11:46:44', 'akereliuk', NULL, NULL),
(10, 'Forced Battle Goblin', 'Forces you to battle the goblin instead of giving you an option.', 'forcedBattleGoblin.xml', 1, 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(11, 'Leave Tower Event Long', 'When user leaves the tower for the first time to enter city.', 'leaveTowerLong.xml', 0, 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(12, 'Leave Tower Event Short', 'When user leaves the tower after the first time.', 'leaveTowerShort.xml', 1, 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(13, 'Sleep at Home', 'Character sleeps in their room at home.', 'sleepAtHome.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(14, 'Look at Home Mirror', 'Take a look at yourself in your full body mirror at home.', 'mirrorAtHome.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(15, 'Reset Stats at UoA', 'Reset your stats at the University of the Arcane.', 'resetStatsUoA.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(16, 'Disenchant Armour at UoA', 'Disenchant your currently equipped armour at the University of the Arcane.', 'disenchantAtUoA.xml', 1, 0, '2016-02-18 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblexperiencechart`
--

CREATE TABLE IF NOT EXISTS `tblexperiencechart` (
  `intLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `intExpToLvl` int(11) NOT NULL,
  `intCumulativeExp` int(11) NOT NULL,
  PRIMARY KEY (`intLevelID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tblexperiencechart`
--

INSERT INTO `tblexperiencechart` (`intLevelID`, `intExpToLvl`, `intCumulativeExp`) VALUES
(1, 1600, 1600),
(2, 3600, 5200),
(3, 6400, 11600),
(4, 10000, 21600),
(5, 14400, 36000),
(6, 19600, 55600),
(7, 25600, 81200),
(8, 32400, 113600),
(9, 40000, 153600),
(10, 48400, 202000);

-- --------------------------------------------------------

--
-- Table structure for table `tblfloor`
--

CREATE TABLE IF NOT EXISTS `tblfloor` (
  `intFloorID` int(11) NOT NULL AUTO_INCREMENT,
  `strFloorName` varchar(45) NOT NULL,
  `txtEntryText` text NOT NULL,
  `strFloorType` varchar(45) NOT NULL DEFAULT 'Town',
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intFloorID`),
  UNIQUE KEY `intFloorID` (`intFloorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblfloor`
--

INSERT INTO `tblfloor` (`intFloorID`, `strFloorName`, `txtEntryText`, `strFloorType`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES
(1, 'Beginner Floor 1', 'In a flash of light, you shimmer into existence. Smoke rises around you', 'Field', 'akereliuk', '2014-09-20 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblflooreventxr`
--

CREATE TABLE IF NOT EXISTS `tblflooreventxr` (
  `intFloorEventXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intFloorID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `intOccurrenceRating` int(11) NOT NULL,
  PRIMARY KEY (`intFloorEventXRID`),
  KEY `intFloorID` (`intFloorID`,`intEventID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblflooreventxr`
--

INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES
(1, 1, 1, 2000),
(2, 1, 3, 600),
(3, 1, 4, 1000),
(5, 1, 7, 1000),
(6, 1, 2, 9999),
(7, 1, 10, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

CREATE TABLE IF NOT EXISTS `tblitem` (
  `intItemID` int(11) NOT NULL AUTO_INCREMENT,
  `strItemName` varchar(45) NOT NULL,
  `txtItemDesc` text NOT NULL,
  `txtItemDescLong` text NOT NULL,
  `strItemType` enum('Weapon:Blunt','Weapon:Sword','Weapon:Axe','Weapon:Shield','Weapon:Staff','Weapon:Tome','Weapon:Wand','Weapon:Dagger','Weapon:Shuriken','Weapon:Pistols','Weapon:Rifle','Weapon:Bow','Weapon:Claws','Weapon:Gloves','Armour:Top','Armour:Bottom','Armour:Armour','Accessory','Food','Potion','Gem','Material','Quest') NOT NULL,
  `strHandType` varchar(45) DEFAULT NULL,
  `intCalories` int(11) DEFAULT NULL,
  `intHPHeal` int(11) NOT NULL DEFAULT '0',
  `intDamage` int(11) DEFAULT NULL,
  `intMagicDamage` int(11) DEFAULT NULL,
  `intDefence` int(11) DEFAULT NULL,
  `intMagicDefence` int(11) DEFAULT NULL,
  `strStatDamage` varchar(45) DEFAULT 'Strength',
  `intSellPrice` int(11) NOT NULL DEFAULT '1',
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblitem`
--

INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES
(1, 'Mysterious Hamburger', 'A warm hamburger found on the ground during an event with more calories than usual.', '', 'Food', NULL, 5000, 2, NULL, NULL, NULL, NULL, NULL, 1, 'akereliuk', '2014-10-09 19:58:50', NULL, NULL),
(3, 'Goblin Mace', 'A blunt mace likely to be used by goblins.', 'A slightly more advanced type of club, this weapon is renowned for its use by bandits, evil humanoid monsters, and other lovely beasties. So obviously it''s perfect for you! The mace uses complex physics known by mace engineers as the ''lever arm'' to deliver powerful blows with its heavy metallic head and strong handle. This particular variant has metallic pyramid like structures on the head to aid in the bashing, smashing, and crashing.', 'Weapon:Blunt', 'Primary', NULL, 0, 2, NULL, NULL, NULL, 'Strength', 1, 'akereliuk', '2014-10-25 19:55:58', NULL, NULL),
(5, 'Small Health Potion', 'A small potion that will recover some of your health points. Use it when you are injured.', '', 'Potion', NULL, 100, 5, NULL, NULL, NULL, NULL, 'Strength', 1, 'admin', '2016-03-11 00:00:00', NULL, NULL),
(6, 'Leather Cuirass', 'A light leather cuirass meant to be worn on top of clothes. The bottom is a skirt which leaves the lower body unprotected. Great for mobility.', '', 'Armour:Armour', NULL, NULL, 0, NULL, NULL, 2, NULL, NULL, 1, 'admin', '2016-04-08 00:00:00', NULL, NULL),
(7, 'Tanktop', 'A simple tanktop.', '', 'Armour:Top', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, 1, 'admin', '2016-04-08 00:00:00', NULL, NULL),
(8, 'Jeans', 'Straight blue jeans.', '', 'Armour:Bottom', NULL, NULL, 0, NULL, NULL, 1, NULL, NULL, 1, 'admin', '2016-04-08 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblitemenchantxr`
--

CREATE TABLE IF NOT EXISTS `tblitemenchantxr` (
  `intItemEnchantXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemID` int(11) NOT NULL,
  `intEnchantID` int(11) NOT NULL,
  `intOccurrence` int(11) NOT NULL,
  PRIMARY KEY (`intItemEnchantXRID`),
  KEY `intItemID` (`intItemID`),
  KEY `intEnchantID` (`intEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblitemenchantxr`
--

INSERT INTO `tblitemenchantxr` (`intItemEnchantXRID`, `intItemID`, `intEnchantID`, `intOccurrence`) VALUES
(5, 6, 1, 0),
(6, 6, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbliteminstanceenchant`
--

CREATE TABLE IF NOT EXISTS `tbliteminstanceenchant` (
  `intItemInstanceEnchantID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemInstanceID` int(11) NOT NULL,
  `intSuffixEnchantID` int(11) DEFAULT NULL,
  `intPrefixEnchantID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intItemInstanceEnchantID`),
  KEY `intItemInstanceID` (`intItemInstanceID`),
  KEY `intSuffixEnchantID` (`intSuffixEnchantID`),
  KEY `intPrefixEnchantID` (`intPrefixEnchantID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbllocation`
--

CREATE TABLE IF NOT EXISTS `tbllocation` (
  `intLocationID` int(11) NOT NULL AUTO_INCREMENT,
  `strLocationName` varchar(45) NOT NULL,
  `strLocationType` varchar(45) NOT NULL DEFAULT 'Building',
  `intTownID` int(11) NOT NULL DEFAULT '1',
  `txtDescription` text,
  PRIMARY KEY (`intLocationID`),
  KEY `fk_intTownID` (`intTownID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbllocation`
--

INSERT INTO `tbllocation` (`intLocationID`, `strLocationName`, `strLocationType`, `intTownID`, `txtDescription`) VALUES
(1, 'Tower Entrance', 'Hub', 1, NULL),
(2, 'Residential District', 'Hub', 1, 'The residential district is where you and most other citizens live. The most obvious exception are the merchants, guildsmen, and freemen, who live in the Commercial, Development, and Red Light districts respectively. The buildings here are the most numerous in the entire city, and range from the most decrepit shacks to the opulent mansions of the elder families. The streets are made of a flat, grey cobblestone that runs beside and behind every home, creating a great lattice of streets and alleyways for the populace to traverse. '),
(3, 'Commercial District', 'Hub', 1, 'The commercial district is one of the most diverse districts in the city. A myriad of scents and sounds assail your senses as you enter the main throughway containing the district. Merchants hawk their wares at you as you pass, and children scamper between the legs of the larger adults in laughter and play. Even so, you’ve been around the block more than once, and keep an eye on your money and yourself - the commercial district has more than its own fair share of thieves and muggers.\r\n<br/><br/>\r\nThough the children play and the streets are filled, you can’t shake the feeling that the district is… empty. Every other shop seems to be boarded up, and even those that are open for business don’t seem to be supplied very well. It makes sense, Turici was founded during the first wave of adventuring into the Tower. With it just being reopened, the city’s still recovering. Maybe with the tower’s reopening, the prospects will improve?'),
(4, 'Development District', 'Hub', 1, NULL),
(5, 'Red Light District', 'Hub', 1, NULL),
(6, 'Home', 'Building', 1, 'This is your home.'),
(7, 'Tailor', 'Building', 1, 'The store you stand in is finely organized and smells faintly of pine. Around you stand dozens of different pieces of clothing, ranging from simple blouses to gilded noble’s outfits, fit only for dances and dinner, not for the rigors of combat. Still, they look good. Other than the clothing you can see a rather elaborate seamstress’s station behind the counter. Seems that you can buy clothes here and have them tailored to fit you too!'),
(8, 'Blacksmith', 'Building', 1, 'The smithy is a claustrophobic space, filled with multitudes of weapons, shields, armour, tools, and other metallic objects. A thin veil of smoke seems to hang in the air, obscuring your sight and discoloring everything you see. Despite this, however, your untrained eye can easily see the masterful craftsmanship in many of the items for sale.\r\n\r\nThe forge is the most obvious centerpiece to all of this, as it’s set in the back wall of the structure and surrounded by plethora of smithing tools. A huge clay lined stone box with a large chimney like structure leading up through the roof, it is the heart of the smithy.'),
(9, 'Apothecary', 'Building', 1, NULL),
(10, 'Grocer', 'Building', 1, NULL),
(11, 'University of the Arcane', 'Building', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationeventlink`
--

CREATE TABLE IF NOT EXISTS `tbllocationeventlink` (
  `intLocationEventLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intLocationID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationEventLinkID`),
  KEY `fk_intLocationID` (`intLocationID`),
  KEY `fk_intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbllocationeventlink`
--

INSERT INTO `tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES
(1, 6, 13, 'Sleep'),
(2, 6, 14, 'View Mirror'),
(3, 11, 15, 'Reset Stats'),
(4, 11, 16, 'Disenchant Armour');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationshoplink`
--

CREATE TABLE IF NOT EXISTS `tbllocationshoplink` (
  `intLocationShopLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intLocationID` int(11) NOT NULL,
  `intShopID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationShopLinkID`),
  KEY `fk_intLocationID2` (`intLocationID`),
  KEY `fk_intShopID2` (`intShopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbllocationshoplink`
--

INSERT INTO `tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES
(1, 7, 1, 'Shop'),
(2, 8, 2, 'Shop'),
(3, 9, 3, 'Shop'),
(4, 10, 4, 'Shop');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationxrlink`
--

CREATE TABLE IF NOT EXISTS `tbllocationxrlink` (
  `intLocationXRLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intFromLocationID` int(11) NOT NULL,
  `intToLocationID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationXRLinkID`),
  KEY `fk_intFromLocationID` (`intFromLocationID`),
  KEY `fk_intToLocationID` (`intToLocationID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbllocationxrlink`
--

INSERT INTO `tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES
(2, 2, 6, 'Home'),
(9, 3, 7, 'Tailor'),
(10, 3, 8, 'Blacksmith'),
(11, 3, 9, 'Apothecary'),
(12, 3, 10, 'Grocer'),
(14, 4, 11, 'University of the Arcane');

-- --------------------------------------------------------

--
-- Table structure for table `tblmodifier`
--

CREATE TABLE IF NOT EXISTS `tblmodifier` (
  `intModifierID` int(11) NOT NULL AUTO_INCREMENT,
  `strModifierName` varchar(45) NOT NULL,
  `strModifierType` enum('Prefix','Suffix') NOT NULL,
  `strModifierXML` varchar(45) NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblmodifierstatchanges`
--

CREATE TABLE IF NOT EXISTS `tblmodifierstatchanges` (
  `intModifierStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intModifierID` int(11) NOT NULL,
  `strStatName` varchar(45) NOT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  PRIMARY KEY (`intModifierStatChangeID`),
  KEY `intModifierID` (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblnpc`
--

CREATE TABLE IF NOT EXISTS `tblnpc` (
  `intNPCID` int(11) NOT NULL AUTO_INCREMENT,
  `strNPCName` varchar(45) NOT NULL,
  `intWeight` int(11) NOT NULL,
  `intHeight` int(11) NOT NULL,
  `intExperienceGiven` int(11) NOT NULL,
  `intGoldDropMin` int(11) NOT NULL,
  `intGoldDropMax` int(11) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intNPCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblnpc`
--

INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Goblin', 120, 150, 800, 0, 5, '2014-10-25 14:22:34', 'akereliuk', NULL, NULL),
(2, 'Seraphine the Tutorial Fairy', 50, 100, 1600, 0, 0, '2014-11-15 16:38:52', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcitemxr`
--

CREATE TABLE IF NOT EXISTS `tblnpcitemxr` (
  `intNPCItemXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `blnEquipped` tinyint(1) NOT NULL DEFAULT '0',
  `blnDropped` tinyint(1) NOT NULL DEFAULT '0',
  `intDropRating` int(11) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intNPCItemXRID`),
  KEY `intNPCID` (`intNPCID`,`intItemID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblnpcitemxr`
--

INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES
(1, 1, 3, 1, 1, 2000, '2014-10-25 19:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcmodifierxr`
--

CREATE TABLE IF NOT EXISTS `tblnpcmodifierxr` (
  `intNPCModifierXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intModifierID` int(11) NOT NULL,
  `intOccurrence` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intNPCModifierXRID`),
  KEY `intNPCID` (`intNPCID`),
  KEY `intModifierID` (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcstats`
--

CREATE TABLE IF NOT EXISTS `tblnpcstats` (
  `intNPCStatsID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intMaxHP` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL,
  `intIntelligence` int(11) NOT NULL,
  `intAgility` int(11) NOT NULL,
  `intVitality` int(11) NOT NULL,
  `intWillpower` int(11) NOT NULL,
  `intDexterity` int(11) NOT NULL,
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  PRIMARY KEY (`intNPCStatsID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblnpcstats`
--

INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES
(1, 1, 8, 5, 5, 5, 5, 5, 5, 0, 150, 0, 0, 10),
(2, 2, 8, 2, 2, 2, 2, 2, 2, 0, 150, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbloverride`
--

CREATE TABLE IF NOT EXISTS `tbloverride` (
  `intOverrideID` int(11) NOT NULL AUTO_INCREMENT,
  `strOverrideName` varchar(45) NOT NULL,
  `strOverrideDesc` text NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intOverrideID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbloverride`
--

INSERT INTO `tbloverride` (`intOverrideID`, `strOverrideName`, `strOverrideDesc`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Armour Binding', 'Player cannot unequip their armour; must wait until it tears or falls off. Additionally, armour is always tight.', '2014-11-04 21:27:39', 'akereliuk', NULL, NULL),
(2, 'Stretchy Armour', 'Armour adjusts to player weight; always skintight.', '2014-11-04 21:27:39', 'akereliuk', NULL, NULL),
(3, 'Allow Equip Tab', 'Allows \r\n\r\nuser to access equip tab during events, but equipping anything will not cause a new event to occur with this override \r\n\r\nset.', '2014-11-13 21:08:16', 'akereliuk', NULL, NULL),
(4, 'Burdened by Weight', 'Lowers Agility stat based on the user''s BMI.', '2014-12-08 15:59:48', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpost`
--

CREATE TABLE IF NOT EXISTS `tblpost` (
  `intPostID` int(11) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strSubject` varchar(45) NOT NULL,
  `txtContents` text NOT NULL,
  `intParentID` int(11) DEFAULT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intPostID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblrpgcharacter`
--

CREATE TABLE IF NOT EXISTS `tblrpgcharacter` (
  `intRPGCharacterID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strRPGCharacterName` varchar(45) NOT NULL,
  `intHeight` int(11) NOT NULL DEFAULT '165',
  `dblWeight` double NOT NULL,
  `intDigestionRate` int(11) NOT NULL DEFAULT '250',
  `intFloorID` int(11) NOT NULL DEFAULT '1',
  `intCurrentFloorID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL DEFAULT '1',
  `intEventNodeID` int(11) NOT NULL DEFAULT '0',
  `intStateID` int(8) NOT NULL DEFAULT '0',
  `intTownID` int(8) DEFAULT NULL,
  `intLocationID` int(11) NOT NULL DEFAULT '6',
  `intDay` int(11) NOT NULL DEFAULT '1',
  `strTime` varchar(5) NOT NULL DEFAULT '00:00',
  `strGender` enum('Female','Male') NOT NULL DEFAULT 'Female',
  `strOrientation` enum('Heterosexual','Homosexual','Bisexual') NOT NULL DEFAULT 'Heterosexual',
  `strPersonality` enum('Shy','Outgoing','Stoic') NOT NULL DEFAULT 'Shy',
  `strFatStance` enum('Negative','Positive','Neutral') NOT NULL DEFAULT 'Negative',
  `strEyeColour` enum('Brown','Blue','Green','Black','Red','White') NOT NULL DEFAULT 'Brown',
  `strHairColour` enum('Brown','Blonde','Black','Red','Brunette','White','Orange','Green','Blue','Pink','Yellow','Purple') NOT NULL DEFAULT 'Brown',
  `strHairLength` enum('Short','Medium','Shoulder Length','Long') NOT NULL DEFAULT 'Short',
  `strEthnicity` enum('White','Peach','Tan','Brown','Black','Olive') NOT NULL DEFAULT 'White',
  `intLevel` int(11) NOT NULL DEFAULT '1',
  `intExperience` int(11) NOT NULL DEFAULT '0',
  `intCurrentHP` int(11) NOT NULL DEFAULT '10',
  `intStatPoints` int(11) NOT NULL DEFAULT '0',
  `intGold` int(11) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intRPGCharacterID`),
  KEY `intUserID` (`strUserID`),
  KEY `intFloorID` (`intFloorID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=84 ;

--
-- Dumping data for table `tblrpgcharacter`
--

INSERT INTO `tblrpgcharacter` (`intRPGCharacterID`, `strUserID`, `strRPGCharacterName`, `intHeight`, `dblWeight`, `intDigestionRate`, `intFloorID`, `intCurrentFloorID`, `intEventID`, `intEventNodeID`, `intStateID`, `intTownID`, `intLocationID`, `intDay`, `strTime`, `strGender`, `strOrientation`, `strPersonality`, `strFatStance`, `strEyeColour`, `strHairColour`, `strHairLength`, `strEthnicity`, `intLevel`, `intExperience`, `intCurrentHP`, `intStatPoints`, `intGold`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(79, 'test', 'Test', 152, 115.5, 250, 1, 1, 10, 1, 1, 0, 0, 2, '10:45', 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 2, 1600, 9, 5, 3, '2016-04-08 21:30:14', 'system', NULL, NULL),
(80, 'test', 'Test2', 152, 261.375, 250, 1, 0, 12, 0, 4, 1, 2, 4, '3:15', 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 4, 2400, 13, 5, 26, '2016-04-08 22:46:42', 'system', NULL, NULL),
(82, 'test', 'Alessia', 157, 247.013, 250, 1, 0, 11, 0, 4, 1, 10, 3, '13:00', 'Female', 'Homosexual', 'Shy', 'Negative', 'Green', 'Red', 'Medium', 'White', 3, 800, 13, 5, 0, '2016-04-10 21:46:09', 'system', NULL, NULL),
(83, 'test', 'Vienna', 157, 403.25, 250, 1, 1, 7, 0, 1, 0, 0, 7, '18:45', 'Female', 'Heterosexual', 'Shy', 'Negative', 'Brown', 'Brown', 'Short', 'White', 5, 8000, 13, 0, 42, '2016-04-10 22:05:58', 'system', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblshop`
--

CREATE TABLE IF NOT EXISTS `tblshop` (
  `intShopID` int(11) NOT NULL AUTO_INCREMENT,
  `strShopName` varchar(45) NOT NULL,
  `txtShopDesc` text,
  `strShopType` varchar(45) NOT NULL,
  PRIMARY KEY (`intShopID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblshop`
--

INSERT INTO `tblshop` (`intShopID`, `strShopName`, `txtShopDesc`, `strShopType`) VALUES
(1, 'Turician Tailor', 'Buy clothes.', 'Tailor'),
(2, 'Turician Blacksmith', 'Buy armour and weapons.', 'Blacksmith'),
(3, 'Turician Apothecary', 'Buy potions.', 'Apothecary'),
(4, 'Turician Grocer', 'Buy food.', 'Grocer');

-- --------------------------------------------------------

--
-- Table structure for table `tblshopitemxr`
--

CREATE TABLE IF NOT EXISTS `tblshopitemxr` (
  `intShopItemID` int(11) NOT NULL AUTO_INCREMENT,
  `intShopID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `dblPrice` double NOT NULL,
  PRIMARY KEY (`intShopItemID`),
  KEY `fk_intShopID` (`intShopID`),
  KEY `fk_intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblshopitemxr`
--

INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES
(2, 2, 3, 1),
(3, 3, 5, 1),
(4, 4, 1, 1),
(5, 1, 7, 1),
(6, 1, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstates`
--

CREATE TABLE IF NOT EXISTS `tblstates` (
  `intStateID` int(11) NOT NULL AUTO_INCREMENT,
  `strStateName` varchar(45) NOT NULL,
  `txtDescription` text,
  PRIMARY KEY (`intStateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tblstates`
--

INSERT INTO `tblstates` (`intStateID`, `strStateName`, `txtDescription`) VALUES
(1, 'Event', 'User is currently within an event.'),
(2, 'Combat', 'User is entered in combat.'),
(3, 'Field', 'User is in an open field where enemies and events can occur.'),
(4, 'Town', 'User is in a town where events can occur.'),
(5, 'Dungeon', 'User is in a dungeon where enemies and events can occur.'),
(6, 'Shop', 'User is currently inside a shop window.'),
(7, 'Dead', 'User is currently dead and needs to be revived.'),
(8, 'Tutorial', 'User is currently in tutorial.'),
(9, 'Stats', 'Stat gain window');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatuseffect`
--

CREATE TABLE IF NOT EXISTS `tblstatuseffect` (
  `intStatusEffectID` int(11) NOT NULL AUTO_INCREMENT,
  `strStatusEffectName` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intStatusEffectID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblstatuseffect`
--

INSERT INTO `tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Fattening I', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(2, 'Armour Binding', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(3, 'Stretchy Armour', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(4, 'Burdened by Weight', '2014-12-08 15:59:48', 'akereliuk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstatuseffectstatchange`
--

CREATE TABLE IF NOT EXISTS `tblstatuseffectstatchange` (
  `intStatusEffectStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intStatusEffectID` int(11) NOT NULL,
  `strStatName` varchar(45) NOT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intOverrideID` int(11) DEFAULT NULL,
  `blnInfinite` tinyint(1) NOT NULL DEFAULT '1',
  `intDuration` int(11) DEFAULT NULL,
  `blnIncremental` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intStatusEffectStatChangeID`),
  KEY `intStatusEffectID` (`intStatusEffectID`),
  KEY `intOverrideID` (`intOverrideID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tblstatuseffectstatchange`
--

INSERT INTO `tblstatuseffectstatchange` (`intStatusEffectStatChangeID`, `intStatusEffectID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intOverrideID`, `blnInfinite`, `intDuration`, `blnIncremental`) VALUES
(4, 1, 'Weight', 1, 3, NULL, 1, 9999, 1),
(5, 2, '', 0, 0, 1, 1, 9999, 0),
(6, 3, '', 0, 0, 2, 1, 9999, 0),
(7, 4, '', 0, 0, 4, 1, 9999, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltown`
--

CREATE TABLE IF NOT EXISTS `tbltown` (
  `intTownID` int(11) NOT NULL AUTO_INCREMENT,
  `strTownName` varchar(45) NOT NULL,
  PRIMARY KEY (`intTownID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbltown`
--

INSERT INTO `tbltown` (`intTownID`, `strTownName`) VALUES
(1, 'Turici');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `intUserID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strPassword` varchar(45) NOT NULL,
  `blnAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intUserID`),
  UNIQUE KEY `strUserID` (`strUserID`),
  UNIQUE KEY `intUserID` (`intUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`intUserID`, `strUserID`, `strPassword`, `blnAdmin`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'bob', 'd7ae1fac04054938fd85d247cc82e80f', 0, '2015-04-14 02:22:54', 'system', NULL, NULL),
(2, 'test', 'd7ae1fac04054938fd85d247cc82e80f', 0, '2016-02-03 20:55:08', 'system', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcharacterabilitystats`
--
ALTER TABLE `tblcharacterabilitystats`
  ADD CONSTRAINT `tblcharacterabilitystats_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacterbody`
--
ALTER TABLE `tblcharacterbody`
  ADD CONSTRAINT `fk_tblcharacterbody_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharactereventxr`
--
ALTER TABLE `tblcharactereventxr`
  ADD CONSTRAINT `tblcharactereventxr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacteritemxr`
--
ALTER TABLE `tblcharacteritemxr`
  ADD CONSTRAINT `tblcharacteritemxr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacteritemxr_ibfk_2` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacteroverridexr`
--
ALTER TABLE `tblcharacteroverridexr`
  ADD CONSTRAINT `tblcharacteroverridexr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacteroverridexr_ibfk_2` FOREIGN KEY (`intOverrideID`) REFERENCES `tbloverride` (`intOverrideID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacterstats`
--
ALTER TABLE `tblcharacterstats`
  ADD CONSTRAINT `tblcharacterstats_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacterstatuseffectxr`
--
ALTER TABLE `tblcharacterstatuseffectxr`
  ADD CONSTRAINT `tblcharacterstatuseffectxr_ibfk_1` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacterstatuseffectxr_ibfk_2` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblcharacterstatuseffectxr_ibfk_3` FOREIGN KEY (`intItemInstanceID`) REFERENCES `tblcharacteritemxr` (`intItemInstanceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblclothingdesc`
--
ALTER TABLE `tblclothingdesc`
  ADD CONSTRAINT `fk_intClothingDescItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblenchantstatchanges`
--
ALTER TABLE `tblenchantstatchanges`
  ADD CONSTRAINT `fk_tblStatusEffectStatChanges_intStatusEffectID` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblenchantstatchanges_ibfk_1` FOREIGN KEY (`intEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblflooreventxr`
--
ALTER TABLE `tblflooreventxr`
  ADD CONSTRAINT `tblflooreventxr_ibfk_1` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblflooreventxr_ibfk_2` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblitemenchantxr`
--
ALTER TABLE `tblitemenchantxr`
  ADD CONSTRAINT `tblitemenchantxr_ibfk_1` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblitemenchantxr_ibfk_2` FOREIGN KEY (`intEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbliteminstanceenchant`
--
ALTER TABLE `tbliteminstanceenchant`
  ADD CONSTRAINT `tbliteminstanceenchant_ibfk_1` FOREIGN KEY (`intItemInstanceID`) REFERENCES `tblcharacteritemxr` (`intItemInstanceID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbliteminstanceenchant_ibfk_2` FOREIGN KEY (`intSuffixEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbliteminstanceenchant_ibfk_3` FOREIGN KEY (`intPrefixEnchantID`) REFERENCES `tblenchant` (`intEnchantID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbllocation`
--
ALTER TABLE `tbllocation`
  ADD CONSTRAINT `fk_intTownID` FOREIGN KEY (`intTownID`) REFERENCES `tbltown` (`intTownID`);

--
-- Constraints for table `tbllocationeventlink`
--
ALTER TABLE `tbllocationeventlink`
  ADD CONSTRAINT `fk_intEventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`),
  ADD CONSTRAINT `fk_intLocationID` FOREIGN KEY (`intLocationID`) REFERENCES `tbllocation` (`intLocationID`);

--
-- Constraints for table `tbllocationshoplink`
--
ALTER TABLE `tbllocationshoplink`
  ADD CONSTRAINT `fk_intLocationID2` FOREIGN KEY (`intLocationID`) REFERENCES `tbllocation` (`intLocationID`),
  ADD CONSTRAINT `fk_intShopID2` FOREIGN KEY (`intShopID`) REFERENCES `tblshop` (`intShopID`);

--
-- Constraints for table `tbllocationxrlink`
--
ALTER TABLE `tbllocationxrlink`
  ADD CONSTRAINT `fk_intFromLocationID` FOREIGN KEY (`intFromLocationID`) REFERENCES `tbllocation` (`intLocationID`),
  ADD CONSTRAINT `fk_intToLocationID` FOREIGN KEY (`intToLocationID`) REFERENCES `tbllocation` (`intLocationID`);

--
-- Constraints for table `tblmodifierstatchanges`
--
ALTER TABLE `tblmodifierstatchanges`
  ADD CONSTRAINT `tblmodifierstatchanges_ibfk_1` FOREIGN KEY (`intModifierID`) REFERENCES `tblmodifier` (`intModifierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcitemxr`
--
ALTER TABLE `tblnpcitemxr`
  ADD CONSTRAINT `tblnpcitemxr_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblnpcitemxr_ibfk_2` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcmodifierxr`
--
ALTER TABLE `tblnpcmodifierxr`
  ADD CONSTRAINT `tblnpcmodifierxr_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblnpcmodifierxr_ibfk_2` FOREIGN KEY (`intModifierID`) REFERENCES `tblmodifier` (`intModifierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcstats`
--
ALTER TABLE `tblnpcstats`
  ADD CONSTRAINT `tblnpcstats_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblrpgcharacter`
--
ALTER TABLE `tblrpgcharacter`
  ADD CONSTRAINT `tblrpgcharacter_ibfk_1` FOREIGN KEY (`strUserID`) REFERENCES `tbluser` (`strUserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblrpgcharacter_ibfk_2` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tblrpgcharacter_ibfk_3` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblshopitemxr`
--
ALTER TABLE `tblshopitemxr`
  ADD CONSTRAINT `fk_intItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`),
  ADD CONSTRAINT `fk_intShopID` FOREIGN KEY (`intShopID`) REFERENCES `tblshop` (`intShopID`);

--
-- Constraints for table `tblstatuseffectstatchange`
--
ALTER TABLE `tblstatuseffectstatchange`
  ADD CONSTRAINT `tblstatuseffectstatchange_ibfk_1` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblstatuseffectstatchange_ibfk_2` FOREIGN KEY (`intOverrideID`) REFERENCES `tbloverride` (`intOverrideID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
