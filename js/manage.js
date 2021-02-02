$(document).ready(function() {

	const DOMAIN = "http://localhost/inv_project";

	///////Manage Category
	manageCategory(1);
	function manageCategory(pno) {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {manageCat: 1, pageno: pno},
			success: function(data) {
				$("#get_category").html(data);
				//alert(data);
			}
		});
	};

	//manage pagination for next page(s)
	$("body").delegate(".page-link", "click", function() {
		let pageno = $(this).attr("pn");
		//alert(pageno);
		manageCategory(pageno);
	});

	//delete category button
	$("body").delegate(".del_cat", "click", function() {
		let did = $(this).attr("did");
		//alert(did);
		if (confirm("Are you sure you want to delete???")) {
			$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {deleteCat: 1, id: did},
			success: function(data) {
				if (data === "DEPENDENT_CATEGORY") {
					alert("Sorry! this category is dependent on another sub-category");

				} else if (data === "CATEGORY_DELETED") {
					alert("Category Deleted Successfully");
					manageCategory(1);

				} else if (data === "DELETED") {
					alert("Record deleted Sucessfully");

				} else {
					alert(data);
				}
				
			}
		});
		} else {
			
		}
	});




	//////////////////
	///Fetch Category
	fetchCategory();
	function fetchCategory() {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {getCategory: 1},
			success: function(data) {
				const root = "<option value='0'>Root</option>";
				const update_cat = "<option value=''>---Choose Category---</option>";
				$("#parent_cat").html(root + data);
				$("#update_category_name").html(update_cat + data);


	
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
				const update_brand = "<option value=''>---Select Brand---</option>";
				$("#select_brand").html(brands + data);
				$("#update_brand_name").html(update_brand + data);
			}
		});


	}



	///retrieve data for category
	$("body").delegate(".edit_cat", "click", function() {
		let eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateCat:1, id:eid},
			success: function(data) {
				$("#cid").val(data["cat_id"]);
				$("#update_cat_name").val(data["category_name"]);
				$("#parent_cat").val(data["parent_cat"]);

			} 
		});
	});




	////////////////////Update Category
$("#update_category_form").on("submit", function() {
	if ($("#update_cat_name").val() == "") {
			$("#update_cat_name").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter New Category Name</span>");

		}else{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  : $("#update_category_form").serialize(),
				success : function(data){
					//alert(data);
					$("#cat_error").html("<span class='text-success'><b>Category Updated Successfully!!!</b></span>");
					manageCategory(1);
					setTimeout(function() {
						window.location.href = "";
					}, 1000);
				}
			})
		}
});



///////////////--------MANAGE BRANDS---------///////////////////
///////Manage Category
	manageBrand(1);
	function manageBrand(pno) {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {manageBrand: 1, pageno: pno},
			success: function(data) {
				$("#get_brand").html(data);
				//alert(data);
			}
		});
	}

//manage pagination for next page(s)
	$("body").delegate(".page-link", "click", function() {
		let pageno = $(this).attr("pn");
		//alert(pageno);
		manageBrand(pageno);
	});



	//delete brand button
	$("body").delegate(".del_brand", "click", function() {
		let bid = $(this).attr("bid");
		//alert(did);
		if (confirm("Are you sure you want to delete???")) {
			$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {deleteBrand: 1, id: bid},
			success: function(data) {
				if (data === "DELETED") {
					alert("Brand Deleted Successfully!!!");
					window.location.href = "";

				} else {
					alert(data);
				}
			}
		});
		} else {
			
		}
	});





	///retrieve data for brand
	$("body").delegate(".edit_brand", "click", function() {
		let eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateBrand:1, id:eid},
			success: function(data) {
				//console.log(data);
				$("#brand_id").val(data["brand_id"]);
				$("#update_brand_name").val(data["brand_name"]);
				

			} 
		});
	});



	////////////////////Update Brand
$("#update_brand_form").on("submit", function() {
	if ($("#update_brand_name").val() == "") {
			$("#update_brand_name").addClass("border-danger");
			$("#brand_error").html("<span class='text-danger'>Please Enter New Brand Name</span>");

		}else{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  : $("#update_brand_form").serialize(),
				success : function(data){
					//alert(data);
					$("#brand_error").html("<span class='text-success'><b>Brand Updated Successfully!!!</b></span>");
					manageBrand(1);
					setTimeout(function() {
						window.location.href = "";
					}, 1000);
				}
			})
		}
});







///////////////--------MANAGE PRODUCTS---------///////////////////
///////Manage Products
	manageProduct(1);
	function manageProduct(pno) {
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {manageProduct: 1, pageno: pno},
			success: function(data) {
				$("#get_product").html(data);
				//alert(data);
			}
		});
	}

//manage pagination for next page(s)
	$("body").delegate(".page-link", "click", function() {
		let pageno = $(this).attr("pn");
		//alert(pageno);
		manageProduct(pageno);
	});


	//delete product button
	$("body").delegate(".del_product", "click", function() {
		let pid = $(this).attr("pid");
		//alert(did);
		if (confirm("Are you sure you want to delete???")) {
			$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			data: {deleteProduct: 1, id: pid},
			success: function(data) {
				if (data === "DELETED") {
					alert("Product Deleted Successfully!!!");
					window.location.href = "";

				} else {
					alert(data);
				}
			}
		});
		} else {
			
		}
	});



	///retrieve data for product
	$("body").delegate(".edit_product", "click", function() {
		let pid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url: DOMAIN + "/includes/process.php",
			method: "POST",
			dataType: "json",
			data: {updateProduct:1, id:pid},
			success: function(data) {
				
				$("#product_id").val(data["product_id"]);
				$("#last_date_added").val(data["added_date"]);
				$("#last_product_stock").val(data["product_stock"]);

				$("#update_product_name").val(data["product_name"]);
				$("#update_category_name").val(data["cat_id"]);
				$("#update_brand_name").val(data["brand_id"]);
				$("#update_product_price").val(data["product_price"]);
				$("#update_product_stock").val(data["product_stock"]);

				//alert($("#last_product_stock").val());

			} 
		});
	});




////////////////////Update Brand
$("#update_product_form").on("submit", function() {
	if ($("#update_product_name").val() == "") {
			$("#update_product_name").addClass("border-danger");
			$("#p_error").html("<span class='text-danger'>Please Enter New Category Name</span>");

		}else{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  : $("#update_product_form").serialize(),
				success : function(data){
					if (data === "UPDATED") {
						$("#p_error").html("<span class='text-success'><b>Product Updated Successfully!!!</b></span>");
					manageProduct(1);

					setTimeout(function() {
						window.location.href = "";
					}, 1000);

					} else {
						alert(data);
					}
					
				}
			})
		}
});





}); 