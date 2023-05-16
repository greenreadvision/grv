<?php

$mysql_address = "127.0.0.1";
$mysql_username = "root";
$mysql_password = '';
$mysql_database = "it_sql_test";

$con = mysqli_connect($mysql_address, $mysql_username, $mysql_password, $mysql_database);
if (!$con) return false;



return $con;

?>
