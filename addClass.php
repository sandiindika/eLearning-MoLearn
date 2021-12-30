<?php
	session_start();
	include "upData.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<div class="register">
			<h2>Add Class</h2>
			<form action="" id="form_addClass" method="post">
				<input type="text" name="nama_kelas" id="nama_kelas" placeholder="Name Class">
				<textarea name="deskripsi_kelas" form="form_addClass" placeholder="Description the Class here...."></textarea>
				<div class="clear"></div>
				<input type="submit" name="addClass" value="Add Class">
				<div class="clear"></div>
			</form>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>

