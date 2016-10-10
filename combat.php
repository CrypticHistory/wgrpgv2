<?php

	include_once 'RPGCharacter.php';
	include_once 'RPGUser.php';
	include_once 'RPGNPC.php';
	include_once 'RPGCombat.php';
	include_once 'UISettings.php';
	include_once 'constants.php';
	
	session_start();

	if(isset($_POST['command'])){
		// check to see if the user's actually in combat
		if(isset($_SESSION['objRPGCharacter']->getCombat()["EnemyTeam"])){
			// to make the end of battle
			if($_POST['command'] == 'end'){
				$_SESSION['objEnemy'] = $_SESSION['objCombat']->getEnemyTeam()->getLeader();
				$_SESSION['objRPGCharacter']->clearCombat();
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
				$objEvent = $_SESSION['objRPGCharacter']->getEvent();
				if($_SESSION['objCombat']->getCombatState() == 'Victory'){
					$objEvent->setEventNodeID($objEvent->getEventNodeID() + 1);
				}
				else if($_SESSION['objCombat']->getCombatState() == 'Defeat'){
					$objEvent->setEventNodeID($objEvent->getEventNodeID() + 2);
				}
				else if($_SESSION['objCombat']->getCombatState() == 'Fled'){
					$objEvent->setEventNodeID($objEvent->getEventNodeID() - 1);
				}
				unset($_SESSION['objCombat']);
			}
			else{
				$strFunction = 'player' . $_POST['command'];
				
				if(isset($_POST['target'])){
					$strTarget = $_POST['target'];
					$_SESSION['objCombat']->$strFunction($strTarget);
				}
				else{
					$_SESSION['objCombat']->$strFunction();
				}
				
				$_SESSION['objCombat']->determineNextTurn();
				
				while(($_SESSION['objCombat']->getNextTurn() == 'Opponent' || $_SESSION['objCombat']->getNextTurn() == 'Party') && $_SESSION['objCombat']->getCombatState() == 'In Progress'){
					if($_SESSION['objCombat']->getNextTurn() == 'Opponent'){
						$_SESSION['objCombat']->enemyTurn();
					}
					else if($_SESSION['objCombat']->getNextTurn() == 'Party'){
						$_SESSION['objCombat']->partyTurn();
					}
					$_SESSION['objCombat']->determineNextTurn();
				}
				
				// update session
				$_SESSION['objRPGCharacter'] = $_SESSION['objCombat']->getPlayerTeam()->getPlayer();
				$_SESSION['objRPGCharacter']->save();
			}
		}	
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>