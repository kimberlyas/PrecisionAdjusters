<?php include "dbaccess.php"; // Connection to PA_Database

   //include "userdbConfig.php";

 session_start(); // Start Session

  $msg = "";

    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get entered fields
        $policyNo = $_POST['policyNo'];//Policy Number <br> <input type = "text" name = "policyNo"> <br><br>
		$lname_ic = $_POST['lname_ic'];//Last Name <br> <input type = "text" name = "lname_ic"> <br><br>
		$fname_ic = $_POST['fname_ic'];//First Name <br> <input type = "text" name = "fname_ic"> <br><br>
		$mname_ic = $_POST['mname_ic'];//Middle Name <br> <input type = "text" name = "mname_ic"> <br><br>
		$dlicense = $_POST['dlicense'];//Driver's License Number <br> <input type = "text" name = "dlicense"> <br><br>
		$icname = $_POST['icname'];//Insurer <br> <input type = "text" name = "insurer"> <br><br>	
		$vin = $_POST['vin']; //Vehicle Identification Number <br> <input type = "text" name = "vin"> <br><br>
		
        
         
         // Check to see if vin and icname is linked to another table
         $linksql = "SELECT * FROM insurance_cominfo, vehicle_accinfo WHERE insurance_cominfo.icname = '$icname' AND vehicle_accinfo.vin = '$vin'";
         $linked = mysql_query($linksql);
         
        if ($linked === false) {
            echo "Could not successfully run query ($linksql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($linked) > 0) { //If found
         	
            // Store to database
            
			$sql1_VO = "INSERT INTO vehicleowner_icinfo VALUES ('$policyNo','$lname_ic','$fname_ic','$mname_ic','$dlicense','$icname','$vin')";
			$q1VO = mysql_query($sql1_VO);

			if(!$q1VO){
		    	echo "Could not successfully run query ($sql1_VO) from DB ($database): " . mysql_error();
			}
            else
            {
         	    $msg = "Insured Vehicle Owner record successfully added";
            }
   		    
        }   
   		else{
   		    //Error message
   		    $msg = "Insurance Company ".$icname." not found ";
   		    $msg .= "OR Vehicle Identification Number ".$vin." not found";

   		}
   		 
            
      }
         
 
?>

<!-- 6.5.8 Screen 8: Vehicle Information
Access right: Field Investigator & Database Manager-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
					<br><br><span>Owner Information</span> 
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
				<form name = "ownerinfo" action = "<?= $_SERVER['PHP_SELF'] ?>" method = "post">
						<table class="form" border="0">
							<tr>
									<th><label for="policyNo"><strong>Policy Number</strong></label><br>
									<input class="inp-text" name="policyNo" id="policyNo" type="text" size="15" required/></th>
									<th></th>
									<th><label for="icname"><strong>Insurer</strong></label><br>
									<input class="inp-text" name="icname" id="icname" type="text" size="15" required/></th>
									
									<!--<select class = "dropdown" name="icname" id="icname" required> Where is this dropdown class defined???????????????????
									<option value = "Advantage General">Advantage General</option> 
									<option value = "General Accident" name = "General Accident"></option>
									<option value = "Sagicor" name="Sagicor"></option>
									//Need a list of ALL motor vehicle insurance in JA???????????????????????????????????????????-->
							<tr>
								<th><label for="lname_ic"><strong>Last Name</strong></label><br>
								<input class="inp-text" name="lname_ic" id="lname_ic" type="text" size="15" required/></th>	
								
								<th><label for="fname_ic"><strong>First Name</strong></label><br>
								<input class="inp-text" name="fname_ic" id="fname_ic" type="text" size="15" required/></th>								
								
								<th><label for="mname_ic"><strong>Middle Name</strong></label><br>
								<input class="inp-text" name="mname_ic" id="mname_ic" type="text" size="15" required/></th>								
							</tr>
							<tr>
								<th><label for="dlicense"><strong>Driver's License Number</strong></label><br>
								<input class="inp-text" name="dlicense" id="dlicense" type="text" size="15" placeholder="123456789" required/></th>	
								<th></th>
								<th><label for="vin"><strong>Vehicle Identification Number</strong></label><br>
								<input class="inp-text" name="vin" id="vin" type="text" size="15" required/></th>
							</tr>
							<tr><div style="color:red;"><?php echo $msg;?></div></tr><!-- Confirmation/Error Message -->
						</table>
						<div id = "centersave"><input type ="submit" value ="Save" name = "addVO_Save" id = "addVO_Save"></div>
					</form>	
			</div>
		</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
