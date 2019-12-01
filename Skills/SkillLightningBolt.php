<?php

include_once "RPGCombatHelper.php";
	
class SkillLightningBolt{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		
		$objRPGCombatHelper = new RPGCombatHelper();
		
		if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
			$strReturnText = $objNPC->getNPCName() . " charges energy and shoots a bolt of electricity at " . $objPlayer->getNPCName() . ", but they dodge it successfully!";
		}
		else{
			$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, $this->getSkillBaseModifier()));
			$objPlayer->takeDamage($intDamage);
			
			$strReturnText = $objNPC->getNPCName() . " charges energy and shoots a bolt of electricity at " . $objPlayer->getNPCName() . ". It connects, inflicting " . $intDamage . " damage.";
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
		return 1.2;
	}
	
	public function isUsableSkill($objPlayer){
		
	}
	
}

?>