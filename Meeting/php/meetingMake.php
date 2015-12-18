<?php
include_once("connect_inc.php");
if(isset($_REQUEST['meetingSubmit'])){
$userID = $_SESSION['userID'];
$meetingRef = filter_input(INPUT_POST, 'meetingRef', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$start = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$end = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$result = $dbConn->query("insert into meeting (meetingRef, userID, password, meetingStart, meetingEnd) values('$meetingRef', '$userID', '$password', '".$start."', '".$end."')");

if($result === false){
	echo "This query didn't work";
}else{
$res = $dbConn->query("select * from meeting where meetingRef= '".$meetingRef."' and userID= ".$userID);
$row = $res->fetch_assoc();
$_SESSION['meetingID'] = $row['meetingID'];
$_SESSION['userID'] = $row['userID'];
$_SESSION['meetingRef'] = $row['meetingRef'];
header("Location: agendaDisplay.php");
}
}
?>