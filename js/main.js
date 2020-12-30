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

			$.ajax({
				url: DOMAIN + "/includes/process.php",
				method: "POST",
				data: $("#register_form").serialize(),
				success: function(data) {
					if (data == "EMAIL_ALREADY_EXIST") {
						alert("Email already used :(");

					} else if( data == "SOME_ERROR") {
						alert("Something went wrong!!!");

					} else {
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



	////Login Part
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
			$.ajax({
				url: DOMAIN + "/includes/process.php",
				method: "POST",
				data: $("#login_form").serialize(),
				success: function(data) {
					if (data == "USER_NOT_REGISTERED") {
						log_email.addClass("border-danger");
						$("#e_error").html("<span class='text-danger'>Sorry! You Haven't Registered Yet.</span>");

					} else if( data == "PASSWORD_MISMATCH_ERROR") {
						log_password.addClass("border-danger");
						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password.</span>");
						

					} else {
						window.location.href = encodeURI(DOMAIN + "/dashboard.php");

					}
				}
			});
		}
	});
});
