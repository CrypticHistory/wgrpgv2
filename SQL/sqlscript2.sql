ALTER TABLE `tblnpcstats` ADD `intAccuracy` INT NOT NULL DEFAULT '0' AFTER `intDexterity`;
ALTER TABLE `tblcharacterstats` ADD `intAccuracy` INT NOT NULL DEFAULT '0' AFTER `intDexterity`;
ALTER TABLE `tblnpcstats` ADD `intFleeResistance` INT NOT NULL DEFAULT '0' AFTER `intBlockReduction`;
UPDATE `tblnpcstats` SET `intFleeResistance` = '100' WHERE `tblnpcstats`.`intNPCStatsID` = 8;
UPDATE `tblnpcstats` SET `intFleeResistance` = '100' WHERE `tblnpcstats`.`intNPCStatsID` = 5;
UPDATE `tblnpcstats` SET `intFleeResistance` = '50' WHERE `tblnpcstats`.`intNPCStatsID` = 7;
UPDATE `dbwgrpg`.`tblnpcstats` SET `intFleeResistance` = '5' WHERE `tblnpcstats`.`intNPCStatsID` = 6;
UPDATE `dbwgrpg`.`tblnpcstats` SET `intFleeResistance` = '5' WHERE `tblnpcstats`.`intNPCStatsID` = 4;
UPDATE `dbwgrpg`.`tblnpcstats` SET `intFleeResistance` = '100' WHERE `tblnpcstats`.`intNPCStatsID` = 2;
