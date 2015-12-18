<?php
include "connect_inc.php";
if(isset($_SESSION['meetingID'])){
unset($_SESSION['meetingID']); 
echo "success";
}
?>