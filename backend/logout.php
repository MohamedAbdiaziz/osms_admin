<?php
	include_once("./connection.php");
	session_destroy();
	header("Location: ../page/authentication-login.php");
// 		exit();
?>