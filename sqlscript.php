<?php

	include_once "Database.class";
	
	$objDB = new Database();
	
	// $strSQL = "INSERT INTO `dbwgrpg`.`tblfloor` (`intFloorID`, `strFloorName`, `txtEntryText`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES ('2', 'Your Room', 'Your room has a mirror and a bed and a closet.', 'admin', '2016-02-03 00:00:00', NULL, NULL);";
	// $strSQL += "INSERT INTO `dbwgrpg`.`tblfloor` (`intFloorID`, `strFloorName`, `txtEntryText`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES ('3', 'Ambellika Residential District', 'A bunch of houses. You can visit the houses of people that you know.', 'admin', '2016-02-03 00:00:00', NULL, NULL);";
	// $strSQL += "INSERT INTO `dbwgrpg`.`tblfloor` (`intFloorID`, `strFloorName`, `txtEntryText`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES ('4', 'Ambellika Shopping District', 'There''s a bunch of shops you can visit. Hope you brought your wallet.', 'admin', '2016-02-03 00:00:00', NULL, NULL);";
	// $strSQL += "INSERT INTO `dbwgrpg`.`tblfloor` (`intFloorID`, `strFloorName`, `txtEntryText`, `strCreatedBy`, `dtmCreatedOn`, `strModifiedBy`, `dtmModifiedOn`) VALUES ('5', 'Ambellika Tailor Shop', 'Buy some new clothes here!', 'admin', '2016-02-03 00:00:00', NULL, NULL);";
	// $strSQL += "ALTER TABLE `tblfloor` ADD `strFloorType` VARCHAR(45) NOT NULL DEFAULT 'Town' AFTER `txtEntryText`;";
	// $strSQL += "UPDATE `dbwgrpg`.`tblfloor` SET `strFloorType` = 'Field' WHERE `tblfloor`.`intFloorID` = 1;";
	
	$objDB->query($strSQL);

?>