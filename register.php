<?php
	session_start();
	include "upData.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="./javascript.js"></script>
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<div class="register">
			<h2>Register Account</h2>
			<form action="" method="post" onsubmit="return validateReg()">
				<div class="radioOption">
					<input type="radio" name="optionLogin" id="student" value="student" onclick="optionCek(this)" checked>
					<label for="student">Student</label>

					<input type="radio" name="optionLogin" id="teacher" value="teacher" onclick="optionCek(this)">
					<label for="teacher">Teacher</label>
				</div>
				<div class="clear"></div>

				<input type="text" name="firstname" id="firstname" placeholder="First name" required>
				<input type="text" name="lastname" id="lastname" placeholder="Last name" required>
				<input type="text" name="nim" id="user" placeholder="NIM" required>
				<input type="text" name="email" id="email" placeholder="Email" required>
				<input type="text" name="cf_email" id="cf_email" placeholder="Email confirmation" required>
				<input type="password" id="password" name="password" placeholder="Password" required>
				<input type="password" id="cf_password" name="cf_password" placeholder="Password confirmation" required>
				<div class="clear"></div>
				<input type="submit" name="register" value="Register">
				<div class="clear"></div>
				<span>Already have an account? <a href="./login.php">login</a></span>
			</form>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>

