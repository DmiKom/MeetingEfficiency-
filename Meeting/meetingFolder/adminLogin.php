<?php
include "connect_inc.php";
?>
<html>
<head>
<title>Login to Meeting</title>
<script src="../js/jquery.min.js"></script>
<script src="../js/underscore.js"></script>
<script src="../js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.min.css" /> 
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.min.css" />
<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.min.css" />  
</head>
<body>
<input type="text" name="meetingID" id="meetingID" placeholder="Enter Meeting ID" required />
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