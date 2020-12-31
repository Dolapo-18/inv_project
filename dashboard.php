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



<section style="margin-top: 30px;">
	<div class="container" style="font-size: 12px; font-family: Arial">
		<div class="row">
			<div class="col-md-4">
				<div class="card mx-auto" style="width:60%; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
				  <img src="./images/user.png" class="card-img-top mx-auto" alt="...">
				  <div class="card-body">
				   <!--  <h5 class="card-title">Profile Info</h5> -->
				    <p class="card-text"><i class="fa fa-user"></i>&nbsp;Progress Ikhobo</p>
				    <p class="card-text"><i class="fa fa-user"></i>&nbsp;Admin</p>
				    <a href="#" class="btn btn-success btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit Profile</a>
				  </div>
				</div>
			</div>
				<br>

			<div class="col-md-8">
				<div class="bg">
					<h2>Inventory Management System</h2>
					<p><i>...manage what matters to you</i></p>
					<div class="new">
							<span><a href="#">New Order</a></span>
					</div>
				</div>
			</div>

		</div>

	</div>
</section>




<section>
	<div class="container" style="margin-top: 25px;">
		<div class="row manage">
			<div class="col-md-4">
				<div class="card">
						<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
						<h4 class="card-title">Categories</h4>
						<p class="card-text">Here you can manage your categories and you add new parent and sub categories</p>
						<div class="cat">
							<span><a href="#" data-toggle="modal" data-target="#form_category">Add</a></span>
							<span><a href="manage_categories.php">Manage</a></span>
						</div>
						<!-- <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a> -->

						<!-- <a href="manage_categories.php" class="btn btn-primary">Manage</a> -->
					</div>
				</div>
			</div>
				
			<div class="col-md-4">
				<div class="card">
						<div class="card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
						<h4 class="card-title">Brands</h4>
						<p class="card-text">Here you can manage your brand and you add new brand</p>
						<div class="brand">
							<span><a href="#" data-toggle="modal" data-target="#form_brand">Add</a></span>
							<span><a href="manage_brand.php">Manage</a></span>
						</div>
						
					</div>
				</div>
			</div>
				<br>
			<div class="col-md-4">
				<div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
						<div class="card-body">
						<h4 class="card-title">Products</h4>
						<p class="card-text">Here you can manage your prpducts and you add new products</p>
						<div class="product">
							<span><a href="#" data-toggle="modal" data-target="#form_products">Add</a></span>
							<span><a href="manage_product.php">Manage</a></span>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<!-- Button trigger modal -->

<!-- Modal  for category-->
<?php include_once('./templates/category.php') ?>

<!-- Modal  for brand-->
<?php include_once('./templates/brand.php') ?>

<!-- Modal  for product-->
<?php include_once('./templates/product.php') ?>









<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/main.js"></script>
	
</body>
</html>
