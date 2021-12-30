<?php
	session_start();
	require "adminPermission.inc";
	include 'upData.inc';
	$idClass = $_GET['class_id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Class</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<?php
		include "menu.inc";
	?>
	<div class="container">
				<?php
					if(isset($_GET['lesson'])){
						$lesson = $_GET['lesson'];
						include "detailLesson.inc";
					}
					else if(isset($_GET['upload'])){
						include "uploadLesson.inc";
					}
					else{
							include "Lessons.inc";
					}
				?>
	</div>
	<?php
		include "footer.inc";
	?>
</body>
</html>