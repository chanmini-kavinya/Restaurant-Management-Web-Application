<?php 
session_start();
$prtdate=$_GET['id1'];
?>
<html>
  <header>
    <title>Daily Income Report</title>
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


</style>
  <body>
	  <section>
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
	</section>
	  
	 <section style="margin-top: 50px">
    <iframe src="rptDailyIncome.php?id1=<?php echo $prtdate?>" width="100%" height="600px"></iframe>
	</section>
  </body>
</html>