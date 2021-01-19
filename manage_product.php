<?php 

	include_once("./database/constants.php");
	if (!isset($_SESSION["user_id"])) {
		header("location:". DOMAIN."/");
	}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<meta name="description" content="Inventory Management System">
  	<meta name="author" content="Software Angle">
  	<meta name="keyword" content="">
 	<link rel="shortcut icon" href="img/favicon.png">

  	<title>Inventory Management System</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/styles.css">
</head>
<body>


<!-- Navbar -->
<section >
	<?php include_once('./templates/header.php'); ?>
</section>
<br>


<div class="container">
	<table class="table table-hover table-bordered table-sm text-center table-success">
    <thead>
      <tr>
        <th>#</th>
        <th>PRODUCT</th>
        <th>CATEGORY</th> 
        <th>BRAND</th>
        <th>PRICE</th>
        <th>STOCK</th>
        <th>DATE ADDED</th>
        <th>STATUS</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody id="get_product">
      <!-- <tr>
        <td>1</td>
        <td>Electronics</td>
        <td>Root</td>
        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
        <td>
        	<a href="#" class="btn btn-danger btn-sm">Delete</a>&nbsp;
        	<a href="#" class="btn btn-info btn-sm">Edit </a>
         </td>
       
      </tr> -->
      
    </tbody>
  </table>
</div>


 <?php include_once("./templates/update_product.php"); ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/manage.js"></script>



</body>
</html>