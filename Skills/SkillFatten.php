<?php

require_once "Database.php";
	
class SkillFatten{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$intHypnosisRoll = mt_rand(0, 100);
		
		if($intHypnosisRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " waves her hands in a circular motion, then points at " . $objPlayer->getNPCName() . ". " . $objPlayer->getNPCName() . " begins to grow heavier!";
			$objPlayer->setWeight($objPlayer->getWeight() + 5);
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " waves her hands and points at " . $objPlayer->getNPCName() . ", but they dodge the spell.";
		}
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 10;
	}
	
	public function getSkillSubType(){
		return "Debuff Ranged";
	}
}

?>