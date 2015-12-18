<?php
include "../includes/connect_include.php";
include "../includes/queries_include.php";
class User
{
	public function __construct ($userName, $userEmail, $userPassword){
		$this->userName = $userName;
		$this->userEmail = $userEmail;
		$this->userPassword = $userPassword;
		addUser($this->userName, $this->userEmail, $this->userPassword, $DBConnect);
	}
	
	
}
?>