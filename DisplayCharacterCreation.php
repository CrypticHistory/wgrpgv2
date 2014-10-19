<?php include_once "header.php"; ?>

<div class='mainWindow'>
	<div class='content'>
		Create your character:<br/>
		
		<form action='createCharacter.php' method='post'>
			<table>
				<tr>
					<td>Name:</td>
					<td><input type='text' name='strRPGCharacterName'/></td>
				</tr>
			</table>
			<input type='submit' value='Submit'/>
		</form>
	</div>
</div>
		
<?php include_once "footer.php"; ?>