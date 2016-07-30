<?php

require_once "Database.php";

class RPGClass{

	private $_intClassID;
	private $_strClassName;
	private $_txtClassDesc;
	private $_intClassLevel;
	private $_intClassExperience;
	
	public function RPGClass($intClassID = null){
		if($intClassID){
			$this->loadClassInfo($intClassID);
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
				$arrClassInfo['txtClassDesc'] = $arrRow['txtClassDesc'];
			}
		$this->populateVarFromRow($arrClassInfo);
	}
	
	public function getClassID(){
		return $this->_intClassID;
	}
	
	public function setClassID($intClassID){
		$this->_intClassID = $intClassID;
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
}
?>