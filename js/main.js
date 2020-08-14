$(document).ready(function() {

	$("#register_form").on("submit", () => {

		let status = false;
		let name = $("#username");
		let email = $("#email");
		let pass1 = $("#password1");
		let pass2 = $("#password2");

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
			$("#p2_error").html("<span class='text-danger'>Password must be more than 7 characters</span>");
			status = false;

		} else {
			pass2.removeClass("border-danger");
			$("#p2_error").html("");
			status = true;
		}

		if (pass1.val() == pass2.val()) {

			$.ajax({

			});
			
		} else {
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Passwords do not Match :(</span>");
			status = false;
		}


	});
});
