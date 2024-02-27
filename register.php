<?php
session_start();
include "connection.php";

if(isset($_POST["txtName"],$_POST["txtAddress"],$_POST["txtMobile"],$_POST["password"],$_POST["cpassword"]))
{
	//Get form data
	$name = $_POST["txtName"];
	$address = $_POST["txtAddress"];
	$mobile = $_POST["txtMobile"];
	$password = md5($_POST["password"]);
	
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	
	$sql = "select count(*),mobile from customer where mobile='$mobile'";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$c=$row[0];
		}
	if($c>0)
	{
		echo "<script type='text/javascript'>alert('This mobile number is already registered. Try login instead');</script>";
		header("location:login.php");
	}
	else
	{
		$sql = "INSERT INTO customer(name,address,mobile,password,type) VALUES('$name','$address','$mobile','$password','c')";
		$result=mysqli_query($con,$sql) or die(mysqli_error($con));
		$rows=mysqli_affected_rows($con);
		if ($rows==1)
		{
			echo "<script type='text/javascript'>alert('Registration successful');window.location.href='index.php';</script>";
			//header("location:index.php");
		}
		
	}
	
	mysqli_close($con);
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="stylesheets/register.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="javascripts/register.js"></script>
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
	<section class="bg">
	<div class="login">
	<form name="regForm" action="#" method="post" onSubmit="return validateform(this);">
		
				<div>
					<h1>Registration</h1>
					<hr>
					<label for="name"><b>Name</b></label>
					<input id="name" type="text" name="txtName" required>

					<label for="address"><b>Address</b></label>
					<input id="address"  type="text" name="txtAddress" required>

					<label for="mobile"><b>Mobile Number</b></label>
					<input id="mobile"  type="text" name="txtMobile" required>

					<label for="password"><b>Password</b></label>
					<input  id="password"  type="password" name="password" required>
					
					<label for="cpassword"><b>Confirm Password</b></label>
					<input  id="cpassword"  type="password" name="cpassword" required>
					<hr >
					Already a member? <a href="login.php" class="reg">Sign In</a>
					<input type="submit" id="register" name="create" value="Register">
				</div>
	</form>
</div>
		
		</section>
	</body>
</html>