<?php

require_once "Database.php";

class RPGStatusEffect{

	private $_intStatusEffectID;
	private $_strStatusEffectName;
	private $_intCharacterStatusEffectXRID;
	private $_intItemInstanceID;
	private $_intTimeRemaining;
	private $_strStatName;
	private $_intStatChangeMin;
	private $_intStatChangeMax;
	private $_intOverrideID;
	private $_blnInfinite;
	private $_intDuration;
	private $_blnIncremental;
	private $_blnKillBuff;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	
	public function __construct($strStatusEffectName = null, $intStatusEffectID = null){
		if($strStatusEffectName != null){
			$this->loadStatusEffectInfo($strStatusEffectName);
		}
		if($intStatusEffectID != null){
			$this->loadStatusEffectInfoFromID($intStatusEffectID);
		}
	}
	
	private function populateVarFromRow($arrStatusEffectInfo){
		$this->setStatusEffectID($arrStatusEffectInfo['intStatusEffectID']);
		$this->setStatusEffectName($arrStatusEffectInfo['strStatusEffectName']);
		$this->setStatName($arrStatusEffectInfo['strStatName']);
		$this->setStatChangeMin($arrStatusEffectInfo['intStatChangeMin']);
		$this->setStatChangeMax($arrStatusEffectInfo['intStatChangeMax']);
		$this->setOverrideID($arrStatusEffectInfo['intOverrideID']);
		$this->setInfinite($arrStatusEffectInfo['blnInfinite']);
		$this->setDuration($arrStatusEffectInfo['intDuration']);
		$this->setIncremental($arrStatusEffectInfo['blnIncremental']);
		$this->setKillBuff($arrStatusEffectInfo['blnKillBuff']);
		$this->setCreatedOn($arrStatusEffectInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrStatusEffectInfo['strCreatedBy']);
		$this->setModifiedOn($arrStatusEffectInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrStatusEffectInfo['strModifiedBy']);
	}
	
	private function loadStatusEffectInfo($strStatusEffectName){
		$objDB = new Database();
		$arrStatusEffectInfo = array();
			$strSQL = "SELECT intStatusEffectID, strStatusEffectName, strStatName, intStatChangeMin, intStatChangeMax, intOverrideID, blnInfinite, intDuration, blnIncremental, blnKillBuff, dtmCreatedOn, strCreatedBy, dtmModifiedOn, strModifiedBy
						FROM tblstatuseffect
							INNER JOIN tblstatuseffectstatchange
								USING (intStatusEffectID)
							WHERE strStatusEffectName = " . $objDB->quote($strStatusEffectName);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrStatusEffectInfo['intStatusEffectID'] = $arrRow['intStatusEffectID'];
				$arrStatusEffectInfo['strStatusEffectName'] = $arrRow['strStatusEffectName'];
				$arrStatusEffectInfo['strStatName'] = $arrRow['strStatName'];
				$arrStatusEffectInfo['intStatChangeMin'] = $arrRow['intStatChangeMin'];
				$arrStatusEffectInfo['intStatChangeMax'] = $arrRow['intStatChangeMax'];
				$arrStatusEffectInfo['intOverrideID'] = $arrRow['intOverrideID'];
				$arrStatusEffectInfo['blnInfinite'] = $arrRow['blnInfinite'];
				$arrStatusEffectInfo['intDuration'] = $arrRow['intDuration'];
				$arrStatusEffectInfo['blnIncremental'] = $arrRow['blnIncremental'];
				$arrStatusEffectInfo['blnKillBuff'] = $arrRow['blnKillBuff'];
				$arrStatusEffectInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrStatusEffectInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrStatusEffectInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrStatusEffectInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrStatusEffectInfo);
	}
	
	private function loadStatusEffectInfoFromID($intStatusEffectID){
		$objDB = new Database();
		$arrStatusEffectInfo = array();
			$strSQL = "SELECT intStatusEffectID, strStatusEffectName, strStatName, intStatChangeMin, intStatChangeMax, intOverrideID, blnInfinite, intDuration, blnIncremental, blnKillBuff, dtmCreatedOn, strCreatedBy, dtmModifiedOn, strModifiedBy
						FROM tblstatuseffect
							INNER JOIN tblstatuseffectstatchange
								USING (intStatusEffectID)
							WHERE intStatusEffectID = " . $objDB->quote($intStatusEffectID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrStatusEffectInfo['intStatusEffectID'] = $arrRow['intStatusEffectID'];
				$arrStatusEffectInfo['strStatusEffectName'] = $arrRow['strStatusEffectName'];
				$arrStatusEffectInfo['strStatName'] = $arrRow['strStatName'];
				$arrStatusEffectInfo['intStatChangeMin'] = $arrRow['intStatChangeMin'];
				$arrStatusEffectInfo['intStatChangeMax'] = $arrRow['intStatChangeMax'];
				$arrStatusEffectInfo['intOverrideID'] = $arrRow['intOverrideID'];
				$arrStatusEffectInfo['blnInfinite'] = $arrRow['blnInfinite'];
				$arrStatusEffectInfo['intDuration'] = $arrRow['intDuration'];
				$arrStatusEffectInfo['blnIncremental'] = $arrRow['blnIncremental'];
				$arrStatusEffectInfo['blnKillBuff'] = $arrRow['blnKillBuff'];
				$arrStatusEffectInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrStatusEffectInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrStatusEffectInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrStatusEffectInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrStatusEffectInfo);
	}
	
	public function create($intRPGCharacterID, $intItemInstanceID = null){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharacterstatuseffectxr
					(intRPGCharacterID, intStatusEffectID, intItemInstanceID, intTimeRemaining)
						VALUES
					(" . $objDB->quote($intRPGCharacterID) . ", " . $objDB->quote($this->_intStatusEffectID) . ", " . ($intItemInstanceID != null ? $objDB->quote($intItemInstanceID) : "null") . ", " . $objDB->quote($this->_intDuration) . ")";
		$objDB->query($strSQL);
		$this->setTimeRemaining($this->_intDuration);
	}
	
	public function save($intRPGCharacterID, $intItemInstanceID = null){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacterstatuseffectxr
					SET intTimeRemaining = " . ($this->_intTimeRemaining != null ? $objDB->quote($this->_intTimeRemaining) : $objDB->quote($this->_intDuration)) . "
					WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . ", intStatusEffectID = " . $objDB->quote($this->_intStatusEffectID);
		$objDB->query($strSQL);
	}
	
	public function remove($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "DELETE FROM tblcharacterstatuseffectxr
					WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . " AND intStatusEffectID = " . $objDB->quote($this->_intStatusEffectID);
		$objDB->query($strSQL);
	}
	
	public function tickStatusEffect(){
		$this->_intTimeRemaining = intval($this->_intTimeRemaining) - 1;
	}
	
	public function getStatusEffectID(){
		return $this->_intStatusEffectID;
	}
	
	public function setStatusEffectID($intStatusEffectID){
		$this->_intStatusEffectID = $intStatusEffectID;
	}
	
	public function getStatusEffectName(){
		return $this->_strStatusEffectName;
	}
	
	public function setStatusEffectName($strStatusEffectName){
		$this->_strStatusEffectName = $strStatusEffectName;
	}
	
	public function getItemInstanceID(){
		return $this->_intItemInstanceID;
	}
	
	public function setItemInstanceID($intItemInstanceID){
		$this->_intItemInstanceID = $intItemInstanceID;
	}
	
	public function getCharacterStatusEffectXRID(){
		return $this->_intCharacterStatusEffectXRID;
	}
	
	public function setCharacterStatusEffectXRID($intCharacterStatusEffectXRID){
		$this->_intCharacterStatusEffectXRID = $intCharacterStatusEffectXRID;
	}
	
	public function getTimeRemaining(){
		return $this->_intTimeRemaining;
	}
	
	public function setTimeRemaining($intTimeRemaining){
		$this->_intTimeRemaining = $intTimeRemaining;
	}
	
	public function getStatName(){
		return $this->_strStatName;
	}
	
	public function setStatName($strStatName){
		$this->_strStatName = $strStatName;
	}
	
	public function getStatChangeMin(){
		return $this->_intStatChangeMin;
	}
	
	public function setStatChangeMin($intStatChangeMin){
		$this->_intStatChangeMin = $intStatChangeMin;
	}
	
	public function getStatChangeMax(){
		return $this->_intStatChangeMax;
	}
	
	public function setStatChangeMax($intStatChangeMax){
		$this->_intStatChangeMax = $intStatChangeMax;
	}
	
	public function getOverrideID(){
		return $this->_intOverrideID;
	}
	
	public function setOverrideID($intOverrideID){
		$this->_intOverrideID = $intOverrideID;
	}
	
	public function getInfinite(){
		return $this->_blnInfinite;
	}
	
	public function setInfinite($blnInfinite){
		$this->_blnInfinite = $blnInfinite;
	}
	
	public function getDuration(){
		return $this->_intDuration;
	}
	
	public function setDuration($intDuration){
		$this->_intDuration = $intDuration;
	}
	
	public function getIncremental(){
		return $this->_blnIncremental;
	}
	
	public function setIncremental($blnIncremental){
		$this->_blnIncremental = $blnIncremental;
	}
	
	public function getKillBuff(){
		return $this->_blnKillBuff;
	}
	
	public function setKillBuff($blnKillBuff){
		$this->_blnKillBuff = $blnKillBuff;
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