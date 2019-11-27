<?php

include_once "RPGCombatHelper.php";
	
class SkillSapHP{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayer, $objNPC){

		$intSapRoll = mt_rand(0, 100);
		
		if($intSapRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$intHPRoll = mt_rand(3, 6);
			$objPlayer->takeDamage($intHPRoll);
			$objNPC->healHP($intHPRoll);
			$strReturnText = $objNPC->getNPCName() . " extends its pulsating vines at " . $objPlayer->getNPCName() . ", entangling them. " . $objNPC->getNPCName() . " saps " . $objPlayer->getNPCName() . ", stealing " . $intHPRoll . " health from them.";
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