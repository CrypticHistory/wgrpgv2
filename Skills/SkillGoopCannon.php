<?php

include_once "RPGCombatHelper.php";
	
class SkillGoopCannon{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$arrTargets = array("Player", "PartyOne", "PartyTwo");
		shuffle($arrTargets);
		
		$strReturnText = $objNPC->getNPCName() . " gurggles sinisterly and spits out a massive blob of slime at your team!";
		
		$intCounter = 0;
		foreach($arrTargets as $strTarget){
			$strTargetObject = "get" . $strTarget;
			
			if($objPlayerTeam->$strTargetObject() != null && !$objPlayerTeam->$strTargetObject()->isDead()){
				$objPlayer = $objPlayerTeam->$strTargetObject();
				
				if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
					$strReturnText .= " " . $objPlayer->getNPCName() . " jumps away from the blob on time and emerges unscathed.";
				}
				else{

					$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 0.8));
					$objPlayer->takeDamage($intDamage);
					
					$strReturnText .= " " . $objPlayer->getNPCName() . " is hit by the blob and takes " . $intDamage . " damage.";
					
					$intStuckRoll = mt_rand(0, 100);
		
					if($intStuckRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
						$strReturnText .= " " . $objPlayer->getNPCName() . " is glued to the floor by the sticky substance!";
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