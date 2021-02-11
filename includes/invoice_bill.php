<?php 

	include_once("../fpdf/fpdf.php");
	include_once("../database/constants.php");

	if (!isset($_SESSION["user_id"])) {
		header("location:". DOMAIN."/");
	} else {
		$username = $_SESSION['username'];
	}

	if ($_GET["order_date"] && $_GET["invoice_no"]) {
		
		$invoice_no = "LNK" . $_GET["invoice_no"];

		//create an object of the PDF library 
		$pdf = new FPDF();
		$pdf->AddPage();
		//Add logo
		$pdf->Image('../images/linkage_trans.png',null,null,50, 15);
		// Set font
		$pdf->SetFont('Arial','B',16);
		// Centered text in a framed 20*10 mm cell and line break
		$pdf->Cell(190,10,'Inventory Invoice',0,1,'C');
		//Give space
		$pdf->Cell(190,10,'',0,1,'C');
		

		$pdf->SetFont('Arial','',11);

		$pdf->Cell(160,10,'Invoice No:',0,0, "R");
		$pdf->Cell(40,10,$invoice_no,0,1);

		$pdf->Cell(30,10,'Order Date:',0,0);
		$pdf->Cell(40,10,$_GET["order_date"],0,1);

		$pdf->Cell(30,10,'Staff Name:',0,0);
		$pdf->Cell(40,10,$_GET["staff_name"],0,1);

		$pdf->Cell(30,10,'Department:',0,0);
		$pdf->Cell(40,10,$_GET["department"],0,1);
		//give space
		$pdf->Cell(190,10,'',0,1);




		$pdf->Cell(30,10,'',0,0);
		$pdf->Cell(20,10,"#",1,0,"C");
		$pdf->Cell(80,10,"Product Name",1,0,"C");
		$pdf->Cell(30,10,"Quantity",1,1,"C");
		// $pdf->Cell(40,10,"Price",1,0,"C");
		// $pdf->Cell(40,10,"Total (Rs)",1,1,"C");
		if (isset($_GET["pid"])) {
			 for ($i=0; $i < count($_GET["pid"]) ; $i++) { 
		 	$pdf->Cell(30,10,'',0,0);
		 	$pdf->Cell(20,10, ($i+1) ,1,0,"C");
		 	$pdf->Cell(80,10, $_GET["pro_name"][$i],1,0,"C");
			$pdf->Cell(30,10, $_GET["qty"][$i],1,1,"C");
		// 	// $pdf->Cell(40,10, $_GET["price"][$i],1,0,"C");
		// 	// $pdf->Cell(40,10, ($_GET["qty"][$i] * $_GET["price"][$i]) ,1,1,"C");
		 }
		} else {
			echo "<h3>No Product was selected, Please go back and add a product.</h3>";
			exit();
		}
		

		$pdf->Cell(50,10,"",0,1);

		// $pdf->Cell(50,10,"Sub Total",0,0);
		// $pdf->Cell(50,10,": ".$_GET["sub_total"],0,1);
		// $pdf->Cell(50,10,"Gst Tax",0,0);
		// $pdf->Cell(50,10,": ".$_GET["vat"],0,1);
		// $pdf->Cell(50,10,"Discount",0,0);
		// $pdf->Cell(50,10,": ".$_GET["discount"],0,1);
		// $pdf->Cell(50,10,"Net Total",0,0);
		// $pdf->Cell(50,10,": ".$_GET["net_total"],0,1);
		// $pdf->Cell(50,10,"Paid",0,0);
		// $pdf->Cell(50,10,": ".$_GET["paid"],0,1);
		// $pdf->Cell(50,10,"Due Amount",0,0);
		// $pdf->Cell(50,10,": ".$_GET["due"],0,1);

		//give space
		$pdf->Cell(190,10,'',0,1);

		$pdf->Cell(50,10,"Request Type",0,0);
		$pdf->Cell(50,10,": ".$_GET["payment_type"],0,1);


		$pdf->Cell(190,10,'',0,1);
		$pdf->Cell(190,10,'',0,1);
		

		$pdf->Cell(140,10,'Issued By:',0,0, "R");
		$pdf->Cell(40,10,$username,0,1);
		// $pdf->Cell(180,10,"Signature",0,0,"R");

		$pdf->Output("../PDF_INVOICE/PDF_INVOICE_".$invoice_no.".pdf","F");

		$pdf->Output();
	}




 ?>