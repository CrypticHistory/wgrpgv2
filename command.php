<?php

	include_once 'DialogConditionFactory.php';
	include_once 'RPGUser.php';
	include_once 'RPGCharacter.php';
	include_once 'RPGNPC.php';
	include_once 'RPGFloor.php';
	include_once 'RPGEvent.php';
	include_once 'UISettings.php';
	include_once 'DataGameUI.php';
	include_once 'constants.php';
	
	session_start();
	
	global $arrStateValues;

	if(isset($_POST['command'])){
		$objEvent = $_SESSION['objRPGCharacter']->getEvent();
		$objXML = new RPGXMLReader($objEvent->getXML());
		if($objXML->isValidNodeID($objEvent->getEventNodeID(), $_POST['command'])){
			// command actions require the command index to be passed in
			if(isset($_POST['commandIndex' . $_POST['command']])){
				$strCommand = $objXML->getCommandAction($objEvent->getEventNodeID(), intval($_POST['commandIndex' . $_POST['command']]));
				if(preg_match_all('/{(.*?)}/', $strCommand, $matches)){
					foreach($matches[1] as $key => $value){
						if($value == "EventItem"){
							$strCommand = str_replace($matches[0][$key], $_SESSION['objRPGCharacter']->getEvent()->getEventItem()->getItemID(), $strCommand);
						}
						else{
							if(strpos($value, "Enemy")){
								$newValue = str_replace("Enemy", "", $value);
								$strCommand = str_replace($matches[0][$key], $_SESSION['objRPGCharacter']->getPotentialEnemy()->getLeader()->$newValue(), $strCommand);
							}
							else{
								$strCommand = str_replace($matches[0][$key], $_SESSION['objRPGCharacter']->$value(), $strCommand);
							}
						}
					}
				}
				DialogConditionFactory::evaluateAction(strval($strCommand));
			}
			$objEvent->setEventNodeID($_POST['command']);
			$objEvent->clearRolls();
		}
	}
	
	if(isset($_POST['traverse']) && $_SESSION['objRPGCharacter']->getTownID() == 0){
		$objCurrentFloor = $_SESSION['objRPGCharacter']->getCurrentFloor();
		
		if($objCurrentFloor->getMaze()->isValidMove($_POST['traverse'])){
			$strMoveFunction = 'move' . $_POST['traverse'];
			$objCurrentFloor->getMaze()->$strMoveFunction();
			$strEventType = $objCurrentFloor->getMaze()->getEventAtCurrentLocation();

			// show staircase down
			if($strEventType == "B"){
				if($objCurrentFloor->getFloorID() == 1){
					// Generic leave tower event on first floor
					$objEvent = new RPGEvent(12, $_SESSION['objRPGCharacter']->getRPGCharacterID());
				}
				else{
					// Generic descend floor event on second+ floor
					$objEvent = new RPGEvent(20, $_SESSION['objRPGCharacter']->getRPGCharacterID());
				}
				$_SESSION['objRPGCharacter']->setEvent($objEvent);
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
			}
			// show staircase up
			else if($strEventType == "E"){
				// Generic ascend floor event
				$objEvent = new RPGEvent(21, $_SESSION['objRPGCharacter']->getRPGCharacterID());
				$_SESSION['objRPGCharacter']->setEvent($objEvent);
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
			}
			// standstill event
			else if($strEventType == "S"){
				$objEvent = $objCurrentFloor->getStandstill($_SESSION['objRPGCharacter']->getRPGCharacterID());
				$_SESSION['objRPGCharacter']->setEvent($objEvent);		
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
			}
			// combat
			else if($strEventType == "C"){
				// todo: 50/50 to decide if forced combat or not, or skills factor in
				$_SESSION['objRPGCharacter']->setPotentialEnemy($objCurrentFloor->getRandomEnemy());
				$objGenericForcedCombatEvent = new RPGEvent(18, $_SESSION['objRPGCharacter']->getRPGCharacterID());
				$_SESSION['objRPGCharacter']->setEvent($objGenericForcedCombatEvent);
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
				$objCurrentFloor->getMaze()->setEventAtCurrentLocation("S");
			}
			else{
				$objEvent = $strEventType;
				$_SESSION['objRPGCharacter']->setEvent($objEvent);		
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
			}
		}
	}
	
	if(isset($_POST['exitField'])){
		// todo: security to check if the "exit flag" for the floor is true to allow them to exit whenever they want
		// if character has viewed the exit first floor event once before
		$objLongLeaveTowerEvent = new RPGEvent(11, $_SESSION['objRPGCharacter']->getRPGCharacterID());
		$_SESSION['objRPGCharacter']->setEvent($objLongLeaveTowerEvent);
		if($_SESSION['objRPGCharacter']->getEvent()->hasViewedEvent()){
			// give them the short leave tower event
			$objShortLeaveTowerEvent = new RPGEvent(12, $_SESSION['objRPGCharacter']->getRPGCharacterID());
			$_SESSION['objRPGCharacter']->setEvent($objShortLeaveTowerEvent);
			
		}
		else{
			// give them the long leave tower event
			$_SESSION['objRPGCharacter']->getEvent()->addToCharacterEventLog();
		}
		$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
	}
	
	if(isset($_POST['return'])){
		if($_SESSION['objRPGCharacter']->getTownID() == 0){
			$objFloor = $_SESSION['objRPGCharacter']->getCurrentFloor();
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues[$objFloor->getFloorType()]);
		}
		else{
			$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Town']);
		}
	}
	
	if(isset($_POST['itemAction']) && isset($_POST['itemInstanceID'])){
		// will there even be weapon/item requirements?
		if($_SESSION['objRPGCharacter']->hasItem($_POST['itemInstanceID'])){
			if($_POST['itemAction'] == 'use'){
				$_SESSION['objRPGCharacter']->eatItem($_POST['itemID'], $_POST['itemInstanceID'], $_POST['itemHPHeal'], $_POST['itemFullness']);
			}
			else if($_POST['itemAction'] == 'drop'){
				$_SESSION['objRPGCharacter']->dropItem($_POST['itemInstanceID']);
			}
			else if($_POST['itemAction'] == 'equip'){
				$strEquipFunction = 'equip' . $_POST['itemType'];
				$_SESSION['objRPGCharacter']->$strEquipFunction($_POST['itemInstanceID'], $_POST['itemID']);
			}
			else if($_POST['itemAction'] == 'unequip'){
				$strUnequipFunction = 'unequip' . $_POST['itemType'];
				$_SESSION['objRPGCharacter']->$strUnequipFunction();
			}
		}
	}
	
	if(isset($_POST['toggleClass'])){
		if($_SESSION['objRPGCharacter']->getClasses()->hasClass($_POST['toggleClass'])){
			if($_SESSION['objRPGCharacter']->getClasses()->isCurrentClass($_POST['toggleClass'])){
				$_SESSION['objRPGCharacter']->getClasses()->disableCurrentClass();
			}
			else{
				$_SESSION['objRPGCharacter']->getClasses()->setCurrentClass($_POST['toggleClass']);
			}
		}
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>