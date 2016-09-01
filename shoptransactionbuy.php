<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	include_once "RPGItem.php";
	
	session_start();

	$intPlayerGold = $_SESSION['objRPGCharacter']->getGold();
	$intPurchasePrice = 0;
	$arrItemsPurchased = array();
	
	for($i=0; $i<count($_POST['itemID']);$i++){
		$intPurchasePrice += $_POST['price'][$i] * $_POST['quantity'][$i];
		$tmpItem = new RPGItem($_POST['itemID'][$i]);
		if(isset($_POST['size'][$i])){
			$tmpItem->setSize($_POST['size'][$i]);
		}
		$tmpItem->setQuantity($_POST['quantity'][$i]);
		$arrItemsPurchased[] = $tmpItem;
	}
	
	if($intPlayerGold >= $intPurchasePrice){
		foreach($arrItemsPurchased as $objItem){
			for($i=0;$i<$objItem->getQuantity();$i++){
				$_SESSION['objRPGCharacter']->giveItem($objItem->getItemID(), $objItem->getSize());
			}
		}
		$_SESSION['objRPGCharacter']->setGold($_SESSION['objRPGCharacter']->getGold() - $intPurchasePrice);
	}
	else{
		$_SESSION['strShopError'] = '<b>Error:</b> You don\'t have enough gold for this purchase.';
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>