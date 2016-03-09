<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	
	session_start();

	if(isset($_POST['changeTo'])){
		//TODO: if statement since this always changes to stat window
		$_SESSION['objRPGCharacter']->setStateID(9);
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>