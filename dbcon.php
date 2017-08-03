<?php
	$servername = "localhost";
	$username = "root";
	$password = "1";
	$database = "getdb";
    $conn = new mysqli($servername, $username, $password ,$database);
    mysqli_set_charset( $conn, 'utf8');

?>