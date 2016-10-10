<?php

include_once "RPGCombatHelper.php";
	
class SkillRend{
	
	public function SkillRend(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, $this->getSkillBaseModifier()));
		
		$objPlayer->takeDamage($intDamage);
		
		$strReturnText = $objNPC->getNPCName() . " swings its " . $objNPC->getEquippedWeapon()->getItemName() . " rapidly over top its head, swapping between hands before finally landing the blade on " . $objPlayer->getNPCName() . "'s skull with a crushing blow. " . $objNPC->getNPCName() . " rends " . $objPlayer->getNPCName() . ", inflicting " . $intDamage . " damage.";
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 50;
	}
	
	public function getSkillBaseModifier(){
		return 2;
	}
}

?>