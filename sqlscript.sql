INSERT INTO `tblshopitemxr` (`intShopItemID`, `intShopID`, `intItemID`, `dblPrice`) VALUES (NULL, '1', '2', '1');
ALTER TABLE `tblshop` ADD `strShopType` VARCHAR(45) NOT NULL AFTER `txtShopDesc`;
UPDATE `dbwgrpg`.`tblshop` SET `strShopType` = 'Tailor' WHERE `tblshop`.`intShopID` = 1;
UPDATE `dbwgrpg`.`tblshop` SET `strShopType` = 'Blacksmith' WHERE `tblshop`.`intShopID` = 2;
UPDATE `dbwgrpg`.`tblshop` SET `strShopType` = 'Apothecary' WHERE `tblshop`.`intShopID` = 3;
UPDATE `dbwgrpg`.`tblshop` SET `strShopType` = 'Grocer' WHERE `tblshop`.`intShopID` = 4;