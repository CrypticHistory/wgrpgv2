<?php

	include_once 'DialogConditionFactory.class';
	include_once 'RPGUser.class';
	include_once 'RPGCharacter.class';
	include_once 'RPGNPC.class';
	include_once 'UISettings.class';
	
	session_start();

	if(isset($_POST['command'])){
		$_SESSION['objRPGCharacter']->setEventNodeID($_POST['command']);
		if(isset($_POST['eventAction' . $_POST['command']])){
			DialogConditionFactory::evaluateAction($_POST['eventAction' . $_POST['command']]);
		}
	}
	
	header('Location: main.php?page=DisplayGameUI');
	exit;
	
?>