<?php

include 'includes/connect_include.php';

?>

<!Doctype>
    <head>
        <title>Meeting</title>
        <style>

        </style>
            <link rel="stylesheet" type="text/css" href="CSS/main.css">

    </head>
    <body>
        <div class="wrap">
            <div id="logo"><img alt="Logo" src="Images/meeting.Gif"></div>
            <div id="Nav">

            </div>
    <div id="MainCont">
    <form action="login.php" method="post">
        <div id="input">
            <p id="top">Welcome to Meeting!!</p>
            User Name <input type="text" name="user" />
            <p></p>
             Password  <input type="password" name="password" />
            <p></p>
            <input id="sub" type="submit" name="submit" value="Login"/>
            <p></p>
            <div id="x"><a href="reg.php">Register </a><a href="&nbsp"> 
        </div>
    </form>
    <div id="UserLogin" style="margin-top: 10px;">
   <a href="userLogin.php">Go To Made Meeting</a>

    </div>
</div> 
        </div>
    
</body>