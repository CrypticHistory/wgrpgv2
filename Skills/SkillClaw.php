<?php

include_once "RPGCombatHelper.php";
include_once "CombatSE/SEBleeding.php";
include_once "RPGCombatStatusEffect.php";
	
class SkillClaw{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . " with its razor sharp claws, but misses!";
		}
		else{
			$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 1.8));
			
			$objPlayer->takeDamage($intDamage);
			
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . " and slashes them for " . $intDamage . " damage with razor sharp claws.";
			
			$intBleedRoll = mt_rand(0, 100);
		
			if($intBleedRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
				$strReturnText .= " " . $objPlayer->getNPCName() . " is bleeding following the attack.";
				$objStatusEffect = new SEBleeding($objNPC, $objPlayer, 2, $strTarget);
				$_SESSION['objCombat']->addToCombatStatusEffects($objStatusEffect);
			}
			
		}
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 80;
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