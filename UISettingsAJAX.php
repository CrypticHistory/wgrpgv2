<?php
	if(isset($_POST['action'])){
		$action = $_POST['action'];
		switch($action){
			case 'setInventoryFrame' : setInventoryFrame(); break;
			case 'setCharacterFrame' : setCharacterFrame(); break;
			case 'setQuestTab' : setQuestTab(); break;
			case 'setClassTab' : setClassTab(); break;
			default: break;
		}
	}
	
	function setInventoryFrame(){
		include_once "UISettings.php";
		session_start();
		$_SESSION['objUISettings']->setInventoryFrame($_POST['strInventoryFrame']);
	}
	
	function setCharacterFrame(){
		include_once "UISettings.php";
		session_start();
		$_SESSION['objUISettings']->setCharacterFrame($_POST['strCharacterFrame']);
	}
	
	function setQuestTab(){
		include_once "UISettings.php";
		session_start();
		$_SESSION['objUISettings']->setQuestTab($_POST['intQuestTab']);
	}
	
	function setClassTab(){
		include_once "UISettings.php";
		session_start();
		$_SESSION['objUISettings']->setClassTab($_POST['intClassTab']);
	}
	
?>