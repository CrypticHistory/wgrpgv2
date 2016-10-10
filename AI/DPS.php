<?php

class DPS{
	
	private $_objNPC;
	private $_objPlayer;
	private $_objLeader;
	private $_objEnemy1;
	private $_objEnemy2;
	private $_objParty1;
	private $_objParty2;
	private $_objTarget;
	
	public function DPS($objNPC, $objPlayer, $objLeader, $objEnemy1 = null, $objEnemy2 = null, $objParty1 = null, $objParty2 = null){
		$this->_objNPC = $objNPC;
		$this->_objPlayer = $objPlayer;
		$this->_objLeader = $objLeader;
		$this->_objEnemy1 = $objEnemy1;
		$this->_objEnemy2 = $objEnemy2;
		$this->_objParty1 = $objParty1;
		$this->_objParty2 = $objParty2;
	}
	
	public function determineActionEnemy(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		
		if(!$this->_objPlayer->isDead()){
			$this->_objTarget = $this->_objPlayer;
		}
		else if(!$this->_objParty1->isDead()){
			$this->_objTarget = $this->_objParty1;
		}
		else{
			$this->_objTarget = $this->_objParty2;
		}
		
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
	
	public function determineActionParty(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		
		if(!$this->_objLeader->isDead()){
			$this->_objTarget = $this->_objLeader;
		}
		else if(!$this->_objEnemy1->isDead()){
			$this->_objTarget = $this->_objEnemy1;
		}
		else{
			$this->_objTarget = $this->_objEnemy2;
		}
		
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
	
	public function getTarget(){
		return $this->_objTarget;
	}
}

?>