<?php

class AlwaysFeed{
	
	private $_objNPC;
	private $_objEnemyTeam;
	private $_objPlayerTeam;
	private $_objTarget;
	
	public function AlwaysFeed($objNPC, $objEnemyTeam, $objPlayerTeam){
		$this->_objNPC = $objNPC;
		$this->_objEnemyTeam = $objEnemyTeam;
		$this->_objPlayerTeam = $objPlayerTeam;
	}
	
	public function determineActionEnemy(){
		
		if(!$this->_objPlayerTeam->getPlayer()->isDead()){
			$this->_objTarget = $this->_objPlayerTeam->getPlayer();
		}
		else if(!$this->_objPlayerTeam->getPartyOne()->isDead()){
			$this->_objTarget = $this->_objPlayerTeam->getPartyOne();
		}
		else{
			$this->_objTarget = $this->_objPlayerTeam->getPartyTwo();
		}
		
		// todo: multiple feed skills?
		$arrSkills = $this->_objNPC->getSkillList('Feed');
		$objSkill = $arrSkills[0];
		$strClassName = $objSkill->getClassName();
		
		return "Skill" . $strClassName;
	}
	
	public function determineActionParty(){
		
		if(!$this->_objEnemyTeam->getLeader()->isDead()){
			$this->_objTarget = $this->_objEnemyTeam->getLeader();
		}
		else if(!$this->_objEnemyTeam->getEnemyOne()->isDead()){
			$this->_objTarget = $this->_objEnemyTeam->getEnemyOne();
		}
		else{
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