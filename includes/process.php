<?php 

include_once("../database/constants.php");
include_once("user.php");

if (isset($_POST["username"] && $_POST["email"])) {
	//create a User object
	$user = new User();

	$result = $user-> createUserAccount($_POST["username"], $_POST["email"], $_POST["password1"], $_POST["usertype"]);
	echo $result;
}

 ?>