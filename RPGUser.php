<?php

require_once "Database.php";

class RPGUser{
	
	private $_intUserID;
	private $_strUserID;
	private $_blnAdmin;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	
	public function __construct($strUserID = null){
		$objDB = new Database();
		if($strUserID != null){
			$arrUserInfo = array();
			$strSQL = "SELECT *
						FROM tbluser
							WHERE strUserID = " . $objDB->quote($strUserID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrUserInfo['intUserID'] = $arrRow['intUserID'];
				$arrUserInfo['strUserID'] = $arrRow['strUserID'];
				$arrUserInfo['blnAdmin'] = $arrRow['blnAdmin'];
				$arrUserInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrUserInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrUserInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrUserInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
			$this->populateVarFromRow($arrUserInfo);
		}
	}
	
	private function populateVarFromRow($arrUserInfo){
		$this->setNumericalUserID($arrUserInfo['intUserID']);
		$this->setStringUserID($arrUserInfo['strUserID']);
		$this->setAdmin($arrUserInfo['blnAdmin']);
		$this->setCreatedOn($arrUserInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrUserInfo['strCreatedBy']);
		$this->setModifiedOn($arrUserInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrUserInfo['strModifiedBy']);
	}
	
	public function getCharacterList(){
		$objDB = new Database();
		$arrReturn = array();
		$strSQL = "SELECT intRPGCharacterID, strRPGCharacterName
					FROM tbluser
						INNER JOIN tblrpgcharacter
						USING (strUserID)
					WHERE strUserID = " . $objDB->quote($this->getStringUserID()) . "
						AND blnActivated = 1";
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrReturn[$arrRow['intRPGCharacterID']] = $arrRow['strRPGCharacterName'];
		}
		return $arrReturn;
	}
	
	public function hasCharacter($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intRPGCharacterID
					FROM tbluser
						INNER JOIN tblrpgcharacter
						USING (strUserID)
					WHERE strUserID = " . $objDB->quote($this->getStringUserID()) . "
						AND intRPGCharacterID = " . $objDB->quote($intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return (isset($arrRow['intRPGCharacterID']) ? true : false);
	}
	
	public function deleteCharacter($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "UPDATE tblrpgcharacter rpgChar
						JOIN tbluser usr ON rpgChar.strUserID = usr.strUserID
					SET rpgChar.blnActivated = 0
						WHERE usr.strUserID = " . $objDB->quote($this->getStringUserID()) . "
							AND rpgChar.intRPGCharacterID = " . $objDB->quote($intRPGCharacterID);
		$objDB->query($strSQL);
		echo $strSQL;
	}
	
	public function getNumericalUserID(){
		return $this->_intUserID;
	}
	
	public function setNumericalUserID($intUserID){
		$this->_intUserID = $intUserID;
	}
	
	public function getStringUserID(){
		return $this->_strUserID;
	}
	
	public function setStringUserID($strUserID){
		$this->_strUserID = $strUserID;
	}
	
	public function getAdmin(){
		return $this->_blnAdmin;
	}
	
	public function setAdmin($blnAdmin){
		$this->_blnAdmin = $blnAdmin;
	}
	
	public function getCreatedOn(){
		return $this->_dtmCreatedOn;
	}
	
	public function setCreatedOn($dtmCreatedOn){
		$this->_dtmCreatedOn = $dtmCreatedOn;
	}
	
	public function getCreatedBy(){
		return $this->_strCreatedBy;
	}
	
	public function setCreatedBy($strCreatedBy){
		$this->_strCreatedBy = $strCreatedBy;
	}
	
	public function getModifiedOn(){
		return $this->_dtmModifiedOn;
	}
	
	public function setModifiedOn($dtmModifiedOn){
		$this->_dtmModifiedOn = $dtmModifiedOn;
	}
	
	public function getModifiedBy(){
		return $this->_strModifiedBy;
	}
	
	public function setModifiedBy($strModifiedBy){
		$this->_strModifiedBy = $strModifiedBy;
	}
}

?>