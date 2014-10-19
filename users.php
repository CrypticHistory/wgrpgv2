<?php

function user_exists($strUsername) {
	$objDB = new Database();
	$strSQL = "SELECT COUNT(intUserID) as intCount FROM tbluser WHERE strUserID = " . $objDB->quote($strUsername);
	$rsResult = $objDB->query($strSQL);
	$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
	return ($arrRow['intCount'] > 0) ? 1 : 0;
}

function logged_in() {
	return (isset($_SESSION['intUserID'])) ? true : false;
}

function login($strUsername, $strPassword) {
	$objDB = new Database();
	$strPassword = md5($strPassword);
	$strSQL = "SELECT intUserID FROM tbluser WHERE strUserID = " . $objDB->quote($strUsername) . " AND strPassword = " . $objDB->quote($strPassword);
	$rsResult = $objDB->query($strSQL);
	$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
	return isset($arrRow['intUserID']) ? true : false;
}

function get_user_id($strUsername) {
	$objDB = new Database();
	$strSQL = "SELECT intUserID FROM tbluser WHERE strUsername = " . $objDB->quote($strUsername);
	$rsResult = $objDB->query($strSQL);
	$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
	return $arrRow['intUserID'];
}

function register_user($arrRegisterData) {
	$objDB = new Database();
	$arrRegisterData['strPassword'] = md5($arrRegisterData['strPassword']);
	
	$strComma = "";
	$strSQL = "INSERT INTO tbluser SET ";
	
	foreach($arrRegisterData as $strFieldTitle => $strFieldData){
		$strSQL .= $strComma . $strFieldTitle . " = " . $objDB->quote($strFieldData);
		$strComma = ",";
	}
	
	$objDB->query($strSQL);
}

function changePassword($strNewPassword){
	$objDB = new Database();
	$strNewPassword = md5($strNewPassword);
	$strSQL = "UPDATE tbluser SET strPassword = " . $objDB->quote($strNewPassword) . " WHERE intUserID = " . $objDB->quote($_SESSION['objUser']->getNumericalUserID());
	$objDB->query($strSQL);
}

?>