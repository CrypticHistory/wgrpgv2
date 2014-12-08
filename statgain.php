<?php

	include_once 'RPGCharacter.class';
	include_once 'UISettings.class';
	
	session_start();

	if(isset($_POST['intStrength'])){
		$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intStrength', $_POST['intStrength'] - $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intStrength']);
	}
	if(isset($_POST['intIntelligence'])){
		$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intIntelligence', $_POST['intIntelligence'] - $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intIntelligence']);
	}
	if(isset($_POST['intAgility'])){
		$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intAgility', $_POST['intAgility'] - $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intAgility']);
	}
	if(isset($_POST['intVitality'])){
		$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intVitality', $_POST['intVitality'] - $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intVitality']);
	}
	if(isset($_POST['intWillpower'])){
		$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intWillpower', $_POST['intWillpower'] - $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intWillpower']);
	}
	if(isset($_POST['intDexterity'])){
		$_SESSION['objRPGCharacter']->getStats()->setAbilityStats('intDexterity', $_POST['intDexterity'] - $_SESSION['objRPGCharacter']->getStats()->getBaseStats()['intDexterity']);
	}
	if(isset($_POST['intSpentStats'])){
		$_SESSION['objRPGCharacter']->setStatPoints(max(0, ($_SESSION['objRPGCharacter']->getStatPoints() - $_POST['intSpentStats'])));
	}
	
	$_SESSION['objRPGCharacter']->getStats()->saveAbilityStats();
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>