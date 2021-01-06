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
		echo "<option value='".$row["cat_id"]."'>".$row["category_name"]. "</option>";
	}
	exit();
}


///For Brand
if (isset($_POST["getBrand"])) {
	//create an object of DBOperation class
	$obj = new DBOperation();
	$rows = $obj->getAllRecords("brands");
	foreach ($rows as $row) {
		echo "<option value='".$row["brand_id"]."'>".$row["brand_name"]. "</option>";
	}
	exit();
}


//////For Add Category
if (isset($_POST["category_name"]) && isset($_POST["parent_cat"])) {
	//create an object of DBOperation class
	$obj = new DBOperation();
	$result = $obj->addCategory($_POST["parent_cat"], $_POST["category_name"]);
	echo $result;
	exit();

}


//////For Add Brand
if (isset($_POST["brand_name"])) {
	//create an object of DBOperation class
	$obj = new DBOperation();
	$result = $obj->addBrand($_POST["brand_name"]);
	echo $result;
	exit();
}


//////For Add Product
if (isset($_POST["cat_id"]) 
	&& isset($_POST["brand_id"]) 
	&& isset($_POST["product_name"]) 
	&& isset($_POST["product_price"]) 
	&& isset($_POST["product_stock"])
	&& isset($_POST["added_date"])) {
	//create an object of DBOperation class
	$obj = new DBOperation();
	$result = $obj->addProduct(
	 $_POST["cat_id"],
	 $_POST["brand_id"], 
	 $_POST["product_name"], 
	 $_POST["product_price"], 
	 $_POST["product_stock"], 
	 $_POST["added_date"]);
	echo $result;
	exit();
}

 ?>