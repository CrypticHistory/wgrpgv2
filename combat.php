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
			$intDamage = $objEnemy->takeDamage(intval($objChar->getModifiedDamage()) - intval($objEnemy->getModifiedDefence()));
			$_SESSION['strCombatMessage'] .= '<br/>' . $objEnemy->getNPCName() . ' takes ' . $intDamage . ' damage.';
			if($objEnemy->isDead()){
				$arrDrops = $objEnemy->getRandomDrops();
				$intCounter = 1;
				foreach($arrDrops as $key => $value){
					$objChar->giveItem($key);
					$_SESSION['strLootMessage'] = 'Loot received:<br/>' . $intCounter . ') ' . $value . '<br/>';
					$intCounter++;
				}
				$objEnemy->setCurrentHP(0);
				$objChar->setCombat(0);
				$objChar->setEventNodeID(4);
				$blnBattleOver = true;
			}
		}
		
		if(!$blnBattleOver){
			// enemy turn
			$intDamage = $objChar->takeDamage(intval($objEnemy->getModifiedDamage()) - intval($objChar->getModifiedDefence()));
			$_SESSION['strCombatMessage'] .= '<br/>You take ' . $intDamage . ' damage.';
			if($objChar->isDead()){
				$objChar->setCurrentHP(0);
				$objChar->setCombat(0);
				$objChar->setEventNodeID(5);
			}
		}
		$_SESSION['strCombatMessage'] .= '<br/>';
		$_SESSION['objEnemy'] = $objEnemy;
		$_SESSION['objRPGCharacter'] = $objChar;
		$_SESSION['objRPGCharacter']->save();
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>