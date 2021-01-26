<?php 


class Manage {
	
	private $con;
	function __construct() {
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}



public function manageRecordWithPagination($table, $pno) {
	//invoke pagination method
	$display = $this->pagination($this->con, $table, $pno, 5);

	if ($table === "categories") {
		$sql = "SELECT p.cat_id as cid, p.category_name as category, c.category_name as parent, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat = c.cat_id " .$display["limit"];

	} else if ($table === "products") {
		$sql = "SELECT p.product_id as pid, p.product_name as product, c.category_name as category, b.brand_name as brand, p.product_price as price, p.product_stock as stock, p.added_date as added_date, p.p_status as status FROM products p, brands b, categories c WHERE p.brand_id = b.brand_id AND p.cat_id = c.cat_id ".$display["limit"];

	}else {
		$sql  = "SELECT * FROM ".$table." ".$display["limit"];

	}
	$result = $this->con->query($sql) or die($this->con->error);
	$rows = array();
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$rows[] = $row;
		}
	}
	return ["rows" => $rows, "pagination" => $display["pagination"]];
 
}



private function pagination($con, $table, $pno, $n) {
	// $total_records = 1000;
	$query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
	$row = mysqli_fetch_assoc($query);


	$cur_page_num = $pno;
	$num_records_per_page = $n;

	$last_page = ceil($row["rows"] / $num_records_per_page);
	$pagination = "<ul class='pagination'>";

	if ($last_page != 1) {
		if ($cur_page_num > 1) {
			$previous = $cur_page_num - 1;
			$pagination .= "<li class='page-item'><a class='page-link' pn='". $previous ."' href='#' style='color:#000'> Previous </a></li>";
		}
		for($i = $cur_page_num - 5; $i < $cur_page_num; $i++) {
			if ($i > 0) {
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i." </a></li>";
			}
			
		}
		$pagination .= "<li class='page-item'><a class='page-link' pn='".$cur_page_num."' href='#' style='color:#000'>".$cur_page_num."</a></li>"; 

		for($i=$cur_page_num + 1; $i<=$last_page; $i++) {
			$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#'> ".$i."</a></li>";
			if ($i > $cur_page_num + 4 ) {
				break;
			}
		}

		if ($last_page > $cur_page_num) {
			$next = $cur_page_num + 1;
			$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#000'> Next</a></li></ul>";
		}
	}

	//lIMIT 0, 10 for first page
		//LIMIT 10, 10 for second page
	$limit = "LIMIT " .($cur_page_num - 1) * $num_records_per_page . "," .$num_records_per_page;
	return ["pagination"=>$pagination, "limit"=>$limit];  //this returns an array

}



//////Delete Record
 public function deleteRecord($table, $pri_key, $id) {
 	if($table == "categories"){
			$pre_stmt = $this->con->prepare("SELECT ".$id." FROM categories WHERE parent_cat = ?");
			$pre_stmt->bind_param("i",$id);
			$pre_stmt->execute();
			$result = $pre_stmt->get_result() or die($this->con->error);
			if ($result->num_rows > 0) {
				return "DEPENDENT_CATEGORY";
			}else{
				$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pri_key." = ?");
				$pre_stmt->bind_param("i",$id);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "CATEGORY_DELETED";
				}
			}
		}else{
			$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pri_key." = ?");
			$pre_stmt->bind_param("i",$id);
			$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) {
					return "DELETED";
			}
		}
 	 
 }




 /////get a single record from DB
 public function getSingleRecord($table, $pri_key, $id) {
 	$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pri_key."= ? LIMIT 1");
 	$pre_stmt->bind_param("i", $id);
 	$pre_stmt->execute() or die($this->con->error);
 	$result = $pre_stmt->get_result();

 	if ($result->num_rows == 1) {
 		$row = $result->fetch_assoc();
 	}
 	return $row;

 }



 ///////////Update Category
	public function updateRecord($table, $where, $fields) {
		//$table represents the table name to be updated
		//$where represents the condition - an array
		//$fields represents the data to be updated - an array
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			// id = '5' AND m_name = 'something'
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		foreach ($fields as $key => $value) {
			//UPDATE table SET m_name = '' , qty = '' WHERE id = '';
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return "UPDATED";
		}
		

	 }




	 /////////Process staff order
	 public function storeStaffOrderInvoice($order_date, $staff_name, $department, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, $sub_total, $vat, $discount, $net_total, $paid, $due, $payment_type) {
	 	
	 	$pre_stmt = $this->con->prepare("INSERT INTO `invoice`(`order_date`, `staff_name`, `department`, `sub_total`, `vat`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("sssdddddds", $order_date, $staff_name, $department, $sub_total, $vat, $discount, $net_total, $paid, $due, $payment_type);
		$pre_stmt->execute() or die($this->con->error);

		//get the last ID of the table
		$invoice_no = $pre_stmt->insert_id;
		if ($invoice_no != null) {
			for ($i=0; $i < count($ar_pro_name); $i++) {

				//Here we are finding the remaning quantity after giving customer
				$rem_qty = $ar_tqty[$i] - $ar_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				}else{
					//Update Product stock
					$sql = "UPDATE products SET product_stock = '$rem_qty' WHERE product_name = '".$ar_pro_name[$i]."'";
					$this->con->query($sql);
				}


				$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
				$insert_product->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$insert_product->execute() or die($this->con->error);
			}

			return $invoice_no;
		}
		



	 }










} //end class Manage









  //$obj = new Manage();
// // echo "<pre>";
// // print_r($obj->manageRecordWithPagination("categories", 1));

// echo $obj->deleteRecord("brands", "brand_id", 2);

 // print_r($obj->getSingleRecord("categories", "cat_id", 12));

  //echo ($obj->updateRecord("categories", ["cat_id"=>12], ["parent_cat"=>0, "category_name"=>"Hard", "status"=>1]));
 ?>