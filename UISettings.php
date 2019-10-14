<?php

include_once "Database.php";

class UISettings{

	private $_strInventoryFrame;
	private $_strEventFrame;
	private $_strCharacterFrame;
	private $_strCommandsFrame;
	private $_strNavigationFrame;
	private $_arrOverrides;
	private $_blnDisableTraversal;
	private $_blnDisableInv;
	private $_blnDisableStats;
	private $_blnDisableSkills;
	private $_blnDisableParty;
	private $_intRPGCharacterID;
	private $_intQuestTab;
	private $_intClassTab;
	
	public function __construct($intRPGCharacterID){
		//defaults
		$this->_intRPGCharacterID = $intRPGCharacterID;
		$this->_strInventoryFrame = "Equipment";
		$this->_strEventFrame = "Event";
		$this->_strCharacterFrame = "Info";
		$this->_strCommandsFrame = "Event";
		$this->_strNavigationFrame = "Compass";
		$this->_arrOverrides = array();
		$this->loadOverrides();
		$this->_blnDisableTraversal = true;
		$this->_blnDisableInv = true;
		$this->_blnDisableStats = false;
		$this->_blnDisableSkills = false;
		$this->_blnDisableParty = false;
		$this->_intQuestTab = 0;
		$this->_intClassTab = 0;
	}
	
	public function loadOverrides(){
		$objDB = new Database();
		$strSQL = "SELECT intOverrideID
						FROM tblcharacteroverridexr
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrOverrides[$arrRow['intOverrideID']] = $arrRow['intOverrideID'];
		}
	}
	
	public function getInventoryFrame(){
		return $this->_strInventoryFrame;
	}
	
	public function setInventoryFrame($strInventoryFrame){
		$this->_strInventoryFrame = $strInventoryFrame;
	}
	
	public function getEventFrame(){
		return $this->_strEventFrame;
	}
	
	public function setEventFrame($strEventFrame){
		$this->_strEventFrame = $strEventFrame;
	}

	public function getCharacterFrame(){
		return $this->_strCharacterFrame;
	}
	
	public function setCharacterFrame($strCharacterFrame){
		$this->_strCharacterFrame = $strCharacterFrame;
	}
	
	public function getCommandsFrame(){
		return $this->_strCommandsFrame;
	}
	
	public function setCommandsFrame($strCommandsFrame){
		$this->_strCommandsFrame = $strCommandsFrame;
	}
	
	public function getOverrides(){
		return $this->_arrOverrides;
	}
	
	public function addToOverrides($intOverrideID){
		$this->_arrOverrides[$intOverrideID] = $intOverrideID;
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharacteroverridexr
						(intRPGCharacterID, intOverrideID)
					VALUES
						(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($intOverrideID) . ")";
		$objDB->query($strSQL);
	}
	
	public function removeFromOverrides($intOverrideID){
		unset($this->_arrOverrides[$intOverrideID]);
		$objDB = new Database();
		$strSQL = "DELETE FROM tblcharacteroverridexr
					WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
						AND intOverrideID = " . $objDB->quote($intOverrideID);
		$objDB->query($strSQL);
	}
	
	public function getDisableTraversal(){
		return $this->_blnDisableTraversal;
	}
	
	public function setDisableTraversal($blnDisableTraversal){
		$this->_blnDisableTraversal = $blnDisableTraversal;
	}
	
	public function getDisableInv(){
		return $this->_blnDisableInv;
	}
	
	public function setDisableInv($blnDisableInv){
		$this->_blnDisableInv = $blnDisableInv;
	}
	
	public function getDisableStats(){
		return $this->_blnDisableStats;
	}
	
	public function setDisableStats($blnDisableStats){
		$this->_blnDisableStats = $blnDisableStats;
	}
	
	public function getDisableSkills(){
		return $this->_blnDisableSkills;
	}
	
	public function setDisableSkills($blnDisableSkills){
		$this->_blnDisableSkills = $blnDisableSkills;
	}
	
	public function getDisableParty(){
		return $this->_blnDisableParty;
	}
	
	public function setDisableParty($blnDisableParty){
		$this->_blnDisableParty = $blnDisableParty;
	}
	
	public function getNavigationFrame(){
		return $this->_strNavigationFrame;
	}
	
	public function setNavigationFrame($strNavigationFrame){
		$this->_strNavigationFrame = $strNavigationFrame;
	}
	
	public function setQuestTab($intQuestTab){
		$this->_intQuestTab = $intQuestTab;
	}
	
	public function getQuestTab(){
		return $this->_intQuestTab;
	}
	
	public function setClassTab($intClassTab){
		$this->_intClassTab = $intClassTab;
	}
	
	public function getClassTab(){
		return $this->_intClassTab;
	}
}

?>