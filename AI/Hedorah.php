<?php

class Hedorah{
	
	private $_objNPC;
	private $_objEnemyTeam;
	private $_objPlayerTeam;
	private $_objTarget;
	
	public function __construct($objNPC, $objEnemyTeam, $objPlayerTeam){
		$this->_objNPC = $objNPC;
		$this->_objEnemyTeam = $objEnemyTeam;
		$this->_objPlayerTeam = $objPlayerTeam;
	}
	
	public function determineActionEnemy(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		$arrRandom = array(0, 1, 2);
		
		if($this->_objPlayerTeam->getPlayer()->isDead()){
			unset($arrRandom[0]);
		}
		if($this->_objPlayerTeam->getPartyOne() == null || $this->_objPlayerTeam->getPartyOne()->isDead()){
			unset($arrRandom[1]);
		}
		if($this->_objPlayerTeam->getPartyTwo() == null || $this->_objPlayerTeam->getPartyTwo()->isDead()){
			unset($arrRandom[2]);
		}
		
		$intRandTarget = array_rand($arrRandom);
		
		if($intRandTarget == 0){
			$this->_objTarget = $this->_objPlayerTeam->getPlayer();
		}
		else if($intRandTarget == 1){
			$this->_objTarget = $this->_objPlayerTeam->getPartyOne();
		}
		else{
			$this->_objTarget = $this->_objPlayerTeam->getPartyTwo();
		}
		
		if($this->_objNPC->getActiveSkillList('Damage')){
			
			foreach($this->_objNPC->getActiveSkillList('Damage') as $key => $objSkill){
				if($objSkill->getCurrentCooldown() == 0 && !$blnPickedSkill){
					$udfCurrentAction = "Skill" . $objSkill->getClassName();
					$this->_objNPC->getActiveSkillList('Damage')[$key]->resetCooldown();
					$blnPickedSkill = true;
					if($objSkill->getTargetCount() == '3'){
						$this->_objTarget = $this->_objPlayerTeam;
					}
					$blnFoundSkill = true;
				}
				else{
					$this->_objNPC->getActiveSkillList('Damage')[$key]->decrementCooldown();
					$blnFoundSkill = false;
				}
			}
			
		}
		else{
			$blnFoundSkill = false;
		}
		
		if($this->_objNPC->getActiveSkillList('Debuff')){
		
			foreach($this->_objNPC->getActiveSkillList('Debuff') as $key => $objSkill){
				if($objSkill->getCurrentCooldown() == 0 && !$blnPickedSkill){
					$udfCurrentAction = "Skill" . $objSkill->getClassName();
					$this->_objNPC->getActiveSkillList('Debuff')[$key]->resetCooldown();
					$blnPickedSkill = true;
					if($objSkill->getTargetCount() == '3'){
						$this->_objTarget = $this->_objPlayerTeam;
					}
				}
				else{
					$this->_objNPC->getActiveSkillList('Debuff')[$key]->decrementCooldown();
				}
			}
		
		}
		
		return $udfCurrentAction;
	}
	
	public function determineActionPlayer(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		
		if(!$this->_objEnemyTeam->getLeader()->isDead()){
			$this->_objTarget = $this->_objEnemyTeam->getLeader();
		}
		else if(!$this->_objEnemyTeam->getEnemyOne()->isDead()){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyOne();
		}
		else{
			$this->_objTarget = $this->_objEnemyTeam->getEnemyTwo();
		}
		
		foreach($this->_objNPC->getActiveSkillList('Debuff') as $key => $objSkill){
			if($objSkill->getCurrentCooldown() == 0 && !$blnPickedSkill){
				$udfCurrentAction = "Skill" . $objSkill->getClassName();
				$this->_objNPC->getActiveSkillList('Debuff')[$key]->resetCooldown();
				$blnPickedSkill = true;
				if($objSkill->getTargetCount() == '3'){
					$this->_objTarget = $this->_objEnemyTeam;
				}
			}
			else{
				$this->_objNPC->getActiveSkillList('Debuff')[$key]->decrementCooldown();
			}
		}
		
		return $udfCurrentAction;
	}
	
	public function getTarget(){
		return $this->_objTarget;
	}
}

?>