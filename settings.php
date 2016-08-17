<?php include_once 'header.php'; ?>

<div class='mainWindow'>
	<div class='content'>
		<hr/>
		<form action="changePassword.php" method="post">
			<ul>
				<h2>User Settings</h2>
				<li class='noBullet'>Change Password:</li>
				<li class='noBullet'><input type="password" name="strPassword"></li>
				<li class='noBullet'>Confirm New Password:</li>
				<li class='noBullet'><input type="password" name="strRepeatPassword"></li>
				<li class='noBullet'><input class='blogbutton' type="submit" value="Save"></li>
			</ul>
		</form>
	</div>
</div>

<?php include_once 'footer.php'; ?>