//Register User
<?php
include "../includes/connect_include.php";
include "../includes/queries_include.php";
if(isset($_REQUEST['submit'])){
$uName = stripslashes($_REQUEST['userName']);
$email = stripslashes($_REQUEST['email']);
$pass = stripslashes($_REQUEST['password']);

$added = addUser($uName, $email, $pass, $DBConnect);
}
if(!$added)
	echo "nope";
else
	echo "yep";

?>