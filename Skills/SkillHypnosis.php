<?php

require_once "Database.php";
	
class SkillHypnosis{
	
	public function SkillHypnosis(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){

		$intHypnosisRoll = mt_rand(0, 100);
		
		if($intHypnosisRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " casts Hypnosis on you successfully.";
			$objPlayer->addToStatusEffects("Hypnotized");
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " casts Hypnosis on you but you resist it.";
		}
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 10;
	}
}

?>