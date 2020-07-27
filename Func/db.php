<?php 
	
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db   = "SUKSESI2020";

	$link = mysqli_connect($host, $user, $pass, $db) or die (mysqli_error());

	//Anti sql Injection
	function escape($data){
		global $link;
		return mysqli_real_escape_string($link, $data);
	}

?>