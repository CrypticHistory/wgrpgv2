<?php

require_once "Database.php";

class RPGCharacterBody{

	private $_intCharacterBodyID;
	private $_intRPGCharacterID;
	private $_intBreasts;
	private $_intBelly;
	private $_intButt;
	private $_intLegs;
	private $_intArms;
	private $_intFace;
	private $_intBellyRipLevel;
	private $_intButtRipLevel;
	private $_intBreastsRipLevel;
	private $_intArmsRipLevel;
	private $_intLegsRipLevel;
	
	public function RPGCharacterBody($intRPGCharacterID = null){
		if($intRPGCharacterID != null){
			$this->loadCharacterBodyInfo($intRPGCharacterID);
		}
	}
	
	private function populateVarFromRow($arrCharacterBodyInfo){
		$this->setCharacterBodyID($arrCharacterBodyInfo['intCharacterBodyID']);
		$this->setRPGCharacterID($arrCharacterBodyInfo['intRPGCharacterID']);
		$this->setBreasts($arrCharacterBodyInfo['intBreasts']);
		$this->setBelly($arrCharacterBodyInfo['intBelly']);
		$this->setButt($arrCharacterBodyInfo['intButt']);
		$this->setLegs($arrCharacterBodyInfo['intLegs']);
		$this->setArms($arrCharacterBodyInfo['intArms']);
		$this->setFace($arrCharacterBodyInfo['intFace']);
		$this->setBellyRipLevel($arrCharacterBodyInfo['intBellyRipLevel']);
		$this->setButtRipLevel($arrCharacterBodyInfo['intButtRipLevel']);
		$this->setBreastsRipLevel($arrCharacterBodyInfo['intBreastsRipLevel']);
		$this->setArmsRipLevel($arrCharacterBodyInfo['intArmsRipLevel']);
		$this->setLegsRipLevel($arrCharacterBodyInfo['intLegsRipLevel']);
	}
	
	private function loadCharacterBodyInfo($intRPGCharacterID){
		$objDB = new Database();
		$arrStatusEffectInfo = array();
			$strSQL = "SELECT intCharacterBodyID, intRPGCharacterID, intBreasts, intBelly, intLegs, intButt, intArms, intFace, intBellyRipLevel, intButtRipLevel, intBreastsRipLevel, intArmsRipLevel, intLegsRipLevel
						FROM tblcharacterbody
							WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrCharacterBodyInfo['intCharacterBodyID'] = $arrRow['intCharacterBodyID'];
				$arrCharacterBodyInfo['intRPGCharacterID'] = $arrRow['intRPGCharacterID'];
				$arrCharacterBodyInfo['intBreasts'] = $arrRow['intBreasts'];
				$arrCharacterBodyInfo['intBelly'] = $arrRow['intBelly'];
				$arrCharacterBodyInfo['intButt'] = $arrRow['intButt'];
				$arrCharacterBodyInfo['intLegs'] = $arrRow['intLegs'];
				$arrCharacterBodyInfo['intArms'] = $arrRow['intArms'];
				$arrCharacterBodyInfo['intFace'] = $arrRow['intFace'];
				$arrCharacterBodyInfo['intBellyRipLevel'] = $arrRow['intBellyRipLevel'];
				$arrCharacterBodyInfo['intButtRipLevel'] = $arrRow['intButtRipLevel'];
				$arrCharacterBodyInfo['intBreastsRipLevel'] = $arrRow['intBreastsRipLevel'];
				$arrCharacterBodyInfo['intArmsRipLevel'] = $arrRow['intArmsRipLevel'];
				$arrCharacterBodyInfo['intLegsRipLevel'] = $arrRow['intLegsRipLevel'];
			}
		$this->populateVarFromRow($arrCharacterBodyInfo);
	}
	
	public function create($intRPGCharacterID, $intFace, $intBelly, $intBreasts, $intArms, $intLegs, $intButt){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharacterbody
					(intRPGCharacterID, intFace, intBelly, intBreasts, intArms, intLegs, intButt)
						VALUES
					(" . $objDB->quote($intRPGCharacterID) . ", " . $objDB->quote($intFace) . ", " . $objDB->quote($intBelly) . ", " . $objDB->quote($intBreasts) . ", " . $objDB->quote($intArms) . ", " . $objDB->quote($intLegs) . ", " . $objDB->quote($intButt) . ")";
		$objDB->query($strSQL);
		$this->loadCharacterBodyInfo($intRPGCharacterID);
	}
	
	public function save(){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacterbody
					SET intBreasts = " . $objDB->quote($this->_intBreasts) . ", intBelly = " . $objDB->quote($this->_intBelly) . ", intLegs = " . $objDB->quote($this->_intLegs) . ", intButt = " . $objDB->quote($this->_intButt) . ", intArms = " . $objDB->quote($this->_intArms) . ", intFace = " . $objDB->quote($this->_intFace) . ", intBellyRipLevel = " . $objDB->quote($this->_intBellyRipLevel) . ", intButtRipLevel = " . $objDB->quote($this->_intButtRipLevel) . ", intBreastsRipLevel = " . $objDB->quote($this->_intBreastsRipLevel) . ", intArmsRipLevel = " . $objDB->quote($this->_intArmsRipLevel) . ", intLegsRipLevel = " . $objDB->quote($this->_intLegsRipLevel) . "
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$objDB->query($strSQL);
	}
	
	public function getCharacterBodyID(){
		return $this->_intCharacterBodyID;
	}
	
	public function setCharacterBodyID($intCharacterBodyID){
		$this->_intCharacterBodyID = $intCharacterBodyID;
	}
	
	public function getRPGCharacterID(){
		return $this->_intRPGCharacterID;
	}
	
	public function setRPGCharacterID($intRPGCharacterID){
		$this->_intRPGCharacterID = $intRPGCharacterID;
	}
	
	public function getBreasts(){
		return $this->_intBreasts;
	}
	
	public function setBreasts($intBreasts){
		$this->_intBreasts = $intBreasts;
	}
	
	public function getBelly(){
		return $this->_intBelly;
	}
	
	public function setBelly($intBelly){
		$this->_intBelly = $intBelly;
	}
	
	public function getLegs(){
		return $this->_intLegs;
	}
	
	public function setLegs($intLegs){
		$this->_intLegs = $intLegs;
	}
	
	public function getButt(){
		return $this->_intButt;
	}
	
	public function setButt($intButt){
		$this->_intButt = $intButt;
	}
	
	public function getArms(){
		return $this->_intArms;
	}
	
	public function setArms($intArms){
		$this->_intArms = $intArms;
	}
	
	public function getFace(){
		return $this->_intFace;
	}
	
	public function setFace($intFace){
		$this->_intFace = $intFace;
	}
	
	public function getBellyRipLevel(){
		return $this->_intBellyRipLevel;
	}
	
	public function setBellyRipLevel($intBellyRipLevel){
		$this->_intBellyRipLevel = $intBellyRipLevel;
	}
	
	public function getButtRipLevel(){
		return $this->_intButtRipLevel;
	}
	
	public function setButtRipLevel($intButtRipLevel){
		$this->_intButtRipLevel = $intButtRipLevel;
	}
	
	public function getBreastsRipLevel(){
		return $this->_intBreastsRipLevel;
	}
	
	public function setBreastsRipLevel($intBreastsRipLevel){
		$this->_intBreastsRipLevel = $intBreastsRipLevel;
	}
	
	public function getArmsRipLevel(){
		return $this->_intArmsRipLevel;
	}
	
	public function setArmsRipLevel($intArmsRipLevel){
		$this->_intArmsRipLevel = $intArmsRipLevel;
	}
	
	public function getLegsRipLevel(){
		return $this->_intLegsRipLevel;
	}
	
	public function setLegsRipLevel($intLegsRipLevel){
		$this->_intLegsRipLevel = $intLegsRipLevel;
	}
	
	public function setAllRipLevel($intRipValue){
		$this->_intBellyRipLevel = $intRipValue;
		$this->_intButtRipLevel = $intRipValue;
		$this->_intBreastsRipLevel = $intRipValue;
		$this->_intLegsRipLevel = $intRipValue;
		$this->_intArmsRipLevel = $intRipValue;
	}
	
	public function setTopRipLevel($intRipValue){
		$this->_intBellyRipLevel = $intRipValue;
		$this->_intArmsRipLevel = $intRipValue;
		$this->_intBreastsRipLevel = $intRipValue;
	}
	
	public function setBottomRipLevel($intRipValue){
		$this->_intBellyRipLevel = $intRipValue;
		$this->_intLegsRipLevel = $intRipValue;
		$this->_intButtRipLevel = $intRipValue;
	}
}

?>