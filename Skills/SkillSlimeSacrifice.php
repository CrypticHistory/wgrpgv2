<?php

require_once "Database.php";
	
class SkillSlimeSacrifice{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		// todo
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		$intFeedRoll = mt_rand(0, 100);
		
		if($intFeedRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
			$strReturnText = $objNPC->getNPCName() . " thrusts itself forward at " . $objPlayer->getNPCName() . ", forcing its body down their throat! " . $objPlayer->getNPCName() . " manages to pull back, but not without a throatful of blue goop they are forced to swallow so as not to choke!";
			$intWeightGain = round(($objNPC->getWeight() / 30));
			$objPlayer->stuffCharacterDeadly(100, $intWeightGain);
			$objNPC->takeDamage($intWeightGain * 3);
			
			if($objNPC->isDead() && !$objPlayer->isDead()){
				$strReturnText .= " The slime slides the last of itself down " . $objPlayer->getNPCName() . "'s gullet! " . $objPlayer->getNPCName() . " clutches their stomach in agony, stuffed beyond their limits. Shortly after, " . $objPlayer->getNPCName() . " lets out a thunderous belch. They've consumed the enemy entirely! Is this victory, by default..? ";
			}
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " lunges forward at " . $objPlayer->getNPCName() . ", aiming for their mouth. " . $objPlayer->getNPCName() . " dodges just in time!";
		}
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 100;
	}
	
	public function getSkillSubType(){
		return "Debuff Ranged";
	}
}

?>