<?php

include_once "RPGCombatHelper.php";
	
class SkillRend{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
				$strReturnText = "You swing your " . $objPlayer->getEquippedWeapon()->getItemName() . " rapidly over top your head, swapping between hands before taking a swing at " . $objNPC->getNPCName() . "'s head. The attack is dodged, inflicting 0 damage.";
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
				$strReturnText = "You swing your " . $objPlayer->getEquippedWeapon()->getItemName() . " rapidly over top your head, swapping between hands before finally landing the blade on " . $objNPC->getNPCName() . "'s skull with a crushing blow. You rend " . $objNPC->getNPCName() . ", inflicting " . $intDamage . " damage.";
			}
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a blunt, sword, or an axe.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
		$objRPGCombatHelper = new RPGCombatHelper();
		
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " swings its " . $objNPC->getEquippedWeapon()->getItemName() . " rapidly over top its head, swapping between hands before taking a swing at " . $objPlayer->getNPCName() . "'s head. The attack is dodged, inflicting 0 damage.";
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
			
			$strReturnText = $objNPC->getNPCName() . " swings its " . $objNPC->getEquippedWeapon()->getItemName() . " rapidly over top its head, swapping between hands before finally landing the blade on " . $objPlayer->getNPCName() . "'s skull with a crushing blow. " . $objNPC->getNPCName() . " rends " . $objPlayer->getNPCName() . ", inflicting " . $intDamage . " damage.";
		}
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 60;
	}
	
	public function getSkillBaseModifier(){
		return 2;
	}
	
	public function getSkillSubType(){
		return "Strong Melee";
	}
	
	public function isUsableSkill($objPlayer){
		$strItemType = $objPlayer->getEquippedWeapon()->getTypeSecondary();
		if($strItemType == "Sword" || $strItemType == "Blunt" || $strItemType == "Axe"){
			return true;
		}
		else{
			return false;
		}
	}
}

?>