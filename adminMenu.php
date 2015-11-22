<?php  
	include "userdbConfig.php"; // Connection to useraccountdb and myPHPadmin login credentials
	session_start(); 
?>

<!-- Menu Screen for Precision Adjusters Website (Database Manager) -->

<!DOCTYPE html>
<html>
<head>
	<title>Precision Adjusters</title>
	<link rel="stylesheet" type="text/css" href="page_basic.css" />
	<link rel="stylesheet" type="text/css" href="stylesheet-button.css" />
	<script type="text/javascript" src="menubar.js"></script>
</head>
<body>
	<div class="page">
		<div class="header">
			<div class="topbar">
				<label id="label">
					<span>
						<span>Menu</span>
					</span>
				</label>
				<div id="logo"> 
					<span>
						<span><img src="images/Company Logo.png" style="padding-top: 10px"></img></span>

					</span>
				</div>
			</div>
		</div>
        <!--End of top bar-->
		<div class="banner-wrap">
			<div class="container">
				<div class="banner">
					<span>MAIN MENU</span>
				</div>
			</div>
		</div>
		<!-- End of header -->
		<div id="nav-wrap" style="overflow: hidden">
			<div class="container">
				<div class="desktop-nav">
					<ul>
						<li>
							<a href="
							<?php 
								if (isset($_SESSION["userType"]))
								{
									// Link to different menu page based on user type
         							if ($_SESSION["userType"] == 'Database Manager'){
         								$homeLink = 'adminMenu.php';
         							}
         							elseif ($_SESSION["userType"] == 'Field Investigator') {
         								$homeLink = 'FImenu.php';
         							}
         							elseif ($_SESSION["userType"] == 'Customer Service Agent') {
         								$homeLink = 'csAgentMenu.php';
         							}

         							echo $homeLink;

								}
							?>">

								Home

					 		</a>  <!--Home (Redirects to respesctive Main Menu screen based on logged in User's type) -->
						</li>	
						<li> <!--UserType -->
							<?php if (isset($_SESSION["userType"])) : ?>
							<?php  echo $_SESSION["userType"]; ?>
							<?php endif; ?>
						</li>	 
						<li> <!--UserName -->
							<?php if (isset($_SESSION["username"])) : ?>
							<?php  echo $_SESSION["username"]; ?>
							<?php endif; ?>
					    </li>		
						<li> <!--Logout --> 
							<a href="logon.php?id=0">Logout
							<?php 
								if (isset($_SESSION["loggedIn"]))
								{
									// Update database
         							$mysql = "UPDATE userAccount SET loggedIn=0 WHERE user = '".$_SESSION["username"]."' ";
         							$result = mysql_query($mysql,$link);

         							//Check that it was updated
         							if (!$result)
         							{
         								echo "Could not successfully run query ($sql) from DB: " . mysql_error();
         							}

         							// Unset all session variables
									session_destroy();
								}
							?>
					 		</a>  
						</li>	
					</ul>
				</div>
			</div>
		</div>
		<!-- End of Nav Bar -->
		<div class="main-wrap">
			<div class="container">
				<div class="pos-wrap">
					<table style="margin: 0px auto;" class="buttons" border="0"> 
			
							<tr style="align:centre margin-top:120px;;"><td><a href='addNewUser.php' class='button' id='button1'>Add New User</a></td></tr>
							<tr style="align:centre;"><td><a href='#' class='button' id='button2'>Add and Update Records</a></td></tr>
							<tr style="align:centre;"><td><a href='#' class='button' id='button3'>Seach and View Records</a></td></tr>

					</table>
						
				</div>
			</div>
		</div>
		<!-- End of main wrap -->
		<div class="footer-wrap">
			<div class="container">
				<div class="footer">
					<span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved</span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
