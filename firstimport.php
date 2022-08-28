<?php
$host="localhost"; // Host name
$username="anish"; // Mysql username
$password="anish"; // Mysql password
$db_name="railres"; // Database name


$servername = "localhost";
$username = "anish";
$password = "anish";
$dbname = "railres";

// Create connection
$connectionnew = new mysqli($servername, $username, $password, $dbname);

$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect");

?>