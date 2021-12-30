<?php
	$dbc = new PDO('mysql:host=localhost;dbname=elearning','root','');
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>