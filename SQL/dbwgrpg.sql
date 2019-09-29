-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 29, 2019 at 01:59 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbwgrpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcharacterabilitystats`
--

DROP TABLE IF EXISTS `tblcharacterabilitystats`;
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
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacterbody`
--

DROP TABLE IF EXISTS `tblcharacterbody`;
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
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharactercheckpointxr`
--

DROP TABLE IF EXISTS `tblcharactercheckpointxr`;
CREATE TABLE IF NOT EXISTS `tblcharactercheckpointxr` (
  `intCharacterCheckpointXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intCheckpointID` int(11) NOT NULL,
  `dtmLastViewed` datetime NOT NULL,
  `intTimesViewed` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterCheckpointXRID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacterclassxr`
--

DROP TABLE IF EXISTS `tblcharacterclassxr`;
CREATE TABLE IF NOT EXISTS `tblcharacterclassxr` (
  `intCharacterClassXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intClassID` int(11) NOT NULL,
  `intClassLevel` int(11) NOT NULL,
  `intClassExperience` int(11) NOT NULL,
  `blnCurrentClass` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intCharacterClassXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intClassID` (`intClassID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharactereventxr`
--

DROP TABLE IF EXISTS `tblcharactereventxr`;
CREATE TABLE IF NOT EXISTS `tblcharactereventxr` (
  `intCharacterEventXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intCharacterEventXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`,`intEventID`)
) ENGINE=InnoDB AUTO_INCREMENT=5209 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacteritemxr`
--

DROP TABLE IF EXISTS `tblcharacteritemxr`;
CREATE TABLE IF NOT EXISTS `tblcharacteritemxr` (
  `intItemInstanceID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intCaloriesRemaining` int(11) DEFAULT NULL,
  `blnDigesting` tinyint(4) NOT NULL DEFAULT '0',
  `blnEquipped` tinyint(4) NOT NULL DEFAULT '0',
  `strSize` enum('XS','S','M','L','XL','XXL','XXXL','XXXXL','Stretch') DEFAULT NULL,
  `blnRipped` tinyint(1) NOT NULL DEFAULT '0',
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intItemInstanceID`),
  KEY `intCharacterID` (`intRPGCharacterID`,`intItemID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=2046 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacteroverridexr`
--

DROP TABLE IF EXISTS `tblcharacteroverridexr`;
CREATE TABLE IF NOT EXISTS `tblcharacteroverridexr` (
  `intCharacterOverrideXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intOverrideID` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterOverrideXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intRPGCharacterID_2` (`intRPGCharacterID`),
  KEY `intOverrideID` (`intOverrideID`)
) ENGINE=InnoDB AUTO_INCREMENT=1074 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacterquestkillreqxr`
--

DROP TABLE IF EXISTS `tblcharacterquestkillreqxr`;
CREATE TABLE IF NOT EXISTS `tblcharacterquestkillreqxr` (
  `intCharacterQuestKillReqXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intQuestID` int(11) NOT NULL,
  `intKillReqID` int(11) NOT NULL,
  `intRPGCharacterID` int(11) NOT NULL,
  `dtmStarted` datetime NOT NULL,
  `dtmCompleted` datetime NOT NULL,
  `intCurrentCount` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterQuestKillReqXRID`),
  KEY `intQuestID` (`intQuestID`),
  KEY `intKillReqID` (`intKillReqID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacterquestxr`
--

DROP TABLE IF EXISTS `tblcharacterquestxr`;
CREATE TABLE IF NOT EXISTS `tblcharacterquestxr` (
  `intCharacterQuestXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intQuestID` int(11) NOT NULL,
  `dtmStarted` datetime NOT NULL,
  `dtmCompleted` datetime NOT NULL,
  `blnActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`intCharacterQuestXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intQuestID` (`intQuestID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacterstats`
--

DROP TABLE IF EXISTS `tblcharacterstats`;
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
  `intAccuracy` int(11) NOT NULL DEFAULT '0',
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  `intMaxHunger` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`intCharacterStatsID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcharacterstatuseffectxr`
--

DROP TABLE IF EXISTS `tblcharacterstatuseffectxr`;
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
) ENGINE=InnoDB AUTO_INCREMENT=792 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblcheckpoint`
--

DROP TABLE IF EXISTS `tblcheckpoint`;
CREATE TABLE IF NOT EXISTS `tblcheckpoint` (
  `intCheckpointID` int(11) NOT NULL AUTO_INCREMENT,
  `strCheckpointName` varchar(45) NOT NULL,
  `txtCheckpointDesc` text NOT NULL,
  PRIMARY KEY (`intCheckpointID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcheckpoint`
--

INSERT INTO `tblcheckpoint` (`intCheckpointID`, `strCheckpointName`, `txtCheckpointDesc`) VALUES
(1, 'Unknown', ''),
(2, 'Unknown', ''),
(3, 'Unknown', ''),
(4, 'Approached Norman', 'Approached Norman at the Library in University of Arcane.'),
(5, 'Unknown', ''),
(6, 'Turn In Warrior Quest', 'Turned in Warrior Quest.');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

DROP TABLE IF EXISTS `tblclass`;
CREATE TABLE IF NOT EXISTS `tblclass` (
  `intClassID` int(11) NOT NULL AUTO_INCREMENT,
  `strClassName` varchar(45) NOT NULL,
  `txtClassDescription` text NOT NULL,
  PRIMARY KEY (`intClassID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`intClassID`, `strClassName`, `txtClassDescription`) VALUES
(1, 'Merchant', 'A class that is more concerned with earning money than increasing their combat prowess. Usually hires mercenaries to fight for them.'),
(2, 'Feeder', 'A class that is focused on feeding your enemies and allies during and outside of battle. Uses old fashioned methods instead of the arcane.'),
(3, 'Manipulator', 'A class that manipulates their surrounding environment to create a favourable situation during battle.'),
(4, 'Warrior', 'A class that is focused on brute strength and willpower, at home on the front lines of a battle.'),
(5, 'Caster', 'A class that is focused on expelling mana in powerful ways, often manipulating the elements in their spellcasting forays.');

-- --------------------------------------------------------

--
-- Table structure for table `tblclassskillxr`
--

DROP TABLE IF EXISTS `tblclassskillxr`;
CREATE TABLE IF NOT EXISTS `tblclassskillxr` (
  `intClassSkillXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intClassID` int(11) NOT NULL,
  `intSkillID` int(11) NOT NULL,
  `intRequiredClassLevel` int(11) NOT NULL,
  PRIMARY KEY (`intClassSkillXRID`),
  KEY `intClassID` (`intClassID`),
  KEY `intSkillID` (`intSkillID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclassskillxr`
--

INSERT INTO `tblclassskillxr` (`intClassSkillXRID`, `intClassID`, `intSkillID`, `intRequiredClassLevel`) VALUES
(1, 2, 1, 1),
(2, 3, 2, 1),
(3, 4, 10, 5),
(4, 4, 11, 10),
(5, 4, 12, 15),
(6, 5, 7, 5),
(7, 5, 8, 10),
(8, 5, 9, 15),
(9, 4, 3, 1),
(10, 5, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblclothingdesc`
--

DROP TABLE IF EXISTS `tblclothingdesc`;
CREATE TABLE IF NOT EXISTS `tblclothingdesc` (
  `intClothingDescID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemID` int(11) NOT NULL,
  `strXML` varchar(45) NOT NULL,
  PRIMARY KEY (`intClothingDescID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclothingdesc`
--

INSERT INTO `tblclothingdesc` (`intClothingDescID`, `intItemID`, `strXML`) VALUES
(3, 6, 'Both/cuirass.xml'),
(4, 7, 'Tops/tanktop.xml'),
(5, 8, 'Bottoms/jeans.xml'),
(6, 22, 'Both/leathermail.xml'),
(7, 23, 'Tops/succubuscorset.xml');

-- --------------------------------------------------------

--
-- Table structure for table `tblenchant`
--

DROP TABLE IF EXISTS `tblenchant`;
CREATE TABLE IF NOT EXISTS `tblenchant` (
  `intEnchantID` int(11) NOT NULL AUTO_INCREMENT,
  `strEnchantName` varchar(45) NOT NULL,
  `strEnchantType` enum('Prefix','Suffix') NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEnchantID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblenchant`
--

INSERT INTO `tblenchant` (`intEnchantID`, `strEnchantName`, `strEnchantType`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Fattening', 'Prefix', '2014-11-04 21:26:02', 'akereliuk', NULL, NULL),
(2, 'Eternally Binding', 'Suffix', '2014-11-04 21:26:02', 'akereliuk', NULL, NULL),
(3, 'Resilient', 'Prefix', '2016-09-11 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblenchantstatchanges`
--

DROP TABLE IF EXISTS `tblenchantstatchanges`;
CREATE TABLE IF NOT EXISTS `tblenchantstatchanges` (
  `intEnchantStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intEnchantID` int(11) NOT NULL,
  `strStatName` varchar(45) DEFAULT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intStatusEffectID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intEnchantStatChangeID`),
  KEY `intEnchantID` (`intEnchantID`),
  KEY `intStatusEffectID` (`intStatusEffectID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblenchantstatchanges`
--

INSERT INTO `tblenchantstatchanges` (`intEnchantStatChangeID`, `intEnchantID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intStatusEffectID`) VALUES
(1, 1, NULL, 0, 0, 1),
(2, 2, NULL, 0, 0, 2),
(3, 2, NULL, 0, 0, 3),
(6, 3, 'Willpower', 0, 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblevent`
--

DROP TABLE IF EXISTS `tblevent`;
CREATE TABLE IF NOT EXISTS `tblevent` (
  `intEventID` int(11) NOT NULL AUTO_INCREMENT,
  `strEventName` varchar(45) NOT NULL,
  `txtEventDesc` text,
  `strXML` varchar(45) NOT NULL,
  `strEventType` varchar(45) NOT NULL DEFAULT 'Event',
  `blnRepeating` tinyint(1) NOT NULL DEFAULT '1',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEventID`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblevent`
--

INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Standstill', 'No event', 'standstill.xml', 'Standstill', 1, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(2, 'Tutorial Fairy', 'Character gets to talk to Tutorial Fairy', 'tutorialFairy.xml', 'Start Event', 0, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(3, 'Weight Gain', 'Character gains weight', 'weightgain.xml', 'Event', 1, '2014-09-27 00:00:00', 'akereliuk', NULL, NULL),
(4, 'Eat Burger', 'Character eats burger', 'eatburger.xml', 'Event', 1, '2014-10-02 00:00:00', 'akereliuk', NULL, NULL),
(11, 'Leave Tower Event Long', 'When user leaves the tower for the first time to enter city.', 'leaveTowerLong.xml', 'Event', 0, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(12, 'Leave Tower Event Short', 'When user leaves the tower after the first time.', 'leaveTowerShort.xml', 'Event', 1, '2016-02-12 00:00:00', 'admin', NULL, NULL),
(13, 'Sleep at Home', 'Character sleeps in their room at home.', 'sleepAtHome.xml', 'Event', 1, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(14, 'Look at Home Mirror', 'Take a look at yourself in your full body mirror at home.', 'mirrorAtHome.xml', 'Event', 1, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(15, 'Reset Stats at UoA', 'Reset your stats at the University of the Arcane.', 'resetStatsUoA.xml', 'Event', 1, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(16, 'Disenchant Armour at UoA', 'Disenchant your currently equipped armour at the University of the Arcane.', 'disenchantAtUoA.xml', 'Event', 1, '2016-02-18 00:00:00', 'admin', NULL, NULL),
(17, 'Generic Combat', 'User given choice to engage in combat.', 'genericCombat.xml', 'Forced Combat', 1, '2016-06-15 00:00:00', 'admin', NULL, NULL),
(18, 'Generic Forced Combat', 'User is thrust into battle.', 'genericForceCombat.xml', 'Combat', 1, '2016-06-15 00:00:00', 'admin', NULL, NULL),
(19, 'Floor 1 Boss', 'Fight the goblin chief at the end of floor 1.', 'floor1Boss.xml', 'End Event', 1, '2016-07-16 00:00:00', 'admin', NULL, NULL),
(20, 'Generic Descend Floor', 'Shows staircase down and option to descend.', 'genericDescend.xml', 'Event', 1, '2016-07-16 00:00:00', 'admin', NULL, NULL),
(21, 'Generic Ascend Floor', 'Show staircase up and option to ascend.', 'genericAscend.xml', 'Event', 1, '2016-07-16 00:00:00', 'admin', NULL, NULL),
(22, 'Floor 2 Boss', 'Fight the succubus at the end of floor 2.', 'floor2Boss.xml', 'End Event', 1, '2016-07-21 00:00:00', 'admin', NULL, NULL),
(23, 'Banquet Table', 'Player comes across a large banquet table and relies on willpower to resist eating from it.', 'banquet.xml', 'Event', 1, '2016-08-15 00:00:00', 'admin', NULL, NULL),
(24, 'Crevice in the Wall', 'Player comes across a crevice in the wall with something glittering just out of reach.', 'crevice.xml', 'Event', 1, '2016-08-16 00:00:00', 'admin', NULL, NULL),
(25, 'Heavy Rock', 'Player comes across a rock with an item protruding.', 'heavyrock.xml', 'Event', 1, '2016-08-16 00:00:00', 'kestrel', NULL, NULL),
(26, 'Floor 2 Standstill', 'Floor 2\'s standstill event.', 'standstill2.xml', 'Standstill', 1, '2016-08-31 00:00:00', 'Droark', NULL, NULL),
(27, 'Seraphine 2nd Convo', 'Seraphine\'s 2nd conversation.', 'seraphine2.xml', 'Event', 0, '2016-09-11 00:00:00', 'admin', NULL, NULL),
(28, 'Trapped Chest', 'Player comes across a locked chest and is given the opportunity to disarm the trap or avoid it.', 'lockedchest.xml', 'Event', 1, '2016-09-17 00:00:00', 'kestrel', NULL, NULL),
(29, 'Blue Water', NULL, 'bluewater.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(30, 'Creamy Water', NULL, 'creamywater.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(31, 'Murky Water', NULL, 'murkywater.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(32, 'Orange Goop', NULL, 'orangegoop.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(33, 'Patchy Mushroom', NULL, 'patchymushroom.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(34, 'Purple Goop', NULL, 'purplegoop.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(35, 'Red Water', NULL, 'redwater.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(36, 'Spotted Mushroom', NULL, 'spottedmushroom.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(37, 'Tainted Water', NULL, 'taintedwater.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(38, 'Floor 3 Boss', NULL, 'floor3Boss.xml', 'End Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(39, 'Floor 3 Standstill', NULL, 'standstill3.xml', 'Standstill', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(40, 'Norman Event 1', NULL, 'norman1.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(41, 'Norman Event 2', NULL, 'norman2.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(42, 'Iyanna Event 1', NULL, 'iyanna1.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(43, 'Iyanna Event 2', NULL, 'iyanna2.xml', 'Event', 1, '2019-09-26 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbleventconversation`
--

DROP TABLE IF EXISTS `tbleventconversation`;
CREATE TABLE IF NOT EXISTS `tbleventconversation` (
  `intEventConversationID` int(11) NOT NULL AUTO_INCREMENT,
  `intEventID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intConversationLevel` int(11) NOT NULL,
  PRIMARY KEY (`intEventConversationID`),
  KEY `intEventID` (`intEventID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbleventconversation`
--

INSERT INTO `tbleventconversation` (`intEventConversationID`, `intEventID`, `intNPCID`, `intConversationLevel`) VALUES
(1, 2, 2, 0),
(2, 27, 2, 1),
(3, 40, 15, 0),
(4, 41, 15, 1),
(5, 42, 16, 0),
(6, 43, 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbleventitemxr`
--

DROP TABLE IF EXISTS `tbleventitemxr`;
CREATE TABLE IF NOT EXISTS `tbleventitemxr` (
  `intEventItemXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intEventID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intDrawGroup` int(11) NOT NULL DEFAULT '1',
  `intOccurrenceRating` int(11) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`intEventItemXRID`),
  KEY `intEventID` (`intEventID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbleventitemxr`
--

INSERT INTO `tbleventitemxr` (`intEventItemXRID`, `intEventID`, `intItemID`, `intDrawGroup`, `intOccurrenceRating`) VALUES
(1, 24, 9, 1, 1000),
(2, 24, 26, 1, 1000),
(3, 24, 28, 1, 1000),
(4, 24, 32, 1, 1000),
(5, 24, 33, 1, 1000),
(6, 24, 34, 1, 300),
(7, 25, 14, 1, 5000),
(8, 25, 35, 1, 1000),
(9, 28, 18, 1, 1000),
(10, 28, 45, 1, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tblexperiencechart`
--

DROP TABLE IF EXISTS `tblexperiencechart`;
CREATE TABLE IF NOT EXISTS `tblexperiencechart` (
  `intLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `intExpToLvl` int(11) NOT NULL,
  `intCumulativeExp` int(11) NOT NULL,
  PRIMARY KEY (`intLevelID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `tblfloor`;
CREATE TABLE IF NOT EXISTS `tblfloor` (
  `intFloorID` int(11) NOT NULL AUTO_INCREMENT,
  `strFloorName` varchar(45) NOT NULL,
  `strFloorType` varchar(45) NOT NULL DEFAULT 'Town',
  `intDimension` int(11) NOT NULL DEFAULT '10',
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intFloorID`),
  UNIQUE KEY `intFloorID` (`intFloorID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfloor`
--

INSERT INTO `tblfloor` (`intFloorID`, `strFloorName`, `strFloorType`, `intDimension`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES
(1, 'Beginner Floor 1', 'Field', 7, 'akereliuk', '2014-09-20 00:00:00', NULL, NULL),
(2, 'Dungeon Floor', 'Field', 5, 'admin', '2016-07-19 00:00:00', NULL, NULL),
(3, 'Swamp Floor', 'Field', 3, 'admin', '2019-09-26 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblflooreventxr`
--

DROP TABLE IF EXISTS `tblflooreventxr`;
CREATE TABLE IF NOT EXISTS `tblflooreventxr` (
  `intFloorEventXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intFloorID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `intOccurrenceRating` int(11) NOT NULL,
  `intCountPerFloor` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`intFloorEventXRID`),
  KEY `intFloorID` (`intFloorID`,`intEventID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblflooreventxr`
--

INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`, `intCountPerFloor`) VALUES
(1, 1, 1, 9999, 1),
(2, 1, 3, 1000, 1),
(3, 1, 4, 1000, 1),
(6, 1, 2, 9999, 1),
(7, 1, 19, 9999, 1),
(9, 2, 22, 9999, 1),
(10, 2, 23, 1000, 1),
(11, 1, 24, 1000, 1),
(12, 1, 25, 1000, 1),
(13, 2, 26, 9999, 1),
(14, 2, 27, 1000, 1),
(15, 1, 28, 1000, 1),
(16, 3, 29, 100, 1),
(17, 3, 30, 100, 1),
(18, 3, 31, 100, 1),
(19, 3, 32, 100, 1),
(20, 3, 33, 100, 1),
(21, 3, 34, 100, 1),
(22, 3, 35, 100, 1),
(23, 3, 36, 100, 1),
(24, 3, 37, 100, 1),
(25, 3, 38, 9999, 1),
(26, 3, 39, 9999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblfloornpcxr`
--

DROP TABLE IF EXISTS `tblfloornpcxr`;
CREATE TABLE IF NOT EXISTS `tblfloornpcxr` (
  `intFloorNPCXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intFloorID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intNPCID2` int(11) NOT NULL,
  `intNPCID3` int(11) NOT NULL,
  `intOccurrenceRating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intFloorNPCXRID`),
  KEY `intFloorID` (`intFloorID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfloornpcxr`
--

INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intNPCID2`, `intNPCID3`, `intOccurrenceRating`) VALUES
(1, 1, 1, 0, 0, 1000),
(2, 1, 2, 0, 0, 9999),
(3, 1, 3, 0, 0, 1000),
(4, 1, 5, 0, 0, 9999),
(5, 2, 4, 0, 0, 1000),
(6, 2, 6, 0, 0, 1000),
(7, 2, 8, 0, 0, 9999),
(8, 2, 7, 0, 0, 1000),
(9, 2, 2, 0, 0, 9999),
(10, 3, 9, 0, 0, 100),
(11, 3, 10, 0, 0, 100),
(12, 3, 11, 0, 0, 100),
(13, 3, 12, 0, 0, 100),
(14, 3, 13, 0, 0, 100),
(15, 3, 9, 10, 11, 100),
(16, 3, 12, 13, 0, 100),
(17, 3, 14, 11, 11, 9999);

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

DROP TABLE IF EXISTS `tblitem`;
CREATE TABLE IF NOT EXISTS `tblitem` (
  `intItemID` int(11) NOT NULL AUTO_INCREMENT,
  `strItemName` varchar(45) NOT NULL,
  `txtItemDesc` text NOT NULL,
  `strItemType` enum('Weapon:Blunt','Weapon:Sword','Weapon:Axe','Secondary:Shield','Weapon:Staff','Weapon:Tome','Weapon:Wand','Weapon:Dagger','Weapon:Shuriken','Weapon:Pistols','Weapon:Rifle','Weapon:Bow','Weapon:Claws','Weapon:Gloves','Armour:Top','Armour:Bottom','Armour:Armour','Accessory','Food','Potion','Gem','Material','Quest') NOT NULL,
  `strHandType` varchar(45) DEFAULT NULL,
  `intCalories` int(11) DEFAULT NULL,
  `intHPHeal` int(11) NOT NULL DEFAULT '0',
  `intDamage` int(11) DEFAULT NULL,
  `intMagicDamage` int(11) DEFAULT NULL,
  `intDefence` int(11) DEFAULT NULL,
  `intMagicDefence` int(11) DEFAULT NULL,
  `intWaitTime` int(11) NOT NULL DEFAULT '0',
  `intFullness` int(11) DEFAULT NULL,
  `strStatDamage` varchar(45) DEFAULT 'Strength',
  `strFileName` varchar(45) DEFAULT NULL,
  `intSellPrice` int(11) NOT NULL DEFAULT '1',
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblitem`
--

INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `strFileName`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES
(1, 'Mysterious Hamburger', 'A warm hamburger found on the ground during an event with more calories than usual.', 'Food', NULL, 5000, 2, NULL, NULL, NULL, NULL, 0, 500, NULL, NULL, 1, 'akereliuk', '2014-10-09 19:58:50', NULL, NULL),
(3, 'Goblin Mace', 'A blunt mace likely to be used by goblins.', 'Weapon:Blunt', 'Primary', NULL, 0, 2, NULL, NULL, NULL, 35, 0, 'Strength', NULL, 1, 'akereliuk', '2014-10-25 19:55:58', NULL, NULL),
(5, 'Small Health Potion', 'A small potion that will recover some of your health points. Use it when you are injured.', 'Potion', NULL, 100, 5, NULL, NULL, NULL, NULL, 0, 50, 'Strength', NULL, 1, 'admin', '2016-03-11 00:00:00', NULL, NULL),
(6, 'Leather Cuirass', 'A light leather cuirass meant to be worn on top of clothes. The bottom is a skirt which leaves the lower body unprotected. Great for mobility.', 'Armour:Armour', NULL, NULL, 0, NULL, NULL, 2, NULL, 10, 0, NULL, NULL, 1, 'admin', '2016-04-08 00:00:00', NULL, NULL),
(7, 'Tanktop', 'A simple tanktop.', 'Armour:Top', NULL, NULL, 0, NULL, NULL, 1, NULL, 2, 0, NULL, NULL, 1, 'admin', '2016-04-08 00:00:00', NULL, NULL),
(8, 'Jeans', 'Straight blue jeans.', 'Armour:Bottom', NULL, NULL, 0, NULL, NULL, 1, NULL, 3, 0, NULL, NULL, 1, 'admin', '2016-04-08 00:00:00', NULL, NULL),
(9, 'Chocolate Cupcake', 'A delicious chocolate glazed cupcake. Yummy!', 'Food', NULL, 600, 1, NULL, NULL, NULL, NULL, 0, 200, NULL, NULL, 1, 'admin', '2016-07-05 00:00:00', NULL, NULL),
(10, 'Wooden Stick', 'A rugged wooden stick that could potentially be used as a weapon, albeit not a very effective one.', 'Weapon:Sword', 'Primary', NULL, 0, 1, NULL, NULL, NULL, 10, 0, 'Strength', NULL, 1, 'admin', '2016-07-14 00:00:00', NULL, NULL),
(11, 'Broad Stick', 'A stick with more girth than your average tree branch, equipped with a trunk-like tip making it much more viable for combat.', 'Weapon:Blunt', 'Primary', NULL, 0, 2, NULL, NULL, NULL, 20, 0, 'Strength', NULL, 1, 'admin', '2016-07-14 00:00:00', NULL, NULL),
(12, 'Wooden Axe', 'A bit of woodwork and a few sturdy logs and you\'ve got yourself a fairly durable axe weapon. Not nearly as effective as a metal axe, but certainly cheaper.', 'Weapon:Axe', 'Primary', NULL, 0, 2, NULL, NULL, NULL, 20, 0, 'Strength', NULL, 1, 'admin', '2016-07-14 00:00:00', NULL, NULL),
(13, 'Hammer', 'A one-handed hammer consisting of a metallic striking head fastened to a wooden handle. In the right hands, this could dish out some heavy blows.', 'Weapon:Blunt', 'Primary', NULL, 0, 8, NULL, NULL, NULL, 25, 0, 'Strength', NULL, 1, 'admin', '2016-07-14 00:00:00', NULL, NULL),
(14, 'Arming Sword', 'A knightly sword about the length of a grown man\'s arm, commonly wielded with one hand. The blade is well made, with a shallow fuller running along the length of the blade to provide flexibility. The guard extends in a cross-like pattern three inches in either direction from the blade.', 'Weapon:Sword', 'Primary', NULL, 0, 4, NULL, NULL, NULL, 15, 0, 'Strength', NULL, 10, 'admin', '2016-07-19 00:00:00', NULL, NULL),
(15, 'Wooden Buckler', 'A round wooden slab with a beveled metallic plate in the center. Thick enough to nullify damage from a typical bladed assault.', 'Secondary:Shield', 'Secondary', NULL, 0, NULL, NULL, 3, NULL, 5, 0, 'Strength', NULL, 1, 'admin', '2016-07-19 00:00:00', NULL, NULL),
(16, 'Wooden Bow', 'An arced wooden rod with a string joining both ends. Bend back the string to shoot arrows with piercing tips to inflict wounds to your enemies.', 'Weapon:Bow', 'Both', NULL, 0, 2, NULL, NULL, NULL, 10, 0, 'Strength', NULL, 1, 'admin', '2016-07-19 00:00:00', NULL, NULL),
(17, 'Wooden Staff', 'A long wooden rod with an arched tip. Magic can be channeled through this staff as it was created from enchanted wood.', 'Weapon:Staff', 'Both', NULL, 0, 0, 2, NULL, NULL, 10, 0, 'Intelligence', NULL, 1, 'admin', '2016-07-19 00:00:00', NULL, NULL),
(18, 'Magi Rod', 'A scepter-like iron rod with a sapphire gemstone encapsulated in the tip.', 'Weapon:Wand', 'Primary', NULL, 0, NULL, 7, NULL, NULL, 5, 0, 'Intelligence', NULL, 20, 'admin', '2016-07-21 00:00:00', NULL, NULL),
(20, 'Longsword', 'A blade with significantly more reach than your average arming sword. Best used with a shield.', 'Weapon:Sword', 'Primary', NULL, 0, 8, NULL, NULL, NULL, 15, 0, 'Strength', NULL, 5, 'admin', '2016-07-24 00:00:00', NULL, NULL),
(21, 'Magi Staff', 'A long iron rod with an cupped sapphire gemstone at the tip. Its respectable magical capacity comes at the expense of its heavier weight.', 'Weapon:Staff', 'Both', NULL, 0, NULL, 10, NULL, NULL, 25, 0, 'Intelligence', NULL, 5, 'admin', '2016-07-24 00:00:00', NULL, NULL),
(22, 'Leather Mail', 'This armour consists of light chainmail with a leather chestpiece over top. Steel cuisses cover the thighs. The chestpiece is constructed by fastening multiple layers of leather together then sturdily sewing it.', 'Armour:Armour', NULL, NULL, 0, NULL, NULL, 5, NULL, 15, 0, NULL, NULL, 5, 'admin', '2016-07-25 00:00:00', NULL, NULL),
(23, 'Succubus Corset', 'A tightly fitting outfit that hardly covers the breasts and extends to the hips. It can be made to be even tighter by pulling the lacing. The material is stiffened and is designed to shape a woman\'s figure.', 'Armour:Top', NULL, NULL, 0, NULL, NULL, 1, 4, 5, 0, 'Strength', NULL, 10, 'admin', '2016-07-30 00:00:00', NULL, NULL),
(24, 'Sub Sandwich', 'A footlong sub sandwich toasted with turkey, ham, lettuce, tomatoes, and mayo on white bread. It will take a lot of time to eat this due to the length of the sandwich.', 'Food', NULL, 1200, 3, NULL, NULL, NULL, NULL, 0, 600, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(25, 'Chocolate Cake Slice', 'The ultimate dessert if you\'re craving chocolate. A spongey exterior stuffed with chocolate cream, glazed with even more melted chocolate and topped with cocoa powder. Only one slice however.', 'Food', NULL, 800, 1, NULL, NULL, NULL, NULL, 0, 300, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(26, 'Salad', 'Lettuce leaves tossed with a balsamic dressing. Diet food.', 'Food', NULL, 100, 2, NULL, NULL, NULL, NULL, 0, 200, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(27, 'Chocolate Peanut Butter Milkshake', 'Blended buttermilk pancakes and chocolate topped with fudge and peanut butter sauce. A deliciously fattening dessert.', 'Food', NULL, 3000, 2, NULL, NULL, NULL, NULL, 0, 800, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(28, 'Rice Bowl', 'A plain bowl of white rice.', 'Food', NULL, 400, 2, NULL, NULL, NULL, NULL, 0, 400, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(29, 'Spaghetti and Meatballs', 'Spaghetti pasta topped with tomato sauce and three tasty meatballs.', 'Food', NULL, 1500, 3, NULL, NULL, NULL, NULL, 0, 700, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(30, 'Large Weight Gain Potion', 'Nobody really knows what it contains aside from a buttload of calories. Drink at your own risk!', 'Potion', NULL, 99999, 0, NULL, NULL, NULL, NULL, 0, 5000, 'Strength', 'LargeWeightGain', 30, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(31, 'Vegetable Smoothie', 'The ultimate diet food. Spinach and kale smoothie that\'s bursting in vitamins and minerals. Will fill you right up with minimal calorie consumption.', 'Food', NULL, 200, 2, NULL, NULL, NULL, NULL, 0, 800, 'Strength', NULL, 1, 'admin', '2016-08-13 00:00:00', NULL, NULL),
(32, 'Brass Knuckles', 'Metal shaped to fit around the knuckles, concentrating the area of a punch more precisely to deal heavier damage on impact.', 'Weapon:Claws', 'Both', NULL, 0, 2, NULL, NULL, NULL, 2, 0, 'Strength', NULL, 1, 'admin', '2016-08-16 00:00:00', NULL, NULL),
(33, 'Knife', 'A shorter and lighter version of a dagger, commonly utilized in a quick and precise stabbing motion. Could also be used to cut meat.', 'Weapon:Dagger', 'Primary', NULL, 0, 2, NULL, NULL, NULL, 5, 0, 'Strength', NULL, 1, 'admin', '2016-08-16 00:00:00', NULL, NULL),
(34, 'Dirk', 'A dagger with a straight, single-edged blade that\'s about a foot long, and short, straight quillions.', 'Weapon:Dagger', 'Primary', NULL, 0, 8, NULL, NULL, NULL, 5, NULL, 'Strength', NULL, 10, 'admin', '2016-08-16 00:00:00', NULL, NULL),
(35, 'Iron Bow', 'A durable iron bow. You can shoot arrows by pulling them back on the string and releasing it.', 'Weapon:Bow', 'Both', NULL, 0, 7, NULL, NULL, NULL, 15, NULL, 'Strength', NULL, 5, 'admin', '2016-08-16 00:00:00', NULL, NULL),
(36, 'Medium Weight Gain Potion', 'Nobody really knows what it contains aside from a buttload of calories. Drink at your own risk!', 'Potion', NULL, 50000, 0, NULL, NULL, NULL, NULL, 0, 2500, 'Strength', 'MediumWeightGain', 20, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(37, 'Small Weight Gain Potion', 'Nobody really knows what it contains aside from a buttload of calories. Drink at your own risk!', 'Potion', NULL, 25000, 0, NULL, NULL, NULL, NULL, 0, 1500, 'Strength', 'SmallWeightGain', 10, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(38, 'Small Weight Loss Potion', 'A potion designed to make you rapidly lose weight. Use at your own risk!', 'Potion', NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 100, 'Strength', 'SmallWeightLoss', 20, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(39, 'Medium Weight Loss Potion', 'A potion designed to make you rapidly lose weight. Use at your own risk!', 'Potion', NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 200, 'Strength', 'MediumWeightLoss', 40, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(40, 'Large Weight Loss Potion', 'A potion designed to make you rapidly lose weight. Use at your own risk!', 'Potion', NULL, 0, 0, NULL, NULL, NULL, NULL, 0, 300, 'Strength', 'LargeWeightLoss', 60, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(41, 'Orange Juice', 'Juice made from squeezed oranges with the pulp inside.', 'Food', NULL, 150, 3, NULL, NULL, NULL, NULL, 0, 300, 'Strength', NULL, 1, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(42, 'Chocolate Milk', 'It\'s milk with cocoa powder mixed in.', 'Food', NULL, 300, 3, NULL, NULL, NULL, NULL, 0, 400, 'Strength', NULL, 1, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(43, 'Jasmine Tea', 'Uses green tea leaves as base and scented with jasmine blossom aroma.', 'Food', NULL, 0, 4, NULL, NULL, NULL, NULL, 0, 200, 'Strength', NULL, 1, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(44, 'Coffee', 'A brewed drink made with roasted coffee beans. It contains caffeine.', 'Food', NULL, 300, 0, NULL, NULL, NULL, NULL, 0, 400, 'Strength', 'Coffee', 1, 'admin', '2016-08-20 00:00:00', NULL, NULL),
(45, 'Battle Wand', 'A wand that resembles a club with a large rugged head instead of the usual narrow tip. This wand sacrifices magical capacity for the slight advantage in a melee.', 'Weapon:Wand', 'Primary', NULL, 0, NULL, 4, NULL, NULL, 10, NULL, 'Intelligence', NULL, 5, 'admin', '2016-09-17 00:00:00', NULL, NULL),
(46, 'Hypno Staff', 'A staff with a unique property: Powerful sleep magic is injected into its wood, granting a chance at putting your enemies to sleep with any magic spell.', 'Weapon:Staff', 'Both', NULL, 0, 0, 6, NULL, NULL, 15, NULL, 'Intelligence', 'HypnoStaff', 25, 'admin', '2016-09-17 00:00:00', NULL, NULL),
(47, 'Blue Jelly', 'Wobbly blue jelly, with presumably no nutritional value.', 'Food', NULL, 2000, 5, NULL, NULL, NULL, NULL, 0, 500, 'Strength', NULL, 1, 'admin', '2019-09-26 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblitemenchantxr`
--

DROP TABLE IF EXISTS `tblitemenchantxr`;
CREATE TABLE IF NOT EXISTS `tblitemenchantxr` (
  `intItemEnchantXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemID` int(11) NOT NULL,
  `intEnchantID` int(11) NOT NULL,
  `intOccurrence` int(11) NOT NULL,
  PRIMARY KEY (`intItemEnchantXRID`),
  KEY `intItemID` (`intItemID`),
  KEY `intEnchantID` (`intEnchantID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `tbliteminstanceenchant`;
CREATE TABLE IF NOT EXISTS `tbliteminstanceenchant` (
  `intItemInstanceEnchantID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemInstanceID` int(11) NOT NULL,
  `intSuffixEnchantID` int(11) DEFAULT NULL,
  `intPrefixEnchantID` int(11) DEFAULT NULL,
  PRIMARY KEY (`intItemInstanceEnchantID`),
  KEY `intItemInstanceID` (`intItemInstanceID`),
  KEY `intSuffixEnchantID` (`intSuffixEnchantID`),
  KEY `intPrefixEnchantID` (`intPrefixEnchantID`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbllocation`
--

DROP TABLE IF EXISTS `tbllocation`;
CREATE TABLE IF NOT EXISTS `tbllocation` (
  `intLocationID` int(11) NOT NULL AUTO_INCREMENT,
  `strLocationName` varchar(45) NOT NULL,
  `strLocationType` varchar(45) NOT NULL DEFAULT 'Building',
  `intTownID` int(11) NOT NULL DEFAULT '1',
  `txtDescription` text,
  PRIMARY KEY (`intLocationID`),
  KEY `fk_intTownID` (`intTownID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
(11, 'University of the Arcane', 'Building', 1, NULL),
(12, 'Armourer', 'Building', 1, ''),
(13, 'The Dragon\'s Barrel', 'Building', 1, 'A pub and quest hub.');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationeventlink`
--

DROP TABLE IF EXISTS `tbllocationeventlink`;
CREATE TABLE IF NOT EXISTS `tbllocationeventlink` (
  `intLocationEventLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intLocationID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationEventLinkID`),
  KEY `fk_intLocationID` (`intLocationID`),
  KEY `fk_intEventID` (`intEventID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocationeventlink`
--

INSERT INTO `tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES
(1, 6, 13, 'Sleep'),
(2, 6, 14, 'View Mirror'),
(3, 11, 15, 'Reset Stats'),
(4, 11, 40, 'Library'),
(5, 13, 43, 'Talk to Iyanna');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationshoplink`
--

DROP TABLE IF EXISTS `tbllocationshoplink`;
CREATE TABLE IF NOT EXISTS `tbllocationshoplink` (
  `intLocationShopLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intLocationID` int(11) NOT NULL,
  `intShopID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationShopLinkID`),
  KEY `fk_intLocationID2` (`intLocationID`),
  KEY `fk_intShopID2` (`intShopID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocationshoplink`
--

INSERT INTO `tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES
(1, 7, 1, 'Shop'),
(2, 8, 2, 'Shop'),
(3, 9, 3, 'Shop'),
(4, 10, 4, 'Shop'),
(5, 11, 5, 'Visit Enchanter'),
(6, 7, 6, 'Repair Clothing'),
(7, 7, 7, 'Resize Clothing'),
(8, 12, 8, 'Shop'),
(9, 11, 9, 'Magic Shop');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocationxrlink`
--

DROP TABLE IF EXISTS `tbllocationxrlink`;
CREATE TABLE IF NOT EXISTS `tbllocationxrlink` (
  `intLocationXRLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `intFromLocationID` int(11) NOT NULL,
  `intToLocationID` int(11) NOT NULL,
  `strLinkName` varchar(45) NOT NULL,
  PRIMARY KEY (`intLocationXRLinkID`),
  KEY `fk_intFromLocationID` (`intFromLocationID`),
  KEY `fk_intToLocationID` (`intToLocationID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllocationxrlink`
--

INSERT INTO `tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES
(2, 2, 6, 'Home'),
(8, 3, 12, 'Armourer'),
(9, 3, 7, 'Tailor'),
(10, 3, 8, 'Blacksmith'),
(11, 3, 9, 'Apothecary'),
(12, 3, 10, 'Grocer'),
(14, 4, 11, 'University of the Arcane'),
(15, 5, 13, 'The Dragon\'s Barrel');

-- --------------------------------------------------------

--
-- Table structure for table `tblmodifier`
--

DROP TABLE IF EXISTS `tblmodifier`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmodifierstatchanges`
--

DROP TABLE IF EXISTS `tblmodifierstatchanges`;
CREATE TABLE IF NOT EXISTS `tblmodifierstatchanges` (
  `intModifierStatChangeID` int(11) NOT NULL AUTO_INCREMENT,
  `intModifierID` int(11) NOT NULL,
  `strStatName` varchar(45) NOT NULL,
  `intStatChangeMin` int(11) NOT NULL,
  `intStatChangeMax` int(11) NOT NULL,
  `intStatusEffectID` int(11) NOT NULL,
  PRIMARY KEY (`intModifierStatChangeID`),
  KEY `intModifierID` (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblnpc`
--

DROP TABLE IF EXISTS `tblnpc`;
CREATE TABLE IF NOT EXISTS `tblnpc` (
  `intNPCID` int(11) NOT NULL AUTO_INCREMENT,
  `strNPCName` varchar(45) NOT NULL,
  `intWeight` int(11) NOT NULL,
  `intHeight` int(11) NOT NULL,
  `intExperienceGiven` int(11) NOT NULL,
  `intGoldDropMin` int(11) NOT NULL,
  `intGoldDropMax` int(11) NOT NULL,
  `blnHasStartEvent` tinyint(1) NOT NULL DEFAULT '0',
  `blnHasEndEvent` tinyint(1) NOT NULL DEFAULT '0',
  `strAIName` varchar(45) NOT NULL DEFAULT 'AlwaysAttack',
  `intWeightGain` int(11) NOT NULL DEFAULT '10',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnpc`
--

INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `intWeightGain`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Goblin', 120, 150, 800, 0, 5, 0, 0, 'AlwaysAttack', 0, '2014-10-25 14:22:34', 'akereliuk', NULL, NULL),
(2, 'Seraphine the Tutorial Fairy', 50, 100, 1600, 0, 0, 1, 1, 'AlwaysFeed', 0, '2014-11-15 16:38:52', 'akereliuk', NULL, NULL),
(3, 'Rat', 2, 30, 400, 0, 3, 0, 0, 'AlwaysAttack', 0, '2016-07-14 00:00:00', 'admin', NULL, NULL),
(4, 'Skeleton', 80, 130, 3200, 3, 10, 0, 0, 'AlwaysAttack', 0, '2016-07-14 00:00:00', 'admin', NULL, NULL),
(5, 'Goblin Chief', 250, 130, 4000, 10, 30, 1, 1, 'AlwaysAttack', 0, '2016-07-14 00:00:00', 'admin', NULL, NULL),
(6, 'Armoured Skeleton', 120, 130, 4500, 5, 15, 0, 0, 'DPS', 0, '2016-07-19 00:00:00', 'admin', NULL, NULL),
(7, 'Skeleton Mage', 130, 120, 4500, 5, 15, 0, 0, 'DPS', 0, '2016-07-21 00:00:00', 'admin', NULL, NULL),
(8, 'Black Succubus', 120, 158, 9600, 20, 50, 1, 1, 'Succubus', 20, '2016-07-21 00:00:00', 'admin', NULL, NULL),
(9, 'Small Slime', 20, 100, 2500, 5, 10, 0, 0, 'AlwaysFeed', 2, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(10, 'Medium Slime', 40, 150, 3000, 6, 12, 0, 0, 'AlwaysFeed', 4, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(11, 'Large Slime', 60, 200, 3500, 8, 16, 0, 0, 'AlwaysFeed', 6, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(12, 'Venus Flytrap', 50, 200, 4000, 5, 15, 0, 0, 'DPS', 0, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(13, 'Sarracenia', 50, 200, 4200, 5, 15, 0, 0, 'DPS', 0, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(14, 'Hedorah', 500, 400, 12600, 10, 25, 1, 1, 'Hedorah', 8, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(15, 'Norman Foelsch', 134, 172, 0, 0, 0, 0, 0, 'DPS', 0, '2019-09-26 00:00:00', 'admin', NULL, NULL),
(16, 'Iyanna Rue', 166, 178, 0, 0, 0, 0, 0, 'DPS', 0, '2019-09-26 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcbattletext`
--

DROP TABLE IF EXISTS `tblnpcbattletext`;
CREATE TABLE IF NOT EXISTS `tblnpcbattletext` (
  `intNPCBattleTextID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `strStartText` text NOT NULL,
  `strForceStartText` text NOT NULL,
  `strEndText` text NOT NULL,
  `strDefeatText` text NOT NULL,
  `strFleeText` text NOT NULL,
  `strFailFleeText` text NOT NULL,
  PRIMARY KEY (`intNPCBattleTextID`),
  KEY `fk_tblnpcbattletext` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnpcbattletext`
--

INSERT INTO `tblnpcbattletext` (`intNPCBattleTextID`, `intNPCID`, `strStartText`, `strForceStartText`, `strEndText`, `strDefeatText`, `strFleeText`, `strFailFleeText`) VALUES
(1, 1, 'As you come closer, you can hear the clinking of metal. This figure is armed. It rears its head and snarls at you, aware of your presence.', 'You hear the clinking of metal. A silhouette appears in the distance. As you come closer, you can tell this figure is armed. It rears its head and snarls at you, aware of your presence.', '', '', '', ''),
(2, 3, 'You hear a faint scurrying ahead of you. Looking down at the ground before you, you can see what appears to be an oversized rat bearing its teeth at you. You should eliminate this rodent before it attacks, so as not to take any chances!', 'You hear a faint scurrying ahead of you. Looking down at the ground before you, you can see what appears to be an oversized rat bearing its teeth at you. You should eliminate this rodent before it attacks, so as not to take any chances!', 'The rat turns over on its back, defeated.', '', '', ''),
(4, 4, 'A crackling and a rattling can be heard ahead of you. Animated bones move towards you; a bare skeleton. In its bony grip is a wooden axe. It takes a battle pose, ready to fight. Should you pursue?', 'A crackling and a rattling can be heard ahead of you. Animated bones move towards you; a bare skeleton. In its bony grip is a wooden axe. It takes a battle pose, ready to fight.', 'Defeated, the skeleton collapses into a pile of bones.', '', '', ''),
(5, 6, 'The clinking of armour can be heard ahead of you. Animated bones protected by a metallic chestpiece move towards you; an armoured skeleton. In one bony hand it holds a sword, the other a shield. It takes a battle pose, ready to fight. Should you pursue?', 'The clinking of armour can be heard ahead of you. Animated bones protected by a metallic chestpiece move towards you; an armoured skeleton. In one bony hand it holds a sword, the other a shield. It takes a battle pose, ready to fight.', 'The skeleton collapses to the floor in a pile of bones, defeated.', '', '', ''),
(6, 7, 'A skeleton wearing a cape and holding a staff can be seen in the distance. Should you pursue?', 'A long oval of radiant light flashes before you, and a figure emerges from within. It is a skeleton wearing a cape and holding a staff. It takes a battle pose; it teleported here to fight you!', 'The skeleton collapses to the floor in a pile of bones, defeated.', '', '', ''),
(7, 9, 'A loud gurgle emits from a nearby bush. A sentient blue slime jumps out at you! You manage to dodge in time, but the slime is ready to rumble. Arming yourself, you are prepared for what’s bound to be a weird encounter.', 'A loud gurgle emits from a nearby bush. A sentient blue slime jumps out at you! You manage to dodge in time, but the slime is ready to rumble. Arming yourself, you are prepared for what’s bound to be a weird encounter.', 'The flattened slime, or rather what’s left of it, rests on the ground it appears incapable of moving anymore.', 'You groan loudly as your stomach ripples and roars from all the food inside it. Unable to move, and stuffed well past your limit, you collapse onto your back in agony. The slime latches onto your face, suffocating you and draining itself into your open mouth rapidly. Your vision begins to fade and warmth overtakes your body...', 'The slime slides the last of itself down your gullet! You clutch your stomach as agony, stuffed beyond your limits. Shortly after, you let out a thunderous belch. You\'ve consumed your enemy entirely! Is this victory, by default..?', 'The slime thrusts itself forward at you, forcing its body down your throat! You manage to pull back, but not without a throatful of blue goop you are forced to swallow so as not to choke!'),
(8, 10, 'A loud gurgle emits from a nearby bush. A sentient blue slime jumps out at you! You manage to dodge in time, but the slime is ready to rumble. Arming yourself, you are prepared for what’s bound to be a weird encounter.', 'A loud gurgle emits from a nearby bush. A sentient blue slime jumps out at you! You manage to dodge in time, but the slime is ready to rumble. Arming yourself, you are prepared for what’s bound to be a weird encounter.', 'The flattened slime, or rather what’s left of it, rests on the ground it appears incapable of moving anymore.', 'You groan loudly as your stomach ripples and roars from all the food inside it. Unable to move, and stuffed well past your limit, you collapse onto your back in agony. The slime latches onto your face, suffocating you and draining itself into your open mouth rapidly. Your vision begins to fade and warmth overtakes your body...', 'The slime slides the last of itself down your gullet! You clutch your stomach as agony, stuffed beyond your limits. Shortly after, you let out a thunderous belch. You\'ve consumed your enemy entirely! Is this victory, by default..?', 'The slime thrusts itself forward at you, forcing its body down your throat! You manage to pull back, but not without a throatful of blue goop you are forced to swallow so as not to choke!'),
(9, 11, 'A loud gurgle emits from a nearby bush. A sentient blue slime jumps out at you! You manage to dodge in time, but the slime is ready to rumble. Arming yourself, you are prepared for what’s bound to be a weird encounter.', 'A loud gurgle emits from a nearby bush. A sentient blue slime jumps out at you! You manage to dodge in time, but the slime is ready to rumble. Arming yourself, you are prepared for what’s bound to be a weird encounter.', 'The flattened slime, or rather what’s left of it, rests on the ground it appears incapable of moving anymore.', 'You groan loudly as your stomach ripples and roars from all the food inside it. Unable to move, and stuffed well past your limit, you collapse onto your back in agony. The slime latches onto your face, suffocating you and draining itself into your open mouth rapidly. Your vision begins to fade and warmth overtakes your body...', 'The slime slides the last of itself down your gullet! You clutch your stomach as agony, stuffed beyond your limits. Shortly after, you let out a thunderous belch. You\'ve consumed your enemy entirely! Is this victory, by default..?', 'The slime thrusts itself forward at you, forcing its body down your throat! You manage to pull back, but not without a throatful of blue goop you are forced to swallow so as not to choke!'),
(10, 12, 'A loud snap comes from the branches above you and suddenly a giant Venus flytrap hangs in front of you. Blocking the way with its leaves it appears there is no way out. With its teeth pointing at you it appears this won\'t be a friendly encounter.\r\n', 'A loud snap comes from the branches above you and suddenly a giant Venus flytrap hangs in front of you. Blocking the way with its leaves it appears there is no way out. With its teeth pointing at you it appears this won\'t be a friendly encounter.\r\n', 'The hideous plant\'s mouth droops down, and its leaves lose the rigidness they had. It hits the ground and begins to curl up, brown and lifeless. You\'ve defeated the fly trap!', '', '', ''),
(11, 13, 'You hear a crunch and release you\'ve stepped on something living. A giant Sarracenia flower raises itself from the waters, petals dancing around it wildly. The petals whip towards you but you dodge them successfully. You must fight!', 'You hear a crunch and release you\'ve stepped on something living. A giant Sarracenia flower raises itself from the waters, petals dancing around it wildly. The petals whip towards you but you dodge them successfully. You must fight!', 'The giant flower falls back into the depths of the water. Victorious. you are once more free to roam these lands.', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcgrowth`
--

DROP TABLE IF EXISTS `tblnpcgrowth`;
CREATE TABLE IF NOT EXISTS `tblnpcgrowth` (
  `intNPCGrowthID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intMaxHP` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL,
  `intIntelligence` int(11) NOT NULL,
  `intAgility` int(11) NOT NULL,
  `intVitality` int(11) NOT NULL,
  `intWillpower` int(11) NOT NULL,
  `intDexterity` int(11) NOT NULL,
  `intAccuracy` int(11) NOT NULL,
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  PRIMARY KEY (`intNPCGrowthID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnpcgrowth`
--

INSERT INTO `tblnpcgrowth` (`intNPCGrowthID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intAccuracy`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES
(1, 2, 1, 0, 2, 3, 0, 1, 2, 0, 1, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcinstance`
--

DROP TABLE IF EXISTS `tblnpcinstance`;
CREATE TABLE IF NOT EXISTS `tblnpcinstance` (
  `intNPCInstanceID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intLevel` int(11) NOT NULL DEFAULT '1',
  `intExperience` int(11) NOT NULL DEFAULT '0',
  `intRelationshipLevel` int(11) NOT NULL DEFAULT '0',
  `intRelationshipEXP` int(11) NOT NULL DEFAULT '0',
  `intConversationLevel` int(11) NOT NULL DEFAULT '0',
  `dblWeight` double NOT NULL,
  `intCurrentHunger` int(11) NOT NULL DEFAULT '500',
  `intHungerRate` int(11) NOT NULL DEFAULT '1',
  `intCurrentHP` int(11) NOT NULL,
  `intDigestionRate` int(11) NOT NULL DEFAULT '250',
  PRIMARY KEY (`intNPCInstanceID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblnpcinstancestats`
--

DROP TABLE IF EXISTS `tblnpcinstancestats`;
CREATE TABLE IF NOT EXISTS `tblnpcinstancestats` (
  `intNPCInstanceStatID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intMaxHP` int(11) NOT NULL,
  `intStrength` int(11) NOT NULL,
  `intIntelligence` int(11) NOT NULL,
  `intAgility` int(11) NOT NULL,
  `intVitality` int(11) NOT NULL,
  `intWillpower` int(11) NOT NULL,
  `intDexterity` int(11) NOT NULL,
  `intAccuracy` int(11) NOT NULL,
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  `intMaxHunger` int(11) NOT NULL,
  PRIMARY KEY (`intNPCInstanceStatID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblnpcitemxr`
--

DROP TABLE IF EXISTS `tblnpcitemxr`;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnpcitemxr`
--

INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES
(1, 1, 3, 1, 1, 1000, '2014-10-25 19:57:05'),
(2, 2, 9, 0, 1, 10000, '2016-07-05 00:00:00'),
(3, 4, 12, 1, 1, 1000, '2016-07-14 00:00:00'),
(4, 5, 13, 1, 1, 2000, '2016-07-14 00:00:00'),
(5, 6, 14, 1, 1, 1000, '2016-07-19 00:00:00'),
(6, 6, 15, 1, 1, 1000, '2016-07-19 00:00:00'),
(7, 7, 18, 1, 1, 1000, '2016-07-21 00:00:00'),
(8, 7, 15, 1, 1, 1000, '2016-07-21 00:00:00'),
(9, 8, 23, 1, 1, 2000, '2016-07-30 00:00:00'),
(10, 9, 47, 0, 1, 1000, '2019-09-26 00:00:00'),
(11, 10, 47, 0, 1, 1000, '2019-09-26 00:00:00'),
(12, 11, 47, 0, 1, 1000, '2019-09-26 00:00:00'),
(13, 14, 34, 0, 1, 2000, '2019-09-26 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcmodifierxr`
--

DROP TABLE IF EXISTS `tblnpcmodifierxr`;
CREATE TABLE IF NOT EXISTS `tblnpcmodifierxr` (
  `intNPCModifierXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intModifierID` int(11) NOT NULL,
  `intOccurrence` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intNPCModifierXRID`),
  KEY `intNPCID` (`intNPCID`),
  KEY `intModifierID` (`intModifierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcskillxr`
--

DROP TABLE IF EXISTS `tblnpcskillxr`;
CREATE TABLE IF NOT EXISTS `tblnpcskillxr` (
  `intNPCSkillXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intSkillID` int(11) NOT NULL,
  `intReqLevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`intNPCSkillXRID`),
  KEY `intNPCID` (`intNPCID`),
  KEY `intSkillID` (`intSkillID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnpcskillxr`
--

INSERT INTO `tblnpcskillxr` (`intNPCSkillXRID`, `intNPCID`, `intSkillID`, `intReqLevel`) VALUES
(1, 2, 1, 1),
(2, 6, 3, 1),
(3, 7, 4, 1),
(4, 8, 2, 1),
(5, 8, 5, 1),
(6, 8, 6, 1),
(7, 9, 13, 1),
(8, 10, 13, 1),
(9, 11, 13, 1),
(10, 12, 14, 1),
(11, 13, 15, 1),
(12, 14, 16, 1),
(13, 14, 17, 1),
(14, 14, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblnpcstats`
--

DROP TABLE IF EXISTS `tblnpcstats`;
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
  `intAccuracy` int(11) NOT NULL DEFAULT '0',
  `intEvasion` int(11) NOT NULL,
  `intCritDamage` int(11) NOT NULL,
  `intPierce` int(11) NOT NULL,
  `intBlockRate` int(11) NOT NULL,
  `intBlockReduction` int(11) NOT NULL,
  `intFleeResistance` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intNPCStatsID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnpcstats`
--

INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intAccuracy`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`, `intFleeResistance`) VALUES
(1, 1, 14, 5, 5, 5, 5, 5, 5, 0, 0, 150, 0, 0, 10, 0),
(2, 2, 20, 2, 2, 2, 2, 2, 2, 0, 0, 150, 0, 0, 10, 100),
(3, 3, 8, 1, 1, 20, 1, 1, 1, 0, 0, 150, 0, 0, 10, 0),
(4, 4, 22, 10, 1, 3, 15, 1, 5, 0, 1, 150, 0, 0, 10, 5),
(5, 5, 16, 10, 5, 5, 5, 5, 30, 0, 10, 150, 10, 30, 50, 100),
(6, 6, 22, 10, 1, 3, 15, 1, 5, 0, 1, 150, 0, 10, 20, 5),
(7, 7, 18, 9, 2, 2, 1, 2, 2, 0, 1, 150, 0, 10, 20, 50),
(8, 8, 25, 5, 100, 20, 5, 20, 20, 0, 60, 150, 0, 10, 20, 100),
(9, 9, 50, 5, 5, 5, 5, 100, 5, 0, 0, 0, 0, 0, 0, 100),
(10, 10, 70, 5, 5, 5, 5, 100, 5, 0, 0, 0, 0, 0, 0, 100),
(11, 11, 90, 5, 5, 5, 5, 100, 5, 0, 0, 0, 0, 0, 0, 100),
(12, 12, 65, 10, 10, 10, 10, 10, 10, 5, 5, 5, 5, 5, 5, 0),
(13, 13, 72, 10, 10, 10, 10, 10, 10, 5, 5, 5, 5, 5, 5, 0),
(14, 14, 120, 20, 5, 5, 10, 5, 5, 5, 5, 5, 5, 5, 5, 100),
(15, 15, 300, 10, 100, 10, 10, 70, 20, 100, 0, 100, 100, 5, 50, 100),
(16, 16, 300, 80, 50, 40, 80, 80, 40, 50, 10, 50, 20, 60, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbloverride`
--

DROP TABLE IF EXISTS `tbloverride`;
CREATE TABLE IF NOT EXISTS `tbloverride` (
  `intOverrideID` int(11) NOT NULL AUTO_INCREMENT,
  `strOverrideName` varchar(45) NOT NULL,
  `strOverrideDesc` text NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intOverrideID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbloverride`
--

INSERT INTO `tbloverride` (`intOverrideID`, `strOverrideName`, `strOverrideDesc`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Armour Binding', 'Player cannot unequip their armour; must wait until it tears or falls off. Additionally, armour is always tight.', '2014-11-04 21:27:39', 'akereliuk', NULL, NULL),
(2, 'Stretchy Armour', 'Armour adjusts to player weight; always skintight.', '2014-11-04 21:27:39', 'akereliuk', NULL, NULL),
(3, 'Allow Equip Tab', 'Allows \r\n\r\nuser to access equip tab during events, but equipping anything will not cause a new event to occur with this override \r\n\r\nset.', '2014-11-13 21:08:16', 'akereliuk', NULL, NULL),
(4, 'Burdened by Weight', 'Lowers Agility stat based on the user\'s BMI.', '2014-12-08 15:59:48', 'akereliuk', NULL, NULL),
(5, 'Hypnotized', 'Cannot attack or use skills and can be controlled by enemy while this override is in effect.', '2016-07-21 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpost`
--

DROP TABLE IF EXISTS `tblpost`;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblquest`
--

DROP TABLE IF EXISTS `tblquest`;
CREATE TABLE IF NOT EXISTS `tblquest` (
  `intQuestID` int(11) NOT NULL AUTO_INCREMENT,
  `strQuestName` varchar(45) NOT NULL,
  `strQuestType` varchar(45) NOT NULL,
  `txtQuestDesc` text NOT NULL,
  `intExpReward` int(11) NOT NULL,
  `intGoldReward` int(11) NOT NULL,
  PRIMARY KEY (`intQuestID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblquest`
--

INSERT INTO `tblquest` (`intQuestID`, `strQuestName`, `strQuestType`, `txtQuestDesc`, `intExpReward`, `intGoldReward`) VALUES
(1, 'Warrior Class Quest', 'Class', 'Iyanna wants you kill 5 Skeleton Warriors on the second floor of the tower and report back. She promises to teach you the ways of the Warrior.', 0, 0),
(2, 'Caster Class Quest', 'Class', 'Norman wants you kill 5 Skeleton Mages on the second floor of the tower and report back. He promises to teach you the ways of the Caster.', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblquestkillreq`
--

DROP TABLE IF EXISTS `tblquestkillreq`;
CREATE TABLE IF NOT EXISTS `tblquestkillreq` (
  `intKillReqID` int(11) NOT NULL AUTO_INCREMENT,
  `strReqName` varchar(45) NOT NULL,
  `intQuestID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intKillReq` int(11) NOT NULL,
  PRIMARY KEY (`intKillReqID`),
  KEY `intQuestID` (`intQuestID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblquestkillreq`
--

INSERT INTO `tblquestkillreq` (`intKillReqID`, `strReqName`, `intQuestID`, `intNPCID`, `intKillReq`) VALUES
(1, 'Kill 5 Armoured Skeletons', 1, 6, 5),
(2, 'Kill 5 Skeleton Mages', 2, 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblrpgcharacter`
--

DROP TABLE IF EXISTS `tblrpgcharacter`;
CREATE TABLE IF NOT EXISTS `tblrpgcharacter` (
  `intRPGCharacterID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strRPGCharacterName` varchar(45) NOT NULL,
  `intHeight` int(11) NOT NULL DEFAULT '165',
  `dblWeight` double NOT NULL,
  `intDigestionRate` int(11) NOT NULL DEFAULT '250',
  `intCurrentHunger` int(11) NOT NULL DEFAULT '500',
  `intHungerRate` int(11) NOT NULL DEFAULT '1',
  `intTicksStuffed` int(11) NOT NULL DEFAULT '0',
  `intFloorID` int(11) NOT NULL DEFAULT '1',
  `intCurrentFloorID` int(11) NOT NULL,
  `intStateID` int(8) NOT NULL DEFAULT '0',
  `intTownID` int(8) DEFAULT NULL,
  `intLocationID` int(11) NOT NULL DEFAULT '6',
  `intDay` int(11) NOT NULL DEFAULT '1',
  `strTime` varchar(5) NOT NULL DEFAULT '00:00',
  `strGender` enum('Female','Male') NOT NULL DEFAULT 'Female',
  `strOrientation` enum('Heterosexual','Homosexual','Bisexual') NOT NULL DEFAULT 'Heterosexual',
  `strPersonality` enum('Shy','Outgoing','Stoic') NOT NULL DEFAULT 'Shy',
  `blnLikesFatSelf` tinyint(1) NOT NULL DEFAULT '1',
  `blnLikesFatOthers` tinyint(1) NOT NULL DEFAULT '1',
  `strEyeColour` enum('Brown','Blue','Green','Black','Red','White') NOT NULL DEFAULT 'Brown',
  `strHairColour` enum('Brown','Blonde','Black','Red','Brunette','White','Orange','Green','Blue','Pink','Yellow','Purple') NOT NULL DEFAULT 'Brown',
  `strHairLength` enum('Short','Medium','Shoulder Length','Long') NOT NULL DEFAULT 'Short',
  `strEthnicity` enum('White','Peach','Tan','Brown','Black','Olive') NOT NULL DEFAULT 'White',
  `intLevel` int(11) NOT NULL DEFAULT '1',
  `intExperience` int(11) NOT NULL DEFAULT '0',
  `intCurrentHP` int(11) NOT NULL DEFAULT '10',
  `intStatPoints` int(11) NOT NULL DEFAULT '0',
  `intGold` int(11) NOT NULL,
  `blnActivated` tinyint(1) NOT NULL DEFAULT '1',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intRPGCharacterID`),
  KEY `intUserID` (`strUserID`),
  KEY `intFloorID` (`intFloorID`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tblshop`
--

DROP TABLE IF EXISTS `tblshop`;
CREATE TABLE IF NOT EXISTS `tblshop` (
  `intShopID` int(11) NOT NULL AUTO_INCREMENT,
  `strShopName` varchar(45) NOT NULL,
  `txtShopDesc` text,
  `strShopType` varchar(45) NOT NULL,
  PRIMARY KEY (`intShopID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblshop`
--

INSERT INTO `tblshop` (`intShopID`, `strShopName`, `txtShopDesc`, `strShopType`) VALUES
(1, 'Turician Tailor', 'Buy clothes.', 'Tailor'),
(2, 'Turician Blacksmith', 'Buy weapons.', 'Blacksmith'),
(3, 'Turician Apothecary', 'Buy potions.', 'Apothecary'),
(4, 'Turician Grocer', 'Buy food.', 'Grocer'),
(5, 'Turician Enchanter', 'Found at the University of the Arcane.', 'Enchanter'),
(6, 'Repair Clothing', 'Repair your ripped clothing. Located within the Tailor.', 'Repair'),
(7, 'Resize Clothing', 'Resize your clothing or armour. Located within the Tailor.', 'Resize'),
(8, 'Armourer', 'Buy armour here.', 'Armourer'),
(9, 'Magic Shop', 'Buy magic weapons here.', 'Blacksmith');

-- --------------------------------------------------------

--
-- Table structure for table `tblshopitemxr`
--

DROP TABLE IF EXISTS `tblshopitemxr`;
CREATE TABLE IF NOT EXISTS `tblshopitemxr` (
  `intShopItemID` int(11) NOT NULL AUTO_INCREMENT,
  `intShopID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `dblPrice` double NOT NULL,
  PRIMARY KEY (`intShopItemID`),
  KEY `fk_intShopID` (`intShopID`),
  KEY `fk_intItemID` (`intItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblshopitemxr`
--

INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES
(3, 3, 5, 20),
(5, 1, 7, 30),
(6, 1, 8, 30),
(7, 2, 10, 10),
(8, 2, 11, 10),
(9, 2, 12, 10),
(10, 2, 16, 10),
(11, 9, 17, 10),
(12, 2, 13, 80),
(13, 2, 20, 80),
(14, 9, 21, 80),
(15, 8, 22, 120),
(16, 2, 15, 25),
(17, 3, 30, 300),
(18, 4, 24, 8),
(19, 4, 25, 5),
(20, 4, 26, 5),
(21, 4, 27, 5),
(22, 4, 28, 5),
(23, 4, 29, 14),
(24, 4, 31, 12),
(25, 3, 36, 200),
(26, 3, 37, 100),
(27, 3, 38, 200),
(28, 3, 39, 400),
(29, 3, 40, 600),
(30, 4, 41, 3),
(31, 4, 42, 3),
(32, 4, 43, 4),
(33, 4, 44, 4),
(34, 2, 33, 10),
(35, 8, 6, 25);

-- --------------------------------------------------------

--
-- Table structure for table `tblskill`
--

DROP TABLE IF EXISTS `tblskill`;
CREATE TABLE IF NOT EXISTS `tblskill` (
  `intSkillID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(45) NOT NULL,
  `strClassName` varchar(45) NOT NULL,
  `txtDescription` text NOT NULL,
  `strSkillType` varchar(45) NOT NULL,
  `intHitCount` int(11) NOT NULL,
  `intTargetCount` int(11) NOT NULL,
  `blnUsableOutsideBattle` tinyint(1) NOT NULL DEFAULT '0',
  `strWeaponType` varchar(45) NOT NULL,
  `intCooldown` int(11) NOT NULL DEFAULT '0',
  `intStatusEffectID` int(11) DEFAULT NULL,
  `intPreCooldown` int(11) NOT NULL,
  PRIMARY KEY (`intSkillID`),
  KEY `intStatusEffectID` (`intStatusEffectID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblskill`
--

INSERT INTO `tblskill` (`intSkillID`, `strName`, `strClassName`, `txtDescription`, `strSkillType`, `intHitCount`, `intTargetCount`, `blnUsableOutsideBattle`, `strWeaponType`, `intCooldown`, `intStatusEffectID`, `intPreCooldown`) VALUES
(1, 'Feed', 'Feed', 'Feed an enemy. Gives option to select the food.', 'Feed', 1, 1, 1, 'All', 0, NULL, 0),
(2, 'Fatten', 'Fatten', 'Fattens an enemy.', 'Debuff', 1, 1, 1, 'All', 2, NULL, 0),
(3, 'Rend', 'Rend', 'Concentrate all your strength into a heavy blow with a melee weapon, targeted at one enemy.', 'Damage', 1, 1, 0, 'Melee', 3, NULL, 0),
(4, 'Magic Bolt', 'MagicBolt', 'Concentrate magical energy into a powerful bolt emitted from your wand or staff. Targets one enemy.', 'Damage', 1, 1, 0, 'Magic', 3, NULL, 0),
(5, 'Hypnosis', 'Hypnosis', 'Skill that places target under control for 3 turns. Has a chance to break out every turn (based on Willpower role). Cannot use attacks or skills during the duration and enemy can control you.', 'Debuff', 1, 1, 1, 'All', 5, 5, 0),
(6, 'Fattening Touch', 'FatteningTouch', 'Used to instantly gain weight. Can be a specific body part or entire body.', 'Debuff', 1, 1, 1, 'All', 0, NULL, 0),
(7, 'Ice Pike', 'IcePike', 'Freezes one enemy for two turns.', 'Debuff', 1, 1, 0, 'Magic', 4, 14, 0),
(8, 'Chain Lightning', 'ChainLightning', 'Fire lightning that hits a target at random then jolts to two more targets. Each jolt does less damage than the initial hit.', 'Damage', 1, 3, 0, 'Magic', 3, NULL, 0),
(9, 'Inferno', 'Inferno', 'Scorch multiple enemies, setting them ablaze for 3 turns in a fiery inferno.', 'Debuff', 1, 3, 0, 'Magic', 4, NULL, 0),
(10, 'Punish', 'Punish', 'Assume a parry stance for one turn, deflecting any melee blows from your enemies and knocking them down if successful.', 'Debuff', 1, 1, 0, 'Melee', 3, 15, 0),
(11, 'Battlecry', 'Battlecry', 'Let out a powerful battlecry! Boosts Willpower by 2 upon activation, with an additional 2 Willpower for every kill, up to a maximum of 80. Disabled upon entering a non-combat zone.', 'Kill Buff', 1, 3, 1, 'Melee', 0, 16, 0),
(12, 'Quake', 'Quake', 'Use your weapon to split the ground, sending shockwaves at your enemies and knocking them off their feet.', 'Damage', 1, 3, 0, 'Melee', 3, NULL, 0),
(13, 'Slime Sacrifice', 'SlimeSacrifice', '', 'Feed', 1, 1, 0, 'None', 0, NULL, 0),
(14, 'Chew', 'Chew', '', 'Damage', 3, 1, 0, 'None', 3, NULL, 0),
(15, 'Leaf Cutter', 'LeafCutter', '', 'Damage', 1, 3, 0, 'None', 4, NULL, 2),
(16, 'Goop Cannon', 'GoopCannon', '', 'Debuff', 1, 3, 0, 'None', 5, 12, 2),
(17, 'Ground Pound', 'GroundPound', '', 'Debuff', 1, 3, 0, 'None', 2, 13, 0),
(18, 'Toxic Breath', 'ToxicBreath', '', 'Debuff', 1, 3, 0, 'None', 3, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstates`
--

DROP TABLE IF EXISTS `tblstates`;
CREATE TABLE IF NOT EXISTS `tblstates` (
  `intStateID` int(11) NOT NULL AUTO_INCREMENT,
  `strStateName` varchar(45) NOT NULL,
  `txtDescription` text,
  PRIMARY KEY (`intStateID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `tblstatuseffect`;
CREATE TABLE IF NOT EXISTS `tblstatuseffect` (
  `intStatusEffectID` int(11) NOT NULL AUTO_INCREMENT,
  `strStatusEffectName` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intStatusEffectID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstatuseffect`
--

INSERT INTO `tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES
(1, 'Fattening I', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(2, 'Armour Binding', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(3, 'Stretchy Armour', '2014-11-04 21:26:59', 'akereliuk', NULL, NULL),
(4, 'Burdened by Weight', '2014-12-08 15:59:48', 'akereliuk', NULL, NULL),
(5, 'Hypnotized', '2016-07-21 00:00:00', 'admin', NULL, NULL),
(6, 'Hungry', '2016-08-12 00:00:00', 'admin', NULL, NULL),
(7, 'Full', '2016-08-12 00:00:00', 'admin', NULL, NULL),
(8, 'Stuffed', '2016-08-12 00:00:00', 'admin', NULL, NULL),
(9, 'Starving', '2016-08-20 00:00:00', 'admin', NULL, NULL),
(11, 'Caffeinated', '2016-08-21 00:00:00', 'admin', NULL, NULL),
(12, 'Stuck', '2019-09-26 00:00:00', 'admin', NULL, NULL),
(13, 'Knocked Down', '2019-09-26 00:00:00', 'admin', NULL, NULL),
(14, 'Frozen', '2019-09-26 00:00:00', 'admin', NULL, NULL),
(15, 'Parry Stance', '2019-09-26 00:00:00', 'admin', NULL, NULL),
(16, 'Battlecry', '2019-09-27 00:00:00', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstatuseffectstatchange`
--

DROP TABLE IF EXISTS `tblstatuseffectstatchange`;
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
  `blnKillBuff` tinyint(1) NOT NULL,
  PRIMARY KEY (`intStatusEffectStatChangeID`),
  KEY `intStatusEffectID` (`intStatusEffectID`),
  KEY `intOverrideID` (`intOverrideID`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstatuseffectstatchange`
--

INSERT INTO `tblstatuseffectstatchange` (`intStatusEffectStatChangeID`, `intStatusEffectID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intOverrideID`, `blnInfinite`, `intDuration`, `blnIncremental`, `blnKillBuff`) VALUES
(4, 1, 'Weight', 1, 3, NULL, 1, 9999, 1, 0),
(5, 2, '', 0, 0, 1, 1, 9999, 0, 0),
(6, 3, '', 0, 0, 2, 1, 9999, 0, 0),
(7, 4, '', 0, 0, 4, 1, 9999, 0, 0),
(8, 5, '', 0, 0, 5, 0, 3, 0, 0),
(12, 9, '', 0, 0, NULL, 1, 9999, 0, 0),
(14, 6, '', 0, 0, NULL, 1, 9999, 0, 0),
(15, 7, '', 0, 0, NULL, 1, 9999, 0, 0),
(16, 8, '', 0, 0, NULL, 1, 9999, 0, 0),
(17, 11, 'intAgility', 0, 20, NULL, 0, 24, 0, 0),
(18, 12, '', 0, 0, NULL, 0, 1, 0, 0),
(19, 13, '', 0, 0, NULL, 0, 1, 0, 0),
(20, 14, '', 0, 0, NULL, 0, 2, 0, 0),
(21, 15, '', 0, 0, NULL, 0, 1, 0, 0),
(22, 16, 'intWillpower', 2, 80, NULL, 1, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltown`
--

DROP TABLE IF EXISTS `tbltown`;
CREATE TABLE IF NOT EXISTS `tbltown` (
  `intTownID` int(11) NOT NULL AUTO_INCREMENT,
  `strTownName` varchar(45) NOT NULL,
  PRIMARY KEY (`intTownID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltown`
--

INSERT INTO `tbltown` (`intTownID`, `strTownName`) VALUES
(1, 'Turici');

-- --------------------------------------------------------

--
-- Table structure for table `tbluniqueeventgifts`
--

DROP TABLE IF EXISTS `tbluniqueeventgifts`;
CREATE TABLE IF NOT EXISTS `tbluniqueeventgifts` (
  `intUniqueEventGiftID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `dtmDateObtained` datetime NOT NULL,
  PRIMARY KEY (`intUniqueEventGiftID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intEventID` (`intEventID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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
-- Constraints for table `tblcharacterclassxr`
--
ALTER TABLE `tblcharacterclassxr`
  ADD CONSTRAINT `fk_tblcharacterclassxr_intClassID` FOREIGN KEY (`intClassID`) REFERENCES `tblclass` (`intClassID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblcharacterclassxr_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tblcharacterquestkillreqxr`
--
ALTER TABLE `tblcharacterquestkillreqxr`
  ADD CONSTRAINT `fk_characterquestkill_KillReqID` FOREIGN KEY (`intKillReqID`) REFERENCES `tblquestkillreq` (`intKillReqID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_characterquestkill_QuestID` FOREIGN KEY (`intQuestID`) REFERENCES `tblquest` (`intQuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_characterquestkill_RPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcharacterquestxr`
--
ALTER TABLE `tblcharacterquestxr`
  ADD CONSTRAINT `fk_characterquest_QuestID` FOREIGN KEY (`intQuestID`) REFERENCES `tblquest` (`intQuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_characterquest_RPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tblclassskillxr`
--
ALTER TABLE `tblclassskillxr`
  ADD CONSTRAINT `fk_tblclassskillxr_intClassID` FOREIGN KEY (`intClassID`) REFERENCES `tblclass` (`intClassID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblclassskillxr_intSkillID` FOREIGN KEY (`intSkillID`) REFERENCES `tblskill` (`intSkillID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tbleventconversation`
--
ALTER TABLE `tbleventconversation`
  ADD CONSTRAINT `fk_tblEventConversation_intEventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblEventConversation_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbleventitemxr`
--
ALTER TABLE `tbleventitemxr`
  ADD CONSTRAINT `fk_tbleventitemxr_intEventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbleventitemxr_intItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblflooreventxr`
--
ALTER TABLE `tblflooreventxr`
  ADD CONSTRAINT `tblflooreventxr_ibfk_1` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblflooreventxr_ibfk_2` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfloornpcxr`
--
ALTER TABLE `tblfloornpcxr`
  ADD CONSTRAINT `fk_tblfloornpcxr_intfloorid` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblfloornpcxr_intnpcid` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tblnpcbattletext`
--
ALTER TABLE `tblnpcbattletext`
  ADD CONSTRAINT `fk_tblnpcbattletext_intnpcid` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcgrowth`
--
ALTER TABLE `tblnpcgrowth`
  ADD CONSTRAINT `fk_tblNPCGrowth_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcinstance`
--
ALTER TABLE `tblnpcinstance`
  ADD CONSTRAINT `fk_tblnpcinstance_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblnpcinstance_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcinstancestats`
--
ALTER TABLE `tblnpcinstancestats`
  ADD CONSTRAINT `fk_tblNPCInstanceStats_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblNPCInstanceStats_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tblnpcskillxr`
--
ALTER TABLE `tblnpcskillxr`
  ADD CONSTRAINT `fk_intnpcskillxr_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblnpcskillxr_intSkillID` FOREIGN KEY (`intSkillID`) REFERENCES `tblskill` (`intSkillID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblnpcstats`
--
ALTER TABLE `tblnpcstats`
  ADD CONSTRAINT `tblnpcstats_ibfk_1` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblquestkillreq`
--
ALTER TABLE `tblquestkillreq`
  ADD CONSTRAINT `fk_killreq_NPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_killreq_QuestID` FOREIGN KEY (`intQuestID`) REFERENCES `tblquest` (`intQuestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblrpgcharacter`
--
ALTER TABLE `tblrpgcharacter`
  ADD CONSTRAINT `tblrpgcharacter_ibfk_1` FOREIGN KEY (`strUserID`) REFERENCES `tbluser` (`strUserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblrpgcharacter_ibfk_2` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON UPDATE CASCADE;

--
-- Constraints for table `tblshopitemxr`
--
ALTER TABLE `tblshopitemxr`
  ADD CONSTRAINT `fk_intItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`),
  ADD CONSTRAINT `fk_intShopID` FOREIGN KEY (`intShopID`) REFERENCES `tblshop` (`intShopID`);

--
-- Constraints for table `tblskill`
--
ALTER TABLE `tblskill`
  ADD CONSTRAINT `fk_tblSkill_intStatusEffectID` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstatuseffectstatchange`
--
ALTER TABLE `tblstatuseffectstatchange`
  ADD CONSTRAINT `tblstatuseffectstatchange_ibfk_1` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect` (`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblstatuseffectstatchange_ibfk_2` FOREIGN KEY (`intOverrideID`) REFERENCES `tbloverride` (`intOverrideID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbluniqueeventgifts`
--
ALTER TABLE `tbluniqueeventgifts`
  ADD CONSTRAINT `fk_uniquegifts_EventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_uniquegifts_ItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_uniquegifts_RPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
