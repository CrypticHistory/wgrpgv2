DELETE FROM `tblevent` WHERE `tblevent`.`intEventID` = 7;
DELETE FROM `tblevent` WHERE `tblevent`.`intEventID` = 10;
ALTER TABLE `tblevent` DROP `blnForcedEvent`;
UPDATE `tblevent` SET `strEventType` = 'Start Event' WHERE `tblevent`.`intEventID` = 2;
UPDATE `tblnpc` SET `blnHasStartEvent` = '1', `blnHasEndEvent` = '1' WHERE `tblnpc`.`intNPCID` = 2;
ALTER TABLE `tblfloornpcxr` ADD `intOccurrenceRating` INT(11) NOT NULL DEFAULT '0' AFTER `intNPCID`;
ALTER TABLE `tblfloor` DROP `txtEntryText`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
INSERT INTO `tblnpcbattletext` (`intNPCBattleTextID`, `intNPCID`, `strStartText`, `strForceStartText`, `strEndText`, `strDefeatText`, `strFleeText`, `strFailFleeText`) VALUES
(1, 1, 'As you come closer, you can hear the clinking of metal. This figure is armed. It rears its head and snarls at you, aware of your presence.', 'You hear the clinking of metal. A silhouette appears in the distance. As you come closer, you can tell this figure is armed. It rears its head and snarls at you, aware of your presence.', '', '', '', '');
ALTER TABLE `tblnpcbattletext`
  ADD CONSTRAINT `fk_tblnpcbattletext_intnpcid` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;
CREATE TABLE IF NOT EXISTS `tblfloornpcxr` (
  `intFloorNPCXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intFloorID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intOccurrenceRating` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intFloorNPCXRID`),
  KEY `intFloorID` (`intFloorID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES
(1, 1, 1, 1000),
(2, 1, 2, 9999);
ALTER TABLE `tblfloornpcxr`
  ADD CONSTRAINT `fk_tblfloornpcxr_intfloorid` FOREIGN KEY (`intFloorID`) REFERENCES `tblfloor` (`intFloorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblfloornpcxr_intnpcid` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;
  UPDATE `tblflooreventxr` SET `intOccurrenceRating` = '9999' WHERE `tblflooreventxr`.`intFloorEventXRID` = 1;
  UPDATE `tblflooreventxr` SET `intOccurrenceRating` = '1000' WHERE `tblflooreventxr`.`intFloorEventXRID` = 2;
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Generic Combat', 'User given choice to engage in combat.', 'genericCombat.xml', 'Forced Combat', '1', '2016-06-15 00:00:00', 'admin', NULL, NULL), (NULL, 'Generic Forced Combat', 'User is thrust into battle.', 'genericForceCombat.xml', 'Combat', '1', '2016-06-15 00:00:00', 'admin', NULL, NULL);
CREATE TABLE IF NOT EXISTS `tblclass` (
  `intClassID` int(11) NOT NULL AUTO_INCREMENT,
  `strClassName` varchar(45) NOT NULL,
  `txtClassDescription` text NOT NULL,
  PRIMARY KEY (`intClassID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;
INSERT INTO `tblclass` (`intClassID`, `strClassName`, `txtClassDescription`) VALUES
(1, 'Merchant', 'A class that is more concerned with earning money than increasing their combat prowess. Usually hires mercenaries to fight for them.'),
(2, 'Feeder', 'A class that is focused on feeding your enemies and allies during and outside of battle. Uses old fashioned methods instead of the arcane.'),
(3, 'Manipulator', 'A class that manipulates their surrounding environment to create a favourable situation during battle.');
CREATE TABLE IF NOT EXISTS `tblskill` (
  `intSkillID` int(11) NOT NULL AUTO_INCREMENT,
  `strName` varchar(45) NOT NULL,
  `txtDescription` text NOT NULL,
  `strSkillType` varchar(45) NOT NULL,
  `intHitCount` int(11) NOT NULL,
  `intTargetCount` int(11) NOT NULL,
  `blnUsableOutsideBattle` tinyint(1) NOT NULL DEFAULT '0',
  `strWeaponType` varchar(45) NOT NULL,
  PRIMARY KEY (`intSkillID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
INSERT INTO `tblskill` (`intSkillID`, `strName`, `txtDescription`, `strSkillType`, `intHitCount`, `intTargetCount`, `blnUsableOutsideBattle`, `strWeaponType`) VALUES
(1, 'Feed', 'Feed an enemy. Gives option to select the food.', 'Feed', 1, 1, 1, 'All'),
(2, 'Fatten', 'Fattens an enemy.', 'Debuff', 1, 1, 1, 'All');
CREATE TABLE IF NOT EXISTS `tblcharacterclassxr` (
  `intCharacterClassXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intClassID` int(11) NOT NULL,
  `intClassLevel` int(11) NOT NULL,
  `intClassExperience` int(11) NOT NULL,
  PRIMARY KEY (`intCharacterClassXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intClassID` (`intClassID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE `tblcharacterclassxr`
  ADD CONSTRAINT `fk_tblcharacterclassxr_intClassID` FOREIGN KEY (`intClassID`) REFERENCES `tblclass` (`intClassID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblcharacterclassxr_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;
  ALTER TABLE `tblcharacterclassxr` ADD `blnCurrentClass` TINYINT(1) NOT NULL DEFAULT '0' AFTER `intClassExperience`;
 CREATE TABLE IF NOT EXISTS `tblclassskillxr` (
  `intClassSkillXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intClassID` int(11) NOT NULL,
  `intSkillID` int(11) NOT NULL,
  `intRequiredClassLevel` int(11) NOT NULL,
  PRIMARY KEY (`intClassSkillXRID`),
  KEY `intClassID` (`intClassID`),
  KEY `intSkillID` (`intSkillID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE `tblclassskillxr`
  ADD CONSTRAINT `fk_tblclassskillxr_intSkillID` FOREIGN KEY (`intSkillID`) REFERENCES `tblskill` (`intSkillID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblclassskillxr_intClassID` FOREIGN KEY (`intClassID`) REFERENCES `tblclass` (`intClassID`) ON DELETE CASCADE ON UPDATE CASCADE; 
INSERT INTO `tblclassskillxr` (`intClassSkillXRID`, `intClassID`, `intSkillID`, `intRequiredClassLevel`) VALUES (NULL, '2', '1', '1'), (NULL, '3', '2', '1');
ALTER TABLE `tblrpgcharacter` DROP FOREIGN KEY `tblrpgcharacter_ibfk_3`;
ALTER TABLE `tblrpgcharacter`
  DROP `intEventID`,
  DROP `intEventNodeID`;
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Chocolate Cupcake', 'A delicious chocolate glazed cupcake. Yummy!', '', 'Food', NULL, '600', '1', NULL, NULL, NULL, NULL, NULL, '1', 'admin', '2016-07-05 00:00:00', NULL, NULL);
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '2', '9', '0', '1', '10000', '2016-07-05 00:00:00');
CREATE TABLE IF NOT EXISTS `tblnpcskillxr` (
  `intNPCSkillXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intNPCID` int(11) NOT NULL,
  `intSkillID` int(11) NOT NULL,
  PRIMARY KEY (`intNPCSkillXRID`),
  KEY `intNPCID` (`intNPCID`),
  KEY `intSkillID` (`intSkillID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
INSERT INTO `tblnpcskillxr` (`intNPCSkillXRID`, `intNPCID`, `intSkillID`) VALUES
(1, 2, 1);
ALTER TABLE `tblnpcskillxr`
  ADD CONSTRAINT `fk_tblnpcskillxr_intSkillID` FOREIGN KEY (`intSkillID`) REFERENCES `tblskill` (`intSkillID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_intnpcskillxr_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `tblnpc` ADD `strAIName` VARCHAR(45) NOT NULL DEFAULT 'AlwaysAttack' AFTER `blnHasEndEvent`;
ALTER TABLE `tblskill` ADD `strClassName` VARCHAR(45) NOT NULL AFTER `strName`;
UPDATE `tblskill` SET `strClassName` = 'Fatten' WHERE `tblskill`.`intSkillID` = 2;
UPDATE `tblskill` SET `strClassName` = 'Feed' WHERE `tblskill`.`intSkillID` = 1;
UPDATE `tblnpcstats` SET `intMaxHP` = '20' WHERE `tblnpcstats`.`intNPCStatsID` = 2;
INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Rat', '2', '30', '400', '0', '3', '0', '0', 'AlwaysAttack', '2016-07-14 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES (NULL, '3', '5', '1', '1', '20', '1', '1', '1', '0', '0', '0', '0', '10');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Wooden Stick', 'A rugged wooden stick that could potentially be used as a weapon, albeit not a very effective one.', '', 'Weapon:Sword', 'Primary', NULL, '0', '1', NULL, NULL, NULL, 'Strength', '1', 'admin', '2016-07-14 00:00:00', NULL, NULL);
ALTER TABLE `tblitem` ADD `intWaitTime` INT NOT NULL DEFAULT '0' AFTER `intMagicDefence`;
UPDATE `tblitem` SET `intWaitTime` = '35' WHERE `tblitem`.`intItemID` = 3;
UPDATE `tblitem` SET `intWaitTime` = '10' WHERE `tblitem`.`intItemID` = 10;
UPDATE `tblitem` SET `intWaitTime` = '10' WHERE `tblitem`.`intItemID` = 6;
UPDATE `tblitem` SET `intWaitTime` = '2' WHERE `tblitem`.`intItemID` = 7;
UPDATE `tblitem` SET `intWaitTime` = '3' WHERE `tblitem`.`intItemID` = 8;
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Broad Stick', 'A stick with more girth than your average tree branch, equipped with a trunk-like tip making it much more viable for combat.', '', 'Weapon:Blunt', 'Primary', NULL, '0', '2', NULL, NULL, NULL, '20', 'Strength', '1', 'admin', '2016-07-14 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES ('12', 'Wooden Axe', 'A bit of woodwork and a few sturdy logs and you''ve got yourself a fairly durable axe weapon. Not nearly as effective as a metal axe, but certainly cheaper.', '', 'Weapon:Axe', 'Primary', NULL, '0', '2', NULL, NULL, NULL, '20', 'Strength', '1', 'admin', '2016-07-14 00:00:00', NULL, NULL);
INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Skeleton', '80', '130', '3200', '3', '10', '0', '0', 'AlwaysAttack', '2016-07-14 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '4', '12', '1', '1', '1500', '2016-07-14 00:00:00');
INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES (NULL, '4', '30', '10', '1', '3', '15', '1', '5', '1', '0', '0', '0', '10');
INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Goblin Chief', '250', '130', '4000', '10', '30', '1', '1', 'AlwaysAttack', '2016-07-14 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES (NULL, '5', '50', '15', '5', '10', '15', '10', '10', '10', '50', '10', '10', '10');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `txtItemDescLong`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Hammer', 'A one-handed hammer consisting of a metallic striking head fastened to a wooden handle. In the right hands, this could dish out some heavy blows.', '', 'Weapon:Blunt', 'Primary', NULL, '0', '8', NULL, NULL, NULL, '25', 'Strength', '1', 'admin', '2016-07-14 00:00:00', NULL, NULL);
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '4', '13', '1', '1', '2000', '2016-07-14 00:00:00');
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES (NULL, '1', '3', '1000');
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES (NULL, '1', '5', '9999');
UPDATE `tblnpcstats` SET `intMaxHP` = '16' WHERE `tblnpcstats`.`intNPCStatsID` = 1;
UPDATE `tblnpcstats` SET `intMaxHP` = '8' WHERE `tblnpcstats`.`intNPCStatsID` = 3;
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Floor 1 Boss', 'Fight the goblin chief at the end of floor 1.', 'floor1Boss.xml', 'End Event', '0', '2016-07-16 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Generic Descend Floor', 'Shows staircase down and option to descend.', 'genericDescend.xml', 'Event', '1', '2016-07-16 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Generic Ascend Floor', 'Show staircase up and option to ascend.', 'genericAscend.xml', 'Event', '1', '2016-07-16 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES (NULL, '1', '19', '9999');
UPDATE `tblevent` SET `blnRepeating` = '1' WHERE `tblevent`.`intEventID` = 19;
UPDATE `tblnpcstats` SET `intMaxHP` = '25', `intVitality` = '10', `intDexterity` = '30', `intBlockRate` = '30', `intBlockReduction` = '50' WHERE `tblnpcstats`.`intNPCStatsID` = 5;
UPDATE `tblnpcstats` SET `intCritDamage` = '150' WHERE `tblnpcstats`.`intNPCStatsID` = 3;
UPDATE `tblnpcstats` SET `intCritDamage` = '150' WHERE `tblnpcstats`.`intNPCStatsID` = 4;
ALTER TABLE `tblitem` DROP `txtItemDescLong`;
DELETE FROM tblshopitemxr WHERE intShopID = '2';
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '10', '10');
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '11', '10'), (NULL, '2', '12', '10');
UPDATE `tblshopitemxr` SET `dblPrice` = '30' WHERE `tblshopitemxr`.`intShopItemID` = 5;
UPDATE `tblshopitemxr` SET `dblPrice` = '30' WHERE `tblshopitemxr`.`intShopItemID` = 6;
UPDATE `tblshopitemxr` SET `dblPrice` = '5' WHERE `tblshopitemxr`.`intShopItemID` = 4;
UPDATE `tblshopitemxr` SET `dblPrice` = '20' WHERE `tblshopitemxr`.`intShopItemID` = 3;
INSERT INTO `tblnpcbattletext` (`intNPCBattleTextID`, `intNPCID`, `strStartText`, `strForceStartText`, `strEndText`, `strDefeatText`, `strFleeText`, `strFailFleeText`) VALUES (NULL, '3', '', 'You hear a faint scurrying ahead of you. Looking down at the ground before you, you can see what appears to be an oversized rat bearing its teeth at you. You should eliminate this rodent before it attacks, so as not to take any chances!', '', '', '', '');
INSERT INTO `tblfloor` (`intFloorID`, `strFloorName`, `strFloorType`, `intDimension`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Dungeon Floor', 'Field', '10', 'admin', '2016-07-19 00:00:00', NULL, NULL);
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES (NULL, '2', '4', '1000');
INSERT INTO `tblskill` (`intSkillID`, `strName`, `strClassName`, `txtDescription`, `strSkillType`, `intHitCount`, `intTargetCount`, `blnUsableOutsideBattle`, `strWeaponType`) VALUES (NULL, 'Rend', 'Rend', 'Concentrate all your strength into a heavy blow with a melee weapon, targeted at one enemy.', 'Damage', '1', '1', '0', 'Melee'), (NULL, 'Magic Bolt', 'MagicBolt', 'Concentrate magical energy into a powerful bolt emitted from your wand or staff. Targets one enemy.', 'Damage', '1', '1', '0', 'Magic');
ALTER TABLE `tblskill` ADD `intCooldown` INT NOT NULL DEFAULT '0' AFTER `strWeaponType`;
UPDATE `tblskill` SET `intCooldown` = '2' WHERE `tblskill`.`intSkillID` = 2;
UPDATE `tblskill` SET `intCooldown` = '3' WHERE `tblskill`.`intSkillID` = 3;
UPDATE `tblskill` SET `intCooldown` = '3' WHERE `tblskill`.`intSkillID` = 4;
INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Armoured Skeleton', '120', '130', '4500', '5', '15', '0', '0', 'DPS', '2016-07-19 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES (NULL, '2', '6', '1000');
INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES (NULL, '6', '30', '10', '1', '3', '15', '1', '5', '1', '150', '0', '10', '20');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Arming Sword', 'A knightly sword about the length of a grown man''s arm, commonly wielded with one hand. The blade is well made, with a shallow fuller running along the length of the blade to provide flexibility. The guard extends in a cross-like pattern three inches in either direction from the blade.', 'Weapon:Sword', 'Primary', NULL, '0', '4', NULL, NULL, NULL, '15', 'Strength', '10', 'admin', '2016-07-19 00:00:00', NULL, NULL);
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '6', '14', '1', '1', '500', '2016-07-19 00:00:00');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Wooden Buckler', 'A round wooden slab with a beveled metallic plate in the center. Thick enough to nullify damage from a typical bladed assault.', 'Weapon:Shield', 'Secondary', NULL, '0', NULL, NULL, '5', NULL, '5', 'Strength', '10', 'admin', '2016-07-19 00:00:00', NULL, NULL);
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '6', '15', '1', '1', '500', '2016-07-19 00:00:00');
INSERT INTO `tblnpcskillxr` (`intNPCSkillXRID`, `intNPCID`, `intSkillID`) VALUES (NULL, '6', '3');
INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES (NULL, '2', '1', '9999');
UPDATE `tblnpcitemxr` SET `intNPCID` = '5' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 4;
UPDATE `tblnpcstats` SET `intMaxHP` = '22' WHERE `tblnpcstats`.`intNPCStatsID` = 4;
UPDATE `tblnpcstats` SET `intMaxHP` = '20' WHERE `tblnpcstats`.`intNPCStatsID` = 5;
UPDATE `tblnpcstats` SET `intMaxHP` = '14' WHERE `tblnpcstats`.`intNPCStatsID` = 1;
UPDATE `tblnpcstats` SET `intMaxHP` = '22' WHERE `tblnpcstats`.`intNPCStatsID` = 6;
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Wooden Bow', 'An arced wooden rod with a string joining both ends. Bend back the string to shoot arrows with piercing tips to inflict wounds to your enemies.', 'Weapon:Bow', 'Both', NULL, '0', '2', NULL, NULL, NULL, '10', 'Strength', '1', 'admin', '2016-07-19 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Wooden Staff', 'A long wooden rod with an arched tip. Magic can be channeled through this staff as it was created from enchanted wood.', 'Weapon:Staff', 'Both', NULL, '0', '0', '2', NULL, NULL, '10', 'Intelligence', '1', 'admin', '2016-07-19 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Magi Rod', 'A scepter-like iron rod with a sapphire gemstone encapsulated in the tip.', 'Weapon:Wand', 'Primary', NULL, '0', NULL, '10', NULL, NULL, '5', 'Intelligence', '20', 'admin', '2016-07-21 00:00:00', NULL, NULL);
INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Skeleton Mage', '130', '120', '4500', '5', '15', '0', '0', 'DPS', '2016-07-21 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblnpcskillxr` (`intNPCSkillXRID`, `intNPCID`, `intSkillID`) VALUES (NULL, '7', '4');
INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES (NULL, '7', '18', '5', '10', '1', '1', '10', '5', '1', '150', '0', '10', '20');
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '7', '18', '1', '1', '800', '2016-07-21 00:00:00');
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '7', '15', '1', '1', '200', '2016-07-21 00:00:00');
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Floor 2 Boss', 'Fight the succubus at the end of floor 2.', 'floor2Boss.xml', 'Event', '1', '2016-07-21 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES (NULL, '2', '22', '9999');
INSERT INTO `tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Black Succubus', '120', '158', '9600', '20', '50', '1', '1', 'AlwaysAttack', '2016-07-21 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES (NULL, '2', '8', '9999');
UPDATE `tblnpc` SET `strAIName` = 'Succubus' WHERE `tblnpc`.`intNPCID` = 8;
ALTER TABLE `tblskill` ADD `intStatusEffectID` INT NULL AFTER `intCooldown`;
ALTER TABLE `tblskill` ADD CONSTRAINT `fk_tblSkill_intStatusEffectID` FOREIGN KEY (`intStatusEffectID`) REFERENCES `tblstatuseffect`(`intStatusEffectID`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Hypnotized', '2016-07-21 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tbloverride` (`intOverrideID`, `strOverrideName`, `strOverrideDesc`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Hypnotized', 'Cannot attack or use skills and can be controlled by enemy while this override is in effect.', '2016-07-21 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblstatuseffectstatchange` (`intStatusEffectStatChangeID`, `intStatusEffectID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intOverrideID`, `blnInfinite`, `intDuration`, `blnIncremental`) VALUES (NULL, '5', '', '0', '0', '5', '0', '3', '0');
INSERT INTO `tblskill` (`intSkillID`, `strName`, `strClassName`, `txtDescription`, `strSkillType`, `intHitCount`, `intTargetCount`, `blnUsableOutsideBattle`, `strWeaponType`, `intCooldown`, `intStatusEffectID`) VALUES (NULL, 'Hypnosis', 'Hypnosis', 'Skill that places target under control for 3 turns. Has a chance to break out every turn (based on Willpower role). Cannot use attacks or skills during the duration and enemy can control you.', 'Debuff', '1', '1', '1', 'All', '5', '5');
INSERT INTO `tblskill` (`intSkillID`, `strName`, `strClassName`, `txtDescription`, `strSkillType`, `intHitCount`, `intTargetCount`, `blnUsableOutsideBattle`, `strWeaponType`, `intCooldown`, `intStatusEffectID`) VALUES (NULL, 'Fattening Touch', 'FatteningTouch', 'Used to instantly gain weight. Can be a specific body part or entire body.', 'Debuff', '1', '1', '1', 'All', '0', NULL);
INSERT INTO `tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`) VALUES (NULL, '8', '25', '5', '100', '20', '5', '20', '20', '60', '150', '0', '10', '20');
INSERT INTO `tblnpcskillxr` (`intNPCSkillXRID`, `intNPCID`, `intSkillID`) VALUES (NULL, '8', '2'), (NULL, '8', '5'), (NULL, '8', '6');
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intOccurrenceRating`) VALUES (NULL, '2', '7', '1000');
UPDATE `tblevent` SET `strEventType` = 'End Event' WHERE `tblevent`.`intEventID` = 22;
UPDATE `tblnpcstats` SET `intStrength` = '10', `intAgility` = '5', `intWillpower` = '5' WHERE `tblnpcstats`.`intNPCStatsID` = 5;
UPDATE `tblfloor` SET `intDimension` = '7' WHERE `tblfloor`.`intFloorID` = 1;
UPDATE `tblfloor` SET `intDimension` = '8' WHERE `tblfloor`.`intFloorID` = 2;
UPDATE `tblnpcstats` SET `intVitality` = '5' WHERE `tblnpcstats`.`intNPCStatsID` = 5;
UPDATE `tblnpcstats` SET `intMaxHP` = '16' WHERE `tblnpcstats`.`intNPCStatsID` = 5;
UPDATE `tblnpcstats` SET `intStrength` = '9', `intIntelligence` = '2', `intAgility` = '2', `intWillpower` = '2', `intDexterity` = '2' WHERE `tblnpcstats`.`intNPCStatsID` = 7;
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '16', '10'), (NULL, '2', '17', '10');
UPDATE `tblnpcitemxr` SET `intDropRating` = '1500' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 5;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1500' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 6;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1500' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 7;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1500' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 8;
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '13', '50');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Longsword', 'A blade with significantly more reach than your average arming sword. Best used with a shield.', 'Weapon:Sword', 'Primary', NULL, '0', '8', NULL, NULL, NULL, '15', 'Strength', '5', 'admin', '2016-07-24 00:00:00', NULL, NULL), (NULL, 'Magi Staff', 'A long iron rod with an cupped sapphire gemstone at the tip. Its respectable magical capacity comes at the expense of its heavier weight.', 'Weapon:Staff', 'Both', NULL, '0', NULL, '8', NULL, NULL, '25', 'Intelligence', '5', 'admin', '2016-07-24 00:00:00', NULL, NULL);
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '20', '50'), (NULL, '2', '21', '50');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Leather Mail', 'This armour consists of light chainmail with a leather chestpiece over top. Steel cuisses cover the thighs. The chestpiece is constructed by fastening multiple layers of leather together then sturdily sewing it.', 'Armour:Armour', NULL, NULL, '0', NULL, NULL, '5', NULL, '15', NULL, '5', 'admin', '2016-07-25 00:00:00', NULL, NULL);
INSERT INTO `tblclothingdesc` (`intClothingDescID`, `intItemID`, `strXML`) VALUES (NULL, '22', 'leathermail.xml');
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '22', '50');
UPDATE `tblclothingdesc` SET `strXML` = 'Both/leathermail.xml' WHERE `tblclothingdesc`.`intClothingDescID` = 6;
UPDATE `tblitem` SET `intSellPrice` = '1' WHERE `tblitem`.`intItemID` = 15;
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '2', '15', '25');
INSERT INTO `tblnpcbattletext` (`intNPCBattleTextID`, `intNPCID`, `strStartText`, `strForceStartText`, `strEndText`, `strDefeatText`, `strFleeText`, `strFailFleeText`) VALUES (NULL, '4', 'A crackling and a rattling can be heard ahead of you. Animated bones move towards you; a bare skeleton. In its bony grip is a wooden axe. It takes a battle pose, ready to fight. Should you pursue?', 'A crackling and a rattling can be heard ahead of you. Animated bones move towards you; a bare skeleton. In its bony grip is a wooden axe. It takes a battle pose, ready to fight.', 'Defeated, the skeleton collapses into a pile of bones.', '', '', '');
UPDATE `tblnpcbattletext` SET `strEndText` = 'The rat turns over on its back, defeated.' WHERE `tblnpcbattletext`.`intNPCBattleTextID` = 2;
INSERT INTO `tblnpcbattletext` (`intNPCBattleTextID`, `intNPCID`, `strStartText`, `strForceStartText`, `strEndText`, `strDefeatText`, `strFleeText`, `strFailFleeText`) VALUES (NULL, '6', 'The clinking of armour can be heard ahead of you. Animated bones protected by a metallic chestpiece move towards you; an armoured skeleton. In one bony hand it holds a sword, the other a shield. It takes a battle pose, ready to fight. Should you pursue?', 'The clinking of armour can be heard ahead of you. Animated bones protected by a metallic chestpiece move towards you; an armoured skeleton. In one bony hand it holds a sword, the other a shield. It takes a battle pose, ready to fight.', 'The skeleton collapses to the floor in a pile of bones, defeated.', '', '', ''), (NULL, '7', 'A skeleton wearing a cape and holding a staff can be seen in the distance. Should you pursue?', 'A long oval of radiant light flashes before you, and a figure emerges from within. It is a skeleton wearing a cape and holding a staff. It takes a battle pose; it teleported here to fight you!', 'The skeleton collapses to the floor in a pile of bones, defeated.', '', '', '');
UPDATE `tblfloor` SET `intDimension` = '5' WHERE `tblfloor`.`intFloorID` = 2;
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Succubus Corset', 'A tightly fitting outfit that hardly covers the breasts and extends to the hips. It can be made to be even tighter by pulling the lacing. The material is stiffened and is designed to shape a woman''s figure.', 'Armour:Top', NULL, NULL, '0', NULL, NULL, '1', '4', '5', 'Strength', '10', 'admin', '2016-07-30 00:00:00', NULL, NULL);
INSERT INTO `tblclothingdesc` (`intClothingDescID`, `intItemID`, `strXML`) VALUES (NULL, '23', 'Tops/succubuscorset.xml');
INSERT INTO `tblnpcitemxr` (`intNPCItemXRID`, `intNPCID`, `intItemID`, `blnEquipped`, `blnDropped`, `intDropRating`, `dtmDateAdded`) VALUES (NULL, '8', '23', '1', '1', '2000', '2016-07-30 00:00:00');