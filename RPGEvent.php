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
	private $_dtmCreatedOn;
	private $_strCreatedBy;
	private $_dtmModifiedOn;
	private $_strModifiedBy;
	private $_intRPGCharacterID;
	
	public function RPGEvent($intEventID = null, $intRPGCharacterID = null){
		if($intEventID){
			$this->loadEventInfo($intEventID);
		}
		if($intRPGCharacterID){
			$this->_intRPGCharacterID = $intRPGCharacterID;
		}
	}
	
	private function populateVarFromRow($arrEventInfo){
		$this->setEventID($arrEventInfo['intEventID']);
		$this->setEventName($arrEventInfo['strEventName']);
		$this->setEventDesc($arrEventInfo['txtEventDesc']);
		$this->setXML($arrEventInfo['strXML']);
		$this->setEventType($arrEventInfo['strEventType']);
		$this->setRepeating($arrEventInfo['blnRepeating']);
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
							WHERE intEventID = " . $objDB->quote($intEventID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrEventInfo['intEventID'] = $arrRow['intEventID'];
				$arrEventInfo['strEventName'] = $arrRow['strEventName'];
				$arrEventInfo['txtEventDesc'] = $arrRow['txtEventDesc'];
				$arrEventInfo['strXML'] = $arrRow['strXML'];
				$arrEventInfo['strEventType'] = $arrRow['strEventType'];
				$arrEventInfo['blnRepeating'] = $arrRow['blnRepeating'];
				$arrEventInfo['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
				$arrEventInfo['strCreatedBy'] = $arrRow['strCreatedBy'];
				$arrEventInfo['dtmModifiedOn'] = $arrRow['dtmModifiedOn'];
				$arrEventInfo['strModifiedBy'] = $arrRow['strModifiedBy'];
			}
		$this->populateVarFromRow($arrEventInfo);
		$this->_intEventNodeID = 0;
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
	
	public function hasViewedEvent(){
		$objDB = new Database();
		$strSQL = "SELECT intEventID FROM tblcharactereventxr
					WHERE intEventID = " . $objDB->quote($this->_intEventID) . " AND
							intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
		return (isset($arrRow['intEventID']) ? true : false);
	}
	
	public function setViewedEvent(){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharactereventxr
					(intEventID, intRPGCharacterID, dtmDateAdded) VALUES
					(" . $objDB->quote($this->_intEventID) . ", " . $objDB->quote($this->_intRPGCharacterID) . ", NOW())";
		$rsResult = $objDB->query($strSQL);
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
			if(isset($_SESSION['objEnemy'])){
				unset($_SESSION['objEnemy']);
			}
			$blnEndOfEvent = true;
		}
		return $blnEndOfEvent;
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