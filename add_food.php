<?php
session_start();
include "connection.php";
$msg="";
if(isset($_POST["txtName"],$_POST["txtPrice"],$_FILES["file"]["name"]))
{
	//Get form data
	$name = $_POST["txtName"];
	$price = $_POST["txtPrice"];
	$img = $_FILES["file"]["name"];
	$ext = end((explode('.',$img))); //extra () to avoid error
	$image = $name.rand(0000,9999).".".$ext;
	$src = $_FILES['file']['tmp_name'];
	$dst = "food_img/".$image;
	$upload = move_uploaded_file($src, $dst);
	if($upload==false)
	{echo "<script type='text/javascript'>alert('image was not uploaded');</script>";
	}
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql = "INSERT INTO food(food_name,price,image) VALUES('$name','$price','$image')";
	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	
	$rows=mysqli_affected_rows($con);
	if ($rows==1)
	{
		$msg="Food added successfully!";
		//echo "<script type='text/javascript'>alert('Food added successfully');</script>";
	}
	mysqli_close($con);
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Add Food Items</title>
<link rel="stylesheet" href="stylesheets/add_food.css" type="text/css"/>
<script language="javascript" type="text/javascript" src="javascripts/add_food.js"></script>	
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
    <section class="add">
        <div class="container">
			
            <form name="form1" enctype="multipart/form-data" method="post" action="#" onSubmit="return validateform(this);"> <!--No characters are encoded. This value is required when you are using forms that have a file upload control-->
				<h1>Add Food Items</h1> </br>
				
				<label for="name" class="font">Food name</label></br> <input type="text" name="txtName" class="textbox" required="required" /><br/>
				<label for="price" class="font">Price</label></br> <input type="text" name="txtPrice" class="textbox" required="required" /><br/>
				<label for="image" class="font">Select Image: </label>     
				<input type="file" name="file" value="Browse" id="browse" accept=".jpg,.jpeg,.png" required="required" />
				</br></br></br>
				<input type="submit" name="submit" value="Add Food" class="button"><p for="msg" class="font" style="color: #65DB6F"><?php echo $msg ?></p>
				<br/>
            </form>
        </div>
	</section>
</body>
</html>