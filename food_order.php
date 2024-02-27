<?php
session_start();
include "connection.php";
if(isset($_SESSION["food_id"]))
{
	$food_id=$_SESSION["food_id"];
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql= "SELECT * FROM food WHERE food_id=$food_id";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$fname=$row['food_name'];
			$price=$row['Price'];
		}
	mysqli_close($con);
}

if(isset($_SESSION["id"]))
{
	$customer_id=$_SESSION["id"];
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql1 = "SELECT * FROM customer WHERE customer_id=$customer_id";
	$result=mysqli_query($con,$sql1) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$name=$row['name'];
			$mobile=$row['mobile'];
			$address=$row['address'];
		}
	mysqli_close($con);
}
else{
	echo "<script type='text/javascript'>alert('Please Sign In to place your order');window.location.href='index.php';</script>";
	
}

if (isset($_POST['btnadd'])) {
    // Set the post variables so we easily identify them, also make sure they are integer
	
    $quantity=$_POST["txtQuantity"];
	$tot=$price*$quantity;
     	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con,$db_name);
	$sql = "INSERT INTO cart(customer_id,food_name,food_id,quantity,unit_price, price) VALUES('$customer_id','$fname','$food_id','$quantity','$price','$tot')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	header('location: cart.php');
	mysqli_close($con);
}




?>
<html>
<head>
<meta charset="utf-8">
<title>Food - Order </title>
<link rel="stylesheet" href="stylesheets/food_order.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="javascripts/food_order.js"></script>	
</head>

<body >
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
<section class="order">
	<div class="container">
		<form name="frmOrder" enctype="multipart/form-data" method="post" action="#">
			<h1>Order Food</h1> </br>
			<label for="food" class="font">Food Item</label></br> 
			<input type="text" name="txtFood" class="textbox" readonly required="required" value="<?php echo $fname; ?> "/><br/>
			<label for="price" class="font">Price</label></br>
			<input type="text" name="txtPrice" readonly required="required" class="textbox" value="<?php echo $price ;?> "/><br/>
			<label for="quantity" class="font">Quantity</label></br> 
			<input type="number" name="txtQuantity" class="textbox" required="required" min="1" max="20" value="1" /><br/><br/><br/>
			<input type="submit" name="btnadd" value="Add to cart" class="button"><br/><br/>
		</form>
	</div>		
</section>	
</body>
</html>