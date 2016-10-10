<?php

class AlwaysAttack{
	
	private $_objNPC;
	private $_objPlayer;
	private $_objLeader;
	private $_objEnemy1;
	private $_objEnemy2;
	private $_objParty1;
	private $_objParty2;
	private $_objTarget;
	
	public function AlwaysAttack($objNPC, $objPlayer, $objLeader, $objEnemy1 = null, $objEnemy2 = null, $objParty1 = null, $objParty2 = null){
		$this->_objNPC = $objNPC;
		$this->_objPlayer = $objPlayer;
		$this->_objLeader = $objLeader;
		$this->_objEnemy1 = $objEnemy1;
		$this->_objEnemy2 = $objEnemy2;
		$this->_objParty1 = $objParty1;
		$this->_objParty2 = $objParty2;
	}
	
	public function determineActionEnemy(){
		if(!$this->_objPlayer->isDead()){
			$this->_objTarget = $this->_objPlayer;
		}
		else if(!$this->_objParty1->isDead()){
			$this->_objTarget = $this->_objParty1;
		}
		else{
			$this->_objTarget = $this->_objParty2;
		}
		return "Attack";
	}
	
	public function determineActionParty(){
		if(!$this->_objLeader->isDead()){
			$this->_objTarget = $this->_objLeader;
		}
		else if(!$this->_objEnemy1->isDead()){
			$this->_objTarget = $this->_objEnemy1;
		}
		else{
			$this->_objTarget = $this->_objEnemy2;
		}
		return "Attack";
	}
	
	public function getTarget(){
		return $this->_objTarget;
	}
}

?>