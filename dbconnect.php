<?php
// Defineringer til key-value par
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'VOR');

// Variabel med funktionalitet til at arbejde med database
$db_connection = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die("Connection could not be established. " . mysqli_connect_error());
?>