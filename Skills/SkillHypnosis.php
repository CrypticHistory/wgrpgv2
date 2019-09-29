<?php

require_once "Database.php";
	
class SkillHypnosis{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){

		$intHypnosisRoll = mt_rand(0, 100);
		
		if($intHypnosisRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " casts Hypnosis on " . $objPlayer->getNPCName() . " successfully.";
			$objPlayer->addToStatusEffects("Hypnotized");
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " casts Hypnosis on " . $objPlayer->getNPCName() . " but " . $objPlayer->getNPCName() . " resists it.";
		}
		return $strReturnText;
	}
	
	public function getSkillSubType(){
		return "Debuff Ranged";
	}
	
	public function getWaitTime(){
		return 10;
	}
}

?>