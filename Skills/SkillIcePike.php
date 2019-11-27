<?php

include_once "RPGCombatHelper.php";
	
class SkillIcePike{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
				$strReturnText = "You wave your " . $objPlayer->getEquippedWeapon()->getItemName() . " and hurl an ice pike at " . $objNPC->getNPCName() . ", but they dodge it successfully!";
			}
			else{
				if($objRPGCombatHelper->calculateCritRoll($objPlayer, $objNPC)){
					$intCritDmgModifier = $objRPGCombatHelper->calculateCritDmg($objPlayer);
				}
				else{
					$intCritDmgModifier = 1.0;
				}
				
				if($objRPGCombatHelper->calculateBlockRoll($objPlayer, $objNPC)){
					$intBlockDmgModifier = $objRPGCombatHelper->calculateBlockDmg($objNPC);
				}
				else{
					$intBlockDmgModifier = 1.0;
				}
				
				$intDamage = max(0, round((((($objPlayer->getModifiedMagicDamage() + $objRPGCombatHelper->calculateAdditionalDmg($objPlayer)) * $this->getSkillBaseModifier()) * $intCritDmgModifier) - $objNPC->getModifiedMagicDefence()) * $intBlockDmgModifier));
				$objNPC->takeDamage($intDamage);
				$strReturnText = "You wave your " . $objPlayer->getEquippedWeapon()->getItemName() . " and hurl an ice pike at " . $objNPC->getNPCName() . ". It connects, inflicting " . $intDamage . " damage.";
				
				$intFreezeRoll = mt_rand(0, 100);
		
				if($intFreezeRoll >= round($objNPC->getStatusEffectResistance() - $objPlayer->getStatusEffectSuccessRate())){
					$strReturnText .= " " . $objNPC->getNPCName() . " is frozen in place following the attack!";
					$objNPC->addToStatusEffects("Frozen");
				}
			}
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a staff or a wand.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
	}
	
	public function getSkillSubType(){
		return "Debuff Ranged";
	}
	
	public function getWaitTime(){
		return 10;
	}
	
	public function getSkillBaseModifier(){
		return 0.5;
	}
	
	public function isUsableSkill($objPlayer){
		$strItemType = $objPlayer->getEquippedWeapon()->getTypeSecondary();
		if($strItemType == "Wand" || $strItemType == "Staff"){
			return true;
		}
		else{
			return false;
		}
	}
	
}

?>