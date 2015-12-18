<?php

include 'includes/connect_include.php';
?>
<html>
<head>
<title>Insert Contact </title>
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.theme.min.css" /> 
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.structure.min.css" />
<link rel="stylesheet" type="text/css" href="js/jquery-ui/jquery-ui.min.css" />
 <link rel="stylesheet" type="text/css" href="CSS/main.css">
    <style>
        #associateEmail{
            margin-bottom: 5px;
        }
        #associateTitle{
            margin-bottom: 5px;
        }
        #knownAssociates{
            margin-top:10px;
        }
    </style>
</head>
<body>
    <div class="wrap">
            <div id="logo"><img alt="Logo" src="Images/meeting.Gif"></div>
            <div id="Nav">

                <a href="home.php">Meeting</a>
                <a href="Calander.php">Create Agenda</a>
                <a href="Users.php" id="currentpage">Users</a>
                <a href="index.php">Log in</a>
   
    </div>
    <div id="MainCont">
        <?php
            if (!empty($_SESSION['user'])){
                
            ?>
    <h1>Add Contacts</h1>
        <div>
            <input type="mail" name="associateEmail" id="associateEmail" placeholder="Associate Email"  required />
        </div>
        <div>
            <input type="text" name="associateTitle" id="associateTitle" placeholder="Associate Title" required />
        </div>
            <button id="stuff"><a href="Users.php">Submit Contact</a></button>
        <div>
            <h2>Associates</h2>
            <?php
            $res = $dbConn->query("select associateEmail, associateTitle from associate where userID = '".$_SESSION['userID']."'");
            while($row = @mysqli_fetch_assoc($res)){
            
            echo "<a href='mailto:".$row['associateEmail']."'>".$row['associateTitle']."</a> <br />";
                }
                ?>
        </div>
        </div> 
</div> 
</body>
<script type="text/javascript">
$(document).ready(function(){

//this is the function to handle the ajax data
$('#stuff').click(function(){
	//converting values into passable info
	var associateEmail = $('#associateEmail').val();
	var associateTitle = $('#associateTitle').val();
	$.post("contactSetup.php", {associateEmail : associateEmail, associateTitle: associateTitle, format : 'json'}, callback);
});
			 
function callback(data){

	var divText = "";
	for(var i in data){
		divText +="<a href='mailto: "+data[i]["associateEmail"]+"'>"+data[i]["associateTitle"]+"</a><input type='checkbox' id="+data[i]
                ["associateTitle"]+" value="+data[i]["associateEmail"]+"><br />" ;
	}
	divText += "<button id='emailMult'>Email Multiple people</button>";
	  $("#knownAssociates").append(divText);
	   //$('#associateEmail').val("");
	 //  $('#associateTitle').val("");
	   $("#associateEmail").focus();
}

/*$('#stuff').click(function(){
	var emails = [];
	$('input:checkbox').each(function(){
		if(this.checked){
			emails.push(this.value);
		}
	});
	
	mults(emails);
	
	});
	
function mults(emails){
	var mailtext = "";
	if(emails != null){
	for(var i = 0;i < emails.length; i++){
		mailtext += email[i]+";";
	}
	window.location.href = "mailto:address@dmail.com";
	}else{
		alert("nothing checked");
	}
} */	

});

<?php
            };
           
?>
</script>

</html>
         