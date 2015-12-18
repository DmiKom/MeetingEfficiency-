<?php
include_once 'connect_inc.php';
//this is to establish the agenda

//get topic from agendaDisplay
//checking if agenda is set
if(isset($_POST['agenda'])){
if(isset($_POST['topic'])){
$topic = $_POST['topic'];               
}else if(!isset($_POST['topic'])){
$topic = ["there are no topics for this agenda"];    
}
//get the agenda title 
$agendaTitle = $_POST['agenda'];
//insert agenda tile and get agendaID
$inserted = $dbConn->query("insert into agenda(meetingID, agendaTitle) values('".$_SESSION['meetingID']."', '".$agendaTitle."')");

if($inserted === false){
               die("Didn't work");
               //validation
}else{     
               //start debugging here if other two queries run successful
               $res = $dbConn->query("select * from agenda where meetingID = ".$_SESSION['meetingID']." and agendaTitle= '".$agendaTitle."'");
               $row = $res->fetch_assoc();
               $agendaID = $row['agendaID'];
               if($res === false){             
                                             die("This doesn't work");
               }else{
                              $i = 0;    
                              while($i < count($topic)){
                                                            //insert the topic array
                                             $insertTopic = $dbConn->query("insert into topic(agendaID, meetingID, topicName) values($agendaID,". $_SESSION['meetingID'].", '".$topic[$i]."')");
                                             if($insertTopic === false){
                                                            //array failed
                                                            $i = count($topic);
                                               }else{
                                                            //array succeeds
                                                                           $i++; 
                                                            }
                                             }
                              }
}
$tmp = "";
$res = $dbConn->query("select agenda.agendaTitle, GROUP_CONCAT(DISTINCT topic.topicName order by topic.topicName) as topics from agenda join topic on agenda.agendaID = topic.agendaID
               where agenda.meetingID = ".$_SESSION['meetingID']."
               group by agenda.agendaID
               order by agenda.agendaID
               ");
if($res === false){
               die("This doesn't work");
   }else{
                              while($row = $res->fetch_assoc()){
                              $returnArray[] = $row; 
                              $json = json_encode($returnArray);
                              

                              }
}


header('Content-type: application/json;charset=UTF-8');
echo $json;

}
?>
