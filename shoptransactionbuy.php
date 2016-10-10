<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	include_once "RPGItem.php";
	include_once "RPGShop.php";
	include_once "constants.php";
	
	session_start();

	global $arrClothingSizes;
	$intPlayerGold = $_SESSION['objRPGCharacter']->getGold();
	$intPurchasePrice = 0;
	$arrItemsPurchased = array();
	$objShop = new RPGShop($_SESSION['intLastShopID']);
	
	for($i=0; $i<count($_POST['itemID']);$i++){
		if($objShop->hasItem($_POST['itemID'][$i])){
			if($objShop->getItemPrice($_POST['itemID'][$i]) == $_POST['price'][$i]){
				$intPurchasePrice += $_POST['price'][$i] * $_POST['quantity'][$i];
				$tmpItem = new RPGItem($_POST['itemID'][$i]);
				if(isset($_POST['size'][$i]) && in_array($_POST['size'][$i], $arrClothingSizes)){
					$tmpItem->setSize($_POST['size'][$i]);
				}
				else{
					$_SESSION['strShopError'] = '<b>Error:</b> Invalid size specified for this item.';
				}
				$tmpItem->setQuantity($_POST['quantity'][$i]);
				$arrItemsPurchased[] = $tmpItem;
			}
			else{
				$_SESSION['strShopError'] = '<b>Error:</b> Invalid price specified for this item.';
			}
		}
		else{
			$_SESSION['strShopError'] = '<b>Error:</b> The item you are trying to purchase is not for sale in this shop.';
		}
	}
	
	if(!isset($_SESSION['strShopError'])){
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
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>