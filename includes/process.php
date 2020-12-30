<?php 

include_once("../database/constants.php");
include_once("./user.php");


///For Registration
if (isset($_POST["username"]) && isset($_POST["email"])) {
	//create a User object
	$user = new User();

	$result = $user->createUserAccount($_POST["username"], $_POST["email"], $_POST["password1"], $_POST["usertype"]);
	echo $result;
}


////For Login
if (isset($_POST["log_email"]) && isset($_POST["log_password"])) {
	$user = new User();

	$result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
	echo $result;
}

 ?>