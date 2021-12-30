<?php
	session_start();
	include "auth.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="./javascript.js"></script>
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<div class="login">
			<h2>Login</h2>
			<?php
				if (isset($_GET['error'])){
					echo "<p>* Login failed! *</p>";
				}
			?>
			<form action="" method="post" onsubmit="return validateForm()">
				<div class="radioOption">
					<input type="radio" name="optionLogin" id="student" value="student" onclick="optionCek(this)" checked>
					<label for="student">Student</label>

					<input type="radio" name="optionLogin" id="teacher" value="teacher" onclick="optionCek(this)">
					<label for="teacher">Teacher</label>
				</div>
				<div class="clear"></div>
				
				<input type="text" name="nim" id="user" placeholder="NIM" required>
				<input type="password" id="password" name="password" placeholder="Password" required>
				<div class="clear"></div>
				<input type="checkbox" onclick="showps()">Show Password
				<div class="clear"></div>
				<input type="submit" name="login" value="Login">
				<div class="clear"></div>
				<span>Not registered? Please, click <a href="./register.php">here</a></span>
			</form>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>