<?php
	if(isset($_GET['class_id']) && isset($_GET['delete']) && isset($_GET['nim'])){
		try{
				$nim = $_GET['nim']; 
				include 'connectdb.php';
				
				$statement = $dbc->query("DELETE FROM masuk WHERE NIM = '".$nim."' AND ID_KELAS = '".$_GET['class_id']."'");

				header("Location: ./detailClass.php?class_id=".$_GET['class_id']);

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}
	else{
		try{
				include 'connectdb.php';
				
				$statement = $dbc->query("DELETE FROM kelas WHERE ID_KELAS = '".$_GET['class_id']."'");

				header("Location: ./");

				return $statement->rowCount() > 0;
			}
		catch(PDOException $err){
				echo "Koneksi bermasalah. ".$err->getMessage();
			}	
	}
?>