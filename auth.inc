<?php
	$view = '';
	$error = false;
	function checkPassword($user, $pass){
		try{
				include 'connectdb.php';
				if ($_POST['optionLogin'] == 'teacher'){
					$statement = $dbc->prepare("SELECT * FROM `teacher` WHERE  NIP = :nip and PASSWORD_TEACHER = SHA2(:password, 0)");
					$statement->bindValue(':nip', $user);
				}
				else{
					$statement = $dbc->prepare("SELECT * FROM `student` WHERE  NIM = :nim and PASSWORD_STUDENT = SHA2(:password, 0)");
					$statement->bindValue(':nim', $user);
				}

				$statement->bindValue(':password',  $pass);
				$statement->execute();

				return $statement->rowCount() > 0;
			}
			catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	

	}

	if(isset($_POST['login'])){
		if(isset($_POST['nip'])){
			$user = $_POST['nip'];
		}
		else{
			$user = $_POST['nim'];
		}

		if(checkPassword($user, $_POST['password'])){
			if ($_POST['optionLogin'] == "teacher"){
				$_SESSION['isTeacher'] = true;
				$_SESSION['nip'] = $user;
			}
			else{
				$_SESSION['isStudent'] = true;
				$_SESSION['nim'] = $user;
			}
			header("Location: ./");
		}
		else{
			$error = true;
			header("Location: ./login.php?error=1");
		}
	}
?>