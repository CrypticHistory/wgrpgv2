<?php include_once "header.php"; ?>
	<script type='text/javascript'>
		$(document).ready(function(){
			$('.blogPostContents').dotdotdot({
				after: "a.readmore"
			});
		});
		
		function showMore(intPostID){
			var content = $('#blogPost' + intPostID).triggerHandler('originalContent');
			$('#blogPost' + intPostID).removeClass('blogPostContents');
			$('#blogPost' + intPostID).text('');
			$('#blogPost' + intPostID).append(content);
			$('#readmore' + intPostID).hide();
		}
	</script>

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
				
				if(isset($_GET['page'])){
					$endThread = $_GET['page'] * 5;
					$startThread = $endThread - 5;
				}
				else{
					$endThread = 5;
					$startThread = 0;
				}
			
				$arrThreads = getAllThreads($startThread, $endThread);
				foreach($arrThreads as $key => $arrColumns){
					echo "<table class='blogPost'><tr><td><div class='blogHeader'>" . $arrColumns['strSubject'] . "</div>";
					echo " - Posted by <b>" . $arrColumns['strUserID'] . "</b> on <b>" . date('F d Y', strtotime($arrColumns['dtmCreatedOn'])) . "</b></td></tr>";
					echo "<tr><td><div class='blogPostContents' id='blogPost" . $arrColumns['intPostID'] . "'>" . nl2br($arrColumns['txtContents']) . "<a class='readmore' id='readmore" . $arrColumns['intPostID'] . "' href='javascript:showMore(" . $arrColumns['intPostID'] . ");'>Read More</a></div></td></tr></table><hr/>";
				}
				
				echo "<center><a href='index.php?page=" . (isset($_GET['page']) && $_GET['page'] != 1 ? $_GET['page'] - 1 : 1) . "'>< View Newer Posts</a> | ";
				echo "<a href='index.php?page=" . (isset($_GET['page']) ? $_GET['page'] + 1 : 2) . "'>View Older Posts ></a></center>";
			?>
		</div>
	</div>
<?php include_once "footer.php";

	function getAllThreads($startThread, $endThread){
		$arrReturn = array();
		$objDB = new Database;
		$strSQL = "SELECT intPostID, strUserID, strSubject, txtContents, dtmCreatedOn
					FROM tblpost
					WHERE intParentID IS NULL
					ORDER BY dtmCreatedOn DESC
					LIMIT " . $startThread . ", " . $endThread;
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