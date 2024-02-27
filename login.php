<?php
session_start();
include "connection.php";


if(isset($_POST["txtUsername"],$_POST["password"]))
{
	//Get form data
	$username = $_POST["txtUsername"];
	$passwd = $_POST["password"];
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql = "select count(*) as log,customer_id,type from customer where mobile='$username' and password=md5('$passwd')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$count=$row['log'];
			$utype=$row['type'];
			$id=$row['customer_id'];
		}
	
	if ($count>0)
	{
		$_SESSION["utype"]=$utype;
		$_SESSION["id"]=$id;
		
		$rem=$_POST["remember"];
		if($rem=='remember')
		{
			setcookie("username", "$username", time()+ (86400 * 30), "/","", 0); // 86400s = 1 day
		}
		else
		{
			setcookie("username", "$username", time()-3600, "/","", 0);
		}
			
		header("location:index.php");
	}
	else
	{
		echo "<script type='text/javascript'>alert('Invalid Username or password');</script>";
	}
	mysqli_close($con);
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="stylesheets/login.css" type="text/css"/>
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
			<h1>Sign In</h1>
			<form name="login" action="#" method="post">
			  <label for="username" class="label">
					
				</label>
				<?php
				if(isset($_COOKIE["username"]))
				{
					?>
					<input type="text" name="txtUsername" placeholder="Mobile number" id="username" value="<?php echo $_COOKIE['username'] ?>" required>
				<?php
				}
				else
				{ ?>
					<input type="text" name="txtUsername" placeholder="Mobile number" id="username" required>
				<?php
				}
				?>
				
			  <label for="password" class="label">
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<table >
					<tr>
						<td height="31" heigt=20px>
							 <label for="rem"  style="word-wrap:break-word">
								<input type="checkbox" name="remember" value="remember">Remember username
							 </label>
						</td>
				  </tr>
					<tr>
						<td>
							Not yet a member?<a href="register.php" class="reg">Register</a>
						</td>
					</tr>
				</table>
				  
				<input type="submit" value="Sign In">
			</form>
		</div>
		
		</section>
	</body>
</html>