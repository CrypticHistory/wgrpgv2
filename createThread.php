<?php
	include_once "header.php";
	
	if(isset($_POST) && isset($_SESSION['objUser'])){
		$objBlogPost = new BlogPost();
		$objBlogPost->createNewPost($_SESSION['objUser']->getStringUserID(), $_POST['strSubject'], $_POST['txtContents'], NULL);
		// header("Location: index.php");
	}
	else{
		$strError = 'Error creating post';
	}
	
	?>
	
	<div class='mainWindow'>
		<div class='content'>
			<?=isset($strError) ? $strError : ""?>
		</div>
	</div>

<?php	
	include_once "footer.php";
?>