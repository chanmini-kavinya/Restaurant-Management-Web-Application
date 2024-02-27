<?php
session_start();
include "fpdf17/fpdf.php";
include "connection.php";

class PDF extends FPDF

{

	function CheckPageBreak($h)

	{       if($this->GetY()+$h>$this->PageBreakTrigger)    
	   $this-> AddPage($this->CurOrientation);
	}


	function Header()
	{

		$prtdate=$_GET['id1'];

		$this->SetFont('Arial','B',13);
		
		$y=12;

		$this->SetY($y);
				$this->SetX(66);
				$this->Cell(100,5,"Food Corner - Daily Income Report");
		$y=$y+8;
		
		$this->SetFont('Arial','B',11);
		$this->SetY($y);
		$this->SetX(90);
		$this->Cell(10,5,$prtdate);

		$this->SetFont('Arial','BU',10);
		$y=$y+12;
		$x=39;
		$this->SetY($y); 
		$this->SetX($x);
		$this->cell(58,5,'Food Name','',L);//Left Align

		$x=$x+58;
		$this->SetY($y); 
		$this->SetX($x);
		$this->cell(25,5,'Quantity','',R);

		$x=$x+24;
		$this->SetY($y); 
		$this->SetX($x);
		$this->cell(20,5,'Unit Price','',R);

		$x=$x+25;
		$this->SetY($y); 
		$this->SetX($x);
		$this->cell(25,5,'Total Price','',R);
	}
}


$pdf = new PDF('P'); //Portrait
//$pdf->AliasNbPages();
$pdf->SetFont('Arial','',10);
$pdf->AddPage();

$y=30;

$prtdate=$_GET['id1'];

$con = mysqli_connect($host,$uname,$pwd);
mysqli_select_db($con, $db_name);
$sql="select * from food";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while($row=mysqli_fetch_array($result))
{
	$food_id=$row['food_id'];
	
	$sql1 = "select food.food_name, sum(order_details.quantity) as tquantity, order_details.unit_price, sum(order_details.price) as tprice from order_details, food_order, food where order_details.order_no=food_order.order_no and order_details.food_id=food.food_id and order_details.food_id='$food_id' and order_date='$prtdate' group by food.food_name, order_details.unit_price";
	$result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
	
	while($row=mysqli_fetch_array($result1))
	{
		
		$food_name=$row['food_name'];
		$tquantity=$row['tquantity'];
		$unit_price=$row['unit_price'];
		$tprice=$row['tprice'];
		
		$y=$y+8;
		$x=40;
		$pdf->SetY($y); 
		$pdf->SetX($x);
		$pdf->multicell(50,5,$food_name,'',L);

		$x=$x+47;
		$pdf->SetY($y); 
		$pdf->SetX($x);
		$pdf->multicell(25,5,$tquantity,'',R);

		$x=$x+32;
		$pdf->SetY($y); 
		$pdf->SetX($x);
		$pdf->multicell(20,5,number_format($unit_price,2),'',R);

		$x=$x+22;
		$pdf->SetY($y); 
		$pdf->SetX($x);
		$pdf->multicell(25,5,number_format($tprice,2),'',R);
	
	}
	
	
}


$sql="select sum(amount) as amt from food_order where order_date='$prtdate'";
$result=mysqli_query($con,$sql) or die(mysqli_error($con));

while($row=mysqli_fetch_array($result))
{
	
	$amount=$row['amt'];
	
	
}

$y=$y+8;
//$x=40;

//$x=$x+109;
$x=149;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->cell(25,5,'_________','',R);

$y=$y+5;
//$x=$x-109;
$x=40;		
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->cell(25,5,'Grand Total','',R);


//$x=$x+119;
$x=151;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->cell(25,5,number_format($amount,2),'',R);

//$x=$x-8;
$x=149;
$y=$y+5;
$pdf->SetY($y); 
$pdf->SetX($x);
$pdf->cell(25,5,'=========','',R);

$pdf->Output();

?>