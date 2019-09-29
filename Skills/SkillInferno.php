<?php

include_once "RPGCombatHelper.php";
include_once "CombatSE/SEBurned.php";
include_once "RPGCombatStatusEffect.php";
	
class SkillInferno{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objEnemyTeam){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			$arrTargets = array("Leader", "EnemyOne", "EnemyTwo");
			shuffle($arrTargets);
			
			$intDmgModifier = $this->getSkillBaseModifier();
			
			$strReturnText = "Your " . $objPlayer->getEquippedWeapon()->getItemName() . " glows blue as you charge it with mana. Waving it causes flames to erupt from beneath your enemies.";
			
			$intCounter = 0;
			foreach($arrTargets as $strTarget){
				$strTargetObject = "get" . $strTarget;
				
				if($objEnemyTeam->$strTargetObject() != null && !$objEnemyTeam->$strTargetObject()->isDead()){
					$objNPC = $objEnemyTeam->$strTargetObject();
					
					if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
						$strReturnText .= $objNPC->getNPCName() . " jumps away from the flames in time and emerges unscathed.";
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
						
						$intDamage = max(0, round((((($objPlayer->getModifiedMagicDamage() + $objRPGCombatHelper->calculateAdditionalDmg($objPlayer)) * $intDmgModifier) * $intCritDmgModifier) - $objNPC->getModifiedMagicDefence()) * $intBlockDmgModifier));
						$objNPC->takeDamage($intDamage);
						
						$strReturnText .= " The flames engulf " . $objNPC->getNPCName() . ", burning them for " . $intDamage . " damage.";
						
						$intBurnRoll = mt_rand(0, 100);
		
						if($intBurnRoll >= round($objNPC->getStatusEffectResistance() - $objPlayer->getStatusEffectSuccessRate())){
							$strReturnText .= " " . $objNPC->getNPCName() . " is burned severely following the attack.";
							$objStatusEffect = new SEBurned($objPlayer, $objNPC, 3, $strTarget);
							$_SESSION['objCombat']->addToCombatStatusEffects($objStatusEffect);
						}
					}
				}
				
				$intCounter++;
			}	
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a staff or a wand.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayerTeam, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
	}
	
	public function getSkillSubType(){
		return "Weak Magic AoE Debuff";
	}
	
	public function getWaitTime(){
		return 50;
	}
	
	public function getSkillBaseModifier(){
		return 1.75;
	}
	
	public function isUsableSkill($objPlayer){
		$strItemType = $objPlayer->getEquippedWeapon()->getTypeSecondary();
		if($strItemType == "Wand" || $strItemType == "Staff"){
			return true;
		}
		else{
			return false;
		}
	}
	
}

?>