<?php

	include_once 'RPGCharacter.class';
	include_once 'RPGUser.class';
	include_once 'RPGNPC.class';
	include_once 'UISettings.class';
	
	session_start();

	if(isset($_POST['command'])){
		// player turn
		$blnBattleOver = false;
		
		$objEnemy = $_SESSION['objEnemy'];
		$objChar = $_SESSION['objRPGCharacter'];
		
		// flee
		if($_POST['command'] == 'flee'){
			$objChar->setCombat(0);
			$objChar->setEventNodeID(2);
			$blnBattleOver = true;
		}
		
		// attack
		if($_POST['command'] == 'attack'){
		
			// player performs a standard attack
			$intDamage = $objEnemy->takeDamage(intval($objChar->getModifiedDamage()) - intval($objEnemy->getModifiedDefence()));
			$_SESSION['strCombatMessage'] .= '<br/>' . $objEnemy->getNPCName() . ' takes ' . $intDamage . ' damage.';
			
			// enemy is dead after the player's turn
			if($objEnemy->isDead()){
			
				// roll for loot
				$arrDrops = $objEnemy->getRandomDrops();
				$intCounter = 1;
				foreach($arrDrops as $key => $value){
					$objChar->giveItem($key);
					$_SESSION['strLootMessage'] = 'Loot received:<br/>' . $intCounter . ') ' . $value . '<br/>';
					$intCounter++;
				}
				
				// end of combat, prepare to move back to event mode
				$objEnemy->setCurrentHP(0);
				$objChar->setCombat(0);
				$objChar->setEventNodeID($objChar->getEventNodeID() + 1);
				$blnBattleOver = true;
				
			}
			
		}
		
		// enemy turn
		if(!$blnBattleOver){
		
			// enemy performs a standard attack
			$intDamage = $objChar->takeDamage(intval($objEnemy->getModifiedDamage()) - intval($objChar->getModifiedDefence()));
			$_SESSION['strCombatMessage'] .= '<br/>You take ' . $intDamage . ' damage.';
			
			// character is dead after the enemy's turn
			if($objChar->isDead()){
				$objChar->setCurrentHP(0);
				$objChar->setCombat(0);
				$objChar->setEventNodeID($objChar->getEventNodeID() + 2);
			}
			
		}
		
		// update session
		$_SESSION['strCombatMessage'] .= '<br/>';
		$_SESSION['objEnemy'] = $objEnemy;
		$_SESSION['objRPGCharacter'] = $objChar;
		$_SESSION['objRPGCharacter']->save();
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>