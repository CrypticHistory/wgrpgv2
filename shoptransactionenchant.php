<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	include_once "RPGItem.php";
	
	session_start();

	if(isset($_POST['itemInstanceID']) && $_SESSION['objRPGCharacter']->hasItem($_POST['itemInstanceID'])){
		$intPlayerGold = $_SESSION['objRPGCharacter']->getGold();
		$intPurchasePrice = 1;

		if($intPlayerGold >= $intPurchasePrice){
			$_SESSION['objRPGCharacter']->disenchantItem($_POST['itemInstanceID'], $_POST['Remove'], $_POST['itemType']);
			$_SESSION['objRPGCharacter']->setGold($_SESSION['objRPGCharacter']->getGold() - $intPurchasePrice);	
		}
		else{
			$_SESSION['strShopError'] = '<b>Error:</b> You don\'t have enough gold for this purchase.';
		}
	}	
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>