<?php

require_once "Database.php";
include_once "RPGSkill.php";

class RPGSkillList{

	private $_arrSkills;
	
	public function RPGSkillList(){
		
	}
	
	public function loadSkillList($intClassID, $intClassLevel){
		$objDB = new Database();
		$strSQL = "SELECT * FROM tblclassskillxr
					WHERE intClassID = " . $objDB->quote($intClassID) . "
						AND intRequiredClassLevel <= " . $objDB->quote($intClassLevel);
		$rsResult = $objDB->query($strSQL);
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$this->_arrSkills[$arrRow['intSkillID']] = new RPGSkill($arrRow['intSkillID']);
		}
	}
	
	public function addToSkillList($intSkillID){
		$this->_arrSkills[$intSkillID] = new RPGSkill($intSkillID);
	}
	
	public function getSkillList(){
		return $this->_arrSkills;
	}
	
	public function resetAllCooldowns(){
		foreach($this->_arrSkills as $intSkillID => $objSkill){
			$objSkill->setCurrentCooldown($objSkill->getPreCooldown());
		}
	}
	
	public function decrementCooldowns(){
		foreach($this->_arrSkills as $intSkillID => $objSkill){
			$objSkill->decrementCooldown();
		}
	}
	
	public function removeCooldown($intSkillID){
		$this->_arrSkills[$intSkillID]->removeCooldown();
	}
	
	public function applyCooldown($intSkillID){
		$this->_arrSkills[$intSkillID]->applyCooldown();
	}
	
	public function isOffCooldown($intSkillID){
		if($this->_arrSkills[$intSkillID]->isOffCooldown()){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function hasSkill($intSkillID){
		if(isset($this->_arrSkills[$intSkillID])){
			return true;
		}
		else{
			return false;
		}
	}

}

?>