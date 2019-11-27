<?php

include_once "RPGCombatHelper.php";
	
class SkillEntangle{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$arrTargets = array("Player", "PartyOne", "PartyTwo");
		shuffle($arrTargets);
		
		$strReturnText = $objNPC->getNPCName() . " reaches out towards your team with its leafy vines.";
		
		$intCounter = 0;
		foreach($arrTargets as $strTarget){
			$strTargetObject = "get" . $strTarget;
			
			if($objPlayerTeam->$strTargetObject() != null && !$objPlayerTeam->$strTargetObject()->isDead()){
				$objPlayer = $objPlayerTeam->$strTargetObject();
				
				if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
					$strReturnText .= " " . $objPlayer->getNPCName() . " jumps away from the vines on time and emerges unscathed.";
				}
				else{

					$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 0.8));
					$objPlayer->takeDamage($intDamage);
					
					$strReturnText .= " " . $objPlayer->getNPCName() . " is entangled by vines, taking " . $intDamage . " damage.";
					
					$intStuckRoll = mt_rand(0, 100);
		
					if($intStuckRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
						$strReturnText .= " " . $objPlayer->getNPCName() . " is locked in place by thick vines.";
						$objPlayer->addToStatusEffects("Stuck");
					}
					
				}
			}
			
			$intCounter++;
		}	
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 150;
	}
	
	public function getSkillBaseModifier(){

	}
	
	public function getSkillSubType(){
		return "Debuff Ranged";
	}
	
	public function isUsableSkill($objPlayer){

	}
}

?>