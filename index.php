<?php
	session_start();
	include 'connectdb.php';
	include 'auth.inc';
	include 'upData.inc';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<script type="text/javascript" src="./javascript.js"></script>
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
		<!-- Cek kondisi sudah login atau tidak -->
		<?php
			if (isset($_SESSION['isTeacher'])){
		?>
			<table class="table1">
				<tr>
					<th><a href="./addClass.php" class="create" title="Add Class">+</a>Class</th>
					<th>Action</th>
				</tr>
				<?php
					try{
						$nip = $_SESSION['nip'];

						$statement = $dbc->query("SELECT * FROM kelas WHERE NIP = $nip");

						foreach ($statement as $data){
				?>
							<tr>
								<td><a href='./detailClass.php?class_id=<?php echo "{$data["ID_KELAS"]}" ?>'><?php echo "{$data['NAMA_KELAS']}" ?></a></td>
								<td><a href='./editClass.php?class_id=<?php echo "{$data["ID_KELAS"]}" ?>' class="edit" title="Edit Class">Edit</a> <a href='./delete.php?class_id=<?php echo "{$data["ID_KELAS"]}" ?>&delete=1' class="delete" title="Delete Class">Delete</a></td>
							</tr>
				<?php
						}
					}
					catch(PDOException $err){
							echo "Koneksi bermasalah. ".$err->getMessage();
					}	
				?>
			</table>	
		<?php
			}
			else if(isset($_SESSION['isStudent'])){
		?>
			<table class="table2">
				<tr>
					<th colspan="3">Kelas saya</th>
				</tr>
				<?php
				$statement2 = $dbc->query("SELECT s.NIM, s.NAMA_STUDENT, m.ID_KELAS, k.NAMA_KELAS, t.NAMA_TEACHERS FROM masuk m, kelas k, student s, teacher t WHERE m.NIM = ".$_SESSION['nim']." AND m.NIM = s.NIM AND m.ID_KELAS = k.ID_KELAS AND t.NIP = k.NIP");
				$n = 1;
				foreach ($statement2 as $data){
					if ($n%3==1) {
						echo"<tr>";
					}
					echo "<td class=\"td\">";
					echo "
						<div class=\"square\">
							<img src=\"./assets/img/kelas.png\" class=\"gambar\"><br>
							<a href=\"./detailClass.php?class_id="."{$data['ID_KELAS']}"."\">"
							."{$data['NAMA_KELAS']}". #diubah sesuai banyaknya data kelas. foreach
							"</a><br>".
							"{$data['NAMA_TEACHERS']}".
						"</div>
					"; #Nama Guru diubah sesuai nama guru di kelas tsb
					echo "</td>";
					if ($n%3==0) {
						echo "</tr>";
					}

					$n++;
				}
				?>

				<tr>
					<td colspan="3">
						<div class="tombol">
							<a href="JoinClass.php">
								+<br>
								Gabung Kelas
							</a>
						</div>	
					</td>
				</tr>
			</table>
			<br>	
		<?php
			}
			else{
		?>
				<div class="thumb">
					<img src="./assets/img/thumbnail.jpg">
					<div class="box">
						<div class="left">
							<span>Learn with flexibility</span>
						</div>
						<div class="right">
							<span>W h e n e v e r</span>
							<span>W h e r e e v e r</span>
							<span>W h a t e v e r</span>
						</div>
					</div>
				</div>
				<div class="home-login">
					<h2>Login</h2>
					<form action="" method="post" onsubmit="return validateForm()">
						<div class="radioOption">
							<input type="radio" name="optionLogin" id="student" value="student" onclick="optionCek(this)" checked>
							<label for="student">Student</label>

							<input type="radio" name="optionLogin" id="teacher" value="teacher" onclick="optionCek(this)">
							<label for="teacher">Teacher</label>
						</div>
						<div class="clear"></div>

						<input type="text" name="nim" id="user" placeholder="NIM">
						<input type="password" id="password" name="password" placeholder="Password">
						<div class="clear"></div>
						<input type="checkbox" onclick="showps()">Show Password
						<div class="clear"></div>
						<input type="submit" name="login" value="Login">
						<div class="clear"></div>
						<span>Not registered? Please, click <a href="./register.php">here</a></span>
					</form>
				</div>
		<?php
			}
		?>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>

