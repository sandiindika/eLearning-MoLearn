<nav>
	<a href='./'><img src='./assets/img/logo.png'></a>
	<?php
		$nama = "";
		if(count($_SESSION) > 0){
	?>
	<div class='dropdown'>
	<?php
					try{
						include "connectdb.php";

						if(isset($_SESSION['nip'])){
							$nip = $_SESSION['nip'];
							$statement = $dbc->query("SELECT * FROM teacher WHERE NIP = $nip");
						}
						else{
							$nim = $_SESSION['nim'];
							$statement = $dbc->query("SELECT * FROM student WHERE NIM = $nim");
						}

						foreach ($statement as $data){
								if(isset($_SESSION['nim'])){
									$nama = ""."{$data['NAMA_STUDENT']}";
								}
								else{
									$nama = ""."{$data['NAMA_TEACHERS']}";
								}

								$foto = ""."{$data['FOTO']}";
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
						}
					}
					catch(PDOException $err){
						echo "Koneksi bermasalah. ".$err->getMessage();
					}	
			?>
					    <div class="dropdown-content">
					    	<a href="./profil.php">My Profile</a>
					      	<a href="./editProfil.php">Edit Profil</a>
					      	<a href="./cPassword.php">Change Password</a>
					      	<a href="./logout.php">Logout</a>
					    </div>
					</div>
			<span class="nama"><?php echo $nama ?></span>
	<?php
	}
		else{
			echo "<ul>";
			echo "<li><a href='./register.php'>Register</a></li>";
			echo "<li><a href='./login.php'>Login</a></li>";
			echo "</ul>";
		}
	?>	
</nav>
<div class="clear"></div>