<?php

include_once "RPGCombatHelper.php";
include_once "CombatSE/SEPoisoned.php";
include_once "RPGCombatStatusEffect.php";
	
class SkillPoisonBite{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . " baring sharp teeth, but misses!";
		}
		else{
			$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 1.8));
			
			$objPlayer->takeDamage($intDamage);
			
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . " and bites them for " . $intDamage . " damage.";
			
			$intPoisonRoll = mt_rand(0, 100);
		
			if($intPoisonRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
				$strReturnText .= " " . $objPlayer->getNPCName() . " is poisoned following the attack.";
				$objStatusEffect = new SEPoisoned($objNPC, $objPlayer, 2, $strTarget);
				$_SESSION['objCombat']->addToCombatStatusEffects($objStatusEffect);
			}
			
		}
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 40;
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