<?php

include_once "RPGCombatHelper.php";
	
class SkillChainLightning{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objEnemyTeam){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			$arrTargets = array("Leader", "EnemyOne", "EnemyTwo");
			shuffle($arrTargets);
			
			$intDmgModifier = $this->getSkillBaseModifier();
			
			$strReturnText = "Your " . $objPlayer->getEquippedWeapon()->getItemName() . " glows blue as you charge it with mana. Waving it sends wiry bolts of lightning surging forward at your enemies.";
			
			$intCounter = 0;
			foreach($arrTargets as $strTarget){
				$strTargetObject = "get" . $strTarget;
				
				if($objEnemyTeam->$strTargetObject() != null && !$objEnemyTeam->$strTargetObject()->isDead()){
					$objNPC = $objEnemyTeam->$strTargetObject();
					
					if($objRPGCombatHelper->calculateEvadeRoll($objPlayer, $objNPC)){
						if($intCounter == 0){
							$strReturnText .= " A jolt of lightning breaks off towards " . $objNPC->getNPCName() . ", but misses.";
						}
						else{
							$strReturnText .= " Another jolt of lightning breaks off towards " . $objNPC->getNPCName() . ", but misses.";
						}
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
						
						if($intCounter == 0){
							$strReturnText .= " A jolt of lightning breaks off towards " . $objNPC->getNPCName() . ", shocking them for " . $intDamage . " damage.";
						}
						else{
							$strReturnText .= " Another jolt of lightning breaks off towards " . $objNPC->getNPCName() . ", shocking them for " . $intDamage . " damage.";
						}
						
					}
					
					$intDmgModifier = $intDmgModifier - 0.5;
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
		return "Weak Magic AoE";
	}
	
	public function getWaitTime(){
		return 50;
	}
	
	public function getSkillBaseModifier(){
		return 2.0;
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