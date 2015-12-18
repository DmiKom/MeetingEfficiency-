<?php
//this is to establish a connection with the database
session_start();
$dbConn = new mysqli("localhost", "root", "", "meeting");
if($dbConn === false){
		die("could not connect to database");
}
?>