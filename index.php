<?php 
session_start();
if(isset($_POST['ordernow']))
{
	$_SESSION['food_id'] = $_POST['hd_food_id'];
	header("location:food_order.php");
}
?>

<html>
<head>
	<title>Home</title>
    <style>
    body{
		background-color:lightblue;		
		}
		
		#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}
	table {
  font-family: 'lato', sans-serif;
  border-collapse: collapse;
  width: 70%;

}


	tr {
		border-radius: 3px;
		display: flex;
		margin-bottom: 10px;
    
		border: 3px solid green;
	}
	
	td{
		width: 25%;
		text-align: center;
		
		
		
	}	
		
	
		
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--Search-->
<script>	
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<!--End Search-->

	      <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8">

        <!-- Stylesheets -->
        <link href="plugin-frameworks/bootstrap.min.css" rel="stylesheet">
        <link href="plugin-frameworks/swiper.css" rel="stylesheet">
        <link href="fonts/ionicons.css" rel="stylesheet">
        <link href="common/styles.css" rel="stylesheet">
    
</head>
<body>
	<header>

<div class="container">
               <div class="logo"><img src="images/logo.png" ></div>
                <div class="right-area">
                   <a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>

                <ul class="main-menu font-mountainsre" id="main-menu">
                        <li><a href="index.php">HOME</a></li>
						<li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT</a></li>
                        <li><?php 
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
                       
                </div><!-- right-area --> 
        </div><!-- container -->


  </header>
	
	
<section class="bg-5 h-500x main-slider pos-relative">
        <div class="triangle-up pos-bottom"></div>
        <div class="container h-100">
                <div class="dplay-tbl">
                        <div class="dplay-tbl-cell center-text color-white pt-90">
								<h2><b><center>FOOD CORNER</center></b></h2>
							<h4><b><center>THE BEST IN TOWN</center></b></h4></br>
							
                      <!--Search-->
              <div class="search_box">
      			<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for food names..">
    	</div>

      <!--End Search-->

                                <h3 class="mt-30 mb-15"><center>Menu</center></h3>
                        </div><!-- dplay-tbl-cell -->
                </div><!-- dplay-tbl -->
        </div><!-- container -->
</section>
	
<section class="bg-lite-blue">
		<center>
        
       
        <table width="100%" cellpadding="5" cellspacing="5"> 
        <thead>
        <tr>
        		
        
        </tr>
        </thead>
        <tbody id="myTable">
        <?php
		include "connection.php";
		
		$con = mysqli_connect($host,$uname,$pwd) or die("Could not connect to database." .mysqli_error());
		
		mysqli_select_db($con,$db_name) or die("Could not select the databse." .mysqli_error());
		
		$query="select *from `food`";
		$query_run=mysqli_query($con,$query);
		
		while($row=mysqli_fetch_array($query_run))
		{
			?>
			<tr>
				<form name=form1, method="post" action="#">
            <td><?php echo"<img src='food_img/{$row['Image']}' width:'200px' height='200px'>"; ?> </td> <!--retrive image -->
            
            <td><h4><?php echo "{$row['food_name']}"; ?></h4> </td> <!--retrive food name -->
            
            <td><h4>Rs.<?php echo "{$row['Price']}"; ?>.00<h4></td> <!--retrive price -->
        
       <td><input type='submit' style='margin-top:5px; padding: 12 20' value='Order Now' name='ordernow' class='btn btn-success'  /></td> <!-- order button-->
				
				<input type='hidden' value='<?php echo $row['food_id'] ?>' name='hd_food_id' />
				</form>
			</tr>	
			<?php
		}
	
		
		?>
        </tbody>
      </table>
			
        </center>
			</section>
	<footer class="pb-50  pt-70 pos-relative">
        <div class="pos-top triangle-bottom"></div>
        <div class="container-fluid">
                

                <div class="pt-30">
                        <p class="underline-secondary"><b>Address:</b></p>
                        <p>49/3,Wijerama Mawatha,Colombo-07,Sri Lanka</p>
                </div>

                <div class="pt-30">
                        <p class="underline-secondary mb-10"><b>Phone:</b></p>
					<a href="tel:+94 112 224 448">+94 112 224 448</a></br>
			<a href="tel:+94 113 339 448 ">+94 113 339 448</a>
                </div>

                <div class="pt-30">
                        <p class="underline-secondary mb-10"><b>Email:</b></p>
                        <a href="mailto:foodcorner@gmail.com"> foodcorner@gmail.com</a>
                </div>

              

                <p class="color-light font-9 mt-50 mt-sm-30">
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved<i class="fa fa-heart-o" aria-hidden="true"></i>
</p>
        </div><!-- container -->
</footer>


			
	
	
	</body>
	</html>