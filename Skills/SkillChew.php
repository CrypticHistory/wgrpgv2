<?php

include_once "RPGCombatHelper.php";
	
class SkillChew{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
		$objRPGCombatHelper = new RPGCombatHelper();
		
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . " baring sharp teeth, but misses!";
		}
		else{
			$intDamageFirst = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 0.5));
			$intDamageSecond = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 0.5));
			$intDamageThird = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 1.8));
			
			$objPlayer->takeDamage($intDamageFirst);
			$objPlayer->takeDamage($intDamageSecond);
			$objPlayer->takeDamage($intDamageThird);
			
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . " baring sharp teeth, biting " . $objPlayer->getNPCName() . " once for " . $intDamageFirst . " damage, again for " . $intDamageSecond . " damage, and finally spits " . $objPlayer->getNPCName() . " to the ground for " . $intDamageThird . " damage."; 
		}
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 100;
	}
	
	public function getSkillBaseModifier(){

	}
	
	public function getSkillSubType(){
		return "Strong Melee";
	}
	
	public function isUsableSkill($objPlayer){

	}
}

?>