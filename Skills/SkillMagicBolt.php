<?php

include_once "RPGCombatHelper.php";
	
class SkillMagicBolt{
	
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
		
		$strReturnText = $objNPC->getNPCName() . " waves its " . $objNPC->getEquippedWeapon()->getItemName() . " and hurls a bolt of magical energy at you. It connects, inflicting " . $intDamage . " damage.";
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 50;
	}
	
	public function getSkillBaseModifier(){
		return 1.8;
	}
}

?>