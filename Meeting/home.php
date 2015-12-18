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

                <a href="home.php" id="currentpage">Meeting </a>
                <a href="Calander.php">Create Agenda</a>
                <a href="Users.php">Users</a>
                <a href="index.php" >Log in</a>
            </div>
            <div id="MainCont">
           
            <?php
            if (!empty($_SESSION['user'])){
                
                include('adminLogin.php');
                
            
            };
            
            ?>
                    </table>
            </div>
        </div>
    </body>
    <?php

     
    ?>