<?php

require_once "Database.php";

class RPGCheckpoint{

	private $_intRPGCharacterID;
	private $_intCheckpointID;
	private $_strCheckpointName;
	private $_txtCheckpointDesc;
	private $_dtmLastViewed;
	private $_intTimesViewed;
	
	public function __construct($intCheckpointID = null, $intRPGCharacterID = null, $blnExistingCheckpoint = true){
		if($intRPGCharacterID != null){
			$this->_intRPGCharacterID = $intRPGCharacterID;
			
			if($intCheckpointID != null){
				$this->loadCheckpointInfo($intCheckpointID);
				$this->_intTimesViewed = 0;
				if($blnExistingCheckpoint){
					$this->loadCheckpointProperties();
				}
				else{
					$this->addCheckpoint();
				}
			}
		}
	}
	
	private function populateVarFromRow($arrCheckpointInfo){
		$this->setCheckpointID($arrCheckpointInfo['intCheckpointID']);
		$this->setCheckpointName($arrCheckpointInfo['strCheckpointName']);
		$this->setCheckpointDesc($arrCheckpointInfo['txtCheckpointDesc']);
	}
	
	private function loadCheckpointInfo($intCheckpointID){
		$objDB = new Database();
		$arrCheckpointInfo = array();
			$strSQL = "SELECT *
						FROM tblcheckpoint
							WHERE intCheckpointID = " . $objDB->quote($intCheckpointID);
			$rsResult = $objDB->query($strSQL);
			while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
				$arrCheckpointInfo['intCheckpointID'] = $arrRow['intCheckpointID'];
				$arrCheckpointInfo['strCheckpointName'] = $arrRow['strCheckpointName'];
				$arrCheckpointInfo['txtCheckpointDesc'] = $arrRow['txtCheckpointDesc'];
			}
		$this->populateVarFromRow($arrCheckpointInfo);
	}
	
	public function addCheckpoint(){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharactercheckpointxr
					(intRPGCharacterID, intCheckpointID, dtmLastViewed)
						VALUES
					(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($this->_intCheckpointID) . ", NOW())";
		$objDB->query($strSQL);
		$this->loadCheckpointProperties();
	}
	
	public function saveCheckpoint(){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharactercheckpointxr
					SET dtmLastViewed = " . $objDB->quote($this->_dtmLastViewed) . "
						, intTimesViewed = " . $objDB->quote($this->_intTimesViewed) . "
						WHERE intCheckpointID = " . $objDB->quote($this->_intCheckpointID) . "
							AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$objDB->query($strSQL);
	}
	
	public function loadCheckpointProperties(){
		$objDB = new Database();
		$strSQL = "SELECT dtmLastViewed, intTimesViewed
					FROM tblcharactercheckpointxr
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
							AND intCheckpointID = " . $objDB->quote($this->_intCheckpointID);
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_dtmLastViewed = $arrRow['dtmLastViewed'];
			$this->_intTimesViewed = $arrRow['intTimesViewed'];
		}
	}
	
	public function hasViewedCheckpoint(){
		if($this->getTimesViewed() != 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function viewCheckpoint(){
		$this->_intTimesViewed++;
		$this->_dtmLastViewed = date("Y-m-d H:i:s");
		$this->saveCheckpoint();
	}
	
	public function getCheckpointID(){
		return $this->_intCheckpointID;
	}
	
	public function setCheckpointID($intCheckpointID){
		$this->_intCheckpointID = $intCheckpointID;
	}
	
	public function getCheckpointName(){
		return $this->_strCheckpointName;
	}
	
	public function setCheckpointName($strCheckpointName){
		$this->_strCheckpointName = $strCheckpointName;
	}
	
	public function getCheckpointDesc(){
		return $this->_txtCheckpointDesc;
	}
	
	public function setCheckpointDesc($txtCheckpointDesc){
		$this->_txtCheckpointDesc = $txtCheckpointDesc;
	}
	
	public function getLastViewed(){
		return $this->_dtmLastViewed;
	}
	
	public function setLastViewed($dtmLastViewed){
		$this->_dtmLastViewed = $dtmLastViewed;
	}
	
	public function getTimesViewed(){
		return $this->_intTimesViewed;
	}
	
	public function setTimesViewed($intTimesViewed){
		$this->_intTimesViewed = $intTimesViewed;
	}

}

?>