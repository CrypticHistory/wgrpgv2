<?php
	include_once 'UISettings.php';
	include_once 'RPGCharacter.php';
	include_once 'RPGUser.php';
	include_once 'RPGEvent.php';
	
	session_start();
	
	//load character
	if(isset($_POST['strCharacterName']) && (isset($_POST['charAction']) && $_POST['charAction'] == 'Load')){
		if($_SESSION['objUser']->hasCharacter($_POST['strCharacterName'])){
			unset($_SESSION['objUISettings']);
			unset($_SESSION['objRelationship']);
			unset($_SESSION['objEnemy']);
			unset($_SESSION['objCombat']);
			//load UI Settings
			$_SESSION['objUISettings'] = new UISettings($_POST['strCharacterName']);
			$_SESSION['objRPGCharacter'] = new RPGCharacter($_POST['strCharacterName']);
			$_SESSION['objRPGCharacter']->removeKillBuffs();
			
			// Turici
			$_SESSION['objRPGCharacter']->setTownID(1);
			// Town State
			$_SESSION['objRPGCharacter']->setStateID(4);
			// Home Location
			$_SESSION['objRPGCharacter']->setLocationID(6);
			// Set default event
			$objEvent = new RPGEvent(1, $_SESSION['objRPGCharacter']->getRPGCharacterID());
			$_SESSION['objRPGCharacter']->setEvent($objEvent);
			
			header('Location: main.php?page=DisplayGameUI');
			exit;
		}
		else{
			header('Location: index.php');
			exit;
		}
	}
	// delete character
	else if(isset($_POST['strCharacterName']) && (isset($_POST['charAction']) && $_POST['charAction'] == 'Delete')){
		if($_SESSION['objUser']->hasCharacter($_POST['strCharacterName'])){
			$_SESSION['objUser']->deleteCharacter($_POST['strCharacterName']);
			
			header('Location: DisplayCharacterSelection.php');
			exit;
		}
		else{
			header('Location: index.php');
			exit;
		}
		
	}
	else{
		header('Location: index.php');
		exit;
	}
	
	
?>