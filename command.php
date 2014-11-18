<?php

	include_once 'DialogConditionFactory.class';
	include_once 'RPGUser.class';
	include_once 'RPGCharacter.class';
	include_once 'RPGNPC.class';
	include_once 'UISettings.class';
	
	session_start();

	if(isset($_POST['command'])){
		$_SESSION['objRPGCharacter']->setEventNodeID($_POST['command']);
		if(isset($_POST['eventAction' . $_POST['command']])){
			DialogConditionFactory::evaluateAction($_POST['eventAction' . $_POST['command']]);
		}
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