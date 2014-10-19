<?php

require_once('Database.class');
require_once('users.php');

if ($_POST){
	$arrUserFields = array('strUserID','strPassword','strRepeatPassword');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $arrUserFields) === true) {
			$arrErrors[] = 'fields not filled out properly';
			break 1;
		}
	}
	
	if (empty($arrErrors) === true) {
		if (user_exists($_POST['strUserID']) === true) {
			$arrErrors[] = 'sorry username exists';
		}
		
		if (strlen($_POST['strPassword']) < 6) {
			$arrErrors[] = 'password must be 7';
		}
		
		if ($_POST['strPassword'] !== $_POST['strRepeatPassword']) {
			$arrErrors[] = 'passwords dont match';
		}
		
		if(empty($arrErrors) === true){
			$arrRegisterData = array(
				'strUserID' => $_POST['strUserID'],
				'strPassword' => $_POST['strPassword'],
				'dtmCreatedOn' => date('Y-m-d H:i:s'),
				'strCreatedBy' => 'system'
			);
			register_user($arrRegisterData);
			echo "Registered<br/><a href='index.php'>Go Back</a>";
		}
		else{
			print_r($arrErrors);
		}
	}
	else{
		print_r($arrErrors);
	}
}
else{

?>
<!DOCTYPE html>
<html>
	<head>
		<title>WGRPG</title>
	</head>
	<body>
		<form action="" method="post">
			<ul>
				<h2>Register</h2>
				<li>Username:</li>
				<li><input type="text" id="userIDTextField" name="strUserID"></li>
				<li>Password:</li>
				<li><input type="password" name="strPassword"></li>
				<li>Confirm Password:</li>
				<li><input type="password" name="strRepeatPassword"></li>
				<li><input type="submit" value="Submit"></li>
			</ul>
		</form>
	</body>
</html>
<?php
}
?>