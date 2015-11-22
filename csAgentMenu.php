<?php include "userdbConfig.php"; // Connection to database: useracountdb and myPHPadmin login credentials
session_start();?>

<!DOCTYPE HTML>
<!-- Menu Screen for Precision Adjusters Website (Field Investigator) -->

<html>
<head>
	<meta charset="UTF-8">
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
			</div><!--End of topbar-->
		</div><!--End of header-->
		
		<div class="banner-wrap">
			<div class="container">
				<div class="banner">
					<br><br><span>MAIN MENU</span> <!--Title of Current Interface>-->
				</div>
			</div>
		</div><!-- End of banner-wrap -->
		
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
						<li>
							<a>
								<?php if (isset($_SESSION["userType"])) : ?>
								<?php echo $_SESSION["userType"]; ?>
								<?php endif; ?>
							</a>
						</li>	<!--User Type -->
						<li>
							<a><?php if (isset($_SESSION["username"])) : ?>
							<?php echo $_SESSION["username"]; ?>
							<?php endif; ?></a>
						</li>  <!--User Name -->		
						<li>
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
					 		</a>  <!--Logout -->
						</li>	
					</ul>
				</div>
			</div>
		</div><!-- End of nav-bar -->
		
		<div class="main-wrap">
			<div class="container">
				<div class="pos-wrap">
					<table style="margin: 0px auto;"><td style="align:centre"><a href='#' class='button' id='button3'>Seach and View Records</a></td> </table><!--Get link from the Boyz -->
				</div>
			</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
