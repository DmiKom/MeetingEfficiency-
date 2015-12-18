<?php include_once "../includes/connect_include.php"; ?>
<html>
<head>
<title>Agenda setup</title>
<style>
#MainCont{
	width: 800px;
	height: 700px;
}
#currentMeeting{
float:left;
width:50%;
overflow:auto;
height:400px;
}
#setAgenda{
float:left;
width:30%;
margin-left:10%;              
}
#header{
width:100%;
clear:both;
height:100px;     
}
h3{
color:green;        
}
li{
list-style-type:none;         
}
</style>
<link rel="stylesheet" type="text/css" href="../CSS/main.css">
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.min.css" /> 
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.min.css" />
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.min.css" />  
</head>
<body>
	<div class="wrap">
            <div id="logo"><img alt="Logo" src="../Images/meeting.Gif"></div>
            <div id="Nav">

                <a href="home.php" id="currentpage">Meeting </a>
                <a href="../Calander.php">Create Agenda</a>
                <a href="Users.php">Users</a>
                <a href="index.php" >Log in</a>
            </div>
            <div id="MainCont" style="height: 400px;" >
<div id="header">
<?php

echo "Set Up Agenda for Meeting ID: ".$_SESSION['meetingID'] .".";
?>
</div>
<div id="setAgenda">
<div>
<label for="agenda">Topic</label>
<div>
<input type="text" name="agenda" id="agenda" placeholder="Put in agenda" />
</div>
<div>
<button class="add">Add A Subtopic</button>
</div>
<div id="topic"></div>
<button name="submitAgenda" id="agendaSub">Submit Topic</button>
<button name="submitMeeting" id="submitMeeting">Submit Agenda</button>
</div>
</div>
<div id="currentMeeting">
</div>
<script type="text/javascript">
$(document).ready(function() {

  $("#submitMeeting").click(function(){
                                             $.post("submitMeeting.php", 
                                              {},
                                             function(data){
                                                            if(data == "success"){
                                                                           window.location.replace("../meetingSetup.html");
                                                            }
                                             });
  });
               
               
               
//this is to dynamically add text boxes
  $(".add").click(function(){
                 //validation
               if($("#agenda").val() == "" || $("#agenda").val() == " "){
                              alert("You need to input an agenda");
               }else{
                              //this sets up the ID's
                              var id = $('input').length;
                              $("#topic").append("<div id='input"+id+"'><input type='text' name='topic[]' id='topics"+id+"' /><button name='delete' class='delete' id='delete"+id+"' >Delete</button></div>");
                              $('#topics'+id).focus();
                              
                              //delete function
                              $("#delete"+id).click(function(){  
                              $("#input"+id).remove();
                              //alert("#input"+id);
                              });
               }
  });
    
//end dynamic text box function  
 
     $("#currentMeeting").accordion({
                              collapsible: true,
                              heightStyle: "content"
               });
               
               
               
 //agenda submission
$("#agendaSub").click(function(){ 
                //validation
               if($("#agenda").val() == "" || $("#agenda").val() == " "){
                              alert("You need to input an agenda");
               }else{
               //getting all inputs. Agenda will ALWAYS be inputArray[0]
               //topic array is to be the data array so be submitted for topic
                              var inputArray = [];
        var topicArray = [];
                              
               //since I am serializing all inputs, I have to remove the $_POST['agenda'] variable
        $('input').each(function(){
            inputArray.push($(this).val());
        });
               //fill topic array
     for(var i=1; i < inputArray.length; i++){
            topicArray[i-1] = inputArray[i];
        }
                              
                              //set agenda variable
                                             var agenda = inputArray[0];
                                             if(topicArray != null){
                                             //ajax request
                                             $.post("agendaSetup.php", 
                                              {'agenda' : agenda, 'topic' : topicArray, format : 'json'},
                                             callback);
                                             }
                                             if(topicArray == null){
                                             $.post("agendaSetup.php", 
                                              {'agenda' : agenda, format : 'json'},
                                             callback);            
                                             }
                              }
});


////////////////start callback
////////////////this is to display the data
function callback(data){
               var divText = "";
               var tmp = ""; 
               var title = new Array();
                 for(var i in data){
                                
                               
                 var topicArray = data[i]["topics"];           
                 var topic = topicArray.split(",");

                 if(tmp != data[i]["agendaTitle"]){
                              divText += "<h3>"+data[i]["agendaTitle"]+"</h3>";
                              tmp = data[i]["agendaTitle"];
                 }
                 divText += "<ul>";
                              for(var j = 0; j < topic.length; j++){              
                   divText += "<li>"+topic[j]+" </li>";
                              }
                 divText += "</ul>";
}
                 $("#currentMeeting").html(divText);
                 $("#currentMeeting").accordion('refresh');
                  $('input').val('');
                  $('input[name="topic[]"]').remove();
                  $("button[name='delete']").remove();
                  $('#agenda').focus();
                  
}

//function(){alert("this is the function");
//end callback
});
</script>
	    </div>
</body>
</html>

