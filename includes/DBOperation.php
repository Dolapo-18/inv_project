<?php 

/**
 * 
 */
class DBOperation {

	private $con;
	function __construct() {
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}



	public function addCategory($parent_cat, $cat_name) {
		$status = 1;
		$pre_stmt = $this->con->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
		$pre_stmt->bind_param("isi", $parent_cat, $cat_name, $status);
		$result = $pre_stmt->execute() or die($this->con->error);

		if ($result) {
			return "CATEGORY_ADDED";
		} else {
			return 0;
		}


	}


	public function addBrand($brand_name) {
		$status = 1;
		$pre_stmt = $this->con->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");
		$pre_stmt->bind_param("si", $brand_name, $status);
		$result = $pre_stmt->execute() or die();

		if ($result) {
			return "BRAND_ADDED";
		} else {
			return 0;
		}
	}



	public function addProduct($cat_id, $brand_id, $product_name, $product_price, $product_stock, $added_date) {
		$status = 1;
		$pre_stmt = $this->con->prepare("INSERT INTO `products`(`cat_id`, `brand_id`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES (?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("iisdisi", $cat_id, $brand_id, $product_name, $product_price, $product_stock, $added_date, $status);
		$result = $pre_stmt->execute() or die($this->con->error);

		if ($result) {
			return "PRODUCT_ADDED";
		} else {
			return "SOMETHING_WENT_WRONG";
		}
	}


	//this function adds certain fields to the "stocks" table when user adds new product or update product in order to keep track on what was added and when it was added and qty added.
	public function add_stock($product_name, $added_date, $product_stock) {
		$pre_stmt = $this->con->prepare("INSERT INTO `stocks`(`product_name`, `added_date`, `product_stock`) VALUES (?,?,?)");
		$pre_stmt->bind_param("ssi", $product_name, $added_date, $product_stock);
		$result = $pre_stmt->execute() or die($this->con->error);

		// if ($result) {
		// 	return "PRODUCT_ADDED";
		// } else {
		// 	return "SOMETHING_WENT_WRONG";
		// }
	}



	public function getAllRecords($table) {
		$pre_stmt = $this->con->prepare("SELECT * FROM " . $table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		$row = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		} else {
			return "NO_RECORD_FOUND";
		}

	}




	




}


//  $dbO = new DBOperation();
//  $dbO->addCategory(1, "Mobiles");
//  echo "<pre>";
//  print_r($dbO->getAllRecords("categories"));
 ?>