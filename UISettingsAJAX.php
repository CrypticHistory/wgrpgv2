<?php
	if(isset($_POST['action'])){
		$action = $_POST['action'];
		switch($action){
			case 'setInventoryFrame' : setInventoryFrame(); break;
			default: break;
		}
	}
	
	function setInventoryFrame(){
		include_once "UISettings.class";
		session_start();
		$_SESSION['objUISettings']->setInventoryFrame($_POST['strInventoryFrame']);
	}
	
?>