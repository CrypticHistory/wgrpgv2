<?php

class DPS{
	
	private $_objNPC;
	
	public function DPS($objNPC){
		$this->_objNPC = $objNPC;
	}
	
	public function determineAction(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		
		foreach($this->_objNPC->getActiveSkillList('Damage') as $key => $objSkill){
			if($objSkill->getCurrentCooldown() == 0 && !$blnPickedSkill){
				$udfCurrentAction = "Skill" . $objSkill->getClassName();
				$this->_objNPC->getActiveSkillList('Damage')[$key]->resetCooldown();
				$blnPickedSkill = true;
			}
			else{
				$this->_objNPC->getActiveSkillList('Damage')[$key]->decrementCooldown();
			}
		}
		
		return $udfCurrentAction;
	}
}

?>