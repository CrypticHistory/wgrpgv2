<?php

	include_once 'RPGCharacter.php';
	include_once "RPGSkill.php";
	include_once "RPGStatusEffect.php";
	
	session_start();

	if(isset($_GET['intClassID'])){
		$intClassID = $_GET['intClassID'];
		
		if(isset($_GET['intSkillID'])){
			$intSkillID = $_GET['intSkillID'];
			
			if($_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getSkills()->hasSkill($intSkillID) && $_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getSkills()->getSkill($intSkillID)->getUsableOutsideBattle() && $_SESSION['objRPGCharacter']->getTownID() < 1){
				
				$objSkill = $_SESSION['objRPGCharacter']->getClasses()->getCurrentClass()->getSkills()->getSkill($intSkillID);
				
				if($objSkill->getStatusEffectID() != NULL){
					
					$objStatusEffect = new RPGStatusEffect(NULL, $objSkill->getStatusEffectID());
					
					if($_SESSION['objRPGCharacter']->hasStatusEffect($objStatusEffect->getStatusEffectName())){
						$_SESSION['objRPGCharacter']->removeFromStatusEffects($objStatusEffect->getStatusEffectName());
					}
					else{
						$_SESSION['objRPGCharacter']->addToStatusEffects($objStatusEffect->getStatusEffectName());
					}
				}
			}
		}
	}
	
	header('Location: main.php?page=DisplayGameUI' . ((isset($intClassID)) ? ('&intClassID=' . $intClassID) : ''));
	exit;
	
?>