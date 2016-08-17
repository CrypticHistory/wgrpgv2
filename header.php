<?php 

include_once "Database.php";
include_once 'constants.php';
include_once "common.php";
include_once "users.php";
include_once "RPGUser.php";
include_once "RPGCharacter.php";

@session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>WGRPG</title>
		<link rel="stylesheet" type="text/css" href="main.css" media="screen" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="JS/jquery.numeric.js" type="text/javascript"></script>
		<?php header('Content-Type: text/html; charset=ISO-8859-15');?>
	</head>
	<body>
		<div class='topWindow'>
			<div class='logo'>
				Turris Puesco
			</div>
		</div>
		<div class='navigationBar'>
			<hr class='cutShort'/>
			<a href="index.php">[ Home ]</a> <a href="about.php">[ About ]</a> <a href="http://www.weightgaming.com/forum/index.php?board=17.0">[ Forum ]</a> <a href="<?=(!isset($_SESSION['objUser']) ? "login.php" : "DisplayCharacterSelection.php")?>">[ Play ]</a><?php if(isset($_SESSION['objUser'])){?> <br/>Logged in as <?=$_SESSION['objUser']->getStringUserID()?>.<br/><a href="settings.php">[ Settings ]</a> <a href="logout.php">[ Logout ]</a><?php } ?>
		</div>