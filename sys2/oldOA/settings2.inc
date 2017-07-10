<?php
@session_start();

$db_user = "root"; 					// Database username
$db_pass = "1qa2WS3ed4RF";					// Database password
$db_name = "sq_user"; 				// Database name
$db_host = "localhost";					// Database host
$db_port = "";						// Database port


$db_con=mysql_connect($db_host,$db_user,$db_pass)or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");
mysql_query("SET NAMES 'UTF8'"); //UTF-8 зЊТы


?>