<?php 

include_once("../database/constants.php");
include_once("./user.php");
include_once("./DBOperation.php");

///For Registration
if (isset($_POST["username"]) && isset($_POST["email"])) {
	//create a User object
	$user = new User();

	$result = $user->createUserAccount($_POST["username"], $_POST["email"], $_POST["password1"], $_POST["usertype"]);
	echo $result;
	exit();
}


////For Login
if (isset($_POST["log_email"]) && isset($_POST["log_password"])) {
	$user = new User();

	$result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
	echo $result;
	exit();
}


///For getCategory
if (isset($_POST["getCategory"])) {
	//create an object of DBOperation class
	$obj = new DBOperation();
	$rows = $obj->getAllRecords("categories");
	foreach ($rows as $row) {
		echo "<option value='".$row["parent_cat"]."'>".$row["category_name"]. "</option>";
	}
	exit();
}

 ?>