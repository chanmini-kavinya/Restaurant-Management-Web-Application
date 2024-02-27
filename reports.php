<?php
session_start();
include "connection.php";

if(isset($_POST["date"]))
{
	$date = $_POST["date"];
	
}
if(isset($_POST["submit"]))
{
	header("location:rptFrame.php?id1=".$date);
}

?>

<html>
<head>
<meta charset="utf-8">
<title>Reports</title>
<link rel="stylesheet" href="stylesheets/reports.css" type="text/css"/>
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
			
            <form name="form1" enctype="multipart/form-data" method="post" action="#" > <!--No characters are encoded. This value is required when you are using forms that have a file upload control-->
				<h1>Daily Income Report</h1> </br>
				
			<label for="date" class="font">Date</label></br>
				<input type="date" name="date" class="textbox" required="required" />
				<input type="submit" name="submit" value="Generate Report" class="button">
				<br/>
            </form>
        </div>
	</section>
</body>
</html>