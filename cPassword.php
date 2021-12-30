<?php
	session_start();
	require "adminPermission.inc";
	include "upData.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="./javascript.js"></script>
</script>
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<div class="login">
			<h2>Change Password</h2>

			<form action="" method="post" onsubmit="return validateCP()">
				<input type="password" id="cr_password" name="cr_password" placeholder="Current Password">
				<input type="password" id="n_password" name="n_password" placeholder="New Password">
				<input type="password" id="cf_password" name="cf_password" placeholder="Confirm Password">
				<div class="clear"></div>

				<input type="submit" name="changePass" value="Change Password">
				<div class="clear"></div>
			</form>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>