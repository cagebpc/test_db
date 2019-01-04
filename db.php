<?php 

$link = mysqli_connect("localhost","root","root", "testbd");

if (!$link) {
	echo(mysqli_error());
	echo (mysql_errno());
}
?>
