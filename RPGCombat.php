<?php

	include_once "RPGCombatHelper.php";

	class RPGCombat{
	
		private $_intTurn;
		private $_arrCombatMessage;
		private $_intCurrPlayerWait;
		private $_intCurrEnemyWait;
		private $_objPlayer;
		private $_objEnemy;
		private $_strFirstTurn; // who gets to attack first
		private $_strCombatState; // in progress, victory, defeat, fled
		private $_strNextTurn; // who attacks next
		private $_strPrevTurn; // who attacked last
		private $_blnEnemyConsecutiveAttacks = false; // to output exhausted message
	
		public function RPGCombat($objPlayer, $objEnemy, $strFirstTurn){
			$this->_intTurn = 1;
			$this->_objPlayer = $objPlayer;
			$this->_objEnemy = $objEnemy;
			$this->_objEnemy->loadActiveSkillList();
			$this->_strFirstTurn = $strFirstTurn;
			$this->_arrCombatMessage = array();
			$this->_arrCombatMessage["Combat"] = array();
			$this->_arrCombatMessage["System"] = array();
		}
	
		public function initiateCombat(){
			$this->_arrCombatMessage["Combat"][1]["Player"] = "";
			$this->_arrCombatMessage["Combat"][1]["Enemy"] = "";
			$this->_strCombatState = 'In Progress';
			$this->_intCurrPlayerWait = $this->_objPlayer->getWaitTime('Standard');
			$this->_intCurrEnemyWait = $this->_objEnemy->getWaitTime('Standard');
			if($this->_strFirstTurn == 'Player'){
				$this->_strNextTurn = 'Player';
				$this->_strPrevTurn = 'Player';
			}
			else{
				$this->_strNextTurn = 'Opponent';
				$this->_strPrevTurn = 'Opponent';
			}
		}
		
		public function determineNextTurn(){
			
			// check if anyone died
			if($this->_objEnemy->isDead()){
				$this->_strCombatState = 'Victory';
				
				// death message
				if($this->_objEnemy->getEndText() != ''){
					$this->_arrCombatMessage["System"][] = $this->_objEnemy->getEndText();
				}
				else{
					$this->_arrCombatMessage["System"][] = $this->_objEnemy->getNPCName() . ' collapses to the ground with injury.';
				}
				
				// exp gain
				$intExpGain = $this->_objEnemy->getExperienceGiven();
				$this->_objPlayer->gainExperience($intExpGain);
				$this->_arrCombatMessage["System"][] = 'You gained <b>' . $intExpGain . ' experience</b> from the battle.';
				
				// receive money
				if($this->_objEnemy->getGoldDropMax() != 0){
					$intMoneyGain = mt_rand($this->_objEnemy->getGoldDropMin(), $this->_objEnemy->getGoldDropMax());
					$this->_objPlayer->receiveGold($intMoneyGain);
					$this->_arrCombatMessage["System"][] = 'You picked up <b>' . $intMoneyGain . ' gold</b> from the enemy\'s remains.';
				}
				
				// roll for loot
				$arrDrops = $this->_objEnemy->getRandomDrops();
				$intCounter = 1;
				foreach($arrDrops as $key => $value){
					$this->_objPlayer->giveItem($key);
					$this->_arrCombatMessage["System"][] = 'Loot received: ' . $value . '<br/>';
					$intCounter++;
				}
				
			}
			else if($this->_objPlayer->isDead()){
				$this->_strCombatState = 'Defeat';
				if($this->_objEnemy->getDefeatText() != ''){
					$this->_arrCombatMessage["System"][] = $this->_objEnemy->getDefeatText();
				}
				else{
					$this->_arrCombatMessage["System"][] = 'You collapse to the ground in injury. You are defeated.';
				}
			}
			else{
				$this->_intTurn++;
				$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "";
				$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = "";
				// determine the next turn using AGI formula
				if($this->_intCurrPlayerWait <= $this->_intCurrEnemyWait){
					//status effect check
					if($this->_objPlayer->hasStatusEffect('Hypnotized')){
						//todo: random skills or action controlled by NPC?
						$this->playerFriendlyFire();
						$this->_objPlayer->tickStatusEffects();
						$this->determineNextTurn();
					}
					else{
						$this->_strNextTurn = 'Player';
					}
				}
				else{
					$this->_strNextTurn = 'Opponent';
					// consecutive opponent attacks means you were too exhausted to move
					if($this->_strPrevTurn == 'Opponent' && $this->_strNextTurn == 'Opponent'){
						$strMessage = "You stop to catch your breath, too exhausted to move. ";
						if($this->_objPlayer->getBMI() > 40 && $this->_objPlayer->getBMI() <= 60){
							$strMessage .= "Clearly the excess pounds have really done a number on your stamina.";
						}
						else if($this->_objPlayer->getBMI() > 60 && $this->_objPlayer->getBMI() <= 80){
							$strMessage .= "Your belly heaves up and down with each deep breath you take. Fighting with this much extra weight puts you at a massive disadvantage on the battlefield.";
						}
						else if($this->_objPlayer->getBMI() > 80){
							$strMessage .= "Despite your best efforts, maneuvering your oversized body in combat has proven to be too much for you. As your enemy prepares to charge at you again, you wonder if your sluggishness on the battlefield may lead to your demise.";
						}
						$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = $strMessage;
					}
				}
			}
			
		}
		
		public function playerAttack(){
			$this->_strPrevTurn = "Player";
			$this->_intCurrPlayerWait += $this->_objPlayer->getWaitTime('Standard');
			
			$objRPGCombatHelper = new RPGCombatHelper();
			
			$intDamage = $this->_objEnemy->takeDamage($objRPGCombatHelper->calculateDamage($this->_objPlayer, $this->_objEnemy));
			
			if(!$objRPGCombatHelper->getEvaded()){
				if($objRPGCombatHelper->getBlocked() && $objRPGCombatHelper->getCrit()){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You land a critical blow on " . $this->_objEnemy->getNPCName() . " but they block the attack, sustaining " . $intDamage . " damage.";
				}
				else if($objRPGCombatHelper->getBlocked() && !$objRPGCombatHelper->getCrit()){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You attack " . $this->_objEnemy->getNPCName() . " but they successfully block the attack, sustaining " . $intDamage . " damage.";
				}
				else if(!$objRPGCombatHelper->getBlocked() && $objRPGCombatHelper->getCrit()){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You land a critical blow on " . $this->_objEnemy->getNPCName() . ", dealing " . $intDamage . " damage.";
				}
				else{
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You attack " . $this->_objEnemy->getNPCName() . " for " . $intDamage . " damage.";
				}
			}
			else{
				$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You attack " . $this->_objEnemy->getNPCName() . " but your attack is evaded.";
			}
		}
		
		public function playerSkill($intSkillID){
			// todo
		}
		
		public function playerWait(){
			$this->_strPrevTurn = "Player";
			$this->_intCurrPlayerWait += $this->_objPlayer->getWaitTime('Standard');
			$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You stand still, doing absolutely nothing...";
		}
		
		public function playerFlee(){
			$intPlayerFleeRoll = mt_rand(1, $this->_objPlayer->getModifiedFleeRate());
			
			if($intPlayerFleeRoll >= $this->_objEnemy->getModifiedFleeResistance()){
				if($this->_objEnemy->getFleeText() != ''){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = $this->_objEnemy->getFleeText();
				}
				else{
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = 'You fled from the battle.';
				}
				$this->_strCombatState = 'Fled';	
			}
			else{
				$this->_strPrevTurn = "Player";
				$this->_intCurrPlayerWait += $this->_objPlayer->getWaitTime('Standard');
				if($this->_objEnemy->getFailFleeText() != ''){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = $this->_objEnemy->getFailFleeText();
				}
				else{
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You attempt to flee but fail, opening yourself up to an attack.";
				}
			}
		}
		
		public function playerFriendlyFire(){
			$this->_strPrevTurn = "Player";
			$this->_intCurrPlayerWait += $this->_objPlayer->getWaitTime('Standard');
			
			if($this->_objPlayer->getEquippedWeapon()->getStatDamage() === null || $this->_objPlayer->getEquippedWeapon()->getStatDamage() == 'Strength'){
				$intDamage = $this->_objPlayer->takeDamage(round($this->_objPlayer->getModifiedDamage()));
			}
			else if($this->_objPlayer->getEquippedWeapon()->getStatDamage() == 'Intelligence'){
				$intDamage = $this->_objPlayer->takeDamage(round($this->_objPlayer->getModifiedMagicDamage()));	
			}
			$this->_arrCombatMessage["Combat"][$this->_intTurn]["Player"] = "You attack yourself for " . $intDamage . " damage under hypnosis.";
		}
		
		public function enemyTurn(){
			// load enemy AI
			$strAIName = $this->_objEnemy->getAIName();
			include_once "AI/" . $strAIName . ".php";
			$objAI = new $strAIName($this->_objEnemy);
			$strAction = $objAI->determineAction();
			
			if($strAction == 'Attack'){
				$this->enemyAttack();
			}
			else if(strpos($strAction, 'Skill') !== false){
				include_once "Skills/" . $strAction . ".php";
				$objSkill = new $strAction();
				$intWaitTime = $objSkill->getWaitTime();
				$this->_strPrevTurn = "Opponent";
				$this->_intCurrEnemyWait += $this->_objEnemy->getWaitTime($intWaitTime);
				$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $objSkill->castedByNPC($this->_objPlayer, $this->_objEnemy);
			}
			else{
				$this->enemyWait();
			}
		}
		
		public function enemyAttack(){
			$this->_strPrevTurn = "Opponent";
			$this->_intCurrEnemyWait += $this->_objEnemy->getWaitTime('Standard');
			
			$objRPGCombatHelper = new RPGCombatHelper();

			$intDamage = $this->_objPlayer->takeDamage($objRPGCombatHelper->calculateDamage($this->_objEnemy, $this->_objPlayer));
			
			if(!$objRPGCombatHelper->getEvaded()){
				if($objRPGCombatHelper->getBlocked() && $objRPGCombatHelper->getCrit()){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $this->_objEnemy->getNPCName() . " lands a critical blow on you but you block it, sustaining " . $intDamage . " damage.";
				}
				else if($objRPGCombatHelper->getBlocked() && !$objRPGCombatHelper->getCrit()){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $this->_objEnemy->getNPCName() . " attacks you and you block the attack, sustaining " . $intDamage . " damage.";
				}
				else if(!$objRPGCombatHelper->getBlocked() && $objRPGCombatHelper->getCrit()){
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $this->_objEnemy->getNPCName() . " lands a critical blow on you, dealing " . $intDamage . " damage.";
				}
				else{
					$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $this->_objEnemy->getNPCName() . " attacks you for " . $intDamage . " damage.";
				}
			}
			else{
				$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $this->_objEnemy->getNPCName() . " attacks you but you successfully evade the attack.";
			}
		}
		
		public function enemyWait(){
			$this->_strPrevTurn = "Opponent";
			$this->_intCurrEnemyWait += $this->_objEnemy->getWaitTime('Standard');
			$this->_arrCombatMessage["Combat"][$this->_intTurn]["Enemy"] = $this->_objEnemy->getNPCName() . " stands still, doing absolutely nothing...";
		}
		
		public function getPlayer(){
			return $this->_objPlayer;
		}
		
		public function getEnemy(){
			return $this->_objEnemy;
		}
		
		public function getCombatMessage($strIndex){
			return $this->_arrCombatMessage[$strIndex];
		}
		
		public function getCombatState(){
			return $this->_strCombatState;
		}
		
		public function getFirstTurn(){
			return $this->_strFirstTurn;
		}
		
		public function getNextTurn(){
			return $this->_strNextTurn;
		}
		
		public function getTurnCount(){
			return $this->_intTurn;
		}
		
	}

?>