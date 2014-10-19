CREATE TABLE IF NOT EXISTS `tbluser` (
  `intUserID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strPassword` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intUserID`),
  UNIQUE KEY `strUserID` (`strUserID`),
  UNIQUE KEY `intUserID` (`intUserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tblrpgcharacter` (
  `intRPGCharacterID` int(12) NOT NULL AUTO_INCREMENT,
  `strUserID` varchar(45) NOT NULL,
  `strRPGCharacterName` varchar(45) NOT NULL,
  `intHeight` int(11) NOT NULL DEFAULT '165',
  `dblWeight` double NOT NULL,
  `intDigestionRate` int(11) NOT NULL DEFAULT '250',
  `intFloorID` int(11) NOT NULL DEFAULT '1',
  `intEventID` int(11) NOT NULL DEFAULT '1',
  `intEventNodeID` int(11) NOT NULL DEFAULT '0',
  `intDay` int(11) NOT NULL DEFAULT '1',
  `strTime` varchar(5) NOT NULL DEFAULT '00:00',
  `intArmourRipLevel` int(11) DEFAULT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intRPGCharacterID`),
  KEY `intUserID` (`strUserID`),
  KEY `intFloorID` (`intFloorID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tblfloor` (
  `intFloorID` int(11) NOT NULL AUTO_INCREMENT,
  `strFloorName` varchar(45) NOT NULL,
  `txtEntryText` text NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intFloorID`),
  UNIQUE KEY `intFloorID` (`intFloorID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tblevent` (
  `intEventID` int(11) NOT NULL AUTO_INCREMENT,
  `strEventName` varchar(45) NOT NULL,
  `txtEventDesc` text,
  `strXML` varchar(45) NOT NULL,
  `blnRepeating` tinyint(1) NOT NULL DEFAULT '1',
  `dtmCreatedOn` datetime NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tblflooreventxr` (
  `intFloorID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  KEY `intFloorID` (`intFloorID`,`intEventID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tblitem` (
  `intItemID` int(11) NOT NULL AUTO_INCREMENT,
  `strItemName` varchar(45) NOT NULL,
  `txtItemDesc` text NOT NULL,
  `strItemType` varchar(45) NOT NULL,
  `intCalories` int(11) DEFAULT NULL,
  `intDamage` int(11) DEFAULT NULL,
  `intDefence` int(11) DEFAULT NULL,
  `strSize` varchar(45) DEFAULT NULL,
  `intEventID` int(11) NOT NULL,
  `strCreatedBy` varchar(45) NOT NULL,
  `dtmCreatedOn` datetime NOT NULL,
  `strModifiedBy` varchar(45) DEFAULT NULL,
  `dtmModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`intItemID`),
  KEY `intEventID` (`intEventID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tblcharacteritemxr` (
  `intItemInstanceID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intCaloriesRemaining` int(11) DEFAULT NULL,
  `blnDigesting` tinyint(4) NOT NULL DEFAULT '0',
  `blnEquipped` tinyint(4) NOT NULL DEFAULT '0',
  `dtmDateAdded` datetime NOT NULL,
  PRIMARY KEY (`intItemInstanceID`),
  KEY `intCharacterID` (`intRPGCharacterID`,`intItemID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tblcharactereventxr` (
  `intRPGCharacterID` int(11) NOT NULL,
  `intEventID` int(11) NOT NULL,
  `dtmDateAdded` datetime NOT NULL,
  KEY `intRPGCharacterID` (`intRPGCharacterID`,`intEventID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;