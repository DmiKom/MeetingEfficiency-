<?php
include 'connect_inc.php';
?>
<html>
<head>
<script src="../js/jquery.min.js"></script>

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
<button id="breakout">Move To BreakOut</button>
</body>
  <script>
$(document).ready(function(){
	var tID = 0;
	var tmp = -1;
	$('#breakout').click(function(){
		//trying to set a temporary variable so I can try and reference something to prevent
		//multiple votes on the same topic.
		var meeting = <?php echo $_SESSION['meetingInSession']; ?>;
		if(tmp != tID){
		$.post("adminUserSwitch.php", {'setBreakOut' : meeting},
		function(data){
			if(data == "success"){
				alert('Voted to breakout');
				}
		});
		tmp = tID;
		}else{
			alert('you already pressed the button for this article');
		}
	});
	// this is the function to get the current meeting topic
	setInterval(function() {
		var meeting = <?php echo $_SESSION['meetingInSession']; ?>;
     // Do something after *
	  	$.post("adminUserSwitch.php", {'getTID' : meeting},
		callback);			 
}, 900);

	function callback(data){
		tID = data;
		//this shows the topics that are currently being discussed
		var tmp = tID - 1;
		 $("#"+tID).animate({
		  backgroundColor: "#aa0000",
          color: "#fff",
          width: 500
	     });
		 //this changes what has already been discussed
		 $("#"+tmp).animate({
		  backgroundColor: "blue",
          color: "#fff",
          width: 200
	     });	
	}
});
  </script>
</html>