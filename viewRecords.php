<?php include "dbaccess.php"; // Connection to PA_Database

include "functions.php"; // File with search and view functions


 session_start(); // Start Session


 $msg = "";


?>

<!-- VIEW RECORDS SCREEN-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="UTF-8">
	<title>Precision Adjusters</title>
	<link rel="stylesheet" type="text/css" href="page_basic.css" /> 
	<link rel="stylesheet" type="text/css" href="page_form.css" />
	<!--<link rel="stylesheet" type="text/css" href="page_form-position.css" /> Test????????????????????????????????????????????????????????--> 
	<link rel="stylesheet" type="text/css" href="page_button.css" /> 
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
					<br><br><span>View Records</span> 
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
						<table class="form" border="0">
							<tr>
								<td>
									<th><label for="victim"><strong>Victim Information</strong></label><br>
									<div id="victimView" style="background-color:blue;"> 
										
										<?php if (isset($_SESSION["victim_accInfo"])){
												display_VictimInfo();
										} ?>
									</div>
								</td>
								<td>
									<th><label for="insurer"><strong>Insurance Information</strong></label><br>
									<div id="companyView" style="background-color:blue;"> 
										<?php if (isset($_SESSION["insurance_cominfo"])){
												 display_InsuranceInfo(); 
										}?>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<th><label for="owner"><strong>Insured Vehicle Owner Information</strong></label><br>
									<div id="ownerView" style="background-color:blue;"> 
										<?php if (isset($_SESSION["vehicleowner_icinfo"])){ 
												display_OwnerInfo();
										}?>
									</div>
								</td>
								<td>
									<th><label for="vehicle"><strong>Vehicle Information</strong></label><br>
									<div id="vehicleView" style="background-color:blue;"> 
										<?php if (isset($_SESSION["vehicle_accInfo"])){ 
												display_VehicleInfo();
										} ?>
									</div>
								</td>
								<td>
									<th><label for="accident"><strong>Accident Information</strong></label><br>
									<div id="accidentView" style="background-color:blue;"> 
										<?php if (isset($_SESSION["accInfo"])){
											display_AccidentInfo();
										} ?>
									</div>
								</td>
							</tr>
								
							<tr><div style="color:red;"><?php echo $msg;?></div></tr><!--Error Message -->
						</table>						
			</div>
		</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
