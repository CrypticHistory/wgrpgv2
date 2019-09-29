<?php

require_once "Database.php";
include_once "constants.php";

class RPGEvent{

	private $_intEventID;
	private $_intEventNodeID;
	private $_strEventName;
	private $_txtEventDesc;
	private $_strXML;
	private $_blnRepeating;
	private $_arrEventItems;
	private $_objEventItem;
	private $_intNPCID;
	private $_intConversationLevel;
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_arrRolls;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	private $_intRPGCharacterID;
	private $_blnHasViewedEvent;
	
	public function __construct($intEventID = null, $intRPGCharacterID = null){
		if($intEventID != null){
			$this->loadEventInfo($intEventID);
		}
		if($intRPGCharacterID != null){
			$this->_intRPGCharacterID = $intRPGCharacterID;
			$this->loadHasViewedEvent();
		}
	}
	
	private function populateVarFromRow($arrEventInfo){
		$this->setEventID($arrEventInfo['intEventID']);
		$this->setEventName($arrEventInfo['strEventName']);
		$this->setEventDesc($arrEventInfo['txtEventDesc']);
		$this->setXML($arrEventInfo['strXML']);
		$this->setEventType($arrEventInfo['strEventType']);
		$this->setRepeating($arrEventInfo['blnRepeating']);
		$this->setNPCID($arrEventInfo['intNPCID']);
		$this->setConversationLevel($arrEventInfo['intConversationLevel']);
		$this->setCreatedOn($arrEventInfo['dtmCreatedOn']);
		$this->setCreatedBy($arrEventInfo['strCreatedBy']);
		$this->setModifiedOn($arrEventInfo['dtmModifiedOn']);
		$this->setModifiedBy($arrEventInfo['strModifiedBy']);
	}
	
	private function loadEventInfo($intEventID){
		$objDB = new Database();
		$arrEventInfo = array();
			$strSQL = "SELECT *
						FROM tblevent
							LEFT JOIN tbleventconversation
								USING (intEventID)
							WHERE intEventID = " . $objDB->quote($intEventID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrEventInfo['intEventID'] = $arrRow['intEventID'];
				$arrEventInfo['strEventName'] = $arrRow['strEventName'];
				$arrEventInfo['txtEventDesc'] = $arrRow['txtEventDesc'];
				$arrEventInfo['strXML'] = $arrRow['strXML'];
				$arrEventInfo['strEventType'] = $arrRow['strEventType'];
				$arrEventInfo['blnRepeating'] = $arrRow['blnRepeating'];
				$arrEventInfo['intNPCID'] = $arrRow['intNPCID'];
				$arrEventInfo['intConversationLevel'] = $arrRow['intConversationLevel'];
				$arrEventInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrEventInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrEventInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrEventInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrEventInfo);
		$this->_intEventNodeID = 0;
		$this->loadApplicableEventItems();
		$this->loadRandomEventItem();
		$this->initRolls();
	}
	
	public function initRolls(){
		$this->_arrRolls["Strength"] = 0;
		$this->_arrRolls["Intelligence"] = 0;
		$this->_arrRolls["Vitality"] = 0;
		$this->_arrRolls["Agility"] = 0;
		$this->_arrRolls["Dexterity"] = 0;
		$this->_arrRolls["Willpower"] = 0;
		$this->_arrRolls["FiftyFifty"] = 0;
	}
	
	public function getLinkName($intLocationID){
		$objDB = new Database();
		$strSQL = "SELECT strLinkName
					FROM tbllocationeventlink
						WHERE intLocationID = " . $objDB->quote($intLocationID) . "
							AND intEventID = " . $objDB->quote($this->_intEventID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return $arrRow['strLinkName'];
	}
	
	public function addToCharacterEventLog(){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharactereventxr
						(intRPGCharacterID, intEventID, dtmDateAdded)
					VALUES
						(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($this->_intEventID) . ", NOW())";
		$objDB->query($strSQL);
	}
	
	public function loadHasViewedEvent(){
		$objDB = new Database();
		$strSQL = "SELECT intEventID FROM tblcharactereventxr
					WHERE intEventID = " . $objDB->quote($this->_intEventID) . " AND
							intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		$this->_blnHasViewedEvent = isset($arrRow['intEventID']) ? true : false;
	}
	
	public function hasObtainedUniqueItem($intItemID){
		$objDB = new Database();
		$strSQL = "SELECT intItemID FROM tbluniqueeventgifts
					WHERE intEventID = " . $objDB->quote($this->_intEventID) . " AND
							intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . " AND
							intItemID = " . $objDB->quote($intItemID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return (isset($arrRow['intItemID']) ? true : false);
	}
	
	public function obtainUniqueItem($intItemID){
		$objDB = new Database();
		$strSQL = "INSERT INTO tbluniqueeventgifts
						(intRPGCharacterID, intEventID, intItemID, dtmDateObtained)
					VALUES
						(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($this->_intEventID) . ", " . $objDB->quote($intItemID) . ", NOW())";
		$objDB->query($strSQL);
	}
	
	public function hasViewedEvent(){
		return $this->_blnHasViewedEvent;
	}
	
	public function checkEndOfEvent(){
		global $arrStateValues;
		$blnEndOfEvent = false;
		$objXML = new RPGXMLReader($this->getXML());
		if((in_array($this->getEventNodeID(), (array)$objXML->getEndNodes())) || $objXML->getEndNodes() == 'any'){
			if(!$this->hasViewedEvent()){
				$this->addToCharacterEventLog();
			}	
			$_SESSION['objRPGCharacter']->removeOverride(3);
			$objCurrentFloor = $_SESSION['objRPGCharacter']->getCurrentFloor();
			if($objCurrentFloor->getFloorID() != 0){
				if($objCurrentFloor->getMaze()->isEntrance()){
					$objCurrentFloor->getMaze()->setEventAtCurrentLocation("B");
				}
				else if($objCurrentFloor->getMaze()->isExit()){
					$objCurrentFloor->getMaze()->setEventAtCurrentLocation("E");
				}
				else{
					$objCurrentFloor->getMaze()->setEventAtCurrentLocation("S");	
				}	
			}
			$blnEndOfEvent = true;
		}
		return $blnEndOfEvent;
	}
	
	public function loadApplicableEventItems(){
		$objDB = new Database();
		$strSQL = "SELECT intItemID, intOccurrenceRating, intDrawGroup
					FROM tbleventitemxr
						WHERE intEventID = " . $objDB->quote($this->_intEventID);
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrEventItems[$arrRow['intItemID']] = $arrRow['intOccurrenceRating'];
		}
	}
	
	public function loadRandomEventItem(){
		if(!empty($this->_arrEventItems)){
			$objLottery = new Lottery();
			foreach($this->_arrEventItems as $key => $value){
				$objLottery->addEntry($key, $value);
			}
			$this->_objEventItem = new RPGItem($objLottery->getWinner());
		}
	}
	
	public function getEventItem(){
		return $this->_objEventItem;
	}
	
	public function getEventID(){
		return $this->_intEventID;
	}
	
	public function setEventID($intEventID){
		$this->_intEventID = $intEventID;
	}
	
	public function getEventNodeID(){
		return $this->_intEventNodeID;
	}
	
	public function setEventNodeID($intEventNodeID){
		$this->_intEventNodeID = intval($intEventNodeID);
	}
	
	public function getEventName(){
		return $this->_strEventName;
	}
	
	public function setEventName($strEventName){
		$this->_strEventName = $strEventName;
	}
	
	public function getEventDesc(){
		return $this->_txtEventDesc;
	}
	
	public function setEventDesc($txtEventDesc){
		$this->_txtEventDesc = $txtEventDesc;
	}
	
	public function getXML(){
		return $this->_strXML;
	}
	
	public function setXML($strXML){
		$this->_strXML = $strXML;
	}
	
	public function getEventType(){
		return $this->_strEventType;
	}
	
	public function setEventType($strEventType){
		$this->_strEventType = $strEventType;
	}
	
	public function getRepeating(){
		return $this->_blnRepeating;
	}
	
	public function setRepeating($blnRepeating){
		$this->_blnRepeating = $blnRepeating;
	}
	
	public function getNPCID(){
		return $this->_intNPCID;
	}
	
	public function setNPCID($intNPCID){
		$this->_intNPCID = $intNPCID;
	}
	
	public function getConversationLevel(){
		return $this->_intConversationLevel;
	}
	
	public function setConversationLevel($intConversationLevel){
		$this->_intConversationLevel = $intConversationLevel;
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
	
	public function getRolls($strIndex){
		return $this->_arrRolls[$strIndex];
	}
	
	public function setRolls($strIndex, $intValue){
		$this->_arrRolls[$strIndex] = $intValue;
	}
	
	public function clearRolls(){
		foreach($this->_arrRolls as $strIndex => $intValue){
			$this->_arrRolls[$strIndex] = 0;
		}
	}
}

?>