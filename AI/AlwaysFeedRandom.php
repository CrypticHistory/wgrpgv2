<?php

class AlwaysFeedRandom{
	
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
		
		$arrRandom = array(0, 1, 2, 3, 4, 5);
		
		if($this->_objPlayerTeam->getPlayer()->isDead()){
			unset($arrRandom[0]);
		}
		if($this->_objPlayerTeam->getPartyOne() == null || $this->_objPlayerTeam->getPartyOne()->isDead()){
			unset($arrRandom[1]);
		}
		if($this->_objPlayerTeam->getPartyTwo() == null || $this->_objPlayerTeam->getPartyTwo()->isDead()){
			unset($arrRandom[2]);
		}
		if($this->_objEnemyTeam->getLeader()->isDead()){
			unset($arrRandom[3]);
		}
		if($this->_objEnemyTeam->getEnemyOne() == null || $this->_objEnemyTeam->getEnemyOne()->isDead()){
			unset($arrRandom[4]);
		}
		if($this->_objEnemyTeam->getEnemyTwo() == null || $this->_objEnemyTeam->getEnemyTwo()->isDead()){
			unset($arrRandom[5]);
		}
		
		if($this->_objEnemyTeam->getEnemyOne() != null && ($this->_objNPC->getNPCName() == $this->_objEnemyTeam->getEnemyOne()->getNPCName())){
			unset($arrRandom[4]);
		}
		else if($this->_objEnemyTeam->getEnemyTwo() != null && ($this->_objNPC->getNPCName() == $this->_objEnemyTeam->getEnemyTwo()->getNPCName())){
			unset($arrRandom[5]);
		}
		
		$intRandTarget = array_rand($arrRandom);
		
		if($intRandTarget == 0){
			$this->_objTarget = $this->_objPlayerTeam->getPlayer();
		}
		else if($intRandTarget == 1){
			$this->_objTarget = $this->_objPlayerTeam->getPartyOne();
		}
		else if($intRandTarget == 2){
			$this->_objTarget = $this->_objPlayerTeam->getPartyTwo();
		}
		else if($intRandTarget == 3){
			$this->_objTarget = $this->_objEnemyTeam->getLeader();
		}
		else if($intRandTarget == 4){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyOne();
		}
		else if($intRandTarget == 5){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyTwo();
		}
		
		// todo: multiple feed skills?
		$arrSkills = $this->_objNPC->getSkillList('Feed');
		$objSkill = $arrSkills[0];
		$strClassName = $objSkill->getClassName();
		
		return "Skill" . $strClassName;
	}
	
	public function determineActionParty(){
		
		$arrRandom = array(0, 1, 2, 3, 4, 5);
		
		if($this->_objPlayerTeam->getPlayer()->isDead()){
			unset($arrRandom[0]);
		}
		if($this->_objPlayerTeam->getPartyOne() == null || $this->_objPlayerTeam->getPartyOne()->isDead()){
			unset($arrRandom[1]);
		}
		if($this->_objPlayerTeam->getPartyTwo() == null || $this->_objPlayerTeam->getPartyTwo()->isDead()){
			unset($arrRandom[2]);
		}
		if($this->_objEnemyTeam->getLeader()->isDead()){
			unset($arrRandom[3]);
		}
		if($this->_objEnemyTeam->getEnemyOne() == null || $this->_objEnemyTeam->getEnemyOne()->isDead()){
			unset($arrRandom[4]);
		}
		if($this->_objEnemyTeam->getEnemyTwo() == null || $this->_objEnemyTeam->getEnemyTwo()->isDead()){
			unset($arrRandom[5]);
		}
		
		if($this->_objNPC->getNPCName() == $this->_objPlayerTeam->getPartyOne()->getNPCName()){
			unset($arrRandom[1]);
		}
		else if($this->_objNPC->getNPCName() == $this->_objPlayerTeam->getPartyTwo()->getNPCName()){
			unset($arrRandom[2]);
		}
		
		$intRandTarget = array_rand($arrRandom);
		
		if($intRandTarget == 0){
			$this->_objTarget = $this->_objPlayerTeam->getPlayer();
		}
		else if($intRandTarget == 1){
			$this->_objTarget = $this->_objPlayerTeam->getPartyOne();
		}
		else if($intRandTarget == 2){
			$this->_objTarget = $this->_objPlayerTeam->getPartyTwo();
		}
		else if($intRandTarget == 3){
			$this->_objTarget = $this->_objEnemyTeam->getLeader();
		}
		else if($intRandTarget == 4){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyOne();
		}
		else if($intRandTarget == 5){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyTwo();
		}
		
		// todo: multiple feed skills?
		$arrSkills = $this->_objNPC->getSkillList('Feed');
		$objSkill = $arrSkills[0];
		$strClassName = $objSkill->getClassName();
		
		return "Skill" . $strClassName;
	}
	
	public function getTarget(){
		return $this->_objTarget;
	}
}

?>