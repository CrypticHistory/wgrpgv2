<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	
	session_start();

	if(is_numeric($_POST['intStrength'])
		&& is_numeric($_POST['intIntelligence'])
		&& is_numeric($_POST['intAgility'])
		&& is_numeric($_POST['intDexterity'])
		&& is_numeric($_POST['intVitality'])
		&& is_numeric($_POST['intWillpower'])){
			
		if(strpos( $_POST['intStrength'], '.' ) === false
			&& strpos( $_POST['intIntelligence'], '.' ) === false
			&& strpos( $_POST['intAgility'], '.' ) === false
			&& strpos( $_POST['intDexterity'], '.' ) === false
			&& strpos( $_POST['intVitality'], '.' ) === false
			&& strpos( $_POST['intWillpower'], '.' ) === false){
				
			if($_POST['intStrength'] > -1
				&& $_POST['intIntelligence'] > -1
				&& $_POST['intAgility'] > -1
				&& $_POST['intDexterity'] > -1
				&& $_POST['intVitality'] > -1
				&& $_POST['intWillpower'] > -1){
				$intCombinedStats = $_POST['intStrength'] + $_POST['intIntelligence'] + $_POST['intAgility'] + $_POST['intVitality'] + $_POST['intWillpower'] + $_POST['intDexterity'];
				if($intCombinedStats <= $_SESSION['objRPGCharacter']->getStatPoints()){
					$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intStrength', $_POST['intStrength'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intStrength']);
					$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intIntelligence', $_POST['intIntelligence'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intIntelligence']);
					$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intAgility', $_POST['intAgility'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intAgility']);
					$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intVitality', $_POST['intVitality'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intVitality']);
					$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intWillpower', $_POST['intWillpower'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intWillpower']);
					$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intDexterity', $_POST['intDexterity'] + $_SESSION['objRPGCharacter']->getStats()->getAbilityStats()['intDexterity']);
					$_SESSION['objRPGCharacter']->setStatPoints(max(0, ($_SESSION['objRPGCharacter']->getStatPoints() - $intCombinedStats)));
					$_SESSION['objRPGCharacter']->getStats()->saveAbilityStats();
				}
				else{
					$_SESSION['strStatError'] = 'Error: Stats entered exceeds maximum allocated stat points.';
				}	
			}
			else{
				$_SESSION['strStatError'] = 'Error: Stat input cannot be negative.';
			}
		}
		else{
			$_SESSION['strStatError'] = 'Error: Stat input cannot have decimals.';
		}
			
	}
	else{
		$_SESSION['strStatError'] = 'Error: Stat input must be a number.';
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>