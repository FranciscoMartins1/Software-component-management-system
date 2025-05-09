<?php
	define("DB_HOST","127.0.0.1");
	define("DB_USER","root");
	define("DB_DATABASE","srsWeb");

	$conn = mysqli_connect(DB_HOST, DB_USER);	
	mysqli_select_db($conn, DB_DATABASE) or die('Sem tabela');
?>