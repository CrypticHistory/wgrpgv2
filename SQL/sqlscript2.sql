ALTER TABLE `tblfloornpcxr` ADD `intNPCID2` INT NULL DEFAULT NULL AFTER `intNPCID`, ADD `intNPCID3` INT NULL DEFAULT NULL AFTER `intNPCID2`;
ALTER TABLE `tblfloornpcxr` ADD CONSTRAINT `fk_tblfloornpcxr_intnpcid2` FOREIGN KEY (`intNPCID2`) REFERENCES `tblnpc`(`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE; ALTER TABLE `tblfloornpcxr` ADD CONSTRAINT `fk_tblfloornpcxr_intnpcid3` FOREIGN KEY (`intNPCID3`) REFERENCES `tblnpc`(`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `tblfloornpcxr` (`intFloorNPCXRID`, `intFloorID`, `intNPCID`, `intNPCID2`, `intNPCID3`, `intOccurrenceRating`) VALUES (NULL, '2', '4', '4', '4', '500');
CREATE TABLE IF NOT EXISTS `tbluniqueeventgifts` (
  `intUniqueEventGiftID` int(11) NOT NULL AUTO_INCREMENT,
  `intEventID` int(11) NOT NULL,
  `intItemID` int(11) NOT NULL,
  `intRPGCharacterID` int(11) NOT NULL,
  `dtmDateObtained` datetime NOT NULL,
  PRIMARY KEY (`intUniqueEventGiftID`),
  KEY `intEventID` (`intEventID`),
  KEY `intItemID` (`intItemID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
INSERT INTO `tbluniqueeventgifts` (`intUniqueEventGiftID`, `intEventID`, `intItemID`, `intRPGCharacterID`, `dtmDateObtained`) VALUES
(3, 2, 6, 194, '2016-10-10 13:56:09'),
(4, 27, 9, 194, '2016-10-10 13:59:16'),
(5, 27, 15, 194, '2016-10-10 14:00:40');
ALTER TABLE `tbluniqueeventgifts`
  ADD CONSTRAINT `fk_tbluniqueeventgifts_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbluniqueeventgifts_intEventID` FOREIGN KEY (`intEventID`) REFERENCES `tblevent` (`intEventID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbluniqueeventgifts_intItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;