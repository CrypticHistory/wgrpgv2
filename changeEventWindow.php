<?php

	include_once 'RPGCharacter.class';
	include_once 'UISettings.class';
	
	session_start();

	if(isset($_POST['changeTo'])){
		//TODO: if statement since this always changes to stat window
		$_SESSION['objRPGCharacter']->setStateID(9);
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>