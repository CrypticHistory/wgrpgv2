<?php

	include_once 'RPGCharacter.class';
	include_once 'UISettings.class';
	
	session_start();

	if(isset($_POST['changeTo'])){
		$_SESSION['objUISettings']->setEventFrame('StatGain');
		$_SESSION['objUISettings']->setCommandsFrame('Return');
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>