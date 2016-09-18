<?php

include_once "header.php";
include_once "UISettings.php";

echo "<div class='mainWindow'><div class='content'>";

	if(!empty($_POST)){
		$intHeight = getHeightInCM($_POST['intHeightFeet'], $_POST['intHeightInches']);
		if($intHeight > 220){
			$intHeight = 220;
		}
		else if($intHeight < 120){
			$intHeight = 120;
		}
		if($_POST['dblWeight'] < 64){
			$_POST['dblWeight'] = 64;
		}
		else if($_POST['dblWeight'] > 193){
			$_POST['dblWeight'] = 193;
		}
		if($_POST['intLegs'] > 5){
			$_POST['intLegs'] = 5;
		}
		else if($_POST['intLegs'] < 0){
			$_POST['intLegs'] = 0;
		}
		if($_POST['intArms'] > 5){
			$_POST['intArms'] = 5;
		}
		else if($_POST['intArms'] < 0){
			$_POST['intArms'] = 0;
		}
		if($_POST['intButt'] > 5){
			$_POST['intButt'] = 5;
		}
		else if($_POST['intButt'] < 0){
			$_POST['intButt'] = 0;
		}
		if($_POST['intBelly'] > 5){
			$_POST['intBelly'] = 5;
		}
		else if($_POST['intBelly'] < 0){
			$_POST['intBelly'] = 0;
		}
		if($_POST['intBreasts'] > 5){
			$_POST['intBreasts'] = 5;
		}
		else if($_POST['intBreasts'] < 0){
			$_POST['intBreasts'] = 0;
		}
		if($_POST['intFace'] > 5){
			$_POST['intFace'] = 5;
		}
		else if($_POST['intFace'] < 0){
			$_POST['intFace'] = 0;
		}
		$objCharacter = new RPGCharacter();
		$objCharacter->createNewCharacter($_SESSION['objUser']->getStringUserID(), $_POST['strRPGCharacterName'], $_POST['dblWeight'], $intHeight, $_POST['strGender'], $_POST['strOrientation'], $_POST['strPersonality'], $_POST['blnLikesFatSelf'], $_POST['blnLikesFatOthers'], $_POST['strHairColour'], $_POST['strHairLength'], $_POST['strEyeColour'], $_POST['strEthnicity'], $_POST['intFace'], $_POST['intBelly'], $_POST['intBreasts'], $_POST['intArms'], $_POST['intLegs'], $_POST['intButt']);
		$_SESSION['objRPGCharacter'] = $objCharacter;
		unset($_SESSION['objUISettings']);
		unset($_SESSION['objEnemy']);
		unset($_SESSION['objRelationship']);
		unset($_SESSION['objCombat']);
		$_SESSION['objUISettings'] = new UISettings($objCharacter->getRPGCharacterID());
		header('Location: main.php?page=DisplayGameUI');
		exit;
	}
	else{
		echo 'you do not have permission to view this page';
	}
	
echo "</div></div>";

include_once "footer.php";

?>