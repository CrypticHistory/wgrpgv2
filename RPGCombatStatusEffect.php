<?php

class RPGCombatStatusEffect{

	private $_objGiver;
	private $_objReceiver;
	private $_intRemainingTurns;
	private $_strEntityName;
	
	public function __construct($objGiver, $objReceiver, $intRemainingTurns, $strEntityName){
		$this->_objGiver = $objGiver;
		$this->_objReceiver = $objReceiver;
		$this->_intRemainingTurns = $intRemainingTurns;
		$this->_strEntityName = $strEntityName;
	}
	
	public function getGiver(){
		return $this->_objGiver;
	}
	
	public function getReceiver(){
		return $this->_objReceiver;
	}

	public function getRemainingTurns(){
		return $this->_intRemainingTurns;
	}
	
	public function getEntityName(){
		return $this->_strEntityName;
	}
	
	public function tick(){
		$this->_intRemainingTurns--;
	}
	
	public function endEffect(){
		$this->_intRemainingTurns = 0;
	}
	
	public function isTimeUp(){
		return (($this->_intRemainingTurns == 0) ? true : false);
	}
}

?>