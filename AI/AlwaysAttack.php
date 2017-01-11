<?php

class AlwaysAttack{
	
	private $_objNPC;
	private $_objEnemyTeam;
	private $_objPlayerTeam;
	private $_objTarget;
	
	public function AlwaysAttack($objNPC, $objEnemyTeam, $objPlayerTeam){
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
		return "Attack";
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
		return "Attack";
	}
	
	public function getTarget(){
		return $this->_objTarget;
	}
}

?>