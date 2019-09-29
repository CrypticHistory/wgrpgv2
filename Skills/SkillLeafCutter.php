<?php

include_once "RPGCombatHelper.php";
	
class SkillLeafCutter{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		$objRPGCombatHelper = new RPGCombatHelper();
		
		$arrTargets = array("Player", "PartyOne", "PartyTwo");
		shuffle($arrTargets);
		
		$strReturnText = "Leaves begin to spin around " . $objNPC->getNPCName() . " rapidly, and three razor sharp leaves split from the rotation and are sent hurling towards your team!";
		
		$intCounter = 0;
		foreach($arrTargets as $strTarget){
			$strTargetObject = "get" . $strTarget;
			
			if($objPlayerTeam->$strTargetObject() != null && !$objPlayerTeam->$strTargetObject()->isDead()){
				$objPlayer = $objPlayerTeam->$strTargetObject();
				
				if($objRPGCombatHelper->calculateEvadeRoll($objNPC, $objPlayer)){
					$strReturnText .= " " . $objPlayer->getNPCName() . " jumps away from the razor sharp leaf in time and emerges unscathed.";
				}
				else{

					$intDamage = max(0, $objRPGCombatHelper->calculateDamage($objNPC, $objPlayer, 2.0));
					$objPlayer->takeDamage($intDamage);
					
					$strReturnText .= " " . $objPlayer->getNPCName() . " is hit by a razor sharp leaf and takes " . $intDamage . " damage.";
					
				}
			}
			
			$intCounter++;
		}	
		
		return $strReturnText;
	}
	
	public function getWaitTime(){
		return 30;
	}
	
	public function getSkillBaseModifier(){

	}
	
	public function getSkillSubType(){
		return "Strong Ranged";
	}
	
	public function isUsableSkill($objPlayer){

	}
}

?>