         <?php
include 'includes/connect_include.php';
        require_once("password.php");
        ?>
 <?php
 $error = 0;
 if ((empty($_POST['user'])|| empty($_POST['password']))){
         $message = "<p>Incorrect User/Password</p>";
         $error = 1;
        
        }
        else{
            
            $DBConnect = @mysql_connect("localhost", "root", "");
            if ($DBConnect === FALSE)
                $message = "<p>Unable to connect to the database server.</p>". "<p>Error code" . myssql_errno() . ":" . mysql_error() . "</p>";
            else {
                        $DBName = "meeting";
                        mysql_select_db($DBName, $DBConnect);
                        $TableName = "login";
                        
                        $user = strtolower(stripslashes ($_POST['user']));
                        $password = strtolower(stripslashes ($_POST['password']));
                        
                        $SQLstring = "select * from $TableName where user = '$user' ";
                        $QueryResult = @mysql_query ($SQLstring, $DBConnect);
                        if ($QueryResult === FALSE){
                          $message = "<p> Unable to execute the query . Error code " . mysql_errno ($DBConnect). ":" . mysql_error ($DBConnect) . "</p>";
                          $error = 1;
                        }
                        else{
                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            var_dump($hash);
                            if ($Row = mysql_fetch_assoc($QueryResult)){
                                if (password_verify($password, $hash)) {
                                $_SESSION['user']=$user;
                                $_SESSION['userID']=$Row['userID'];
                                    $_SESSION['loggedIn']=TRUE;
                                    header("Location: home.php");
                            }
                            else {
                                $message = "<p>Incorrect password</p>";
                                    $_SESSION['loggedIn']=FALSE;
                                    $error= 1;
                            }
                                    
                                }
                            }
                    }
                    
             mysql_close($DBConnect);
        }
$_SESSION['message'] = $message;
if ($error === 1)
    header("Location: index.php");

        ?>