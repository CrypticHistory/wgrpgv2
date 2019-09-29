<?php

require_once "Database.php";
include_once "RPGClass.php";

class RPGPlayerClasses{

	private $_intRPGCharacterID;
	private $_arrClasses;
	private $_intCurrentClassID;
	
	public function __construct($intRPGCharacterID){
		$this->_intRPGCharacterID = $intRPGCharacterID;
		$this->_arrClasses = array();
		if($this->_intRPGCharacterID != null){
			$this->loadClasses();
		}
	}
	
	public function loadClasses(){
		$objDB = new Database();
		$strSQL = "SELECT * FROM tblcharacterclassxr
					WHERE intRPGCharacterID = " . $objDB->quote($this->_intRPGCharacterID) . "
						ORDER BY intClassLevel, intClassExperience DESC";
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrClasses[$arrRow['intClassID']] = new RPGClass($arrRow['intClassID'], $this->_intRPGCharacterID);
			if($arrRow['blnCurrentClass']){
				$this->_intCurrentClassID = $arrRow['intClassID'];
			}
		}
	}
	
	public function addToClassList($intClassID){
		if(!isset($this->_arrClasses[$intClassID])){
			$this->_arrClasses[$intClassID] = new RPGClass($intClassID, $this->_intRPGCharacterID, false);
			$this->_arrClasses[$intClassID]->addClass();
		}
	}
	
	public function getClassList(){
		return $this->_arrClasses;
	}
	
	public function getCurrentClass(){
		if($this->_intCurrentClassID != NULL){
			return $this->_arrClasses[$this->_intCurrentClassID];
		}
		else{
			return false;
		}
	}
	
	public function isCurrentClass($intClassID){
		return ($intClassID == $this->_intCurrentClassID);
	}
	
	public function disableCurrentClass(){
		$this->_arrClasses[$this->_intCurrentClassID]->setCurrentClass(0);
		$this->_intCurrentClassID = NULL;
	}
	
	public function hasClass($intClassID){
		return (($this->_arrClasses[$intClassID] != null) ? true : false);
	}
	
	public function setCurrentClass($intCurrentClassID){
		if($this->_intCurrentClassID != null){
			$this->_arrClasses[$this->_intCurrentClassID]->setCurrentClass(0);
			$this->_arrClasses[$this->_intCurrentClassID]->saveClass();
		}
		$this->_intCurrentClassID = $intCurrentClassID;
		$this->_arrClasses[$intCurrentClassID]->setCurrentClass(1);
		$this->_arrClasses[$intCurrentClassID]->saveClass();
	}
	
	public function gainExperience($intExpGain){
		if($this->_intCurrentClassID != null){
			$this->_arrClasses[$this->_intCurrentClassID]->gainExperience($intExpGain);
		}
	}

}

?>