<?php
	// include_once("./connection.php");
	if(!isset($_SESSION['admin_username'])){
	    header("Location: ../page/authentication-login.php");
		exit();
	}
?>