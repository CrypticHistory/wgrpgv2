<?php

	include_once "Database.class";
	
	$objDB = new Database();
	
	$strSQL = "SET FOREIGN_KEY_CHECKS = 0;"
	$strSQL += "DELETE FROM `dbwgrpg`.`tblfloor` WHERE `tblfloor`.`intFloorID` = 2;
				DELETE FROM `dbwgrpg`.`tblfloor` WHERE `tblfloor`.`intFloorID` = 3;
				DELETE FROM `dbwgrpg`.`tblfloor` WHERE `tblfloor`.`intFloorID` = 4;
				DELETE FROM `dbwgrpg`.`tblfloor` WHERE `tblfloor`.`intFloorID` = 5;
				INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Forced Battle Goblin', 'Forces you to battle the goblin instead of giving you an option.', 'forcedBattleGoblin.xml', '1', '0', '2016-02-12 00:00:00', 'admin', NULL, NULL);
				INSERT INTO `dbwgrpg`.`tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES (NULL, '1', '10', '1000');
				CREATE TABLE IF NOT EXISTS `tbltown` (
				  `intTownID` int(11) NOT NULL AUTO_INCREMENT,
				  `strTownName` varchar(45) NOT NULL,
				  PRIMARY KEY (`intTownID`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
				INSERT INTO `tbltown` (`intTownID`, `strTownName`) VALUES
				(1, 'Turici');
				ALTER TABLE `tblrpgcharacter` ADD `intTownID` INT(8) NULL AFTER `intStateID`;
				INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Leave Tower Event Long', 'When user leaves the tower for the first time to enter city.', 'leaveTowerLong.xml', '0', '0', '2016-02-12 00:00:00', 'admin', NULL, NULL), (NULL, 'Leave Tower Event Short', 'When user leaves the tower after the first time.', 'leaveTowerShort.xml', '1', '0', '2016-02-12 00:00:00', 'admin', NULL, NULL);
				ALTER TABLE `tblitem` CHANGE `strItemType` `strItemType` ENUM('Weapon:Blunt','Weapon:Sword','Weapon:Axe','Weapon:Shield','Weapon:Staff','Weapon:Tome','Weapon:Wand','Weapon:Dagger','Weapon:Shuriken','Weapon:Pistols','Weapon:Rifle','Weapon:Bow','Weapon:Claws','Weapon:Gloves','Armour:Clothes','Armour:Light','Armour:Heavy','Accessory','Food','Potion','Gem','Material','Quest') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
				ALTER TABLE `tblitem` ADD `strHandType` VARCHAR(45) NULL AFTER `strItemType`;
				UPDATE `dbwgrpg`.`tblitem` SET `strHandType` = 'Primary' WHERE `tblitem`.`intItemID` = 3;
				ALTER TABLE `tblitem` ADD `txtItemDescLong` TEXT NOT NULL AFTER `txtItemDesc`;
				UPDATE `dbwgrpg`.`tblflooreventxr` SET `intOccurrenceRating` = '2000' WHERE `tblflooreventxr`.`intFloorEventXRID` = 1;
				UPDATE `dbwgrpg`.`tblflooreventxr` SET `intOccurrenceRating` = '1000' WHERE `tblflooreventxr`.`intFloorEventXRID` = 5;";
	
	$objDB->query($strSQL);

?>