<?php
	
	if (count($_SESSION) == 0){
		header("Location: http://{$_SERVER['HTTP_HOST']}/mendes/login.php");
		exit();
	}
?>