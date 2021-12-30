<?php
	session_start();
	require "adminPermission.inc";
	$idClass = $_GET['class_id'];
	include "upData.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Class</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<div class="classContent">
			<div class="editClass">
				<h2>Edit Class</h2>
				<hr></hr>
				<form action="" id="form_editClass" method="post">
					<?php
						try{
							$nip = $_SESSION['nip'];
							include 'connectdb.php';

							$statement = $dbc->query("SELECT * FROM kelas WHERE NIP = '".$nip."' AND ID_KELAS = '".$idClass."'");
							foreach ($statement as $data){
					?>
					
						<input type="text" name="name_class" id="name_class" placeholder="Name Class" value='<?php echo "{$data["NAMA_KELAS"]}" ?>'>
						<br><br>
						<textarea name="deskripsi_kelas" form="form_editClass" placeholder="Description the Class here...."><?php echo "{$data["DESKRIPSI_KELAS"]}" ?></textarea>
						<br><br>
						<input type="hidden" name="idClass" value="<?php echo $idClass ?>">
						<input type="submit" name="updateClass" value="U P D A T E">
					
					<?php
						}
					?>
				</form>
			</div>
			<hr class="edit">
			<div class="memberClass">
					<h2>Member</h2>
					<hr></hr>
					<?php
						$statement2 = $dbc->query("SELECT  s.NIM, s.NAMA_STUDENT, s.FOTO, m.ID_KELAS  FROM student s, masuk m WHERE s.NIM = m.NIM AND ID_KELAS = '".$idClass."'");
						foreach ($statement2 as $data){
					?>
					<div class="member">
						<div class="imgFrame">
							<?php
								$foto = ""."{$data["FOTO"]}";
								if($foto == ''){
									echo "<img src='./assets/img/default.jpg'>";
								}
								else{
									echo "<img src='./assets/img/student/".$foto."'>";
								}
							?>
						</div>
						<p><?php echo "{$data["NAMA_STUDENT"]}" ?></p>
						<a href='./delete.php?class_id=<?php echo "{$data["ID_KELAS"]}" ?>&nim=<?php echo "{$data["NIM"]}" ?>&delete=1' title="Delete Member">X</a>
					</div>
					<?php
						}
					}
					catch(PDOException $err){
							echo "Koneksi bermasalah. ".$err->getMessage();
					}	
				?>
				</div>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>