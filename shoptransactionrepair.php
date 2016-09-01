<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	include_once "RPGItem.php";
	
	session_start();

	if(isset($_POST['itemInstanceID']) && $_SESSION['objRPGCharacter']->hasItem($_POST['itemInstanceID'])){
		$intPlayerGold = $_SESSION['objRPGCharacter']->getGold();
		$intPurchasePrice = $_POST['itemSellPrice'];

		if($intPlayerGold >= $intPurchasePrice){
			$_SESSION['objRPGCharacter']->repairItem($_POST['itemInstanceID']);
			$_SESSION['objRPGCharacter']->setGold($_SESSION['objRPGCharacter']->getGold() - $intPurchasePrice);	
		}
		else{
			$_SESSION['strShopError'] = '<b>Error:</b> You don\'t have enough gold for this purchase.';
		}
	}	
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>