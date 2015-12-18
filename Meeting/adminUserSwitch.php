<?php
 include "/includes/connect_include.php"; 

//this sets the meeting position
if(isset($_POST['setTID'])){
               $tID = $_POST['setTID'];
               $res = $dbConn->query("update meeting set meetingPosition = $tID where meetingID = ".$_SESSION['meetingInSession']);             
               $res = $dbConn->query("update meeting set breakOut = 0 where meetingID = ".$_SESSION['meetingInSession']);
               if($res === false){
                              echo "failure";
               }else{
                              echo "success";
               }
//this sends the meeting position
}else if(isset($_POST['getTID'])){
               $res = $dbConn->query("select * from meeting where meetingID = ".$_POST['getTID']);
               if ($res === false){
               echo "failure";    
               }else{
               $row = $res->fetch_assoc();
               echo $row['meetingPosition'];
               }
//adds points to breakout
}else if(isset($_POST['setBreakOut'])){
               $res = $dbConn->query("update meeting set breakOut = breakOut + 1 where meetingID = ".$_POST['setBreakOut']);
               if($res === false){
                              echo "failure";
               }else{
                              //$res = $dbConn->query('
                              echo "success";
               }
//echos breakout points
}else if(isset($_POST['getBreakOut'])){
               $res = $dbConn->query("select * from meeting where meetingID = ".$_POST['getBreakOut']."");
               if ($res === false){
               echo "failure";    
               }else{
               $row = $res->fetch_assoc();
               echo $row['breakOut'];
               }
}else if(isset($_POST['BreakOut'])){
//{'BreakOut' : breakout, 'topic': topicToBreak, 'tID' : tID},
$meetingID = $_POST['BreakOut'];
$topic = $_POST['topic'];
$res = $dbConn->query("update topic set brokeOut = 'yes' where meetingID = $meetingID and topicName like '$topic'");
if ($res === false){
echo "failure in brokeout update";             
}else{
echo "success";
}
}else if(isset($_POST['getBroke'])){
$meetingID = $_POST['getBroke'];
$topic = $_POST['topic'];
$res = $dbConn->query("select * from topic where meetingID = $meetingID and topicName like '$topic'");
if ($res === false){
echo "failure in brokeout update";             
}else{
$row = $res->fetch_assoc();
echo $row['brokeOut'];
}
}
?>
