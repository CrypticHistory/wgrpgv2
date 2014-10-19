<?php
	require_once "Database.class";
	require_once 'users.php';
	require_once 'RPGUser.class';
	session_start();
	
	$arrErrors = array();
	if(!empty($_POST)){
		$strUsername = $_POST['strUserID'];
		$strPassword = $_POST['strPassword'];
		if (empty($strUsername) === true || empty($strPassword) === true) {
			 $arrErrors[] = "You need to enter a username and password";
		}
		else{
			$blnLogin = login($strUsername, $strPassword);
			
			if($blnLogin === false) {
				$arrErrors[] = 'incorrect login';
			} else {
				session_unset();
				$_SESSION['objUser'] = new RPGUser($strUsername);
			}
		}
	}
	else{
		$arrErrors[] = "Access denied";
	}
	
	if(!empty($arrErrors)){
		foreach($arrErrors as $key => $value){
			echo $value . "<br/>";
		}
		echo "<br/><a href='index.php'>Try Again</a>";
	}
	else{
		header('Location: main.php?page=DisplayCharacterSelection');
		exit;
	}
?>