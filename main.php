<?php
	require_once 'constants.php';
	require_once 'common.php';
	require_once "Database.class";
	require_once 'users.php';
	require_once 'RPGUser.class';
	
	$blnPageFlag = false;
	
	if(isset($_GET['page']) && file_exists($_GET['page'] . ".class")){
		$blnPageFlag = true;
		include_once $_GET['page'] . ".class";
	}
	
	if(!isset($_SESSION)){
		session_start();
	}
	
?>

<html>
	<head>
		<title>WGRPG</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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