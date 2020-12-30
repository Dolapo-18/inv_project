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
		$result = $pre_stmt->execute() or die();

		if ($result) {
			return "CATEGORY_ADDED_SUCCESSFULLY";
		} else {
			return 0;
		}


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