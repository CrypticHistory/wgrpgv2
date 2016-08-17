<?php

include_once "Database.php";
include_once 'constants.php';
include_once "common.php";
include_once "users.php";
include_once "RPGUser.php";
include_once "RPGCharacter.php";
@session_start();

if ($_POST){
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
			
	if(!empty($arrErrors)){
		include_once "header.php";

		echo "<div class='mainWindow'>";
		echo "<div class='content'>";
		echo "<hr/>";
		foreach($arrErrors as $key => $value){
			echo $value . "<br/>";
		}
	}
	else{
		include_once "header.php";

		echo "<div class='mainWindow'>";
		echo "<div class='content'>";
		echo "<hr/><br/>Welcome, " . $_SESSION['objUser']->getStringUserID() . "! Press \"Play\" again and you will be taken to the character selection/creation screen.";
	}
}
else{
	
include_once "header.php";

echo "<div class='mainWindow'>";
echo "<div class='content'>";

?>
<hr/>
<form action='login.php' method='post'>
	<ul>
	<h2>Login</h2>
	<table>
		<tr><td>Username:</td><td><input class='useridInput' type='text' name='strUserID' size='45'/></td></tr>
		<tr><td>Password:</td><td><input type='password' class='passwordInput' name='strPassword' size='45'/></td></tr>
		<tr><td><input class='blogbutton' type='submit' value='Login'/></td></tr>
	</table>
	<br/>
	No account? <a href="register.php"><u>Register here.</u></a>
	</ul>
</form>
<?php
}
echo "</div></div>";
include_once "footer.php";
?>