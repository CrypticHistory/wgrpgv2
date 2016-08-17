ALTER TABLE `tblrpgcharacter` ADD `intCurrentHunger` INT NOT NULL DEFAULT '500' AFTER `intDigestionRate`;
ALTER TABLE `tblcharacterstats` ADD `intMaxHunger` INT NOT NULL DEFAULT '1000' AFTER `intBlockReduction`;
ALTER TABLE `tblrpgcharacter` ADD `intHungerRate` INT NOT NULL DEFAULT '1' AFTER `intCurrentHunger`;
ALTER TABLE `tblitem` ADD `intFullness` INT NOT NULL AFTER `intWaitTime`;
ALTER TABLE `tblitem` CHANGE `intFullness` `intFullness` INT(11) NULL;
UPDATE `tblitem` SET `intFullness` = '50' WHERE `tblitem`.`intItemID` = 5;
UPDATE `tblitem` SET `intFullness` = '500' WHERE `tblitem`.`intItemID` = 1;
UPDATE `tblitem` SET `intFullness` = '200' WHERE `tblitem`.`intItemID` = 9;
INSERT INTO `tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Hungry', '2016-08-12 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Full', '2016-08-12 00:00:00', 'admin', NULL, NULL), (NULL, 'Stuffed', '2016-08-12 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tbloverride` (`intOverrideID`, `strOverrideName`, `strOverrideDesc`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Hungry', 'Fullness 10% or lower makes stat decrease by 10%.', '2016-08-12 00:00:00', 'admin', NULL, NULL), (NULL, 'Full', 'Fullness 100-120% gives stat bonuses by 10%.', '2016-08-12 00:00:00', 'admin', NULL, NULL), (NULL, 'Stuffed', 'Fullness 121%+ gives Agi, Dex, Will decreases by 10%.', '2016-08-12 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblstatuseffectstatchange` (`intStatusEffectStatChangeID`, `intStatusEffectID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intOverrideID`, `blnInfinite`, `intDuration`, `blnIncremental`) VALUES (NULL, '6', '', '0', '0', '6', '1', '9999', '0'), (NULL, '7', '', '0', '0', '7', '1', '9999', '0'), (NULL, '8', '', '0', '0', '8', '1', '9999', '0');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Sub Sandwich', 'A footlong sub sandwich toasted with turkey, ham, lettuce, tomatoes, and mayo on white bread. It will take a lot of time to eat this due to the length of the sandwich.', 'Food', NULL, '1200', '3', NULL, NULL, NULL, NULL, '0', '600', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL), (NULL, 'Chocolate Cake Slice', 'The ultimate dessert if you''re craving chocolate. A spongey exterior stuffed with chocolate cream, glazed with even more melted chocolate and topped with cocoa powder. Only one slice however.', 'Food', NULL, '800', '1', NULL, NULL, NULL, NULL, '0', '300', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Salad', 'Lettuce leaves tossed with a balsamic dressing. Diet food.', 'Food', NULL, '100', '2', NULL, NULL, NULL, NULL, '0', '200', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL), (NULL, 'Chocolate Peanut Butter Milkshake', 'Blended buttermilk pancakes and chocolate topped with fudge and peanut butter sauce. A deliciously fattening dessert.', 'Food', NULL, '3000', '2', NULL, NULL, NULL, NULL, '0', '800', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Rice Bowl', 'A plain bowl of white rice.', 'Food', NULL, '400', '2', NULL, NULL, NULL, NULL, '0', '400', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL), (NULL, 'Spaghetti and Meatballs', 'Spaghetti pasta topped with tomato sauce and three tasty meatballs.', 'Food', NULL, '1000', '3', NULL, NULL, NULL, NULL, '0', '700', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Weight Gain Potion', 'Nobody really knows what it contains aside from a buttload of calories. Drink at your own risk!', 'Potion', NULL, '99999', '0', NULL, NULL, NULL, NULL, '0', '5000', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL), (NULL, 'Vegetable Smoothie', 'The ultimate diet food. Spinach and kale smoothie that''s bursting in vitamins and minerals. Will fill you right up with minimal calorie consumption.', 'Food', NULL, '200', '2', NULL, NULL, NULL, NULL, '0', '800', 'Strength', '1', 'admin', '2016-08-13 00:00:00', NULL, NULL);
INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '3', '30', '250'), (NULL, '4', '24', '8'), (NULL, '4', '25', '5'), (NULL, '4', '26', '5'), (NULL, '4', '27', '5'), (NULL, '4', '28', '5'), (NULL, '4', '29', '14'), (NULL, '4', '31', '12');
DELETE FROM tblshopitemxr WHERE intShopItemID = 4;
UPDATE `tblitem` SET `intCalories` = '1500' WHERE `tblitem`.`intItemID` = 29;
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Banquet Table', 'Player comes across a large banquet table and relies on willpower to resist eating from it.', 'banquet.xml', 'Event', '1', '2016-08-15 00:00:00', 'admin', NULL, NULL);
INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`) VALUES (NULL, '2', '23', '1000');
ALTER TABLE `tblflooreventxr` ADD `intCountPerFloor` INT NOT NULL DEFAULT '1' AFTER `intOccurrenceRating`;
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Crevice in the Wall', 'Player comes across a crevice in the wall with something glittering just out of reach.', 'crevice.xml', 'Event', '1', '2016-08-16 00:00:00', 'kestrel', NULL, NULL);
INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`, `intCountPerFloor`) VALUES (NULL, '1', '24', '1000', '1');
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Brass Knuckles', 'Metal shaped to fit around the knuckles, concentrating the area of a punch more precisely to deal heavier damage on impact.', 'Weapon:Claws', 'Both', NULL, '0', '2', NULL, NULL, NULL, '2', NULL, 'Strength', '1', 'admin', '2016-08-16 00:00:00', NULL, NULL), (NULL, 'Knife', 'A shorter and lighter version of a dagger, commonly utilized in a quick and precise stabbing motion. Could also be used to cut meat.', 'Weapon:Dagger', 'Primary', NULL, '0', '2', NULL, NULL, NULL, '5', NULL, 'Strength', '1', 'admin', '2016-08-16 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Dirk', 'A dagger with a straight, single-edged blade that''s about a foot long, and short, straight quillions.', 'Weapon:Dagger', 'Primary', NULL, '0', '8', NULL, NULL, NULL, '5', NULL, 'Strength', '10', 'admin', '2016-08-16 00:00:00', NULL, NULL);
INSERT INTO `tblitem` (`intItemID`, `strItemName`, `txtItemDesc`, `strItemType`, `strHandType`, `intCalories`, `intHPHeal`, `intDamage`, `intMagicDamage`, `intDefence`, `intMagicDefence`, `intWaitTime`, `intFullness`, `strStatDamage`, `intSellPrice`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES (NULL, 'Iron Bow', 'A durable iron bow. You can shoot arrows by pulling them back on the string and releasing it.', 'Weapon:Bow', 'Both', NULL, '0', '7', NULL, NULL, NULL, '15', NULL, 'Strength', '5', 'admin', '2016-08-16 00:00:00', NULL, NULL);
INSERT INTO `tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Heavy Rock', 'Player comes across a rock with an item protruding.', 'heavyrock.xml', 'Event', '1', '2016-08-16 00:00:00', 'kestrel', NULL, NULL);
CREATE TABLE IF NOT EXISTS `tbleventitemxr` (
  `intEventItemXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intEventID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intDrawGroup` int(11) NOT NULL DEFAULT '1',
  `intOccurrenceRating` int(11) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`intEventItemXRID`),
  KEY `intEventID` (`intEventID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;
INSERT INTO `tbleventitemxr` (`intEventItemXRID`, `intEventID`, `intItemID`, `intDrawGroup`, `intOccurrenceRating`) VALUES
(1, 24, 9, 1, 1000),
(2, 24, 26, 1, 1000),
(3, 24, 28, 1, 1000),
(4, 24, 32, 1, 1000),
(5, 24, 33, 1, 1000),
(6, 24, 34, 1, 300),
(7, 25, 14, 1, 5000),
(8, 25, 35, 1, 1000);
ALTER TABLE `tbleventitemxr`
  ADD CONSTRAINT `fk_tbleventitemxr_intEventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbleventitemxr_intItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `tblflooreventxr` (`intFloorEventXRID`, `intFloorID`, `intEventID`, `intOccurrenceRating`, `intCountPerFloor`) VALUES (NULL, '1', '25', '1000', '1');
UPDATE `tblnpcitemxr` SET `intDropRating` = '1000' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 1;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1000' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 3;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1000' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 5;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1000' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 6;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1000' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 7;
UPDATE `tblnpcitemxr` SET `intDropRating` = '1000' WHERE `tblnpcitemxr`.`intNPCItemXRID` = 8;
UPDATE `tblitem` SET `intDefence` = '3' WHERE `tblitem`.`intItemID` = 15;
UPDATE `tblitem` SET `intMagicDamage` = '10' WHERE `tblitem`.`intItemID` = 21;
UPDATE `tblitem` SET `intMagicDamage` = '7' WHERE `tblitem`.`intItemID` = 18;
UPDATE `tblshopitemxr` SET `dblPrice` = '80' WHERE `tblshopitemxr`.`intShopItemID` = 12;
UPDATE `tblshopitemxr` SET `dblPrice` = '80' WHERE `tblshopitemxr`.`intShopItemID` = 13;
UPDATE `tblshopitemxr` SET `dblPrice` = '80' WHERE `tblshopitemxr`.`intShopItemID` = 14;
UPDATE `tblshopitemxr` SET `dblPrice` = '120' WHERE `tblshopitemxr`.`intShopItemID` = 15;