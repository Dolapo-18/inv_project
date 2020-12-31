<?php 
	include_once("./database/constants.php");
	if (isset($_SESSION["user_id"])) {
		header("location:".DOMAIN."/dashboard.php");
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link type="text/css" rel="stylesheet" href="./css/styles.css">
</head>
<body>
<div class="overlay">
	<div class="loader"></div>
</div>

<!-- Navbar -->
<section >
	<?php include_once('./templates/header.php'); ?>
</section>



<section style="margin-top: 25px;">
	<div class="container" style="font-size: 14px; font-family: Roboto">
		<?php 
			if (isset($_GET["msg"]) && !empty($_GET["msg"])) {
				?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					   <?php echo $_GET["msg"]; ?>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>

				<?php
			}
		 ?>
		<div class="card mx-auto" style="width: 18rem; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);">
		  <img src="./images/login.jpg" class="card-img-top" alt="..." height="250px">

		  <div class="card-body index">
		    <form id="login_form" onsubmit="return false">
			  <div class="form-group">
			    <label for="exampleInputEmail1"><b>Email address</b></label>
			    <input type="email" class="form-control form-control-sm" name="log_email" id="log_email" placeholder="jdoe@linkageassurance.com">
			    <small id="e_error" class="form-text text-muted"></small>

			  </div>
			  <div class="form-group">
			    <label for="exampleInputPassword1"><b>Password</b></label>
			    <input type="password" class="form-control form-control-sm" name="log_password" id="log_password" placeholder="Password">
			    <small id="p_error" class="form-text text-muted"></small>
			  </div>
			  
			  <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-lock"></i>&nbsp;Login</button>
			  <span><a href="register.php">Register</a></span>
			</form>
		  </div>
		</div>
	</div>
</section>








<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/main.js"></script>
	
</body>
</html>
