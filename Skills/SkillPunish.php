<?php

include_once "RPGCombatHelper.php";
	
class SkillPunish{
	
	public function __construct(){
		
	}

	public function castedByPlayer($objPlayer, $objNPC){
		if($this->isUsableSkill($objPlayer)){
			$objRPGCombatHelper = new RPGCombatHelper();
		
			$strReturnText = "You enter a parry pose, waiting for your enemy's approach...";
			
			$objPlayer->addToStatusEffects("Parry Stance");
		}
		else{
			$strReturnText = "You aren't using the correct weapon for this skill! You must equip a blunt, sword, or an axe.";
		}
		return $strReturnText;
	}
	
	public function castedByNPC($objPlayer, $objNPC){
		// todo: strSkillUseText in tblnpcskillxr
		
	}
	
	public function playerParry($objPlayer, $objNPC){
		if($objNPC->getEquippedWeapon()->getStatDamage() === null || $objNPC->getEquippedWeapon()->getStatDamage() == 'Strength'){
			$intDamage = round((($objNPC->getModifiedDamage() + $objNPC->getAdditionalDamage()) * ($this->getSkillCounterModifier() + $this->getSkillBaseModifier())) - $objNPC->getModifiedDefence());
		}
		else if($objNPC->getEquippedWeapon()->getStatDamage() == 'Intelligence'){
			$intDamage = round((($objNPC->getModifiedMagicDamage() + $objNPC->getAdditionalDamage()) * ($this->getSkillCounterModifier() + $this->getSkillBaseModifier())) - $objNPC->getModifiedMagicDefence());
		}
		
		$objNPC->takeDamage($intDamage);
		$objNPC->addToStatusEffects("Knocked Down");
		
		$strReturnText = $objNPC->getNPCName() . " attacks you, but you parry the attack! " . $objNPC->getNPCName() . " sustains " . $intDamage . " damage from the counterattack and is knocked onto the ground, unable to attack.";
		
		return $strReturnText;
	}
	
	public function NPCParry($objPlayer, $objNPC){
		// todo
	}
	
	public function playerParrySkill($objPlayer, $objNPC, $objSkill){
		if($objSkill->getSkillSubType() == "Strong Melee" || $objSkill->getSkillSubType() == "Weak Melee"){
			if($objNPC->getEquippedWeapon()->getStatDamage() === null || $objNPC->getEquippedWeapon()->getStatDamage() == 'Strength'){
				$intDamage = round((($objNPC->getModifiedDamage() + $objNPC->getAdditionalDamage()) * ($objSkill->getSkillBaseModifier() + $this->getSkillBaseModifier())) - $objNPC->getModifiedDefence());
			}
			else if($objNPC->getEquippedWeapon()->getStatDamage() == 'Intelligence'){
				$intDamage = round((($objNPC->getModifiedMagicDamage() + $objNPC->getAdditionalDamage()) * ($objSkill->getSkillBaseModifier() + $this->getSkillBaseModifier())) - $objNPC->getModifiedMagicDefence());
			}
			
			$objNPC->takeDamage($intDamage);
			$objNPC->addToStatusEffects("Knocked Down");
			
			$strReturnText = $objNPC->getNPCName() . " attacks you, but you parry the attack! " . $objNPC->getNPCName() . " sustains " . $intDamage . " damage from the counterattack and is knocked onto the ground, unable to attack.";
		}
		else{
			$strReturnText = "You fail to counter " . $objNPC->getNPCName() . "'s attack as it was not a melee attack! ";
			$strReturnText .= $objSkill->castedByNPC($objPlayer, $objNPC);
		}
		
		return $strReturnText;
	}
	
	public function NPCParrySkill($objPlayer, $objNPC){
		// todo
	}
	
	public function getWaitTime(){
		return 10;
	}
	
	public function getSkillBaseModifier(){
		return 0.5;
	}
	
	public function getSkillCounterModifier(){
		return 1.0;
	}
	
	public function getSkillSubType(){
		return "Parry";
	}
	
	public function isUsableSkill($objPlayer){
		$strItemType = $objPlayer->getEquippedWeapon()->getTypeSecondary();
		if($strItemType == "Blunt" || $strItemType == "Sword" || $strItemType == "Axe"){
			return true;
		}
		else{
			return false;
		}
	}
	
}

?>