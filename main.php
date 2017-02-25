<?php
	require_once 'constants.php';
	require_once 'common.php';
	require_once "Database.php";
	require_once 'users.php';
	require_once 'RPGUser.php';
	//error_reporting(E_ALL);
	//ini_set('display_errors', 1);
	$blnPageFlag = false;
	$blnGameDown = false;
	
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
		<meta charset="UTF-8"/>
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
		<script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/datatables.min.js"></script>
		<link rel="stylesheet" type="text/css" href="JS/DataTables/css/dataTables.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
		<?php header('Content-Type: text/html; charset=ISO-8859-15');
		if(!$blnGameDown || $_SESSION['objUser']->getAdmin()){
			if($blnPageFlag){
				$objPage = new $_GET['page']();
				$objPage->toJavascript();
			}
		}
		?>
	</head>
	<body>
		<?php
		if(!$blnGameDown || $_SESSION['objUser']->getAdmin()){
			if($blnPageFlag){
				$objPage->toHTML();
			}
			else{
				print_r("You do not have permission to view this page");
			}			
		}
		else{
			print_r("The game has been taken down for maintenance. Please check back later.");
		}
		?>
	</body>
</html>