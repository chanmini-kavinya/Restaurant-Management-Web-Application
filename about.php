<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<title>About Us</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/style_aboutus.css">
</head>
<body>
	
	<header>
                   
            <div class="text-right">
                <ul>
                    <li><a href="index.php">HOME</a></li>
						<li><a href="about.php">ABOUT US</a></li>
                        <li><a href="contact.php">CONTACT</a></li>
                        <?php 
						session_start();
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
	<section id="aboutus">
		<div class="container">
			<div class="row">
				<div class="col-sm-7"><br><br>
				<h2 class="text-center">ABOUT US</h2>
				<p>'Food Corner' restaurant began 05 years ago at Colombo, and today has become an iconic food delivery restaurant among other restaurant in the area.Over the 5 years, it remain dedicated to the craft of bakery products making, priding ourselves in our baking process.Over the 5 years, it remain dedicated to the craft of bakery products making, priding ourselves in our baking process.Inspired by great fresh ingredients, our bakeries were transformed to a multi cuisine restaurant in 2018. In 2019, we continued with rapid growth and increased demand. To satisfy our customers we built a mobile distribution network focused on ensuring freshness and quality. We continue to fulfill the needs and desires of our guests with a menu of ingredient-inspired food.</p><br>
				<p>In 2019 Food Corner restaurant ventured into the home delivery service setting yet another innovative milestone in Colombo District. With the launch of our home delivery service, its popularity rose swiftly. Currently Food Corner Restaurant serves a wide range of food with an exciting selection of special crusts as well as appetizers, pastas, rice, desserts and beverages. To date, Food Corner Restaurant employs over 30 staff members.At Food Corner restaurant we believe in delighting the senses of each and every customer.</p>
				</div>
				<div class="col-sm-5">
					<div class="img-wrap">
						<br><br><br>
						<img src="images/Food-bread-wheat_1024x768.jpg"/>
					</div>
				</div>					
			</div>			
		</div>
	</section>
</body>
</html>