<?php 
session_start();

if(isset($_POST['update']))
{
	$_SESSION['food_id'] = $_POST['hd_food_id'];
	header("location:update_food.php");
}

if(isset($_POST['delete']))
{
	$_SESSION['food_id'] = $_POST['hd_food_id'];
	header("location:delete_food.php");
	
}
?>

<html>
<head>
<meta charset="utf-8">
<title>Manage Food</title>
<link rel="stylesheet" href="stylesheets/manage_food.css" type="text/css"/>
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
	
	<section class="manage">
		</br>
		<h1>Manage Food</h1>
		<a href="add_food.php"><input type='button' value='ADD NEW FOOD' name='add' class='buttona' onClick="add_food.php"/></a>
		
		<center>
        <table> 
                
		<tr bgcolor=" #91A5A5">
		<th>Food Name</th>
		<th>Price</th>
		<th>Image</th>
		<th>Action</th>
		</tr>
		
        <?php
		include "connection.php";
		
		$con = mysqli_connect($host,$uname,$pwd) or die(mysqli_error());
		
		mysqli_select_db($con,$db_name) or die(mysqli_error());
		
		$query="select *from food order by food_name";
		$result=mysqli_query($con,$query);
		
			
		while($row=mysqli_fetch_array($result))
		{
			?>
			<tr bgcolor=#DDDDDD>
				<form name=form1, method="post" action="#">
				<td></br><?php echo $row[1]; ?> </td>
            
            <td></br>Rs.<?php echo $row[2]; ?></td>
				
			<td><img src="Food_img/<?php echo $row[3]; ?>" width="100px" height="100px"/></td>
				
			<td></br><input type='submit' value='Update' name='update' class='buttonu'  />
			<input type='submit' value='Delete' name='delete' class='buttond' /></td>
			
			<input type='hidden' value='<?php echo $row[0] ?>' name='hd_food_id' />
			</form>
			</tr>

			<?php
		}
	
		mysqli_close($con);
		?>
      </table>
      </center>
	  </section>
</body>
</html>