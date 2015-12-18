<?php
include "connect_inc.php";


//gets the id
$meetingID = $_POST['meetingID'];
$pass = $_POST['pass'];

//meeting input
$date = date('Y-m-d H:i:s');
$res = $dbConn->query("select * from meeting where meetingID = ".$meetingID." and password = '".$pass."'");
if($res === false){
echo "failure";	
}else{
$row = $res->fetch_assoc();
$_SESSION['meetingInSession'] = $row['meetingID'];
if(isset($_SESSION['meetingInSession'])){
echo "success";
}
}

?>