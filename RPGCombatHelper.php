<?php

class RPGCombatHelper{
	
	private $_blnEvaded;
	private $_blnCrit;
	private $_blnBlocked;
	
	public function __construct(){
	
	}
	
	public function calculateEvadeRoll($objAttacker, $objDefender){
		$intAccuracyAfterEvasion = max(0, (100 + $objAttacker->getModifiedAccuracy()) - $objDefender->getModifiedEvasion());
		$intDefenderEvadeRoll = mt_rand(0, 100);
		
		// compare defender evade roll with attacker accuracy roll
		if($intDefenderEvadeRoll >= $intAccuracyAfterEvasion){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function calculateCritRoll($objAttacker, $objDefender){
		// attacker crit success roll
		$intAttackerCritRoll = mt_rand(0, $objAttacker->getModifiedCritRate());
		
		// attacker crit resist success roll
		$intDefenderCritResistRoll = mt_rand(0, $objDefender->getModifiedCritResistance());
		
		// crit roll out of 100
		$int100CritRoll = mt_rand(0, 100);
		
		// compare attacker crit roll minus defender crit resist roll out of 100
		if($intAttackerCritRoll - $intDefenderCritResistRoll >= $int100CritRoll){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function calculateCritDmg($objAttacker){
		$intAttackerCritDamageModifier = $objAttacker->getModifiedCritDamage();
		return $intAttackerCritDamageModifier;
	}
	
	public function calculateBlockRoll($objAttacker, $objDefender){
		// defender block success roll
		if($objDefender->getEquippedSecondary()->getItemType() == 'Shield'){
			$intDefenderBlockRoll = mt_rand(0, $objDefender->getModifiedBlockRate() + 10); // shield adds 10
			$intDefenderBlockedDamageModifier = 1.0 - ($objDefender->getModifiedBlock() + 0.1); // shield adds 10
		}
		else{
			$intDefenderBlockRoll = mt_rand(0, $objDefender->getModifiedBlockRate());
			$intDefenderBlockedDamageModifier = 1.0 - $objDefender->getModifiedBlock();
		}
		
		// block roll out of 100
		$int100BlockRoll = mt_rand(0, 100);
		
		// defender pierce success roll
		$intAttackerPierceRoll = mt_rand(0, $objAttacker->getModifiedPierceRate());
		
		// compare defender block roll minus attacker pierce out of 100
		if($intDefenderBlockRoll - $intAttackerPierceRoll >= $int100BlockRoll){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function calculateBlockDmg($objDefender){
		// blocked damage
		if($objDefender->getEquippedSecondary()->getItemType() == 'Shield'){
			$intDefenderBlockedDamageModifier = 1.0 - ($objDefender->getModifiedBlock() + 0.1); // shield adds 10
		}
		else{
			$intDefenderBlockedDamageModifier = 1.0 - $objDefender->getModifiedBlock();
		}
		return $intDefenderBlockedDamageModifier;
	}
	
	public function calculateAdditionalDmg($objAttacker){
		// attacker additional damage roll
		$intAttackerAdditionalDamageRoll = mt_rand(0, $objAttacker->getAdditionalDamage());
		return $intAttackerAdditionalDamageRoll;
	}

	public function calculateDamage($objAttacker, $objDefender, $dblSkillModifier = 1.0){
		// defender evade success roll
		$intDefenderEvadeRoll = mt_rand(0, $objDefender->getModifiedEvasion());
		$intAttackerAccuracyRoll = 100 + mt_rand(0, $objAttacker->getModifiedAccuracy());
		
		// compare defender evade roll with attacker accuracy roll
		if($intDefenderEvadeRoll > $intAttackerAccuracyRoll){
			$intDamage = 0;
			$this->_blnEvaded = true;
		}
		else{
			$this->_blnEvaded = false;
			
			// defender block success roll
			if($objDefender->getEquippedSecondary()->getItemType() == 'Shield'){
				$intDefenderBlockRoll = mt_rand(0, $objDefender->getModifiedBlockRate() + 10); // shield adds 10
				$intDefenderBlockedDamageModifier = 1.0 - ($objDefender->getModifiedBlock() + 0.1); // shield adds 10
			}
			else{
				$intDefenderBlockRoll = mt_rand(0, $objDefender->getModifiedBlockRate());
				$intDefenderBlockedDamageModifier = 1.0 - $objDefender->getModifiedBlock();
			}
			
			// block roll out of 100
			$int100BlockRoll = mt_rand(0, 100);
			
			// defender pierce success roll
			$intAttackerPierceRoll = mt_rand(0, $objAttacker->getModifiedPierceRate());
			
			// compare defender block roll minus attacker pierce out of 100
			if($intDefenderBlockRoll - $intAttackerPierceRoll >= $int100BlockRoll){
				$this->_blnBlocked = true;
			}
			else{
				$this->_blnBlocked = false;
				$intDefenderBlockedDamageModifier = 1.0;
			}
			
			// attacker additional damage roll
			$intAttackerAdditionalDamageRoll = mt_rand(0, $objAttacker->getAdditionalDamage());
			
			// attacker crit success roll
			$intAttackerCritRoll = mt_rand(0, $objAttacker->getModifiedCritRate());
			
			// attacker crit resist success roll
			$intDefenderCritResistRoll = mt_rand(0, $objDefender->getModifiedCritResistance());
			
			// crit roll out of 100
			$int100CritRoll = mt_rand(0, 100);
			
			// compare attacker crit roll minus defender crit resist roll out of 100
			if($intAttackerCritRoll - $intDefenderCritResistRoll >= $int100CritRoll){
				$intAttackerCritDamageModifier = $objAttacker->getModifiedCritDamage();
				$this->_blnCrit = true;
			}
			else{
				$intAttackerCritDamageModifier = 1.0;
				$this->_blnCrit = false;
			}
			
			if($objAttacker->getEquippedWeapon()->getStatDamage() === null || $objAttacker->getEquippedWeapon()->getStatDamage() == 'Strength'){
				$intDamage = round((((($objAttacker->getModifiedDamage() + $intAttackerAdditionalDamageRoll) * $dblSkillModifier) * $intAttackerCritDamageModifier) - $objDefender->getModifiedDefence()) * $intDefenderBlockedDamageModifier);
			}
			else if($objAttacker->getEquippedWeapon()->getStatDamage() == 'Intelligence'){
				$intDamage = round((((($objAttacker->getModifiedMagicDamage() + $intAttackerAdditionalDamageRoll) * $dblSkillModifier) * $intAttackerCritDamageModifier) - $objDefender->getModifiedMagicDefence()) * $intDefenderBlockedDamageModifier);	
			}
		}
		return $intDamage;
	}
	
	public function getCrit(){
		return $this->_blnCrit;
	}
	
	public function getBlocked(){
		return $this->_blnBlocked;
	}
	
	public function getEvaded(){
		return $this->_blnEvaded;
	}
}

?>