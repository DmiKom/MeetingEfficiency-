<?php
//FILE FOR SQL QUERIES

include "connect_include.php";

//query to add user
////////////////////
function addUser($userName, $email, $password, $DBConnect){
	$tableName = "user";
	$SQLString = "select count(*) from $tableName where email='$email'";
	$QueryResult = @mysql_query($SQLString, $DBConnect);
    if($QueryResult !== false){
	$Row = mysql_fetch_row($QueryResult);
	if($Row[0] > 0){
	echo "That email is already registered";
	return false;
	}
}
$sql ="insert into $tableName (userName, userEmail, userPassword) values('".$userName."', '".$email."', '".$password."')";
$QueryResult = @mysql_query($sql, $DBConnect);
if($QueryResult === false){
	return false;
}else{
	return true;
}
}
////////////////////
//end add user query


?>