<?php

require_once "Database.php";
	
class SkillFatteningTouch{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){

		$intHypnosisRoll = mt_rand(0, 100);
		
		if($intHypnosisRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " lunges forward and hugs " . $objPlayer->getNPCName() . " tightly, placing hands on their two ass cheeks. " . $objPlayer->getNPCName() . " begins to slowly expand outward!";
			$intFatteningRoll = mt_rand(1, 5);
			$objPlayer->setWeight($objPlayer->getWeight() + $intFatteningRoll);
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " lunges forward with arms outstretched, but " . $objPlayer->getNPCName() . " dodges them.";
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