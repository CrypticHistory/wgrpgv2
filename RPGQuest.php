<?php

require_once "Database.php";
include_once "RPGQuestReq.php";
include_once "RPGQuestKillReq.php";

class RPGQuest{

	private $_intRPGCharacterID;
	private $_intQuestID;
	private $_strQuestName;
	private $_strQuestType;
	private $_txtQuestDesc;
	private $_intExpReward;
	private $_intGoldReward;
	private $_dtmStarted;
	private $_dtmCompleted;
	private $_blnActive;
	private $_arrRequirements;
	
	public function __construct($intQuestID = null, $intRPGCharacterID = null, $blnExistingQuest = true){
		$this->_arrRequirements = array();
		if($intRPGCharacterID != null){
			$this->_intRPGCharacterID = $intRPGCharacterID;
		}
		if($intQuestID != null){
			$this->loadQuestInfo($intQuestID);
			$this->loadRequirements();
			if($blnExistingQuest && $intRPGCharacterID != null){
				$this->loadQuestProperties();
				$this->loadKillReqProperties();
			}
		}
	}
	
	private function populateVarFromRow($arrQuestInfo){
		$this->setQuestID($arrQuestInfo['intQuestID']);
		$this->setQuestName($arrQuestInfo['strQuestName']);
		$this->setQuestType($arrQuestInfo['strQuestType']);
		$this->setQuestDesc($arrQuestInfo['txtQuestDesc']);
		$this->setExpReward($arrQuestInfo['intExpReward']);
		$this->setGoldReward($arrQuestInfo['intGoldReward']);
	}
	
	private function loadQuestInfo($intQuestID){
		$objDB = new Database();
		$arrQuestInfo = array();
			$strSQL = "SELECT *
						FROM tblquest
							WHERE intQuestID = " . $objDB->quote($intQuestID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrQuestInfo['intQuestID'] = $arrRow['intQuestID'];
				$arrQuestInfo['strQuestName'] = $arrRow['strQuestName'];
				$arrQuestInfo['strQuestType'] = $arrRow['strQuestType'];
				$arrQuestInfo['txtQuestDesc'] = $arrRow['txtQuestDesc'];
				$arrQuestInfo['intExpReward'] = $arrRow['intExpReward'];
				$arrQuestInfo['intGoldReward'] = $arrRow['intGoldReward'];
			}
		$this->populateVarFromRow($arrQuestInfo);
	}
	
	public function addQuest(){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharacterquestxr
					(intRPGCharacterID, intQuestID, dtmStarted, blnActive)
						VALUES
					(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($this->_intQuestID) . ", NOW(), 1)";
		$objDB->query($strSQL);
		// if this quest has requirements, create them in the db table
		if($this->hasKillRequirements()){
			foreach($this->_arrRequirements["Kill"] as $intNPCID => $objReqs){
				$strSQL = "INSERT INTO tblcharacterquestkillreqxr
							(intRPGCharacterID, intQuestID, intKillReqID, intCurrentCount, dtmStarted)
								VALUES
							(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($this->_intQuestID) . ", " . $objDB->quote($objReqs->getKillReqID()) . ", 0, NOW())";
				$objDB->query($strSQL);
				$this->_arrRequirements["Kill"][$intNPCID]->setCurrentKillCount(0);
				$this->_arrRequirements["Kill"][$intNPCID]->setStarted(date("Y-m-d H:i:s"));
				$this->_arrRequirements["Kill"][$intNPCID]->setCompleted('0000-00-00 00:00:00');
			}
		}
		$this->loadQuestProperties();
	}
	
	public function saveQuest(){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacterquestxr
					SET dtmCompleted = " . $objDB->quote($this->_dtmCompleted) . "
						, blnActive = " . $objDB->quote($this->_blnActive) . "
						WHERE intQuestID = " . $objDB->quote($this->_intQuestID) . "
							AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$objDB->query($strSQL);
		
		if($this->hasKillRequirements()){
			foreach($this->_arrRequirements["Kill"] as $intNPCID => $objReq){
				$strSQL = "UPDATE tblcharacterquestkillreqxr
							SET dtmCompleted = " . $objDB->quote($objReq->getCompleted()) . "
								, intCurrentCount = " . $objDB->quote($objReq->getCurrentKillCount()) . "
								WHERE intKillReqID = " . $objDB->quote($objReq->getKillReqID()) . "
									AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
				$objDB->query($strSQL);
			}
		}
	}
	
	public function loadQuestProperties(){
		$objDB = new Database();
		$strSQL = "SELECT dtmStarted, dtmCompleted, blnActive
					FROM tblcharacterquestxr
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
							AND intQuestID = " . $objDB->quote($this->_intQuestID);
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_dtmStarted = $arrRow['dtmStarted'];
			$this->_dtmCompleted = $arrRow['dtmCompleted'];
			$this->_blnActive = $arrRow['blnActive'];
		}
	}
	
	public function loadKillReqProperties(){
		$objDB = new Database();
		$strSQL = "SELECT intNPCID, intKillReqID, dtmStarted, dtmCompleted, intCurrentCount
					FROM tblcharacterquestkillreqxr
						INNER JOIN tblquestkillreq
							USING (intKillReqID)
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
							AND tblcharacterquestkillreqxr.intQuestID = " . $objDB->quote($this->_intQuestID);
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrRequirements["Kill"][$arrRow['intNPCID']]->setStarted($arrRow['dtmStarted']);
			$this->_arrRequirements["Kill"][$arrRow['intNPCID']]->setCompleted($arrRow['dtmCompleted']);
			$this->_arrRequirements["Kill"][$arrRow['intNPCID']]->setCurrentKillCount($arrRow['intCurrentCount']);
		}
	}
	
	public function loadRequirements(){
		$this->loadKillRequirements();
		$this->loadCheckpointRequirements();
	}
	
	public function loadKillRequirements(){
		$objDB = new Database();
		$strSQL = "SELECT *
					FROM tblquestkillreq
						WHERE intQuestID = " . $objDB->quote($this->_intQuestID);
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$objQuestReq = new RPGQuestKillReq();
			$objQuestReq->setKillReqID($arrRow['intKillReqID']);
			$objQuestReq->setReqName($arrRow['strReqName']);
			$objQuestReq->setQuestID($arrRow['intQuestID']);
			$objQuestReq->setNPCID($arrRow['intNPCID']);
			$objQuestReq->setKillReq($arrRow['intKillReq']);
			$this->_arrRequirements["Kill"][$arrRow['intNPCID']] = $objQuestReq;
		}
	}
	
	public function loadCheckpointRequirements(){
		// todo
	}
	
	public function getAllRequirements(){
		return $this->_arrRequirements;
	}
	
	public function getRequirements($strReqType, $intNPCID){
		if(isset($this->_arrRequirements[$strReqType][$intNPCID])){
			return $this->_arrRequirements[$strReqType][$intNPCID];
		}
		else{
			return false;
		}
	}
	
	public function hasKillRequirements(){
		return !empty($this->_arrRequirements["Kill"]) ? true : false;
	}
	
	public function getQuestID(){
		return $this->_intQuestID;
	}
	
	public function setQuestID($intQuestID){
		$this->_intQuestID = $intQuestID;
	}
	
	public function getQuestName(){
		return $this->_strQuestName;
	}
	
	public function setQuestName($strQuestName){
		$this->_strQuestName = $strQuestName;
	}
	
	public function getQuestDesc(){
		return $this->_txtQuestDesc;
	}
	
	public function setQuestDesc($txtQuestDesc){
		$this->_txtQuestDesc = $txtQuestDesc;
	}
	
	public function getQuestType(){
		return $this->_strQuestType;
	}
	
	public function setQuestType($strQuestType){
		$this->_strQuestType = $strQuestType;
	}
	
	public function getStarted(){
		return $this->_dtmStarted;
	}
	
	public function setStarted($dtmStarted){
		$this->_dtmStarted = $dtmStarted;
	}
	
	public function getCompleted(){
		return $this->_dtmCompleted;
	}
	
	public function setCompleted($dtmCompleted){
		$this->_dtmCompleted = $dtmCompleted;
	}
	
	public function getActive(){
		return $this->_blnActive;
	}
	
	public function setActive($blnActive){
		$this->_blnActive = $blnActive;
	}
	
	public function getExpReward(){
		return $this->_intExpReward;
	}
	
	public function setExpReward($intExpReward){
		$this->_intExpReward = $intExpReward;
	}
	
	public function getGoldReward(){
		return $this->_intGoldReward;
	}
	
	public function setGoldReward($intGoldReward){
		$this->_intGoldReward = $intGoldReward;
	}
	
	public function allReqComplete(){
		foreach($this->_arrRequirements as $strIndex => $arrReqs){
			foreach($arrReqs as $intIndex => $objReq){
				if($objReq->getCompleted() == '0000-00-00 00:00:00'){
					return false;
				}
			}
		}
		return true;
	}
	
	public function turnInQuest($objRPGCharacter){
		$this->setActive(false);
		$objRPGCharacter->setGold($objRPGCharacter->getGold() + $this->_intGoldReward);
		$objRPGCharacter->gainExperience($this->_intExpReward);
	}

}

?>