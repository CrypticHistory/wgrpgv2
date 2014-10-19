<?php
	require_once "Database.class";
	require_once 'users.php';
	require_once 'RPGUser.class';
	require_once 'RPGCharacter.class';
	require_once 'RPGFloor.class';
	require_once 'RPGEvent.class';
	require_once 'RPGXMLReader.class';
	require_once "DisplayGameUI.class";
	
	if(isset($_POST['strCharacterName'])){
		$blnFirstLoad = true;
	}
	else{
		$blnFirstLoad = false;
	}
	
	session_start();
	
	if($blnFirstLoad){
		$_SESSION['objUser'] = new RPGUser($_SESSION['strUsername']);
		$_SESSION['objRPGCharacter'] = new RPGCharacter($_POST['strCharacterName']);
		$_SESSION['objPage'] = new DisplayGameUI();
	}
	var_dump($_SESSION);
	
?>

<html>
	<head>
		<title>WGRPG</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<?php header('Content-Type: text/html; charset=ISO-8859-15');
			$_SESSION['objPage']->toJavascript();
		?>
	</head>
	<body>
		<?php
			$_SESSION['objPage']->toHTML();
		?>
	</body>
</html>