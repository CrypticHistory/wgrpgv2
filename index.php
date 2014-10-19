<?php include_once "header.php"; ?>
	<div class='mainWindow'>
		<div class='content'>
			<?php
				if(isset($_SESSION['objUser']) && $_SESSION['objUser']->getAdmin()){
					echo "<form action='createThread.php' method='post'>";
					echo "<b>New Thread</b><br/>";
					echo "Subject: <input type='text' id='blogSubject' name='strSubject'/><br/>";
					echo "<textarea rows='10' cols='75' name='txtContents'></textarea><br/>";
					echo "<input class='blogButton' type='submit' value='Submit'/>";
					echo "</form>";
					echo "<br/><br/>";
				}
			
				$arrThreads = getAllThreads();
				foreach($arrThreads as $key => $arrColumns){
					echo "<table class='blogPost'><tr><td><div class='blogHeader'>" . $arrColumns['strSubject'] . "</div>";
					echo " - Posted by <b>" . $arrColumns['strUserID'] . "</b> on <b>" . date('F d Y', strtotime($arrColumns['dtmCreatedOn'])) . "</b></td></tr>";
					echo "<tr><td><div class='blogPostContents'>" . nl2br($arrColumns['txtContents']) . "</div></td></tr></table><hr/>";
				}
			?>
		</div>
	</div>
<?php include_once "footer.php";

	function getAllThreads(){
		$arrReturn = array();
		$objDB = new Database;
		$strSQL = "SELECT intPostID, strUserID, strSubject, txtContents, dtmCreatedOn
					FROM tblpost
					WHERE intParentID IS NULL";
		$rsResult = $objDB->query($strSQL);
		$intCounter = 0;
		while($arrRow = $rsResult->fetch(PDO::FETCH_ASSOC)){
			$arrReturn[$intCounter]['intPostID'] = $arrRow['intPostID'];
			$arrReturn[$intCounter]['strUserID'] = $arrRow['strUserID'];
			$arrReturn[$intCounter]['strSubject'] = $arrRow['strSubject'];
			$arrReturn[$intCounter]['txtContents'] = $arrRow['txtContents'];
			$arrReturn[$intCounter]['dtmCreatedOn'] = $arrRow['dtmCreatedOn'];
			$intCounter++;
		}
		return $arrReturn;
	}

?>