<?php

require_once "Database.php";
include_once "RPGSkillList.php";

class RPGClass{

	private $_intRPGCharacterID;
	private $_intClassID;
	private $_strClassName;
	private $_txtClassDesc;
	private $_intClassLevel;
	private $_intClassExperience;
	private $_blnCurrentClass;
	private $_objSkillList;
	private $_intRequiredExperience;
	
	public function __construct($intClassID = null, $intRPGCharacterID = null, $blnExistingClass = true){
		if($intRPGCharacterID != null){
			$this->_intRPGCharacterID = $intRPGCharacterID;
		}
		if($intClassID != null){
			$this->loadClassInfo($intClassID);
			if($blnExistingClass && $intRPGCharacterID != null){
				$this->loadClassProperties();
			}
			$this->_intRequiredExperience = $this->loadRequiredExperience();
		}
	}
	
	private function populateVarFromRow($arrClassInfo){
		$this->setClassID($arrClassInfo['intClassID']);
		$this->setClassName($arrClassInfo['strClassName']);
		$this->setClassDesc($arrClassInfo['txtClassDesc']);
	}
	
	private function loadClassInfo($intClassID){
		$objDB = new Database();
		$arrClassInfo = array();
		$strSQL = "SELECT *
					FROM tblclass
						WHERE intClassID = " . $objDB->quote($intClassID);
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrClassInfo['intClassID'] = $arrRow['intClassID'];
			$arrClassInfo['strClassName'] = $arrRow['strClassName'];
			$arrClassInfo['txtClassDesc'] = $arrRow['txtClassDescription'];
		}
		$this->populateVarFromRow($arrClassInfo);
	}
	
	public function addClass(){
		$objDB = new Database();
		$strSQL = "INSERT INTO tblcharacterclassxr
					(intRPGCharacterID, intClassID, intClassLevel, intClassExperience, blnCurrentClass)
						VALUES
					(" . $objDB->quote($this->_intRPGCharacterID) . ", " . $objDB->quote($this->_intClassID) . ", 1, 0, 0)";
		$objDB->query($strSQL);
		$this->loadClassProperties();
	}
	
	public function saveClass(){
		$objDB = new Database();
		$strSQL = "UPDATE tblcharacterclassxr
					SET intClassLevel = " . $objDB->quote($this->_intClassLevel) . "
						, intClassExperience = " . $objDB->quote($this->_intClassExperience) . "
						, blnCurrentClass = " . $objDB->quote($this->_blnCurrentClass) . "
						WHERE intClassID = " . $objDB->quote($this->_intClassID) . "
							AND intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID);
		$objDB->query($strSQL);
	}
	
	public function loadClassProperties(){
		$objDB = new Database();
		$strSQL = "SELECT intClassLevel, intClassExperience, blnCurrentClass
					FROM tblcharacterclassxr
						WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
							AND intClassID = " . $objDB->quote($this->_intClassID);
		$rsResult = $objDB->query($strSQL);
		while ($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_intClassLevel = $arrRow['intClassLevel'];
			$this->_intClassExperience = $arrRow['intClassExperience'];
			$this->_blnCurrentClass = $arrRow['blnCurrentClass'];
		}
		$this->_objSkillList = new RPGSkillList();
		$this->_objSkillList->loadSkillList($this->_intClassID, $this->_intClassLevel);
		$this->_intRequiredExperience = $this->loadRequiredExperience();
	}
	
	public function gainExperience($intExpGain){
		if($this->getClassLevel() != 15){
			$this->_intClassExperience += $intExpGain;
			$this->saveClass();
		}
		if($this->_intClassExperience >= $this->_intRequiredExperience){
			$this->levelUp();
		}
	}
	
	public function levelUp(){
		$intExpDiff = $this->_intClassExperience - $this->loadRequiredExperience(); 
		$this->_intClassLevel++;
		$this->setClassExperience(0);
		$this->_intRequiredExperience = $this->loadRequiredExperience();
		$this->gainExperience($intExpDiff);
		$this->saveClass();
		$this->_objSkillList->loadSkillList($this->_intClassID, $this->_intClassLevel);
	}
	
	public function loadRequiredExperience(){
		return pow(($this->_intClassLevel + 1) * 4, 2) * 100;
	}
	
	public function getClassID(){
		return $this->_intClassID;
	}
	
	public function setClassID($intClassID){
		$this->_intClassID = $intClassID;
	}
	
	public function getSkills(){
		return $this->_objSkillList;
	}
	
	public function setSkills($objSkillList){
		$this->_objSkillList = $objSkillList;
	}
	
	public function getClassName(){
		return $this->_strClassName;
	}
	
	public function setClassName($strClassName){
		$this->_strClassName = $strClassName;
	}
	
	public function getClassDesc(){
		return $this->_txtClassDesc;
	}
	
	public function setClassDesc($txtClassDesc){
		$this->_txtClassDesc = $txtClassDesc;
	}
	
	public function getClassLevel(){
		return $this->_intClassLevel;
	}
	
	public function setClassLevel($intClassLevel){
		$this->_intClassLevel = $intClassLevel;
	}
	
	public function getClassExperience(){
		return $this->_intClassExperience;
	}
	
	public function setClassExperience($intClassExperience){
		$this->_intClassExperience = $intClassExperience;
	}
	
	public function getCurrentClass(){
		return $this->_blnCurrentClass;
	}
	
	public function setCurrentClass($blnCurrentClass){
		$this->_blnCurrentClass = $blnCurrentClass;
	}
	
	public function getRequiredExperience(){
		return $this->_intRequiredExperience;
	}
	
	public function setRequiredExperience($intRequiredExperience){
		$this->_intRequiredExperience = $intRequiredExperience;
	}
	
}
?>