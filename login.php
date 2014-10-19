<?php
	
	include_once "header.php";
	
	$arrErrors = array();
	if(!empty($_POST)){
		$strUsername = $_POST['strUserID'];
		$strPassword = $_POST['strPassword'];
		if (empty($strUsername) === true || empty($strPassword) === true) {
			 $arrErrors[] = "Error: You need to enter a username and password";
		}
		else{
			$blnLogin = login($strUsername, $strPassword);
			
			if($blnLogin === false) {
				$arrErrors[] = 'Error: Incorrect login';
			} else {
				session_unset();
				$_SESSION['objUser'] = new RPGUser($strUsername);
			}
		}
	}
	else{
		$arrErrors[] = "Error: Access denied";
	}
	
	echo "<div class='mainWindow'>";
	echo "<div class='content'>";
			
	if(!empty($arrErrors)){
		foreach($arrErrors as $key => $value){
			echo $value . "<br/>";
		}
		echo "</div></div>";
	}
	else{
		header('Location: index.php');
		exit;
	}
	include_once "footer.php";
?>