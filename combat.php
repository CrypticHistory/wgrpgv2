<?php

	include_once 'RPGCharacter.class';
	include_once 'RPGUser.class';
	include_once 'RPGNPC.class';
	include_once 'RPGCombat.class';
	include_once 'UISettings.class';
	include_once 'constants.php';
	
	session_start();

	if(isset($_POST['command'])){
		// check to see if the user's actually in combat
		if(isset($_SESSION['objRPGCharacter']->getCombat()[0])){
			// to make the end of battle
			if($_POST['command'] == 'end'){
				$_SESSION['objEnemy'] = $_SESSION['objCombat']->getEnemy();
				$_SESSION['objRPGCharacter']->setCombat(0, NULL);
				$_SESSION['objRPGCharacter']->setStateID($arrStateValues['Event']);
				if($_SESSION['objCombat']->getCombatState() == 'Victory'){
					$_SESSION['objRPGCharacter']->setEventNodeID($_SESSION['objRPGCharacter']->getEventNodeID() + 1);
				}
				else if($_SESSION['objCombat']->getCombatState() == 'Defeat'){
					$_SESSION['objRPGCharacter']->setEventNodeID($_SESSION['objRPGCharacter']->getEventNodeID() + 2);
				}
				else if($_SESSION['objCombat']->getCombatState() == 'Fled'){
					$_SESSION['objRPGCharacter']->setEventNodeID($_SESSION['objRPGCharacter']->getEventNodeID() - 1);
				}
				unset($_SESSION['objCombat']);
			}
			else{
				if($_SESSION['objCombat']->getFirstTurn() == 'Player'){
					$strFunction = 'player' . $_POST['command'];
					
					$_SESSION['objCombat']->$strFunction();
					
					$_SESSION['objCombat']->determineNextTurn();
					
					while($_SESSION['objCombat']->getNextTurn() == 'Opponent' && $_SESSION['objCombat']->getCombatState() == 'In Progress'){
						$_SESSION['objCombat']->enemyTurn();
						$_SESSION['objCombat']->determineNextTurn();
					}
				}
				else{
					while($_SESSION['objCombat']->getNextTurn() == 'Opponent' && $_SESSION['objCombat']->getCombatState() == 'In Progress'){
						$_SESSION['objCombat']->enemyTurn();
						$_SESSION['objCombat']->determineNextTurn();
					}
					
					$strFunction = 'player' . $_POST['command'];
					
					$_SESSION['objCombat']->$strFunction();
					
					$_SESSION['objCombat']->determineNextTurn();
				}
				
				// update session
				$_SESSION['objRPGCharacter'] = $_SESSION['objCombat']->getPlayer();
				$_SESSION['objRPGCharacter']->save();
			}
		}	
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>