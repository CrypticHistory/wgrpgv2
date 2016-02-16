<?php

	include_once 'DialogConditionFactory.class';
	include_once 'RPGUser.class';
	include_once 'RPGCharacter.class';
	include_once 'RPGNPC.class';
	include_once 'RPGFloor.class';
	include_once 'UISettings.class';
	include_once 'DataGameUI.class';
	include_once 'constants.php';
	
	session_start();
	
	global $arrStateValues;

	if(isset($_POST['command'])){
		$_SESSION['objRPGCharacter']->setEventNodeID($_POST['command']);
		if(isset($_POST['eventAction' . $_POST['command']])){
			DialogConditionFactory::evaluateAction($_POST['eventAction' . $_POST['command']]);
		}
	}
	
	if(isset($_POST['traverse'])){
		$objFloor = new RPGFloor($_SESSION['objRPGCharacter']->getFloor());
		$objFloor->setApplicableEvents($_SESSION['objRPGCharacter']->getRPGCharacterID());
		$intEventID = $objFloor->generateRandomEvent();
		$_SESSION['objRPGCharacter']->setEventID($intEventID);		
		$_SESSION['objRPGCharacter']->setEventNodeID(0);
		$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
	}
	
	if(isset($_POST['exit'])){
		// if character has viewed the exit first floor event once before
		if($_SESSION['objRPGCharacter']->hasViewedEvent(11)){
			// give them the short leave tower event
			$_SESSION['objRPGCharacter']->setEventID(12);
			$_SESSION['objRPGCharacter']->setEventNodeID(0);
		}
		else{
			// give them the long leave tower event
			$_SESSION['objRPGCharacter']->setEventID(11);
			$_SESSION['objRPGCharacter']->setEventNodeID(0);
		}
		$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Town']);
	}
	
	if(isset($_POST['return'])){
		if($_SESSION['objRPGCharacter']->getTownID() == NULL){
			$objFloor = new RPGFloor($_SESSION['objRPGCharacter']->getFloor());
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues[$objFloor->getFloorType()]);
		}
		else{
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Town']);
		}
	}
	
	if(isset($_POST['itemAction']) && isset($_POST['itemID'])){
		if($_SESSION['objRPGCharacter']->hasItem($_POST['itemID'])){
			if($_POST['itemAction'] == 'use'){
				$_SESSION['objRPGCharacter']->eatItem($_POST['itemID'], $_POST['itemHPHeal']);
			}
			elseif($_POST['itemAction'] == 'drop'){
				$_SESSION['objRPGCharacter']->dropItem($_POST['itemID']);
			}
			elseif($_POST['itemAction'] == 'equip'){
				$strEquipFunction = 'equip' . $_POST['itemType'];
				$_SESSION['objRPGCharacter']->$strEquipFunction($_POST['itemID']);
			}
			elseif($_POST['itemAction'] == 'unequip'){
				$strUnequipFunction = 'unequip' . $_POST['itemType'];
				$_SESSION['objRPGCharacter']->$strUnequipFunction($_POST['itemID']);
			}
		}
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>