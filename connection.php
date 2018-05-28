<?php 


$dbServername ="localhost";
$dbUsername ="root";
$dbPassword ="";
$dbName ="usuarios";

$connection = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

mysqli_query($connection, "SET NAMES 'utf8'");

if($connection->connect_errno){
	echo "Error en la conexión";
	exit;
}

