<?php
$db_hostname = 'localhost';
$db_database = 'gssamru_rosgosstrakh';
$db_username = 'gssamru_rosgosst';
$db_password = 'rosgosstrakh';
mysql_connect($db_hostname, $db_username, $db_password) or die ("Could not connect to MySQL");
mysql_select_db ("$db_database") or die ("Could not select database");
mysql_query("SET NAMES 'utf8'");

$categoryTable = "categories";
$productTable = "products";
$logTable = "products";
?>