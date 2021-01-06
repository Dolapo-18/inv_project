<?php 

$con = mysqli_connect("localhost", "root", "", "test");

function pagination($con, $table, $pno, $n) {
	// $total_records = 1000;
	$query = $con->query("SELECT COUNT(*) as rows FROM ".$table);
	$row = mysqli_fetch_assoc($query);


	$cur_page_num = $pno;
	$num_records_per_page = $n;

	$last_page = ceil($row["rows"] / $num_records_per_page);
	$pagination = "";

	if ($last_page != 1) {
		if ($cur_page_num > 1) {
			$previous = $cur_page_num - 1;
			$pagination .= "<a href='pagination.php?pageno=". $previous ."' style='color:#000'> Previous </a>";
		}
		for($i = $cur_page_num - 5; $i < $cur_page_num; $i++) {
			if ($i > 0) {
				$pagination .= "<a href='pagination.php?pageno=".$i."'> ".$i." </a>&nbsp";
			}
			
		}
		$pagination .= "<a href='pagination.php?pageno=".$cur_page_num."' style='color:#000'>".$cur_page_num."</a>&nbsp"; 

		for($i=$cur_page_num + 1; $i<=$last_page; $i++) {
			$pagination .= "<a href='pagination.php?pageno=".$i."'> ".$i."</a>&nbsp";
			if ($i > $cur_page_num + 4 ) {
				break;
			}
		}

		if ($last_page > $cur_page_num) {
			$next = $cur_page_num + 1;
			$pagination .= "<a href='pagination.php?pageno=".$next."' style='color:#000'> Next</a>";
		}
	}

	//lIMIT 0, 10 for first page
		//LIMIT 10, 10 for second page
	$limit = "LIMIT " .($cur_page_num - 1) * $num_records_per_page . "," .$num_records_per_page;
	return ["pagination"=>$pagination, "limit"=>$limit];  //this returns an array

}




if (isset($_GET['pageno'])) {
	$pageno = $_GET['pageno'];
	
	$table = "test";
	$array = pagination($con, $table, $pageno, 10); 

	$sql = "SELECT * FROM ".$table." ". $array["limit"];

	$query = $con->$query($sql);

	while ($row = mysqli_fetch_assoc($query)) {
		//remember to replace column_name1 and column_name2 with actual table column name
		echo "<div>".$row["column_name1"]. " ". $row["column_name2"] ."</div>";
	}

	//echo pagination to screen
	echo "<div>".$array["pagination"]."</div>";
}



 ?>