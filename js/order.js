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
				tr.find(".price").val(data["product_price"]);
				tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());

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

		} else {
			//check if requested quantity > available quantity
			if ((qty.val() - 0) > (tr.find(".tqty").val() - 0)) {
				alert("Sorry! Your Quantity Request Isn't Available");
				qty.val(1);

			} else {
				tr.find(".amt").html(qty.val() * tr.find(".price").val());

			}

	}

	});



});