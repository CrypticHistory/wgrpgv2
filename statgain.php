<?php

	include_once 'RPGCharacter.class';
	include_once 'UISettings.class';
	
	session_start();

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
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>