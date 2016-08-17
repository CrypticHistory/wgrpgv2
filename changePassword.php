<?php
	
include_once "users.php";
include_once "header.php";

echo "<div class='mainWindow'>";
echo "<div class='content'>";
echo "<hr/>";
	
if ($_POST){
	$arrUserFields = array('strUserID','strPassword','strRepeatPassword');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $arrUserFields) === true) {
			$arrErrors[] = 'Error: Fields not filled out properly.';
			break 1;
		}
	}
	if (strlen($_POST['strPassword']) < 6) {
		$arrErrors[] = 'Error: Password must be at least 7 characters. ';
	}
		
	if ($_POST['strPassword'] !== $_POST['strRepeatPassword']) {
		$arrErrors[] = 'Error: Passwords dont match. ';
	}

	if(empty($arrErrors)){
		changePassword($_POST['strPassword']);
		echo "Changed password successfully";
	}
	else{
		foreach($arrErrors as $key => $value){
			echo $value;
		}
	}
}
else{
	echo "You do not have permission to view this page.";
}

echo "</div></div>";

include_once "footer.php";

?>