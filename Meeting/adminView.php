<?php
 include "/includes/connect_include.php"; 
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
<script src="js/jquery.min.js"></script>
<script src="js/underscore.js"></script>
<script src="js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.theme.min.css" /> 
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.structure.min.css" />
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.min.css" />
</head>
<body>
	<div class="wrap">
            <div id="logo"><img alt="Logo" src="Images/meeting.Gif"></div>
            <div id="Nav">

                <a href="home.php" id="currentpage">Meeting </a>
                <a href="Calander.php">Create Agenda</a>
                <a href="Users.php">Users</a>
                <a href="index.php" >Log in</a>
            </div>
            <div id="MainCont" style="width: 700px;">

<div id="meetingTab">
<?php
//This is the query to get the meeting information
$res = $dbConn->query("select agenda.agendaTitle, GROUP_CONCAT(DISTINCT topic.topicName order by topic.topicName) as topics from agenda join topic on agenda.agendaID = topic.agendaID
               where agenda.meetingID = ".$_SESSION['meetingInSession']."
               group by agenda.agendaID
               order by agenda.agendaID");
//this variable is to set up the id's for the topic
$j = 0;

                              while($row = $res->fetch_assoc()){
                                             //takes the group concat and makes an array out of it
                                             $topicArray =  explode(',',$row['topics']);
                                             //Sets up the accordion
                                             echo "<h3>".$row['agendaTitle']."</h3>";
                                             echo "<ul>";
                                             for($i = 0; $i < count($topicArray); ++$i){
                                                            echo "<li id='".$j."'>".$topicArray[$i]."</li>";
                                                            $j++;
                                             }
                                             echo "</ul>";
                              }
?>
</div>
<button id="nextTopic">Next topic</button>
<button id="breakout">Move To Breakout</button>
<div id="breakoutVotes"></div>
<div id="breakOutTopics">
	
	
	
</div>
           

            </div>
</body>
  <script>
$(document).ready(function(){
               //this is for the topic ID, it is a temp variable
               var tID = 0;
               //establishing total topics so the count is right
               var totalTopic = <?php echo $j?>;
               $(function(){
                              //this is to highlight the first topic topic
               $("#"+tID).animate({
                                backgroundColor: "#aa0000",
          color: "#fff",
          width: 500
                              });
               });
               // this is the function for next topic
               $("#nextTopic").click(function(){
                              //this resets the count
                              if(tID == totalTopic){
                                             tID = 0;
                              }else{
                              //this moves to the next topic
                              tID++;
                              }
                              $.post("adminUserSwitch.php", {'setTID' : tID},
                              function(data){
                                             
                              }
                              );
                              //this shows the topics that are currently being discussed
                              var tmp = tID - 1;
                              $("#"+tID).animate({
                                backgroundColor: "#aa0000",
          color: "#fff",
          width: 500
                    });
                              //this changes what has already been discussed
                              $("#"+tID).select();
                              $("#"+tmp).animate({
                                backgroundColor: "blue",
          color: "#fff",
          width: 500
                    });
               });
               
               var meeting = <?php echo $_SESSION['meetingInSession']; ?>;
               var divText = "";
               setInterval(function() {
                              
                              $.post("adminUserSwitch.php", {'getBreakOut' : meeting},
                              function(data){
                                             divText = "<p>"+data+" people have voted to move to breakout"+"</p>";
                                             $("#breakoutVotes").html(divText);
                              }
                              );                                           
}, 10000);


//move to break out function start            
               $("#breakout").click(function(){
                              var bText = "";
                              var breakout = <?php echo $_SESSION['meetingInSession']; ?>;
                              var topicToBreak = $("#"+tID).text();
                              
                              //this resets the count
                              $.post("adminUserSwitch.php", {'BreakOut' : breakout, 'topic': topicToBreak},
                              function(data){
                                             if(data == "success"){
                                             $("#"+tID).text("Moved to breakout");
                                             bText += "<p>"+topicToBreak+"</p></n>";
                                             $("#breakOutTopics").append(bText);
                                             }else{
                                                       
                                             }
                                             }
                                             );
                              });
               });
  </script>
</html>
