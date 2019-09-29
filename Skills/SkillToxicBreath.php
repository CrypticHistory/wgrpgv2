<?php

include_once "RPGCombatHelper.php";
include_once "CombatSE/SEPoisoned.php";
include_once "RPGCombatStatusEffect.php";
	
class SkillToxicBreath{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$arrTargets = array("Player", "PartyOne", "PartyTwo");
		shuffle($arrTargets);
		
		$strReturnText = $objNPC->getNPCName() . " gurggles unpleasantly, opening their slimy hole of a mouth wide. Putrid chemicals emerge and are moving toward your team!";
		
		$intCounter = 0;
		foreach($arrTargets as $strTarget){
			$strTargetObject = "get" . $strTarget;
			
			if($objPlayerTeam->$strTargetObject() != null && !$objPlayerTeam->$strTargetObject()->isDead()){
				$objPlayer = $objPlayerTeam->$strTargetObject();
				
				if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
					$strReturnText .= " " . $objPlayer->getNPCName() . " dodges the chemicals and emerges unscathed.";
				}
				else{

					$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 1.2));
					$objPlayer->takeDamage($intDamage);
					
					$strReturnText .= " " . $objPlayer->getNPCName() . " is hit by the toxic breath and suffers from " . $intDamage . " damage.";
					
					$intPoisonRoll = mt_rand(0, 100);
		
					if($intPoisonRoll >= round($objPlayer->getStatusEffectResistance() - $objNPC->getStatusEffectSuccessRate())){
						$strReturnText .= " " . $objPlayer->getNPCName() . " is poisoned by the attack!";
						$objStatusEffect = new SEPoisoned($objNPC, $objPlayer, 3, $strTarget);
						$_SESSION['objCombat']->addToCombatStatusEffects($objStatusEffect);
					}
					
				}
			}
			
			$intCounter++;
		}	
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 200;
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