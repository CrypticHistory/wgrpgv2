<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	include_once "RPGItem.php";
	
	session_start();

	if(isset($_POST['sellItemInstanceID'])){
		$intSellPrice = 0;
		$arrItemsSold = array();
		
		for($i=0; $i<count($_POST['sellItemInstanceID']);$i++){
			$tmpItem = new RPGItem($_POST['sellItemID'][$i]);
			$tmpItem->setItemInstanceID($_POST['sellItemInstanceID'][$i]);
			if($_SESSION['objRPGCharacter']->hasItem($_POST['sellItemInstanceID'][$i])){
				$arrItemsSold[] = $tmpItem;
			}
		}
		
		foreach($arrItemsSold as $objItem){
			if($_SESSION['objRPGCharacter']->hasItem($objItem->getItemInstanceID())){
				$intSellPrice += $objItem->getSellPrice();
				$_SESSION['objRPGCharacter']->dropItem($objItem->getItemInstanceID());
			}
			else{
				break;
			}
		}
	
		$_SESSION['objRPGCharacter']->setGold($_SESSION['objRPGCharacter']->getGold() + $intSellPrice);
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>