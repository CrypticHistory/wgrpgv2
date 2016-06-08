ALTER TABLE `tblfloor` ADD `intDimension` INT NOT NULL DEFAULT '10' AFTER `strFloorType`;
ALTER TABLE `tblevent` ADD `strEventType` VARCHAR(45) NOT NULL DEFAULT 'Event' AFTER `strXML`;
UPDATE `dbwgrpg`.`tblevent` SET `strEventType` = 'Standstill' WHERE `tblevent`.`intEventID` = 1;
UPDATE `dbwgrpg`.`tblevent` SET `strEventType` = 'Combat' WHERE `tblevent`.`intEventID` = 7;
UPDATE `dbwgrpg`.`tblevent` SET `strEventType` = 'Forced Combat' WHERE `tblevent`.`intEventID` = 10;