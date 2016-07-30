<?php

class RPGCombatHelper{
	
	private $_blnEvaded;
	private $_blnCrit;
	private $_blnBlocked;
	
	public function RPGCombatHelper(){
	
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
				$intDamage = round((((($objAttacker->getModifiedDamage() * $dblSkillModifier) + $intAttackerAdditionalDamageRoll) * $intAttackerCritDamageModifier) - $objDefender->getModifiedDefence()) * $intDefenderBlockedDamageModifier);
			}
			else if($objAttacker->getEquippedWeapon()->getStatDamage() == 'Intelligence'){
				$intDamage = round((((($objAttacker->getModifiedMagicDamage() * $dblSkillModifier) + $intAttackerAdditionalDamageRoll) * $intAttackerCritDamageModifier) - $objDefender->getModifiedMagicDefence()) * $intDefenderBlockedDamageModifier);	
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