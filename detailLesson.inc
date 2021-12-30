<div class="detailLesson">

<?php
	try{
		$idLesson = $_GET['lesson'];
		include 'connectdb.php';
	
		$statement = $dbc->query("SELECT * FROM materi WHERE ID_KELAS = '".$idClass."' AND ID_MATERI = '".$idLesson."'");

		foreach ($statement as $data){
?>
			<h2 class="titleLesson"><?php echo "{$data["TITLE"]}" ?></h2>
			<span class="descLesson"><?php echo "{$data["KETERANGAN"]}" ?></span>
			<?php
				$file = ""."{$data["CONTENT"]}";
				if($file != ''){
			?>
					<div class="boxFile">
						<img src='./assets/img/file_logo.png' alt="file">
						<span class="nameFile"><?php echo $file ?></span>
						<?php
							if(isset($_SESSION['nim'])){
						?>
								<a href='./assets/file/<?php echo $file ?>' alt='Dowload'>Download</a>
						<?php
							}
						?>
					</div>
			<?php
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