<?php include "dbaccess.php"; // Connection to PA_Database

	include "functions.php"; // File with search and view functions

 session_start(); // Start Session


 $msg = ""; 
 $pageLink = 'viewRecords.php';

 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    /* Get entered field data and assign to session variables
	$_SESSION["TRN"] = $_POST["trn"];
	$_SESSION["ICNAME"] = $_POST["icname"];
	$_SESSION["VIN"] = $_POST["vin"];
	$_SESSION["ACCIDENTNO"]= $_POST["accidentNo"]; */

	//============================
  	/*     SEARCH EVALUATION    */
  	//============================
  // Decide which search to do based on link clicked using ?search_name=true
  if (isset($_GET["searchVictim"]))
  {
     	// Get data from text input using name of <input>
  		if (isset($_GET["trn"]))
  	{
  	 	// Run corresponding search using search_by_name($enteredField)
  	 	$arr = search_by_trn($_GET["trn"]);
  	 	// Iterate over returned array exploding each row of data
	 	// place respective indexes into specific arrays
	 	//eg. victim_accinfo = [record0,record1]
	 	//where record = [trn,lname,fname,....] entonces another list of data
	 	explode_tables($arr);
	 	// Redirect to view records page
	 	
         header('Location: '.$pageLink.'');
	 }
	  else
  	 {
  	 	$msg = "No data entered";
  	 }
	

  }
  elseif (isset($_GET["searchCompany"]))
  {
  	  if (isset($_GET["icname"]))
  	 {
  		 $arr = search_by_vin($_GET["icname"]);
  	 	 explode_tables($arr);
  	 	 // Redirect to view records page
         header('Location: '.$pageLink.'');
  	 }
  	  else
  	 {
  	 	$msg = "No data entered";
  	 }
  }
  elseif (isset($_GET["searchVehicle"]))
  {
  	  if (isset($_GET["vin"]))
  	 {
  		 $arr = search_by_icname($_GET["vin"]);
  	 	 explode_tables($arr);
  	 	 // Redirect to view records page
         header('Location: '.$pageLink.'');
  	 }
  	  else
  	 {
  	 	$msg = "No data entered";
  	 }
  }
  elseif (isset($_GET["searchAccident"]))
  {
  	  if (isset($_GET["accidentNo"]))
  	 {
  	 	
  	 	$arr = search_by_accidentNo($_GET["accidentNo"]);
  		explode_tables($arr);
  		// Redirect to view records page
         header('Location: '.$pageLink.'');
  	 }
  	 else
  	 {
  	 	$msg = "No data entered";
  	 }
  	 
  }
  /*else
  {
  	 $msg = "No search executed";
  } */
}
	   
?>

<!-- SEARCH RECORDS SCREEN-->

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
					<br><br><span>Search Records</span> 
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
					<form name="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
						<table class="form" border="0">
							<tr>
								<td>
									<div id="victimSearch" style="background-color:blue;"> 
										<th><label for="trn"><strong>Victim's TRN</strong></label><br>
										<input class="inp-text" name="trn" id="trn" type="text" size="15" /></th>
										<input type="submit" name="searchVictim" class="button" value="Search by Victim">
										<!--<a href="viewRecords.php?searchVictim=true" class="button" id="searchVictim">Search by Victim</a>-->
									</div>
								</td>
								<td>
									<div id="companySearch" style="background-color:blue;"> 
									<th><label for="icname"><strong>Insurance Company</strong></label><br>
									<input class="inp-text" name="icname" id="icname" type="text" size="15" /></th>
									<input type="submit" name="searchCompany" class="button" value="Search by Company">
									<!---<div><a href="viewRecords.php?searchCompany=true" class="button" id="searchCompany">Search by Company</a></div>-->
								</div>
								</td>
							</tr>
							<tr>
								<td>
									<div id="vehicleSearch" style="background-color:blue;"> 
									<th><label for="vin"><strong>Vechicle Identification Number</strong></label><br>
									<input class="inp-text" name="vin" id="vin" type="text" size="15" /></th>
									<input type="submit" name="searchVehicle" class="button" value="Search by Vehicle">
									<!--<div><a href="viewRecords.php?searchVehicle=true" class="button" id="searchVehicle">Search by Vehicle</a></div>-->
								</div>
								</td>
								<td>
									<div id="accidentSearch" style="background-color:blue;"> 
									<th><label for="accidentNo"><strong>Accident Number</strong></label><br>
									<input class="inp-text" name="accidentNo" id="accidentNo" type="text" size="15" /></th>
									<input type="submit" name="searchAccident" class="button" value="Search by Accident">
									<!--<div><a href="viewRecords.php?searchAccident=true" class="button" id="searchAccident">Search by Accident</a></div>-->
								</div>
								</td>
							</tr>
								
							<tr><div style="color:red;"><?php echo $msg;?></div></tr><!--Error Message -->
						</table>
					</form>						
			</div>
		</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
