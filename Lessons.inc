<?php
	try{
		if(isset($_SESSION['nip'])){
			$nip = $_SESSION['nip'];
		}
		else{
			$nim = $_SESSION['nim'];
		}
		include 'connectdb.php';

		$statement = $dbc->query("SELECT * FROM kelas WHERE ID_KELAS = '".$idClass."'");

		foreach ($statement as $data){
?>
<div class="detailClass">
	<h2 class="nameClass"><?php echo "{$data["NAMA_KELAS"]}" ?></h2>
	<span class="descClass"><?php echo "{$data["DESKRIPSI_KELAS"]}" ?></span>
</div>
<?php
		}
?>
<div class="classContent">
	<div class="lesson">
			<div class="box">
				<h2>Lessons</h2>
				<?php
					if(isset($_SESSION['nip'])){
				?>
				<a href="./detailClass.php?class_id=<?php echo $idClass ?>&upload=1" class="upload">Upload Lesson</a>
				<?php
					}
				?>
			</div>
			<hr></hr>
			<?php
				$col = 1;
				$index = 1;
				$statement2 = $dbc->query("SELECT * FROM materi WHERE ID_KELAS = '".$idClass."'");
				$n = $statement2->rowCount();
				foreach ($statement2 as $data){
					if($col%3 == 1){	
			?>
			<div class="boxOuter">
				<div class="boxLesson">
					<div class="titleLesson"><a href='./detailClass.php?class_id=<?php echo $idClass ?>&lesson=<?php echo "{$data["ID_MATERI"]}" ?>'><?php echo "{$data["TITLE"]}" ?></a></div>
					<div class="descLesson"><p><?php echo "{$data["KETERANGAN"]}" ?></p></div>

				</div>
			<?php
						if ($n%3 == 1 && $index >= ($n - ($n%3))){
								echo "</div>";
								echo "<div class='clear'></div>";
						}
					}

					else if($col%3 == 2){
			?>
				<div class="boxLesson">
					<div class="titleLesson"><a href='./detailClass.php?class_id=<?php echo $idClass ?>&lesson=<?php echo "{$data["ID_MATERI"]}" ?>'><?php echo "{$data["TITLE"]}" ?></a></div>
					<div class="descLesson"><p><?php echo "{$data["KETERANGAN"]}" ?></p></div>
				</div>
			<?php
						if ($n%3 == 2 && $index >= ($n - ($n%3))){
								echo "</div>";
								echo "<div class='clear'></div>";
						}
					}
					else{
			?>
				<div class="boxLesson">
					<div class="titleLesson"><a href='./detailClass.php?class_id=<?php echo $idClass ?>&lesson=<?php echo "{$data["ID_MATERI"]}" ?>'><?php echo "{$data["TITLE"]}" ?></a></div>
					<div class="descLesson"><p><?php echo "{$data["KETERANGAN"]}" ?></p></div>
				</div>
			</div>
			<div class="clear"></div>
			<?php
					}

					$col++;
					$index++;
					if ($col > 3){
						$col = 1;
					}
				}
			?>
	</div>
	<hr>
	<div class="memberClass">
		<h2>Member</h2>
		<hr></hr>
		<?php
			$statement3 = $dbc->query("SELECT  s.NIM, s.NAMA_STUDENT, s.FOTO, m.ID_KELAS  FROM student s, masuk m WHERE s.NIM = m.NIM AND ID_KELAS = '".$idClass."'");
			//var_dump($statement3);
			//die;
			foreach ($statement3 as $data){
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
		</div>
		<?php
			}
		?>
	</div>
</div>
<?php
	}
	catch(PDOException $err){
		echo "Koneksi bermasalah. ".$err->getMessage();
	}	
?>