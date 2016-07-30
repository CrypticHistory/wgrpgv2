<?php

require_once "Database.php";
	
class SkillFatteningTouch{
	
	public function SkillFatteningTouch(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){

		$intHypnosisRoll = mt_rand(0, 100);
		
		if($intHypnosisRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " lunges forward and hugs you tightly, placing hands on your two ass cheeks. You feel warmth spread throughout your body and feel yourself begin to slowly expand outward.";
			$intFatteningRoll = mt_rand(1, 5);
			$objPlayer->setWeight($objPlayer->getWeight() + $intFatteningRoll);
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " lunges forward with arms outstretched, but you dodge them.";
		}
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 10;
	}
}

?>