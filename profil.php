<?php
	session_start();
	include "upData.inc";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profil</title>
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
		<div class="profil">
			<h2> P R O F I L E </h2>
			<?php
					try{
						include 'connectdb.php';
						if(isset($_SESSION['nip'])){
							$nip = $_SESSION['nip'];
							$statement = $dbc->query("SELECT * FROM teacher WHERE NIP = $nip");
						}
						else{
							$nip = $_SESSION['nim'];
							$statement = $dbc->query("SELECT * FROM student WHERE NIM = $nim");
						}

						foreach ($statement as $data){
							$foto = ""."{$data['FOTO']}";
							$alamat = ""."{$data['ALAMAT']}";
							if( $foto == ''){
								echo "<img src='./assets/img/default.jpg'>";
							}
							else{
								if(isset($_SESSION['nip'])){
									echo "<img src='./assets/img/teacher/"."{$data['FOTO']}"."'>";
								}
								else{
									echo "<img src='./assets/img/student/"."{$data['FOTO']}"."'>";
								}
							}
							if(isset($_SESSION['nip'])){
			?>
								<h3>NIP</h3>
								<p> <?php echo "{$data['NIP']}" ?> </p>
								<h3>Nama</h3>
								<p> <?php echo "{$data['NAMA_TEACHERS']}" ?> </p>
						<?php
							}
							else{
						?>
								<h3>NIM</h3>
								<p> <?php echo "{$data['NIM']}" ?> </p>
								<h3>Nama</h3>
								<p> <?php echo "{$data['NAMA_STUDENT']}" ?> </p>
						<?php
							}
						?>
							<h3>Email</h3>
							<p> <?php echo "{$data['EMAIL']}" ?> </p>
							<h3>Alamat</h3>
							<?php
								if($alamat == ''){
									echo "<p> *Anda belum mengisi Alamat* </p>";
								}
								else{
									echo "<p>"."{$data['ALAMAT']}"."</p>";
								}
							?>
			<?php
						}
					}
					catch(PDOException $err){
							echo "Koneksi bermasalah. ".$err->getMessage();
					}	
			?>
		</div>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>

