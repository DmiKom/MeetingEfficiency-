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
        
             
             
             <?php
            
            if (!empty($_SESSION['user'])){
                $user= $_SESSION['user'];
                
                include 'meetingSetup.html';
        
            }
            
            ?>
            

    </body>
    <?php
    ?>