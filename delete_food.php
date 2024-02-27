<?php
session_start();
include "connection.php";
//"javascript: return confirm('Please confirm deletion');\" href='delete.php?id=".$query2['id']."
//if(echo "<script type='text/javascript'>confirm('Are you sure you want to delete this food');</script>";)

if(isset($_SESSION["food_id"]))
{
	//Get session data
	$food_id=$_SESSION["food_id"];
	
	$con = mysqli_connect($host,$uname,$pwd);
	mysqli_select_db($con, $db_name);
	$sql1 = "SELECT * FROM food WHERE food_id=$food_id";
	$result=mysqli_query($con,$sql1) or die(mysqli_error($con));
	while($row=mysqli_fetch_array($result))
		{
			$cimage=$row[3];
		}
	unlink("images/".$cimage);
	
	$sql2 = "DELETE FROM food WHERE food_id=$food_id";
	$result=mysqli_query($con,$sql2) or die(mysqli_error($con));
	$rows=mysqli_affected_rows($con);
		if ($rows==1)
		{
			echo "<script type='text/javascript'>alert('Food deleted successfully');</script>";
			header("location:manage_food.php");
		}
	mysqli_close($con);
}

?>