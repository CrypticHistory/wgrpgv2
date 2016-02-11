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
		DataGameUI::traverse();
	}
	
	if(isset($_POST['return'])){
		$objFloor = new RPGFloor($_SESSION['objRPGCharacter']->getFloor());
		$_SESSION['objRPGCharacter']->setStateID($arrStateValues[$objFloor->getFloorType()]);
	}
	
	if(isset($_POST['itemAction']) && isset($_POST['itemID'])){
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
			$_SESSION['objRPGCharacter']->unequipItem($_POST['itemID']);
		}
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>