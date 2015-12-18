<?php
try{
include_once 'includes/connect_include.php';

if(isset($_POST['associateEmail'])){
               
//this is is getting the post data
$assTitle = $_POST['associateTitle'];
$assEmail = $_POST['associateEmail'];     

//insert agenda tile and get agendaID
$inserted = $dbConn->query("insert into associate(userID, associateEmail, associateTitle) values(".$_SESSION['userID'].", '".$assEmail."', '".$assTitle."')");

if($inserted === false){
               die();
               //validation
}else{     
//this is the query for the return json only happens if data was inserted
$res = $dbConn->query("select associateEmail, associateTitle from associate where userID = '".$_SESSION['userID']."'");
if($res === false){
               die();
   }else{
                              while($row = $res->fetch_assoc()){
                              $returnArray[] = $row; 
                              }
                              $json = json_encode($returnArray);
                              header('Content-type: application/json;charset=UTF-8');
                              //everything went well
echo $json;
                              
}

}
}
}
catch(Exception $e){
echo $e->getMessage();
die("The contact insert didn't work. Please try again.");      
}

?>
