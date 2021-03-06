$(document).ready(function() {

	const DOMAIN = "http://localhost/inv_project";

	$("#register_form").on("submit", () => {

		let status = false;
		let name = $("#username");
		let email = $("#email");
		let pass1 = $("#password1");
		let pass2 = $("#password2");
		let userType = $("#usertype");

		//email pattern using Regular Expression
		let e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
		//validate name field
		if (name.val() == "") {
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Please Enter Name</span>");
			status = false;

		} else {
			name.removeClass("border-danger");
			$("#u_error").html("");
			status = true;
		}

		//validate email field
		if (!e_patt.test(email.val())) {
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter a Valid Email Address</span>");
			status = false;

		} else {
			email.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}

		//validate password1 field
		if (pass1.val() == "" || pass1.val().length < 8) {
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Password must be more than 7 characters</span>");
			status = false;

		} else {
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status = true;
		}

		//validate password2 field
		if (pass2.val() == "" || pass2.val().length < 8) {
			pass2.addClass("border-danger");
			$("#p2_error").html(`<span class='text-danger'>Password must be more than 7 characters</span>`);
			status = false;

		} else {
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status = true;
		}

		//Validate User type
		if (userType.val() === "") {
			userType.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>This field cannot be empty</span>");
			status = false;

		} else {
			userType.removeClass("border-danger");
			$("#t_error").html("");
			status = true;

		}

		//Validate Passwords
		if ((pass1.val() === pass2.val()) && status == true) {
			$(".overlay").show();
			$.ajax({
				url: DOMAIN + "/includes/process.php",
				method: "POST",
				data: $("#register_form").serialize(),
				success: function(data) {
					if (data == "EMAIL_ALREADY_EXIST") {
						$(".overlay").hide();
						alert("Email already used :(");

					} else if( data == "SOME_ERROR") {
						$(".overlay").hide();
						alert("Something went wrong!!!");

					} else {
						$(".overlay").hide();
						window.location.href = encodeURI(DOMAIN + "/index.php?msg=Registration Successful. Kindly Login");
					}
				}
			});
			
		} else {
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Passwords do not Match :(</span>");
			status = false;
		} 


	});







	///////////////Login Part
	$("#login_form").on("submit", () => {
		
		let log_email = $("#log_email");
		let log_password = $("#log_password");
		let status = false;

		//email pattern using Regular Expression
		let e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

		if (!e_patt.test(log_email.val()) || log_email.val() == "") {
			log_email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Please Enter a Valid Email Address</span>");
			status = false;

		} else {
			log_email.removeClass("border-danger");
			$("#e_error").html("");
			status = true;
		}

		if (log_password.val() == "") {
			log_password.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Password can't be empty</span>");
			status = false;

		} else {
			log_password.removeClass("border-danger");
			$("#p_error").html("");
			status = true;
		}

		if (status) {
			$(".overlay").show();
			$.ajax({
				url: DOMAIN + "/includes/process.php",
				method: "POST",
				data: $("#login_form").serialize(),
				success: function(data) {
					if (data === "USER_NOT_REGISTERED") {
						$(".overlay").hide();
						log_email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'><b>Sorry! You Haven't Registered Yet.</b></span>");

						

					} else if( data === "PASSWORD_MISMATCH_ERROR") {
						$(".overlay").hide();
						log_password.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password.</span>");
						

					} else {
						$(".overlay").hide();
						window.location.href = encodeURI(DOMAIN + "/dashboard.php");

					}
				}
			});
		}
	});



	///Fetch Category
	fetchCategory();
	function fetchCategory() {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {getCategory: 1},
			success: function(data) {
				const root = "<option value='0'>Root</option>";
				const choose = "<option value=''>---Select Category---</option>";
				$("#parent_cat").html(root + data);
				$("#select_cat").html(choose + data);
			}
		});


	}



///Fetch Brand
	fetchBrand();
	function fetchBrand() {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {getBrand: 1},
			success: function(data) {
				const brands = "<option value=''>---Select Brand---</option>";
				$("#select_brand").html(brands + data);
			}
		});


	}



	///////////Add Category Form
	$("#category_form").on("submit", function() {
		if ($("#category_name").val() == "") {
			$("#category_name").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
		}else{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  : $("#category_form").serialize(),
				success : function(data){
					if (data == "CATEGORY_ADDED") {
							$("#category_name").removeClass("border-danger");
							$("#cat_error").html("<span class='text-success'><b>New Category Added Successfully..!</b></span>");
							$("#category_name").val("");
							fetchCategory();

					}else{
						 $("#category_name").addClass("border-danger");
					     $("#cat_error").html("<span class='text-danger'><b>Category Name Already Exist!!!</b></span>");
					}
				}
			})
		}
		
	
	});




	////////////Add Brand Form
	$("#brand_form").on("submit", () => {
		if ($("#brand_name").val() == "") {
			$("#brand_name").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
		}else{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data : $("#brand_form").serialize(),
				success : function(data){
					if (data == "BRAND_ADDED") {
						$("#brand_name").removeClass("border-danger");
						$("#brand_error").html("<span class='text-success'><b>New Brand Added Successfully..!</b></span>");
						$("#brand_name").val("");
						fetchBrand();
						
					}else{
						$("#brand_name").addClass("border-danger");
						$("#brand_error").html("<span class='text-danger'><b>Sorry, Brand Name Already Exist!!!</b></span>");
					}
						
				}
			})
		}
		

	});



	///////////////Add Product  
	$("#product_form").on("submit", () => {
		let report = $("#product_report");
		let product_name = $("#product_name");
		let select_cat = $("#select_cat");
		let select_brand = $("#select_brand");
		let product_price = $("#product_price");
		let product_stock = $("#product_stock");
		let status = false;

		



		if (product_name.val() === "") {
			product_name.addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Product Name cannot be empty!</span>");
			status = false;

		} else {
			product_name.removeClass("border-danger");
			$("#p_error").html("");
			status = true;
		}

		if (select_cat.val() === "") {
			select_cat.addClass("border-danger");
			$("#c_error").html("<span class='text-danger'>Category Name cannot be empty!</span>");
			status = false;

		} else {
			select_cat.removeClass("border-danger");
			$("#c_error").html("");
			status = true;
		}

		if (select_brand.val() === "") {
			select_brand.addClass("border-danger");
			$("#b_error").html("<span class='text-danger'>Brand Name cannot be empty!</span>");
			status = false;

		} else {
			select_brand.removeClass("border-danger");
			$("#b_error").html("");
			status = true;
		}

		if (product_price.val() === "") {
			product_price.addClass("border-danger");
			$("#price_error").html("<span class='text-danger'>Price cannot be empty!</span>");
			status = false;

		} else {
			product_price.removeClass("border-danger");
			$("#price_error").html("");
			status = true;
		}


		if (product_stock.val() === "") {
			product_stock.addClass("border-danger");
			$("#stock_error").html("<span class='text-danger'>Price cannot be empty!</span>");
			status = false;

		} else {
			product_stock.removeClass("border-danger");
			$("#stock_error").html("");
			status = true;
		}

		if (status) {

			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#product_form").serialize(),
				success : function(data){
					if (data == "PRODUCT_ADDED") {
						$("#product_report").html("<span class='text-success'><b>New Product Added Successfully!!!</b></span>");
						$("#product_name").val("");
						$("#select_cat").val("");
						$("#select_brand").val("");
						$("#product_price").val("");
						$("#product_qty").val("");

					}else{
						$("#product_report").html("<span class='text-danger'><b>Sorry, Product Name Already Exist!!!</b></span>");
					    $("#product_name").addClass("border-danger");
					}
						
				}
			});
			
		}
	});







	

	
});
