<?php

include_once "header.php";

echo "<div class='mainWindow'>";
echo "<div class='content'>";
echo "<hr/>";

if ($_POST){
	$arrUserFields = array('strUserID','strPassword','strRepeatPassword');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $arrUserFields) === true) {
			$arrErrors[] = 'Fields not filled out properly.';
			break 1;
		}
	}
	
	if (empty($arrErrors) === true) {
		if (user_exists($_POST['strUserID'])) {
			$arrErrors[] = 'Error: That username already exists.';
		}
		
		if (strlen($_POST['strPassword']) < 6) {
			$arrErrors[] = 'Error: Password must be at least 7 characters.';
		}
		
		if ($_POST['strPassword'] !== $_POST['strRepeatPassword']) {
			$arrErrors[] = 'Error: Passwords dont match.';
		}
		
		if(empty($arrErrors) === true){
			$arrRegisterData = array(
				'strUserID' => $_POST['strUserID'],
				'strPassword' => $_POST['strPassword'],
				'dtmCreatedOn' => date('Y-m-d H:i:s'),
				'strCreatedBy' => 'system'
			);
			register_user($arrRegisterData);
			echo "Registered successfully. You may now log in.";
		}
		else{
			foreach($arrErrors as $key => $value){
				echo $value . "<br/>";
			}
			echo "<u><a href='register.php'>Try again.</a></u>";
		}
	}
	else{
		foreach($arrErrors as $key => $value){
			echo $value . "<br/>";
		}
		echo "<u><a href='register.php'>Try again.</a></u>";
	}
}
else{

?>

<form action="" method="post">
	<ul>
		<h2>Register</h2>
		<li class='noBullet'>Username:</li>
		<li class='noBullet'><input type="text" id="userIDTextField" name="strUserID"></li>
		<li class='noBullet'>Password:</li>
		<li class='noBullet'><input type="password" name="strPassword"></li>
		<li class='noBullet'>Confirm Password:</li>
		<li class='noBullet'><input type="password" name="strRepeatPassword"></li>
		<li class='noBullet'><input type="submit" value="Submit"></li>
	</ul>
</form>

<?php
}
echo "</div></div>";
include_once "footer.php";
?>