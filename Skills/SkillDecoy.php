<?php

include_once "RPGCombatHelper.php";
	
class SkillDecoy{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			$strReturnText = "You summon your decoy, and dart off into the shadows.";
			
			$objPlayer->addToStatusEffects("Decoy");
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a dagger.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$strReturnText = $objNPC->getNPCName() . " disappears into the shadows...";
		
		$objNPC->addToStatusEffects("Decoy");
		
		return $strReturnText;
	}
	
	public function playerParry($objPlayer, $objNPC){
		$objPlayer->removeFromStatusEffects("Decoy");
		$objPlayer->addToStatusEffects("Stealth");
		
		$strReturnText = $objNPC->getNPCName() . " attacks " . $objPlayer->getNPCName() . "'s decoy in confusion. " . $objPlayer->getNPCName() . " enters stealth, waiting to counterattack.";
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 40;
	}
	
	public function getSkillBaseModifier(){
		return 0.5;
	}
	
	public function getSkillCounterModifier(){
		return 1.0;
	}
	
	public function getSkillSubType(){
		return "Parry";
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