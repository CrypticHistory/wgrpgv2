<?php include_once "header.php"; ?>

<script>
	function checkDelete(){
		if(!confirm("Are you sure you want to delete this character?")){
			return false;
		}
		else{
			$('#deleteButton').prop('type', 'submit');
		}
	}
</script>

<div class='mainWindow'>
	<div class='content'>
		<hr/>
		<br/>
		<form id='charForm' action='character.php' method='post'>
			Existing Character: 
			<select name='strCharacterName'>
			<?php
				$arrCharacters = $_SESSION['objUser']->getCharacterList();
				foreach($arrCharacters as $key => $strCharacterName){
					echo "<option value='" . $key . "'>" . $strCharacterName . " - Character ID #" . $key . "</option>";
				}
			?>
			</select>
			<input type='submit' name='charAction' value='Load' <?=(empty($arrCharacters) ? "disabled" : "")?>/>
			<input type='button' id='deleteButton' onclick='checkDelete()' name='charAction' value='Delete' <?=(empty($arrCharacters) ? "disabled" : "")?>/>
		</form>
		<br/>

		<a href='DisplayCharacterCreation.php'><u>New Character</u></a>
	</div>
</div>

<?php include_once "footer.php"; ?>