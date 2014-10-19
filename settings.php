<?php include_once 'header.php'; ?>

<div class='mainWindow'>
	<div class='content'>
		<form action="changePassword.php" method="post">
			<ul>
				<h2>User Settings</h2>
				<li>Change Password:</li>
				<li><input type="password" name="strPassword"></li>
				<li>Confirm New Password:</li>
				<li><input type="password" name="strRepeatPassword"></li>
				<li><input class='blogbutton' type="submit" value="Save"></li>
			</ul>
		</form>
	</div>
</div>

<?php include_once 'footer.php'; ?>