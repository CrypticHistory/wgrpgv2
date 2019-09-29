<?php

include_once "RPGCombatHelper.php";
	
class SkillGroundPound{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$arrTargets = array("Player", "PartyOne", "PartyTwo");
		shuffle($arrTargets);
		
		$strReturnText = $objNPC->getNPCName() . " roars maliciously, slamming the ground with it's slimy arms. The impact shakes the ground, causing your team to lose balance.";
		
		$intCounter = 0;
		foreach($arrTargets as $strTarget){
			$strTargetObject = "get" . $strTarget;
			
			if($objPlayerTeam->$strTargetObject() != null && !$objPlayerTeam->$strTargetObject()->isDead()){
				$objPlayer = $objPlayerTeam->$strTargetObject();
				
				if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
					$strReturnText .= " " . $objPlayer->getNPCName() . " maintains their footing and emerges from the attack unscathed.";
				}
				else{

					$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 1.5));
					$objPlayer->takeDamage($intDamage);
					
					$strReturnText .= " " . $objPlayer->getNPCName() . " is hit by the impact for " . $intDamage . " damage.";
					
					$intKDRoll = mt_rand(0, 100);
		
					if($intKDRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
						$strReturnText .= " " . $objPlayer->getNPCName() . " is knocked on their feet following the attack!";
						$objPlayer->addToStatusEffects("Knocked Down");
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