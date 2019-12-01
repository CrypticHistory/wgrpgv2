<?php

include_once "RPGCombatHelper.php";
	
class SkillMagicBolt{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
				$strReturnText = "You wave your " . $objPlayer->getEquippedWeapon()->getItemName() . " and hurl a bolt of magical energy at " . $objNPC->getNPCName() . ", but they dodge it successfully!";
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
				$strReturnText = "You wave your " . $objPlayer->getEquippedWeapon()->getItemName() . " and hurl a bolt of magical energy at " . $objNPC->getNPCName() . ". It connects, inflicting " . $intDamage . " damage.";
			}
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a staff or a wand.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
		$objRPGCombatHelper = new RPGCombatHelper();
		
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " waves its " . $objNPC->getEquippedWeapon()->getItemName() . " and hurls a bolt of magical energy at " . $objPlayer->getNPCName() . ", but they dodge it successfully!";
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
			
			$intDamage = max(0, round((((($objNPC->getModifiedMagicDamage() + $objRPGCombatHelper->calculateAdditionalDmg($objNPC)) * $this->getSkillBaseModifier()) * $intCritDmgModifier) - $objPlayer->getModifiedMagicDefence()) * $intBlockDmgModifier));
			$objPlayer->takeDamage($intDamage);
			
			$strReturnText = $objNPC->getNPCName() . " waves its " . $objNPC->getEquippedWeapon()->getItemName() . " and hurls a bolt of magical energy at " . $objPlayer->getNPCName() . ". It connects, inflicting " . $intDamage . " damage.";
		}
		
		return $strReturnText;
	}
	
	public function getSkillSubType(){
		return "Strong Ranged";
	}
	
	public function getWaitTime(){
		return 50;
	}
	
	public function getSkillBaseModifier(){
		return 1.8;
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