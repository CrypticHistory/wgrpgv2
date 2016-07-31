<?php

require_once "Database.php";
	
class SkillFatten{
	
	public function SkillFatten(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$intHypnosisRoll = mt_rand(0, 100);
		
		if($intHypnosisRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " waves her hands in a circular motion, then points at you. You feel warmth in your belly that begins to travel throughout your body. You feel yourself growing heavier.";
			$objPlayer->setWeight($objPlayer->getWeight() + 5);
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " waves her hands and points at you, but you dodge the spell.";
		}
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 10;
	}
}

?>