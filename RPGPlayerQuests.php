<?php

require_once "Database.php";
include_once "RPGQuest.php";

class RPGPlayerQuests{

	private $_intRPGCharacterID;
	private $_arrQuests;
	
	public function __construct($intRPGCharacterID){
		$this->_intRPGCharacterID = $intRPGCharacterID;
		$this->_arrQuests = array();
		if($this->_intRPGCharacterID != null){
			$this->loadQuests();
		}
	}
	
	public function loadQuests(){
		$objDB = new Database();
		$strSQL = "SELECT intQuestID
					FROM tblcharacterquestxr
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
							AND blnActive = 1";
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrQuests[$arrRow['intQuestID']] = new RPGQuest($arrRow['intQuestID'], $this->_intRPGCharacterID);
		}
	}
	
	public function incrementKillCount($intNPCID){
		foreach($this->_arrQuests as $intQuestID => $objQuest){
			if($objQuest->getCompleted() == '0000-00-00 00:00:00'){
				if($objQuest->hasKillRequirements()){
					if($objQuest->getRequirements("Kill", $intNPCID) != false && $objQuest->getRequirements("Kill", $intNPCID)->getCompleted() == '0000-00-00 00:00:00'){
						$objQuest->getRequirements("Kill", $intNPCID)->incrementKillCount();
						if($objQuest->allReqComplete()){
							$objQuest->setCompleted(date("Y-m-d H:i:s"));
						}
						$objQuest->saveQuest();
					}
				}
			}
		}
	}
	
	public function turnInQuest($intQuestID, $objRPGCharacter){
		$this->_arrQuests[$intQuestID]->turnInQuest($objRPGCharacter);
		$this->_arrQuests[$intQuestID]->saveQuest();
		unset($this->_arrQuests[$intQuestID]);
	}
	
	public function isQuestCompleted($intQuestID){
		if(isset($this->_arrQuests[$intQuestID]) && $this->_arrQuests[$intQuestID]->getCompleted() != '0000-00-00 00:00:00'){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function startNewQuest($intQuestID){
		$this->_arrQuests[$intQuestID] = new RPGQuest($intQuestID, $this->_intRPGCharacterID, false);
		$this->_arrQuests[$intQuestID]->addQuest();
	}
	
	public function getQuestList(){
		return $this->_arrQuests;
	}

}

?>