<?php 

include_once("../database/constants.php");
include_once("./user.php");
include_once("./DBOperation.php");
include_once("./manage.php");

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
if (isset($_POST["category_name"]) AND isset($_POST["parent_cat"])) {
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


//////For Add Product and stock
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

	//add stock
	$obj2 = new DBOperation();
	$result2 = $obj2->add_stock(
		 $_POST["product_name"],
		  $_POST["added_date"],
		  $_POST["product_stock"]
	);
	echo $result;
	//echo $result2;
	exit();
}


// ////For Add Stock
// if (isset($_POST["product_name"])) {

// 	//create an object of DBOperation
// 	$obj = new DBOperation();
// 	$result = $obj->add_stock($_POST["product_name"],
// 		$_POST["added_date"], 
// 		 $_POST["product_stock"]);
// 	echo $result;
// 	exit();
// 	# code...
// }





////////////////Manage Category
if (isset($_POST["manageCat"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("categories", $_POST["pageno"]);
	$rows = $result["rows"]; //fetch rows array
	$pagination = $result["pagination"]; //fetch pagination array

	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * 5) + 1;
		foreach ($rows as $row) {
			//echo $row['cat_id'];
			?>
				<tr style="font-size: 14px;">
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["category"]; ?></td>
			        <td><?php echo $row["parent"]; ?></td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a>&nbsp;|
			        	<a href="./templates/update_category.php" eid="<?php echo $row['cid']; ?>" class="btn btn-info btn-sm edit_cat" data-toggle="modal" data-target="#update_category">Edit </a>
			        </td>
			       
			    </tr>

			<?php
			$n++;
		}

		?>

		 <tr>
			<td colspan="5"><?php echo $pagination; ?></td>
		</tr>
 
		<?php  
		
	}
	 exit();
	
}




////////////////Delete categories or other table row
if (isset($_POST["deleteCat"])) {
	$m = new Manage();
	$result = $m->deleteRecord("categories", "cat_id", $_POST["id"]);
	echo $result;
	exit();
}



/////////Retrieve Categories for the sake of updating
if (isset($_POST["updateCat"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("categories", "cat_id", $_POST["id"]);

	echo json_encode($result);
	exit();
}


///////////Update Categories
if (isset($_POST["update_cat_name"])) {
	//create an object of DBOperation class
	$m = new Manage();

	//fields
	$id = $_POST["cat_id"]; //retrieved from our update_category.php form
	$new_cat_name = $_POST["update_cat_name"];
	$parent = $_POST["parent_cat"]; 

	$result = $m->updateRecord("categories", ["cat_id"=>$id], ["parent_cat"=>$parent, "category_name"=>$new_cat_name, "status"=>1]);
	echo $result;
	exit();
}



//////////////-----Manage Brands-------//////////////

////////////////Manage Brand
if (isset($_POST["manageBrand"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("brands", $_POST["pageno"]);
	$rows = $result["rows"]; //fetch rows array
	$pagination = $result["pagination"]; //fetch pagination array

	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * 5) + 1;
		foreach ($rows as $row) {
			//echo $row['cat_id'];
			?>
				<tr style="font-size: 14px;">
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["brand_name"]; ?></td>
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" bid="<?php echo $row['brand_id']; ?>" class="btn btn-danger btn-sm del_brand">Delete</a>&nbsp;|
			        	<a href="./templates/update_brand.php" eid="<?php echo $row['brand_id']; ?>" class="btn btn-info btn-sm edit_brand" data-toggle="modal" data-target="#update_brand">Edit </a>
			        </td>
			       
			    </tr>

			<?php
			$n++;
		}

		?>

		 <tr>
			<td colspan="5"><?php echo $pagination; ?></td>
		</tr>
 
		<?php  
		
	}
	 exit();
	
}



////////////////Delete brands or other table row
if (isset($_POST["deleteBrand"])) {
	$m = new Manage();
	$result = $m->deleteRecord("brands", "brand_id", $_POST["id"]);
	echo $result;
	exit();
}



/////////Retrieve Brands for the sake of updating
if (isset($_POST["updateBrand"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("brands", "brand_id", $_POST["id"]);

	echo json_encode($result);
	exit();
}



///////////Update Categories
if (isset($_POST["update_brand_name"])) {
	//create an object of DBOperation class
	$m = new Manage();

	//fields
	$id = $_POST["brand_id"]; //retrieved from our update_brand.php form
	$new_brand_name = $_POST["update_brand_name"];
	
	$result = $m->updateRecord("brands", ["brand_id"=>$id], ["brand_name"=>$new_brand_name, "status"=>1]);
	echo $result;
	exit();
}






//////////////-----Manage Products-------/////////////////
if (isset($_POST["manageProduct"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("products", $_POST["pageno"]);
	$rows = $result["rows"]; //fetch rows array
	$pagination = $result["pagination"]; //fetch pagination array

	if (count($rows) > 0) {
		$n = (($_POST["pageno"] - 1) * 5) + 1;
		foreach ($rows as $row) {
			//echo $row['cat_id'];
			?>
				<tr style="font-size: 14px;">
			        <td><?php echo $n; ?></td>
			        <td><?php echo $row["product"]; ?></td>
			        <td><?php echo $row["category"]; ?></td>
			        <td><?php echo $row["brand"]; ?></td>
			        <td><?php echo $row["price"]; ?></td>
			        <td><?php echo $row["stock"]; ?></td>
			        <td><?php echo $row["added_date"]; ?></td>
			    
			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td>
			        	<a href="#" pid="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>&nbsp;|
			        	<a href="./templates/update_product.php" eid="<?php echo $row['pid']; ?>" class="btn btn-info btn-sm edit_product" data-toggle="modal" data-target="#update_product">Edit </a>
			        </td>
			       
			    </tr>

			<?php
			$n++;
		}

		?>

		 <tr>
			<td colspan="9"><?php echo $pagination; ?></td>
		</tr>
 
		<?php  
		
	}
	 exit();
	
}



////////////////Delete product or other table row
if (isset($_POST["deleteProduct"])) {
	$m = new Manage();
	$result = $m->deleteRecord("products", "product_id", $_POST["id"]);
	echo $result;
	exit();
}



/////////Retrieve Products for the sake of updating
if (isset($_POST["updateProduct"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("products", "product_id", $_POST["id"]);

	echo json_encode($result);
	exit();
}


///////////Update Products
if (isset($_POST["new_product_name"])) {
	//create an object of DBOperation class
	$m = new Manage();
	$obj = new DBOperation();

	//fields

	$id = $_POST["product_id"]; //retrieved from our update_product.php form
	$last_date_added = $_POST["last_date_added"]; //retrieved from our update_product.php form
	$added_date = $_POST["added_date"]; //retrieved from our update_product.php form
	$last_product_stock = $_POST["last_product_stock"]; //retrieved from our update_product.php form


	$new_product_name = $_POST["new_product_name"];
	$new_category_name = $_POST["new_category_name"];
	$new_brand = $_POST["new_brand_name"];
	$new_product_price = $_POST["new_product_price"];
	$new_product_stock = $_POST["new_product_stock"];

	if ($last_product_stock === 0) {
		$total_product_stock = $last_product_stock + 0;

	} else {
		$total_product_stock  = ($last_product_stock + $new_product_stock);
	}
	
	
	$result = $m->updateRecord("products", ["product_id"=>$id],
	 ["cat_id"=>$new_category_name,
	 "last_date_added"=>$last_date_added,
	 "added_date"=>$added_date,
	 "brand_id"=>$new_brand,
	 "product_name"=>$new_product_name,
	 "product_price"=>$new_product_price,
	 "new_product_added"=>$new_product_stock,
	 "product_stock"=>$total_product_stock,
	 "p_status"=>1]);

	//add updated products to "stocks" table
	$result2 = $obj->add_stock(
		$new_product_name,
		$added_date,
		$new_product_stock

	);
	//echo $result2;
	echo $result;
	exit();
}








/////////////////////////ORDER PROCESSING ///////////////////////////////////
if (isset($_POST["getNewOrderItem"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecords("products");
	?>

	<tr>
	    <td><b class="number"></b></td>
	    <td>
	        <select name="pid[]" class="form-control form-control-sm pid" id="" required>
	        	<option value="">---Select Product---</option>
	            <?php 
	            	foreach ($rows as $row) {
	            		?>

	            			<option value="<?php echo $row["product_id"]; ?>"><?php echo $row["product_name"]; ?></option>

	            		<?php
	            	}
	             ?>

	        </select>
	        <small id="p_error" class="form-text text-muted"></small>
	    </td>
	    <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>   
	    <td><input name="qty[]" type="text" class="form-control form-control-sm qty" placeholder="Enter Quantity" id="">
	    	<small id="qty_error" class="form-text text-muted"></small>
	    </td>
	    <td><!--<input name="price[]" type="text" class="form-control form-control-sm price" readonly> -->
	    <span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></span></td>
	    <td><!-- N <span class="amt" id="amt">0</span> --></td>
	</tr>

	<?php
	exit();

}




////Get price and quantity of one item
if (isset($_POST["getPriceAndQty"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("products", "product_id", $_POST["id"]);

	echo json_encode($result);
	exit();
}


/////Process order form
if (isset($_POST["order_date"]) AND isset($_POST["staff_name"])) {
	//get form data
	$order_date = $_POST["order_date"];
	$staff_name = $_POST["staff_name"];
	$department = $_POST["department"];

	//getting array variables
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	// $ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];

	// //other fields
	// $sub_total = $_POST["sub_total"];
	// $vat = $_POST["vat"];
	// $discount = $_POST["discount"];
	// $net_total = $_POST["net_total"];
	// $paid = $_POST["paid"];
	// $due = $_POST["due"];
	$payment_type = $_POST["payment_type"];


	$m = new Manage();
	echo $result = $m->storeStaffOrderInvoice($order_date, $staff_name, $department, $ar_tqty, $ar_qty, $ar_pro_name, $payment_type);

}


 ?>