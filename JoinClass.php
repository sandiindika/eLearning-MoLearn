<?php
	require 'connectdb.php';
	session_start();
	$class = $_GET['class_id'];
	include 'upData.inc';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Join Class</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<?php 
			$statement = $dbc -> prepare ("SELECT * FROM kelas k WHERE k.ID_KELAS NOT IN (SELECT ID_KELAS FROM masuk m WHERE m.NIM = '".$_SESSION['nim']."')");
			$statement -> execute();

			foreach ($statement as $key) {
				echo "<div class=\"boxFile\">
						<span class=\"nameFile\">{$key['NAMA_KELAS']}</span>
						<span class=\"desc\">( {$key['DESKRIPSI_KELAS']} )</span>
						<a href=\"./JoinClass.php?class_id="."{$key['ID_KELAS']}"."&gabung=1\">Gabung</a>
					</div>"; #gabungnya nge add kelas ke kelas-saya.kalo bisa ada pop up kalo sudah bergabung ke kelas tsb
			}
		?>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>