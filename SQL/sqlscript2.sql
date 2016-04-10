ALTER TABLE `tblrpgcharacter` DROP `intArmourRipLevel`;
ALTER TABLE `tblitem` CHANGE `strItemType` `strItemType` ENUM('Weapon:Blunt','Weapon:Sword','Weapon:Axe','Weapon:Shield','Weapon:Staff','Weapon:Tome','Weapon:Wand','Weapon:Dagger','Weapon:Shuriken','Weapon:Pistols','Weapon:Rifle','Weapon:Bow','Weapon:Claws','Weapon:Gloves','Armour:Top','Armour:Bottom','Armour:Armour','Accessory','Food','Potion','Gem','Material','Quest') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
DELETE FROM `dbwgrpg`.`tblitemenchantxr` WHERE `tblitemenchantxr`.`intItemEnchantXRID` = 1;
DELETE FROM `dbwgrpg`.`tblitemenchantxr` WHERE `tblitemenchantxr`.`intItemEnchantXRID` = 2;
DELETE FROM tbliteminstanceenchant;
DELETE FROM tblrpgcharacter;
DELETE FROM tblshopitemxr WHERE intShopItemID = 1;
DELETE FROM `dbwgrpg`.`tblitem` WHERE `tblitem`.`intItemID` = 2;
DELETE FROM `dbwgrpg`.`tblitem` WHERE `tblitem`.`intItemID` = 4;
INSERT INTO `dbwgrpg`.`tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Leather Cuirass', 'A light leather cuirass meant to be worn on top of clothes. The bottom is a skirt which leaves the lower body unprotected. Great for mobility.', '', 'Armour:Armour', NULL, NULL, '0', NULL, NULL, '2', NULL, NULL, '1', 'admin', '2016-04-08 00:00:00', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Tanktop', 'A simple tanktop.', '', 'Armour:Top', NULL, NULL, '0', NULL, NULL, '1', NULL, NULL, '1', 'admin', '2016-04-08 00:00:00', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Jeans', 'Straight blue jeans.', '', 'Armour:Bottom', NULL, NULL, '0', NULL, NULL, '1', NULL, NULL, '1', 'admin', '2016-04-08 00:00:00', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblitemenchantxr` (`intItemEnchantXRID`, `intItemID`, `intEnchantID`, `intOccurrence`) VALUES (NULL, '6', '1', '0'), (NULL, '6', '2', '0');
INSERT INTO `dbwgrpg`.`tblclothingdesc` (`intClothingDescID`, `intItemID`, `strXML`) VALUES (NULL, '6', 'Both/cuirass.xml'), (NULL, '7', 'Tops/tanktop.xml'), (NULL, '8', 'Bottoms/jeans.xml');
INSERT INTO `dbwgrpg`.`tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '1', '7', '1'), (NULL, '1', '8', '1');
DELETE FROM `dbwgrpg`.`tblflooreventxr` WHERE `tblflooreventxr`.`intFloorEventXRID` = 4
DELETE FROM `dbwgrpg`.`tblevent` WHERE `tblevent`.`intEventID` = 5;

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

ALTER TABLE `tblcharacterbody`
  ADD CONSTRAINT `fk_tblcharacterbody_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;