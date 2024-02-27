<?php 
session_start();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="stylesheets/contact.css">
	
			<style>
		
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

.bg{
	
	background-image: url(images/905573.jpg);
	background-size: cover;
    background-repeat: no-repeat;
}

		</style>
	
</head>
<body class="bg">
	<header>
             <div class="logo"><img src="images/logo.png" ></div>        
            <div class="text-right">
                <ul style="margin-top: 18px">
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
	<section class="contact">
		<div class="content">
			<h2><b>Contact Us</b></h2>
			<p>Email us with your any suggestions or complaint.We are happily accept your any responses.</p>
		</div>
		<div class="container">
			<div class="contactinfo">
				<div class="box">
					<div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
					<div class="text">
						<h3>Address</h3>
						<p>49/3,Wijerama Mawatha,<br>Colombo-07,Sri Lanka</p>
					</div>
				</div>
				<div class="box">
					<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
					<div class="text">
						<h3>Phone</h3>
						<p>+94 112 224 448<br>+94 113 339 448</p>
					</div>
				</div>
				<div class="box">
					<div class="icon"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
					<div class="text">
						<h3>E-mail</h3>
						<p>foodcorner@gmail.com</p>
					</div>
				</div>
			</div>
			<div class="contactform">
				<form>
					<h2>Send Message</h2>
					<div class="inputbox">
						<input type="text" name="" required="required">
						<span>Full Name</span>
					</div>
					<div class="inputbox">
						<input type="text" name="" required="required">
						<span>Email</span>
					</div>
					<div class="inputbox">
						<textarea required="required"></textarea>
						<span>Type your message .... </span>
					</div>
					<div class="inputbox">
						<input type="Submit" name="" value="Send">
					</div>
				</form>
			</div>
		</div>
	</section>
</body>
</html>