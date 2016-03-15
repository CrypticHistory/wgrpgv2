<?php
	require_once 'constants.php';
	require_once 'common.php';
	require_once "Database.php";
	require_once 'users.php';
	require_once 'RPGUser.php';
	
	$blnPageFlag = false;
	
	if(isset($_GET['page']) && file_exists($_GET['page'] . ".php")){
		$blnPageFlag = true;
		include_once $_GET['page'] . ".php";
	}
	
	if(!isset($_SESSION)){
		session_start();
	}
	
?>

<html>
	<head>
		<title>WGRPG</title>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
		<?php header('Content-Type: text/html; charset=ISO-8859-15');
		if($blnPageFlag){
			$objPage = new $_GET['page']();
			$objPage->toJavascript();
		}
		?>
	</head>
	<body>
		<?php
		if($blnPageFlag){
			$objPage->toHTML();
		}
		else{
			print_r("You do not have permission to view this page");
		}
		?>
	</body>
</html>