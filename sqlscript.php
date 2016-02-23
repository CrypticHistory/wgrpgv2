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
				UPDATE `dbwgrpg`.`tblflooreventxr` SET `intOccurrenceRating` = '1000' WHERE `tblflooreventxr`.`intFloorEventXRID` = 5;
				CREATE TABLE IF NOT EXISTS `tbllocation` (
				  `intLocationID` int(11) NOT NULL AUTO_INCREMENT,
				  `strLocationName` varchar(45) NOT NULL,
				  `strLocationType` varchar(45) NOT NULL DEFAULT 'Building',
				  `intTownID` int(11) NOT NULL DEFAULT '1',
				  `txtDescription` text,
				  PRIMARY KEY (`intLocationID`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
				INSERT INTO `tbllocation` (`intLocationID`, `strLocationName`, `strLocationType`, `intTownID`, `txtDescription`) VALUES
					(1, 'Tower Entrance', 'Hub', 1, NULL),
					(2, 'Residential District', 'Hub', 1, NULL),
					(3, 'Commercial District', 'Hub', 1, NULL),
					(4, 'Development District', 'Hub', 1, NULL),
					(5, 'Red Light District', 'Hub', 1, NULL),
					(6, 'Home', 'Building', 1, NULL),
					(7, 'Tailor', 'Building', 1, NULL),
					(8, 'Blacksmith', 'Building', 1, NULL),
					(9, 'Apothecary', 'Building', 1, NULL),
					(10, 'Grocer', 'Building', 1, NULL),
					(11, 'University of the Arcane', 'Building', 1, NULL),
					(12, 'Town Square', 'Hub', 1, NULL);
				ALTER TABLE `tblrpgcharacter` ADD `intCurrentFloorID` INT NOT NULL AFTER `intFloorID`;
				ALTER TABLE tbllocation ADD CONSTRAINT fk_intTownID FOREIGN KEY (intTownID) REFERENCES tbltown(intTownID);
				ALTER TABLE tbllocationeventlink ADD CONSTRAINT fk_intLocationID FOREIGN KEY (intLocationID) REFERENCES tbllocation(intLocationID);
				ALTER TABLE tbllocationeventlink ADD CONSTRAINT fk_intEventID FOREIGN KEY (intEventID) REFERENCES tblevent(intEventID);
				ALTER TABLE tbllocationshoplink ADD CONSTRAINT fk_intLocationID2 FOREIGN KEY (intLocationID) REFERENCES tbllocation(intLocationID);
				ALTER TABLE tbllocationshoplink ADD CONSTRAINT fk_intShopID2 FOREIGN KEY (intShopID) REFERENCES tblshop(intShopID);
				ALTER TABLE tbllocationxrlink ADD CONSTRAINT fk_intFromLocationID FOREIGN KEY (intFromLocationID) REFERENCES tbllocation(intLocationID);
				ALTER TABLE tbllocationxrlink ADD CONSTRAINT fk_intToLocationID FOREIGN KEY (intToLocationID) REFERENCES tbllocation(intLocationID);
				ALTER TABLE tblshopitemxr ADD CONSTRAINT fk_intShopID FOREIGN KEY (intShopID) REFERENCES tblshop(intShopID);
				ALTER TABLE tblshopitemxr ADD CONSTRAINT fk_intItemID FOREIGN KEY (intItemID) REFERENCES tblitem(intItemID);
				INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Sleep at Home', 'Character sleeps in their room at home.', 'sleepAtHome.xml', '1', '0', '2016-02-18 00:00:00', 'admin', NULL, NULL);
				INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Look at Home Mirror', 'Take a look at yourself in your full body mirror at home.', 'mirrorAtHome.xml', '1', '0', '2016-02-18 00:00:00', 'admin', NULL, NULL);
				INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Reset Stats at UoA', 'Reset your stats at the University of the Arcane.', 'resetStatsUoA.xml', '1', '0', '2016-02-18 00:00:00', 'admin', NULL, NULL);
				INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `blnRepeating`, `blnForcedEvent`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Disenchant Armour at UoA', 'Disenchant your currently equipped armour at the University of the Arcane.', 'disenchantAtUoA.xml', '1', '0', '2016-02-18 00:00:00', 'admin', NULL, NULL);
				INSERT INTO `dbwgrpg`.`tblshop` (`intShopID`, `strShopName`, `txtShopDesc`) VALUES (NULL, 'Turician Tailor', 'Buy clothes.'), (NULL, 'Turician Blacksmith', 'Buy armour and weapons.'), (NULL, 'Turician Apothecary', 'Buy potions.'), (NULL, 'Turician Grocer', 'Buy food.');
				INSERT INTO `dbwgrpg`.`tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES (NULL, '6', '13', 'Sleep'), (NULL, '6', '14', 'View Mirror');
				INSERT INTO `dbwgrpg`.`tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES (NULL, '7', '1', 'Shop');
				INSERT INTO `dbwgrpg`.`tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES (NULL, '8', '2', 'Shop');
				INSERT INTO `dbwgrpg`.`tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES (NULL, '9', '3', 'Shop');
				INSERT INTO `dbwgrpg`.`tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES (NULL, '10', '4', 'Shop');
				INSERT INTO `dbwgrpg`.`tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES (NULL, '6', '2', 'Leave'), (NULL, '2', '6', 'Home'), (NULL, '12', '1', 'Tower Entrance'), (NULL, '12', '2', 'Residential District'), (NULL, '12', '3', 'Commercial District'), (NULL, '12', '4', 'Development District'), (NULL, '12', '5', 'Red Light District'), (NULL, '2', '12', 'Square'), (NULL, '3', '7', 'Tailor'), (NULL, '3', '8', 'Blacksmith'), (NULL, '3', '9', 'Apothecary'), (NULL, '3', '10', 'Grocer'), (NULL, '3', '12', 'Square'), (NULL, '4', '11', 'University of the Arcane'), (NULL, '4', '12', 'Square'), (NULL, '5', '12', 'Square'), (NULL, '7', '3', 'Leave'), (NULL, '8', '3', 'Leave'), (NULL, '9', '3', 'Leave'), (NULL, '10', '3', 'Leave'), (NULL, '11', '4', 'Leave');
				INSERT INTO `dbwgrpg`.`tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES (NULL, '11', '15', 'Reset Stats'), (NULL, '11', '16', 'Disenchant Armour');
				ALTER TABLE `tblrpgcharacter` ADD `intLocationID` INT NOT NULL DEFAULT '6' AFTER `intTownID`;
				INSERT INTO `dbwgrpg`.`tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES (NULL, '1', '12', 'Square');
				UPDATE `dbwgrpg`.`tbllocation` SET `txtDescription` = 'The residential district is where you and most other citizens live. The most obvious exception are the merchants, guildsmen, and freemen, who live in the Commercial, Development, and Red Light districts respectively. The buildings here are the most numerous in the entire city, and range from the most decrepit shacks to the opulent mansions of the elder families. The streets are made of a flat, grey cobblestone that runs beside and behind every home, creating a great lattice of streets and alleyways for the populace to traverse. ' WHERE `tbllocation`.`intLocationID` = 2;
				UPDATE `dbwgrpg`.`tbllocation` SET `txtDescription` = 'The commercial district is one of the most diverse districts in the city. A myriad of scents and sounds assail your senses as you enter the main throughway containing the district. Merchants hawk their wares at you as you pass, and children scamper between the legs of the larger adults in laughter and play. Even so, you’ve been around the block more than once, and keep an eye on your money and yourself - the commercial district has more than its own fair share of thieves and muggers.
					<br/><br/>Though the children play and the streets are filled, you can’t shake the feeling that the district is… empty. Every other shop seems to be boarded up, and even those that are open for business don’t seem to be supplied very well. It makes sense, Turici was founded during the first wave of adventuring into the Tower. With it just being reopened, the city’s still recovering. Maybe with the tower’s reopening, the prospects will improve?' WHERE intLocationID = 3;
				UPDATE `dbwgrpg`.`tbllocation` SET `txtDescription` = 'The smithy is a claustrophobic space, filled with multitudes of weapons, shields, armour, tools, and other metallic objects. A thin veil of smoke seems to hang in the air, obscuring your sight and discoloring everything you see. Despite this, however, your untrained eye can easily see the masterful craftsmanship in many of the items for sale. The forge is the most obvious centerpiece to all of this, as it’s set in the back wall of the structure and surrounded by plethora of smithing tools. A huge clay lined stone box with a large chimney like structure leading up through the roof, it is the heart of the smithy.' WHERE `tbllocation`.`intLocationID` = 8;
				UPDATE `dbwgrpg`.`tbllocation` SET `txtDescription` = 'The store you stand in is finely organized and smells faintly of pine. Around you stand dozens of different pieces of clothing, ranging from simple blouses to gilded noble’s outfits, fit only for dances and dinner, not for the rigors of combat. Still, they look good. Other than the clothing you can see a rather elaborate seamstress’s station behind the counter. Seems that you can buy clothes here and have them tailored to fit you too!' WHERE `tbllocation`.`intLocationID` = 7;";
	
	$objDB->query($strSQL);

?>