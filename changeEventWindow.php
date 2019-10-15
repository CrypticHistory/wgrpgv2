<?php

	include_once 'RPGCharacter.php';
	include_once 'UISettings.php';
	
	session_start();

	if(isset($_REQUEST['changeTo'])){
		$strChangeTo = $_REQUEST['changeTo'];
		if($strChangeTo == "StatGain"){
			$_SESSION['objRPGCharacter']->setStateID(9);
			header('Location: main.php?page=DisplayGameUI');
		}
		else if($strChangeTo == "SkillView"){
			$_SESSION['objRPGCharacter']->setStateID(10);
			header('Location: main.php?page=DisplayGameUI&intClassID=' . $_REQUEST['intClassID']);
		}
		else if($strChangeTo == "PartyView"){
			$_SESSION['objRPGCharacter']->setStateID(11);
			if(isset($_REQUEST['intNPCID'])){
				header('Location: main.php?page=DisplayGameUI&intNPCID=' . $_REQUEST['intNPCID']);
			}
			else{
				header('Location: main.php?page=DisplayGameUI');
			}
		}
		else{
			header('Location: main.php?page=DisplayGameUI');
		}
	}
	
	exit;
	
?>