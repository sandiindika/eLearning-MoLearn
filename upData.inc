<?php
	include 'connectdb.php';
	if (isset($_POST['register'])){
		try{
				$name = $_POST['firstname']." ".$_POST['lastname'];

				if($_POST['optionLogin'] == 'teacher'){
					$statement = $dbc->prepare("INSERT INTO `teacher`(`NIP`, `NAMA_TEACHERS`, `EMAIL`,  `PASSWORD_TEACHER`) VALUES (:nip, :name, :email, SHA2(:password, 0))");

					$statement->bindValue(':nip', $_POST['nip']);
					$statement->bindValue(':name', $name);
					$statement->bindValue(':email', $_POST['email']);
				}

				else{
					$statement = $dbc->prepare("INSERT INTO `student`(`NIM`, `NAMA_STUDENT`, `EMAIL`, `PASSWORD_STUDENT`) VALUES (:nim, :name, :email, SHA2(:password, 0))");

					$statement->bindValue(':nim', $_POST['nim']);
					$statement->bindValue(':name', $name);
					$statement->bindValue(':email', $_POST['email']);
				}

				$statement->bindValue(':password', $_POST['password']);
				$statement->execute();


				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/login.php");

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}
	if(isset($_POST['addClass'])){
		try{
				$name = $_POST['nama_kelas'];
				$arr = explode(' ', $name);
				$singkatan = '';

				foreach($arr as $kata){
					$singkatan .= substr($kata, 0, 1);
				}
				$nipF = substr($_SESSION['nip'], 0, 1);
				$nipL = substr($_SESSION['nip'], -1);
				$idClass = $singkatan.$nipF.$nipL;
				
				$statement = $dbc->prepare("INSERT INTO `kelas`(`ID_KELAS`, `NIP`, `NAMA_KELAS`, `DESKRIPSI_KELAS`) VALUES (:idClass,:nip,:name,:descClass)");

				$statement->bindValue(':idClass', $idClass);
				$statement->bindValue(':nip', $_SESSION['nip']);
				$statement->bindValue(':name', $name);
				$statement->bindValue(':descClass', $_POST['deskripsi_kelas']);
				$statement->execute();


				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/");

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}

	if(isset($_POST['uploadLesson'])){
		try{
				$title = $_POST['title'];
				$arr = explode(' ', $title);
				$singkatan = '';

				foreach($arr as $kata){
					$singkatan .= substr($kata, 0, 1);
				}
				$id = substr($_POST['idClass'],0,1);
				$nipF = substr($_SESSION['nip'], 0, 1);
				$nipL = substr($_SESSION['nip'], -1);
				$idLesson = strtoupper($id.$singkatan.$nipF.$nipL);
				
				$statement = $dbc->prepare("INSERT INTO `materi`(`ID_MATERI`, `ID_KELAS`, `TITLE`, `CONTENT`, `KETERANGAN`) VALUES (:idLesson,:idClass,:title,:file,:descLesson)");

				$statement->bindValue(':idLesson', $idLesson);
				$statement->bindValue(':idClass', $_POST['idClass']);
				$statement->bindValue(':title', $title);
				if($_FILES['fileLesson']['error'] == 0){
					$namafile = $_FILES['fileLesson']['name'];
					$tempname = $_FILES['fileLesson']['tmp_name'];

					$dirUpload = "./assets/file/";

					$terupload = move_uploaded_file($tempname, $dirUpload.$idLesson.$namafile);

					$statement->bindValue(':file', $idLesson.$namafile);

				}
				else{
					$statement->bindValue(':file', '');
				}
				$statement->bindValue(':descLesson', $_POST['detailLesson']);
				$statement->execute();


				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/detailClass.php?class_id=".$_POST['idClass']);

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}

	if(isset($_POST['updateClass'])){
		try{
				
				$name = $_POST['name_class'];
				$arr = explode(' ', $name);
				$singkatan = '';

				foreach($arr as $kata){
					$singkatan .= substr($kata, 0, 1);
				}
				$nipF = substr($_SESSION['nip'], 0, 1);
				$nipL = substr($_SESSION['nip'], -1);
				$idClass = $singkatan.$nipF.$nipL;
				
				$statement = $dbc->prepare("UPDATE `kelas` SET `ID_KELAS`=:idClass,`NAMA_KELAS`=:nameClass,`DESKRIPSI_KELAS`=:descClass WHERE ID_KELAS = :cridClass");

				$statement->bindValue(':idClass', $idClass);
				$statement->bindValue(':nameClass', $name);
				$statement->bindValue(':descClass', $_POST['deskripsi_kelas']);
				$statement->bindValue(':cridClass', $_POST['idClass']);
				$statement->execute();
				
				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/detailClass.php?class_id=".$idClass);

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}

	if(isset($_POST['updateProfile'])){
		try{	
				if(isset($_SESSION['nip'])){
					$nip = $_SESSION['nip']; 
					$statement = $dbc->prepare("UPDATE `teacher` SET `NAMA_TEACHERS`=:name, `EMAIL`=:email,`ALAMAT`=:alamat, `FOTO`=:pict WHERE NIP = '".$nip."'");
				}
				else{
					$nim = $_SESSION['nim']; 
					$statement = $dbc->prepare("UPDATE `student` SET `NAMA_STUDENT`=:name, `EMAIL`=:email,`ALAMAT`=:alamat, `FOTO`=:pict WHERE NIM = '".$nim."'");
				}

				$statement->bindValue(':name', $_POST['nama']);
				$statement->bindValue(':email', $_POST['email']);
				$statement->bindValue(':alamat', $_POST['alamat']);
			
				if($_FILES['photo']['error'] == 0){
					$namafile = $_FILES['photo']['name'];
					$tempname = $_FILES['photo']['tmp_name'];

					if(isset($_SESSION['nip'])){
						$dirUpload = "./assets/img/teacher/";
						$terupload = move_uploaded_file($tempname, $dirUpload.$nip.$namafile);

						$statement->bindValue(':pict', $nip.$namafile);
					}
					else{
						$dirUpload = "./assets/img/student/";
						$terupload = move_uploaded_file($tempname, $dirUpload.$nim.$namafile);

						$statement->bindValue(':pict', $nim.$namafile);
					}

					

				}
				else{
					$statement->bindValue(':pict', $_POST['tempPict']);
				}
				$statement->execute();

				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/profil.php");

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}
	}

	if(isset($_POST['changePass'])){
		try{
				if(isset($_SESSION['nip'])){
					$nip = $_SESSION['nip']; 
					$statement = $dbc->prepare("UPDATE `teacher` SET `PASSWORD_TEACHER`= sha2(:password,0) WHERE NIP = '".$nip."'");
				}
				else{
					$nim = $_SESSION['nim']; 
					$statement = $dbc->prepare("UPDATE `student` SET `PASSWORD_STUDENT`= sha2(:password,0) WHERE NIM = '".$nim."'");
				}
				$statement->bindValue(':password', $_POST['n_password']);
				$statement->execute();


				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/logout.php");

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}
	if(isset($_GET['class_id']) && isset($_GET['gabung'])){
		try{
				$statement = $dbc->prepare("INSERT INTO `masuk`(`NIM`, `ID_KELAS`) VALUES (:nim, :idClass)");

				$statement->bindValue(':idClass', $_GET['class_id']);
				$statement->bindValue(':nim', $_SESSION['nim']);
				$statement->execute();


				header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/");

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}
?>