<?php

class Rylie{
	
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
		
		$objStealth = $this->_objNPC->getActiveSkill("Buff", "Stealth");
		$objDecoy = $this->_objNPC->getActiveSkill("Debuff", "Decoy");
		$objBackstab = $this->_objNPC->getActiveSkill("Damage", "Backstab");
		
		$blnPickedSkill = false;
		
		if($this->_objNPC->hasStatusEffect("Stealth")){
			$udfCurrentAction = "SkillBackstab";
			$this->_objNPC->getActiveSkill("Damage", "Backstab")->resetCooldown();
			$blnPickedSkill = true;
		}
		else if($objStealth->getCurrentCooldown() == 0 && !$blnPickedSkill){
			$udfCurrentAction = "SkillStealth";
			$this->_objNPC->getActiveSkill("Buff", "Stealth")->resetCooldown();
			$blnPickedSkill = true;
		}
		else if($objDecoy->getCurrentCooldown() == 0 && !$blnPickedSkill){
			$udfCurrentAction = "SkillDecoy";
			$this->_objNPC->getActiveSkill("Debuff", "Decoy")->resetCooldown();
			$blnPickedSkill = true;
		}
		
		$this->_objNPC->getActiveSkill("Damage", "Backstab")->decrementCooldown();
		$this->_objNPC->getActiveSkill("Buff", "Stealth")->decrementCooldown();
		$this->_objNPC->getActiveSkill("Debuff", "Decoy")->decrementCooldown();
		
		return $udfCurrentAction;
	}
	
	public function determineActionParty(){
		$udfCurrentAction = "Attack";
		$blnPickedSkill = false;
		
		$arrRandom = array(0, 1, 2);
		
		if($this->_objEnemyTeam->getLeader()->isDead()){
			unset($arrRandom[0]);
		}
		if($this->_objEnemyTeam->getEnemyOne() == null || $this->_objEnemyTeam->getEnemyOne()->isDead()){
			unset($arrRandom[1]);
		}
		if($this->_objEnemyTeam->getEnemyTwo() == null || $this->_objEnemyTeam->getEnemyTwo()->isDead()){
			unset($arrRandom[2]);
		}
		
		$intRandTarget = array_rand($arrRandom);

		if($intRandTarget == 0){
			$this->_objTarget = $this->_objEnemyTeam->getLeader();
		}
		else if($intRandTarget == 1){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyOne();
		}
		else{
			$this->_objTarget = $this->_objEnemyTeam->getEnemyTwo();
		}
		
		$objStealth = $this->_objNPC->getActiveSkill("Buff", "Stealth");
		$objDecoy = $this->_objNPC->getActiveSkill("Debuff", "Decoy");
		$objBackstab = $this->_objNPC->getActiveSkill("Damage", "Backstab");
		
		$blnPickedSkill = false;
		
		if($this->_objNPC->hasStatusEffect("Stealth")){
			$udfCurrentAction = "SkillBackstab";
			$this->_objNPC->getActiveSkill("Damage", "Backstab")->resetCooldown();
			$blnPickedSkill = true;
		}
		else if($objStealth->getCurrentCooldown() == 0 && !$blnPickedSkill){
			$udfCurrentAction = "SkillStealth";
			$this->_objNPC->getActiveSkill("Buff", "Stealth")->resetCooldown();
			$blnPickedSkill = true;
		}
		else if($objDecoy->getCurrentCooldown() == 0 && !$blnPickedSkill){
			$udfCurrentAction = "SkillDecoy";
			$this->_objNPC->getActiveSkill("Debuff", "Decoy")->resetCooldown();
			$blnPickedSkill = true;
		}
		else{
			$udfCurrentAction = "Attack";
		}
		
		$this->_objNPC->getActiveSkill("Damage", "Backstab")->decrementCooldown();
		$this->_objNPC->getActiveSkill("Buff", "Stealth")->decrementCooldown();
		$this->_objNPC->getActiveSkill("Debuff", "Decoy")->decrementCooldown();
		
		return $udfCurrentAction;
	}
	
	public function getTarget(){
		return $this->_objTarget;
	}
}

?>