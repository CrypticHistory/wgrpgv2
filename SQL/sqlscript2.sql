ALTER TABLE `tblitem` DROP `intEventID`;
DELETE FROM `tblevent` WHERE intEventID IN (6,8,9);
CREATE TABLE IF NOT EXISTS `tblclothingdesc` (
  `intClothingDescID` int(11) NOT NULL AUTO_INCREMENT,
  `intItemID` int(11) NOT NULL,
  `strXML` varchar(45) NOT NULL,
  PRIMARY KEY (`intClothingDescID`),
  KEY `intItemID` (`intItemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `tblclothingdesc`
  ADD CONSTRAINT `fk_intClothingDescItemID` FOREIGN KEY (`intItemID`) REFERENCES `tblitem` (`intItemID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `dbwgrpg`.`tblclothingdesc` (`intClothingDescID`, `intItemID`, `strXML`) VALUES (NULL, '2', 'tanktopjeans.xml'), (NULL, '4', 'cuirass.xml');