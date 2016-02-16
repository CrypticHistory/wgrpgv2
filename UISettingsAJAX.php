<?php
	if(isset($_POST['action'])){
		$action = $_POST['action'];
		switch($action){
			case 'setInventoryFrame' : setInventoryFrame(); break;
			case 'setCharacterFrame' : setCharacterFrame(); break;
			case 'setViewItemDialog' : setViewItemDialog(); break;
			default: break;
		}
	}
	
	function setInventoryFrame(){
		include_once "UISettings.class";
		session_start();
		$_SESSION['objUISettings']->setInventoryFrame($_POST['strInventoryFrame']);
	}
	
	function setCharacterFrame(){
		include_once "UISettings.class";
		session_start();
		$_SESSION['objUISettings']->setCharacterFrame($_POST['strCharacterFrame']);
	}
	
	function setViewItemDialog(){
		include_once "Database.class";
		session_start();
		if(isset($_POST['intItemID'])){
			$objDB = new Database();
			$strSQL = "SELECT strItemName, txtItemDescLong
						FROM tblitem
							WHERE intItemID = " . $_POST['intItemID'];
			$rsResult = $objDB->query($strSQL);
			$arrRow = $rsResult->fetch(PDO::FETCH_ASSOC);
			echo $arrRow['txtItemDescLong'];
		}
	}
	
?>