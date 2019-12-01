<?php

include_once "RPGCombatHelper.php";
	
class SkillStealth{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			$strReturnText = $objPlayer->getNPCName() . " vanishes in a cloud of smoke.";
			
			$objPlayer->addToStatusEffects("Stealth");
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a dagger.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
	
		$strReturnText = $objNPC->getNPCName() . " vanishes in a cloud of smoke.";
		
		$objNPC->addToStatusEffects("Stealth");
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 0;
	}
	
	public function getSkillBaseModifier(){
		return 0;
	}
	
	public function getSkillCounterModifier(){
		return 0;
	}
	
	public function getSkillSubType(){
		return "Buff";
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