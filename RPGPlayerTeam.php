<?php

	class RPGPlayerTeam{
		
		private $_objPlayer;
		private $_objPartyOne;
		private $_objPartyTwo;
		
		public function __construct($objPlayer = null, $objPartyOne = null, $objPartyTwo = null){
			$this->_objPlayer = $objPlayer;
			$this->_objPartyOne = $objPartyOne;
			$this->_objPartyTwo = $objPartyTwo;
		}
		
		public function getPlayer(){
			return $this->_objPlayer;
		}
		
		public function setPlayer($objPlayer){
			$this->_objPlayer = $objPlayer;
		}
		
		public function getPartyOne(){
			return $this->_objPartyOne;
		}
		
		public function setPartyOne($objPartyOne){
			$this->_objPartyOne = $objPartyOne;
		}
		
		public function getPartyTwo(){
			return $this->_objPartyTwo;
		}
		
		public function setPartyTwo($objPartyTwo){
			$this->_objPartyTwo = $objPartyTwo;
		}
		
		public function loadActiveSkillList(){
			if($this->_objPartyOne != null){
				$this->_objPartyOne->loadActiveSkillList();
			}
			if($this->_objPartyTwo != null){
				$this->_objPartyTwo->loadActiveSkillList();
			}
		}
		
		public function isAnyDead(){
			if($this->_objPlayer->isDead() || ($this->_objPartyOne != null && $this->_objPartyOne->isDead()) || ($this->_objPartyTwo != null && $this->_objPartyTwo->isDead())){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function allDead(){
			if($this->_objPlayer->isDead() && ($this->_objPartyOne == null || $this->_objPartyOne->isDead()) && ($this->_objPartyTwo == null || $this->_objPartyTwo->isDead())){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function hasStatusEffect($strStatusEffectName){
			if($this->_objPlayer->hasStatusEffect($strStatusEffectName) || ($this->_objPartyOne != null && $this->_objPartyOne->hasStatusEffect($strStatusEffectName)) || ($this->_objPartyTwo != null && $this->_objPartyTwo->hasStatusEffect($strStatusEffectName))){
				return true;
			}
			else{
				return false;
			}
		}
		
		public function gainExperience($intAmount){
			$this->_objPlayer->gainExperience($intAmount);
			if($this->_objPartyOne != null){
				$this->_objPartyOne->gainExperience($intAmount);
				$this->_objPartyOne->save();
			}
			if($this->_objPartyTwo != null){
				$this->_objPartyTwo->gainExperience($intAmount);
				$this->_objPartyTwo->save();
			}
		}
		
		public function takeDamage($intAmount){
			$this->_objPlayer->takeDamage($intAmount);
			if($this->_objPartyOne != null){
				$this->_objPartyOne->takeDamage($intAmount);
			}
			if($this->_objPartyTwo != null){
				$this->_objPartyTwo->takeDamage($intAmount);
			}
		}
		
	}

?>