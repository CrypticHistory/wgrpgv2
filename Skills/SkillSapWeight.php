<?php

include_once "RPGCombatHelper.php";
	
class SkillSapWeight{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){

		$intSapRoll = mt_rand(0, 100);
		
		if($intSapRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " extends its pulsating vines at " . $objPlayer->getNPCName() . ", entangling them. " . $objPlayer->getNPCName() . " begins to slowly deflate, losing weight rapidly.";
			$intFatteningRoll = mt_rand(1, 3);
			$objPlayer->setWeight($objPlayer->getWeight() - $intFatteningRoll);
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " extends its pulsating vines but " . $objPlayer->getNPCName() . " dodges them.";
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