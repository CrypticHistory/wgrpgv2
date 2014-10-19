<?php

include_once "header.php";

echo "<div class='mainWindow'><div class='content'>";

	if(!empty($_POST)){
		$objCharacter = new RPGCharacter();
		$objCharacter->createNewCharacter($_SESSION['objUser']->getStringUserID(), $_POST['strRPGCharacterName']);
		$_SESSION['objRPGCharacter'] = $objCharacter;
		header('Location: main.php?page=DisplayGameUI');
		exit;
	}
	else{
		echo 'you do not have permission to view this page';
	}
	
echo "</div></div>";

include_once "footer.php";

?>