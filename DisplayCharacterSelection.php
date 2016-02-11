<?php include_once "header.php"; ?>

<div class='mainWindow'>
	<div class='content'>
		<form action='main.php?page=DisplayGameUI' method='post'>
			Existing Character: 
			<select name='strCharacterName'>
			<?php
				$arrCharacters = $_SESSION['objUser']->getCharacterList();
				foreach($arrCharacters as $key => $strCharacterName){
					echo "<option value='" . $key . "'>" . $strCharacterName . " - Character ID #" . $key . "</option>";
				}
			?>
			</select>
			<input type='submit' value='Load' <?=(empty($arrCharacters) ? "disabled" : "")?>/>
		</form>
		<br/>

		<a href='DisplayCharacterCreation.php'><u>New Character</u></a>
	</div>
</div>

<?php include_once "footer.php"; ?>