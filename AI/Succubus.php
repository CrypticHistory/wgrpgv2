<?php

class Succubus{
	
	private $_objNPC;
	
	public function Succubus($objNPC){
		$this->_objNPC = $objNPC;
	}
	
	public function determineAction(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		
		foreach($this->_objNPC->getActiveSkillList('Debuff') as $key => $objSkill){
			if($objSkill->getCurrentCooldown() == 0 && !$blnPickedSkill){
				$udfCurrentAction = "Skill" . $objSkill->getClassName();
				$this->_objNPC->getActiveSkillList('Debuff')[$key]->resetCooldown();
				$blnPickedSkill = true;
			}
			else{
				$this->_objNPC->getActiveSkillList('Debuff')[$key]->decrementCooldown();
			}
		}
		
		return $udfCurrentAction;
	}
}

?>