<?php

include_once "RPGCombatHelper.php";
	
class SkillQuake{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objEnemyTeam){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			$arrTargets = array("Leader", "EnemyOne", "EnemyTwo");
			shuffle($arrTargets);
			
			$intDmgModifier = $this->getSkillBaseModifier();
			
			$strReturnText = "You twist your " . $objPlayer->getEquippedWeapon()->getItemName() . " over your head before slamming it into the ground with all your might. The force creates fissures in the ground beneath your enemies and they are stunned by the impact.";
			
			$intCounter = 0;
			foreach($arrTargets as $strTarget){
				$strTargetObject = "get" . $strTarget;
				
				if($objEnemyTeam->$strTargetObject() != null && !$objEnemyTeam->$strTargetObject()->isDead()){
					$objNPC = $objEnemyTeam->$strTargetObject();
					
					if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
						$strReturnText .= $objNPC->getNPCName() . " jumps away from the fissure in time and emerges unscathed.";
					}
					else{
						
						if($objRPGCombatHelper->calculateCritRoll($objPlayer, $objNPC)){
							$intCritDmgModifier = $objRPGCombatHelper->calculateCritDmg($objPlayer);
						}
						else{
							$intCritDmgModifier = 1.0;
						}
						
						if($objRPGCombatHelper->calculateBlockRoll($objPlayer, $objNPC)){
							$intBlockDmgModifier = $objRPGCombatHelper->calculateBlockDmg($objNPC);
						}
						else{
							$intBlockDmgModifier = 1.0;
						}
						
						$intDamage = max(0, round((((($objPlayer->getModifiedDamage() + $objRPGCombatHelper->calculateAdditionalDmg($objPlayer)) * $intDmgModifier) * $intCritDmgModifier) - $objNPC->getModifiedDefence()) * $intBlockDmgModifier));
						$objNPC->takeDamage($intDamage);
						
						$strReturnText .= "  " . $objNPC->getNPCName() . " suffers from " . $intDamage . " damage.";
						
						$intKDRoll = mt_rand(0, 100);
		
						if($intKDRoll >= round($objNPC->getStatusEffectResistance() - $objPlayer->getStatusEffectSuccessRate())){
							$strReturnText .= " " . $objNPC->getNPCName() . " is knocked off their feet following the attack.";
							$objNPC->addToStatusEffects("Knocked Down");
						}
					}
				}
				
				$intCounter++;
			}	
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a blunt, sword, or an axe.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
	}
	
	public function getSkillSubType(){
		return "Weak Ranged AoE";
	}
	
	public function getWaitTime(){
		return 50;
	}
	
	public function getSkillBaseModifier(){
		return 1.5;
	}
	
	public function isUsableSkill($objPlayer){
		$strItemType = $objPlayer->getEquippedWeapon()->getTypeSecondary();
		if($strItemType == "Sword" || $strItemType == "Blunt" || $strItemType == "Axe"){
			return true;
		}
		else{
			return false;
		}
	}
	
}

?>