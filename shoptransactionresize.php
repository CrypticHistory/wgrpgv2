<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	include_once "RPGItem.php";
	
	session_start();

	if(isset($_POST['itemInstanceID']) && $_SESSION['objRPGCharacter']->hasItem($_POST['itemInstanceID'])){
		$intPlayerGold = $_SESSION['objRPGCharacter']->getGold();
		$intPurchasePrice = $_POST['itemSellPrice'];
		$strSize = $_POST['itemSize'];
		$objItem = new RPGItem(null, $_POST['itemInstanceID']);
		$objItem->loadArmourStatus();
		
		if($strSize == $objItem->getSize()){
			$_SESSION['strShopError'] = '<b>Error:</b> Your item is already that size.';
		}
		else{
			if($intPlayerGold >= $intPurchasePrice){
				$_SESSION['objRPGCharacter']->resizeItem($_POST['itemInstanceID'], $strSize);
				$_SESSION['objRPGCharacter']->setGold($_SESSION['objRPGCharacter']->getGold() - $intPurchasePrice);	
			}
			else{
				$_SESSION['strShopError'] = '<b>Error:</b> You don\'t have enough gold for this purchase.';
			}
		}
	}	
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>