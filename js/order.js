$(document).ready(() => {
	const DOMAIN = "http://localhost/inv_project";

	addNewRow(); // displays the first row
	$("#add").click(function() {
		addNewRow();
	});


	function addNewRow() {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {getNewOrderItem: 1},
			success: function(data) {
				$("#invoice_item").append(data);

				//increment each newly added row using jQuery
				let n = 0;
				$(".number").each(function() {
					$(this).html(++n);
				});
			}
		});
	}

	//this removes the last child when clicked
	$("#remove").click(function() {
		$("#invoice_item").children("tr:last").remove();
		//calculate(0); //calculate subtotal
	});


	//change/fetch quantity if user changes input- product name
	$("#invoice_item").delegate(".pid", "change", function() {
		const pid = $(this).val(); //retrieve the id of selected product
		const tr = $(this).parent().parent(); //get the parent of the selected product


			//$(".overlay").show();
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {getPriceAndQty: 1, id:pid},
			success: function(data) {
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".qty").val(1);
				// tr.find(".price").val(data["product_price"]);
				// tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
				//calculate(0, 0); //calculate subtotal

			}
		});
	

		

	});
	


	$("#invoice_item").delegate(".qty", "keyup", function() {
		let qty = $(this);
		let tr = $(this).parent().parent();

		//check if quantity input isn't a number
		if (isNaN(qty.val())) {
			alert("Please Enter a Valid Quantity!!!");
			qty.val(1);

		} else if(qty.val() === "") {
			alert("Please Enter a Quantity Value!!!");
			qty.val(1);
		}
		else {
			//check if requested quantity > available quantity
			if ((qty.val() * 1) > (tr.find(".tqty").val() - 0)) {
				alert("Sorry! Your Quantity Request Isn't Available");
				qty.val(0);

			} else {
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				//calculate(0, 0); //calculate subtotal

			}

	}

	});



	/////function calculate
	// function calculate(dis, paid) {
	// 	let sub_total = 0; 
	// 	let vat = 0;
	// 	let net_total = 0;
	// 	let discount = dis;
	// 	let paid_amt = paid;
	// 	let due = 0;

	// 	//set dicount value to user's input
	// 	if ($("#discount").val() === "") {
	// 		discount = 0;


	// 	} else if(isNaN($("#discount").val())) {
	// 		alert("Please Enter a Valid Quantity!!!");
	// 		$("#discount").val("");
	// 		discount = 0;
	// 	}
	// 	else{
	// 		$("discount").val(discount);
	// 	}
		

	// 	//sum up each total to get sub total
	// 	$(".amt").each(function() {
	// 		sub_total +=  ($(this).html() * 1);
	// 	});
	// 	$("#sub_total").val(sub_total);


	// 	//calculate GST or 7.5% VAT
	// 	vat = 0.075 * sub_total;
	// 	$("#vat").val(vat);

	// 	//calculate net total
	// 	net_total += (vat + sub_total);
	// 	net_total = net_total - discount;
	// 	$("#net_total").val(net_total);


	// 	//calculate due
	// 	 due = net_total - paid_amt;
	// 	 $("#due").val(due);


	// }

	// //discount field
	// $("#discount").keyup(function() {
	// 	const discount = $(this).val();
	// 	calculate(discount, 0);

	// });

	// ////paid field
	// $("#paid").keyup(function() {
	// 	let paid = $(this).val();
	// 	let discount = $("#discount").val();

	// 	calculate(discount, paid);

	// });





	////////Process our ORDER FORM
	$("#order_form").click(function() {
		const invoice = $("#get_order_data").serialize();

		if ($("#staff_name").val() === "") {
			$("#staff_name").addClass("border-danger");
			$("#s_error").html("<span class='text-danger'>Please Enter Staff Name</span>");

		}else if($("#department").val() === ""){
			$("#department").addClass("border-danger");
			$("#dept_error").html("<span class='text-danger'>Please Select Department</span>");

		}else if($("#product_name").val() === "") {
			$("#product_name").addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Select a Product</span>");

		}else if($("#qty").val() === "") {
			$("#qty").addClass("border-danger");
			$("#qty_error").html("<span class='text-danger'>Please Enter Quantity</span>");

		}else {
			$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: $("#get_order_data").serialize(),
			success: function(data) {
				
				if (data < 0) {
						alert(data);

					}else if (data === "ORDER_FAIL_TO_COMPLETE") {
						alert("Sorry! One of your requests is out of stock");

					// }else if(data === "DUPLICATE_REQUEST") {
					// 	alert("Duplicate Request");
					}else{
						$("#get_order_data").trigger("reset");
						window.location.href = "";

						if (confirm("Do u want to print invoice ?")) {
							window.open(
							   DOMAIN+"/includes/invoice_bill.php?invoice_no="+data+"&"+invoice,
							  '_blank' //  This is what makes it open in a new window.
							);
						}
					}
				
			}
		});
		}

		
	});



	



});