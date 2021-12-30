<?php
	session_start();
	include "upData.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript">
		function optionCek(element){
			var change = document.getElementById('user');
			if(element.value == "student"){
				change.name = 'nim';
				change.placeholder = 'NIM';
				element.checked;
			}
			else{
				change.name = 'nip';
				change.placeholder = 'NIP';
				element.checked;
			}
		}
	</script>
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<div class="register">
			<div class="editPofile">
			<h2>Edit Profile</h2>
			<form action="" id="editProfile" method="post" enctype="multipart/form-data" accept="image/*">
				<?php
					try{
						include 'connectdb.php';
						if(isset($_SESSION['nip'])){
							$nip = $_SESSION['nip'];
							$statement = $dbc->query("SELECT * FROM teacher WHERE NIP = '".$nip."'");
						}
						else{
							$nim = $_SESSION['nim'];
							$statement = $dbc->query("SELECT * FROM student WHERE NIM = '".$nim."'");
						}

						foreach ($statement as $data){
						if(isset($_SESSION['nip'])){
				?>
							<input type="text" name="nama" id="nama" placeholder="Your Name" value='<?php echo "{$data["NAMA_TEACHERS"]}" ?>'>
				<?php
						}
						else{
				?>
							<input type="text" name="nama" id="nama" placeholder="Your Name" value='<?php echo "{$data["NAMA_STUDENT"]}" ?>'>
				<?php
						}
				?>
				<input type="text" name="email" id="email" placeholder="Your Email"value='<?php echo "{$data["EMAIL"]}" ?>'>
				<textarea name="alamat" form="editProfile" placeholder="Your Address..."><?php echo "{$data["ALAMAT"]}" ?></textarea>
				<input type="hidden" name="tempPict" value='<?php echo "{$data["FOTO"]}" ?>'>
				<?php
						}
					}
					catch(PDOException $err){
							echo "Koneksi bermasalah. ".$err->getMessage();
					}	
				?>
				<p>Photo Profile</p>
				<input type="file" name="photo" id="photo" value="Choose File">
				<div class="clear"></div>
				<input type="submit" name="updateProfile" value="Update Profile">
				<div class="clear"></div>
			</div>
			</form>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>

