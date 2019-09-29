<?php

class AlwaysAttack{
	
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