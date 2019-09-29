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
			$strReturnText = $objNPC->getNPCName() . " thrusts itself forward at you, forcing its body down your throat! You manage to pull back, but not without a throatful of blue goop you are forced to swallow so as not to choke!";
			$intWeightGain = round(($objNPC->getWeight() / 30));
			$objPlayer->stuffCharacterDeadly(100, $intWeightGain);
			$objNPC->takeDamage($intWeightGain * 3);
			
			if($objNPC->isDead() && !$objPlayer->isDead()){
				$strReturnText .= " The slime slides the last of itself down your gullet! You clutch your stomach as agony, stuffed beyond your limits. Shortly after, you let out a thunderous belch. You've consumed your enemy entirely! Is this victory, by default..? ";
			}
		}
		else{
			$strReturnText = $objNPC->getNPCName() . " lunges forward at you, aiming for your mouth. You dodge just in time!";
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