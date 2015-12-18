
<html>
<head>
<title>Login to Meeting</title>
<script src="js/jquery.min.js"></script>
<script src="js/underscore.js"></script>
<script src="js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.theme.min.css" /> 
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.structure.min.css" />
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.min.css" />
<style>
	#meetingID{
		margin-right: 10px;
	}
</style>
</head>

<body>
<h3 style="margin-bottom: 40px;">Login to Meeting</h3>
<?php
$userID = $_SESSION['userID'];
                $res = $dbConn->query("select * from meeting where userID ='$userID'");
		echo "<select name='meetingID' id='meetingID' placeholder='Select Meeting' required='yes'  />";
		while ($row= @mysqli_fetch_assoc($res)){
			echo "<option value='".$row['meetingID']."'>".$row['meetingRef']."</option>";
		}
?>
<input type="password" name="pass" id="pass" placeholder="Enter Meeting Password" required />
<button id="goToMeeting">Login to meeting</button>
</body>
<script>
$(document).ready(function(){
$('#goToMeeting').click(function(){
	var meetingID = $('#meetingID').val();
	var pass = $('#pass').val();
	$.post("meetingVerify.php", {'meetingID' : meetingID, 'pass' : pass},
			 function(data){
				 if(data == "success"){
					 window.location.replace("adminView.php");
				 }else{
					 alert("this didn't work");
					 $('#meetingID').val("");
					 $('#pass').val("");
					 $('#meetingID').focus();
				 }
			 });
});
});
</script>
</html>