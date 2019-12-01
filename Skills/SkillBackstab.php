<?php

include_once "RPGCombatHelper.php";
	
class SkillBackstab{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			if($objPlayer->hasStatusEffect("Stealth")){
				if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
					$strReturnText = "You swiftly approach " . $objNPC->getNPCName() . " from behind, but they are aware, and dodge your stab. Your stealth deactivates.";
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
					
					$intDamage = max(0, round((((($objPlayer->getModifiedDamage() + $objRPGCombatHelper->calculateAdditionalDmg($objPlayer)) * $this->getSkillBaseModifier()) * $intCritDmgModifier) - $objNPC->getModifiedDefence()) * $intBlockDmgModifier));
					$objNPC->takeDamage($intDamage);
					$strReturnText = "You swiftly approach " . $objNPC->getNPCName() . " from behind and stab them in the back, inflicting " . $intDamage . " damage. Your stealth deactivates.";
				}
				$objPlayer->removeFromStatusEffects("Stealth");
			}
			else{
				$strReturnText = "You must be in stealth to use Backstab.";
			}
			
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a dagger.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
	
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " swiftly approaches " . $objPlayer->getNPCName() . " from behind, but they are aware, and dodge the stab. " . $objNPC->getNPCName() . "'s stealth deactivates.";
		}
		else{
			
			if($objRPGCombatHelper->calculateCritRoll($objNPC, $objPlayer)){
				$intCritDmgModifier = $objRPGCombatHelper->calculateCritDmg($objNPC);
			}
			else{
				$intCritDmgModifier = 1.0;
			}
			
			if($objRPGCombatHelper->calculateBlockRoll($objNPC, $objPlayer)){
				$intBlockDmgModifier = $objRPGCombatHelper->calculateBlockDmg($objPlayer);
			}
			else{
				$intBlockDmgModifier = 1.0;
			}
			
			$intDamage = max(0, round((((($objNPC->getModifiedDamage() + $objRPGCombatHelper->calculateAdditionalDmg($objNPC)) * $this->getSkillBaseModifier()) * $intCritDmgModifier) - $objPlayer->getModifiedDefence()) * $intBlockDmgModifier));
			$objPlayer->takeDamage($intDamage);
			$strReturnText = $objNPC->getNPCName() . " swiftly approaches " . $objPlayer->getNPCName() . " from behind and stabs them in the back, inflicting " . $intDamage . " damage. " . $objNPC->getNPCName() . "'s stealth deactivates.";
		}
		$objNPC->removeFromStatusEffects("Stealth");
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 20;
	}
	
	public function getSkillBaseModifier(){
		return 2.5;
	}
	
	public function getSkillSubType(){
		return "Strong Melee";
	}
	
	public function isUsableSkill($objPlayer){
		$strItemType = $objPlayer->getEquippedWeapon()->getTypeSecondary();
		if($strItemType == "Dagger"){
			return true;
		}
		else{
			return false;
		}
	}
}

?>