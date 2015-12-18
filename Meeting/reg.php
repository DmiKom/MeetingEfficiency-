        <?php
        session_start();
        require_once("password.php");
        ?>
<!Doctype>
    <head>
        <title>Meeting</title>
        <style>
            main{
                height: 95%;
                width: 100%
            }
            form {
                margin-left: 32%;
                margin-top: 10%
            }

        </style>
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
    </head>
    <body>
        <div class="wrap">
            <div id="logo"><img alt="Logo" src="Images/meeting.Gif"></div>
            <div id="Nav">

                <a href="home.php">Agenda</a>
                <a href="Calander.php">Create</a>
                <a href="Users.php">Users</a>
                <a href="index.php">Log in</a>
            </div>
             <div id= "main">
 <form action="" method="post">

        <div id="Log">
            <div id="input">
        <p id="top">Welcome to Meeting!! please enter all information</p>
        User Name <input type="text" name="user" value=""/>
        <p></p>
         Password  <input type="text" name="password" />
        <p></p>
        Re-enter Password  <input type="text" name="passCheck" />
        <p></p>
                <input id="sub" type="submit" name="submit" value="register"/>
                <p></p>
        <?php
        if ((empty($_POST['user'])|| empty($_POST['password']) || empty($_POST['passCheck']))){
         $message = "<p>Please enter all information/p>";
         $error = 1;
        
        }
        else{
            
            $DBConnect = @mysql_connect("localhost", "root", "");
            if ($DBConnect === FALSE)
                $message = "<p>Unable to connect to the database server.</p>". "<p>Error code" . myssql_errno() . ":" . mysql_error() . "</p>";
            else if($_POST['password'] === $_POST['passCheck'] ){
                        $DBName = "meeting";
                        mysql_select_db($DBName, $DBConnect);
                        $TableName = "login";
                        $user = strtolower(stripslashes ($_POST['user']));
                        $password = strtolower(stripslashes ($_POST['password']));
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        
                            
                        $SQLstring = "INSERT INTO $TableName (`userID`, `user`, `password`) VALUES (null,'$user','$hash')";
                        $QueryResult = @mysql_query ($SQLstring, $DBConnect);
                        if ($QueryResult === FALSE){
                          $message = "<p> Unable to execute the query . Error code " . mysql_errno ($DBConnect). ":" . mysql_error ($DBConnect) . "</p>";
                          $error = 1;
                        }
                        else{
                                echo "<p>Thank you for registering ". $_POST['user'] . "</p>";
                               
                        }
                    }
                    
             mysql_close($DBConnect);
        }
        
        ?>
           
        </div>
</form>
 
        </div>
             </div>
    </body>
