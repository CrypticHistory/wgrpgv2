DELETE FROM `dbwgrpg`.`tbllocationeventlink` WHERE `tbllocationeventlink`.`intLocationEventLinkID` = 4;
INSERT INTO `dbwgrpg`.`tblshop` (`intShopID`, `strShopName`, `txtShopDesc`, `strShopType`) VALUES (NULL, 'Turician Enchanter', 'Found at the University of the Arcane.', 'Enchanter');
INSERT INTO `dbwgrpg`.`tbllocationshoplink` (`intLocationShopLinkID`, `intLocationID`, `intShopID`, `strLinkName`) VALUES (NULL, '11', '5', 'Visit Enchanter');
