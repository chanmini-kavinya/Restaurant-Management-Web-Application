<?php 
session_start();
include "connection.php";

if(isset($_SESSION["id"]))
{
	$customer_id=$_SESSION["id"];
}
else{
	echo "<script type='text/javascript'>alert('Please Sign In to view the cart');window.location.href='index.php';</script>";
	
}

$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);

if (isset($_POST['btnConfirm'])) {
	
	
	$sql = "select *,sum(price) as tot from cart where customer_id=$customer_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$tot=$row['tot']; 
		}
	$date=date('Y-m-d');
	$sql = "INSERT INTO food_order(customer_id,order_date,amount) VALUES('$customer_id','$date','$tot')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	$sql = "select max(order_no) as max from food_order where customer_id=$customer_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$order_no=$row['max']; 
		}
	
	$sql = "select * from cart where customer_id=$customer_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	
	$i=0;
	while($row=mysqli_fetch_array($result))
		{
			$food_id=$row['food_id']; 
			$quantity=$row['quantity'];
			$unit_price=$row['unit_price'];
			$price=$row['price'];
			
			$i++;
			$sql1 = "INSERT INTO order_details(order_no,line_no,food_id,quantity,unit_price,price) VALUES('$order_no','$i','$food_id','$quantity', '$unit_price','$price')";
			$result1=mysqli_query($con,$sql1) or die(mysqli_error($con));
		}
	if ($recno>0){
		$sql = "DELETE FROM cart WHERE customer_id=$customer_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Your Order Has Been Placed! Thank you for ordering with us');</script>";
		
	}
	
	
	
}

if (isset($_POST['btnCancel'])) {
	$sql = "select * from cart where customer_id=$customer_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$recno=mysqli_num_rows($result);
	if ($recno>0){
	$sql = "DELETE FROM cart WHERE customer_id=$customer_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Your Order Has Been Cancelled');</script>";
	}
}
mysqli_close($con);
?>

<html>
<head>
<meta charset="utf-8">
<title>Food Cart</title>
<style>

	h1{
  		font-family: 'lato', sans-serif;
		margin-left: 15%;
		color: white;
		padding-top: 20px;
	}
	
table {
  font-family: 'lato', sans-serif;
  border-collapse: collapse;
  width: 70%;

}

th {
    font-size: 14px;
    text-transform: uppercase;
	padding: 10px;
	width: 25%;
	text-align: center; 
}
	tr {
		border-radius: 5px;
		display: flex;
		margin-bottom: 10px;
    	box-shadow: 0px 0px 15px 15px rgba(0,0,0,0.1);
	}
	
	td{
		width: 25%;
		text-align: center;
	}
	
	body{
		background-image: url("images/bg2.jpg");
		
	}
	
	.buttona{
	padding: 10px;
    border: none;
	font-size: 16px;
    background-color: #2A9734;
    color: white;
    cursor: pointer;
	margin-bottom: 20px;
	margin-left: 15%;
}
		
	.buttona:hover{
		color: white;
		background-color: #2B7D33;
	}
	
.buttonu{
	padding: 2px;
	width: 100px;
    border: none;
	font-size: 16px;
    background-color: #2B8378;
    color: white;
    cursor: pointer;
	margin-top: 2%;
}
		
	.buttonu:hover{
		color: white;
		background-color: #216960;
	}
	
	.buttond{
	padding: 2px;
	width: 100px;
    border: none;
	font-size: 16px;
    background-color: #A62222;
    color: white;
    cursor: pointer;
	margin-top: 2%;
}
		
	.buttond:hover{
		color: white;
		background-color: #8A1C1C;
	}
	

.text-right{
    text-align: right;
}
a{
    color: white;
    text-decoration: none;
}
a:hover{
    color: #1EB72C;
}
li{
    display: inline;
    padding: 1%;
    font-weight: bold;
	font-family: 'lato', sans-serif;
}
	
header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        padding: 5 20 0 0;
		background-color: #363636;
}
header .logo {
        float: left;
        height:50;
		margin-left: 20px;
}

header .logo img {
        height: 100%;
        width: auto;
}

</style>
</head>

<body>
	
	<header>
             <div class="logo"><img src="images/logo.png" ></div>        
            <div class="text-right">
                <ul>
                    <li><a href="index.php">HOME</a></li>
						<li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT</a></li>
                        <?php 
						if(isset($_SESSION["utype"]))
						{
							if($_SESSION["utype"]=='a')
							{
								?>
								 <li><a href="manage_food.php">MANAGE FOOD</a></li>
								<li><a href="reports.php">REPORTS</a></li>
								<?php
							}
							?>
							<li>
								<a href="cart.php">CART</a>
							</li>
							<li>
								<a href="logout.php">LOGOUT</a>
							</li>
					<?php
						}
						else
						{
							?>
							<li>
								<a href="login.php">SIGN IN / REGISTER</a>
							</li>
					<?php
						}
					?></li>
                        
                </ul>
            </div>

    </header>
	<form name="form1" method="post" action="#">
	<section class="manage">
		</br>
		<h1>Food Cart</h1>
		
		
		<center>
			
        <table> 
                
		<tr bgcolor=" #91A5A5">
		<th>Food Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
		</tr>
		
        <?php
		include "connection.php";
		
		$con = mysqli_connect($host,$uname,$pwd) or die(mysqli_error());
		
		mysqli_select_db($con,$db_name) or die(mysqli_error());
		
		$query="select *from cart where customer_id=$customer_id ";
		$result=mysqli_query($con,$query);
		
			
		while($row=mysqli_fetch_array($result))
		{
			?>
			<tr bgcolor=#DDDDDD>
				<form name=form1, method="post" action="#">
				<td></br><?php echo $row['food_name']; ?> </td>
            
            <td></br>Rs.<?php echo $row['unit_price']; ?></td>
				
			<td></br><?php echo $row['quantity']; ?> </td>
				
			<td></br><?php echo $row['price']; ?> </td>
			
			</form>
			</tr>

			<?php
		}
	
		mysqli_close($con);
		?>
      </table>
</center></br>
<a href="index.php"><input type='button' value='ORDER MORE' name='btnMore' class='buttona'/></a>
<input type='submit' value='CONFIRM ORDER' name='btnConfirm' class='buttona'/>
<input type='submit' value='CANCEL ORDER' name='btnCancel' class='buttona'/>
	  </section>
</form>
</body>
</html>