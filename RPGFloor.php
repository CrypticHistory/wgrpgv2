<?php

require_once "Database.php";
include_once "Lottery.php";
include_once "RPGEvent.php";

class RPGFloor{

	private $_intFloorID;
	private $_strFloorName;
	private $_txtEntryText;
	private $_strFloorType;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	private $_arrApplicableEvents;
	
	public function RPGFloor($intFloorID = null){
		if($intFloorID){
			$this->loadFloorInfo($intFloorID);
		}
	}
	
	private function populateVarFromRow($arrFloorInfo){
		$this->setFloorID($arrFloorInfo['intFloorID']);
		$this->setFloorName($arrFloorInfo['strFloorName']);
		$this->setEntryText($arrFloorInfo['txtEntryText']);
		$this->setFloorType($arrFloorInfo['strFloorType']);
		$this->setCreatedOn($arrFloorInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrFloorInfo['strCreatedBy']);
		$this->setModifiedOn($arrFloorInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrFloorInfo['strModifiedBy']);
	}
	
	private function loadFloorInfo($intFloorID){
		$objDB = new Database();
		$arrFloorInfo = array();
			$strSQL = "SELECT *
						FROM tblfloor
							WHERE intFloorID = " . $objDB->quote($intFloorID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrFloorInfo['intFloorID'] = $arrRow['intFloorID'];
				$arrFloorInfo['strFloorName'] = $arrRow['strFloorName'];
				$arrFloorInfo['txtEntryText'] = $arrRow['txtEntryText'];
				$arrFloorInfo['strFloorType'] = $arrRow['strFloorType'];
				$arrFloorInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrFloorInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrFloorInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrFloorInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrFloorInfo);
	}
	
	public function setApplicableEvents($intRPGCharacterID){
		$objDB = new Database();
		$strSQL = "SELECT intEventID, intOccurrenceRating
					FROM tblflooreventxr
						WHERE intEventID NOT IN
							(SELECT intEventID
								FROM tblcharactereventxr
									INNER JOIN tblevent
										USING (intEventID)
									WHERE intRPGCharacterID = " . $objDB->quote($intRPGCharacterID) . "
										AND blnRepeating = 0)
							AND intFloorID = " . $objDB->quote($this->getFloorID());
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrApplicableEvents[$arrRow['intEventID']] = $arrRow['intOccurrenceRating'];
		}
	}
	
	public function getApplicableEvents(){
		return $this->_arrApplicableEvents;
	}
	
	public function generateRandomEvent(){
		$objLottery = new Lottery();
		foreach($this->getApplicableEvents() as $key => $value){
			$objEvent = new RPGEvent($key);
			if($objEvent->getForcedEvent() == true){
				return $key;
			}
			else{
				$objLottery->addEntry($key, $value);
			}
		}
		return $objLottery->getWinner();
	}
	
	public function getFloorID(){
		return $this->_intFloorID;
	}
	
	public function setFloorID($intFloorID){
		$this->_intFloorID = $intFloorID;
	}
	
	public function getFloorName(){
		return $this->_strFloorName;
	}
	
	public function setFloorName($strFloorName){
		$this->_strFloorName = $strFloorName;
	}
	
	public function getEntryText(){
		return $this->_txtEntryText;
	}
	
	public function setEntryText($txtEntryText){
		$this->_txtEntryText = $txtEntryText;
	}
	
	public function getFloorType(){
		return $this->_strFloorType;
	}
	
	public function setFloorType($strFloorType){
		$this->_strFloorType = $strFloorType;
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