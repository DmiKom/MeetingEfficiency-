<?php
include 'connect_inc.php';
?>
<html>
<head>
<script src="../js/jquery.min.js"></script>
<script src="../js/underscore.js"></script>
<script src="../js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.min.css" /> 
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.min.css" />
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.min.css" />
</head>
<body>
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
<div id="breakoutVotes"></div>
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
          width: 200
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

  	 
});
  </script>
</html>