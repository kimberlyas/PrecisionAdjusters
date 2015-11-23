<?php include "dbaccess.php"; // Connection to PA_Database

   //include "userdbConfig.php";

 session_start(); // Start Session

  $msg = "";

    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get entered fields
        $vin = $_POST['vin']; //Vehicle Identification Number <br> <input type = "text" name = "vin"> <br><br>
        $plateNo = $_POST['plateNo']; //Plate Number <br> <input type = "text" name = "plateNo"> <br><br>
       	$type = $_POST['type']; //Type <br> <input type = "text" name = "type"> <br><br>        
		$make = $_POST['make']; //Make <br> <input type = "text" name = "make"> <br><br>
		$model = $_POST['model']; //Model <br> <input type = "text" name = "model"> <br><br>        
        $year = $_POST['year']; //Year <br> <input type = "text" name = "year"> <br><br>
        $damages = $_POST['damages']; //Damage Description <br> <input type = "textarea" name = "damages"> <br><br>
        $accidentNo = $_POST['accidentNo']; //Accident Number <br> <input type = "text" name = "accidentNo"> <br><br>
        
         
         // Check to see if accidentNo is linked to another table
         $linksql = "SELECT * FROM accinfo WHERE accidentNo = '$accidentNo'";
         $linked = mysql_query($linksql);
         
        if ($linked === false) {
            echo "Could not successfully run query ($linksql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($linked) > 0) { //If found
         	
            // Store to database
            
			$sql1_VI = "INSERT INTO vehicle_accinfo VALUES ('$vin','$plateNo','$type','$make','$model','$year','$damages','$accidentNo')";
			$q1VI = mysql_query($sql1_VI);

			if(!$q1VI){
		    	echo "Could not successfully run query ($sql1_VI) from DB ($database): " . mysql_error();
			}
            else
            {
         	    $msg = "Accident Vehicle record successfully added";
            }
   		    
        }   
   		else{
   		    //Error message
   		    $msg = "Accident No. ".$accidentNo." does not exist";
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
					<br><br><span>Vehicle Information</span> 
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
				<form name = "vehinfo" action = "<?= $_SERVER['PHP_SELF'] ?>" method = "post">
						<table class="form" border="0">
							<tr>
								<th><label for="vin"><strong>Vehicle Identification Number</strong></label><br>
								<input class="inp-text" name="vin" id="vin" type="text" size="15" required/></th>								
								<th><label for="plateNo"><strong>Plate Number</strong></label><br>
								<input class="inp-text" name="plateNo" id="plateNo" type="text" size="15" required/></th>								
							</tr>
							<tr>
								<th><label for="type"><strong>Type</strong></label><br>
								<input class="inp-text" name="type" id="type" type="text" size="15" required/></th>								
								<th><label for="make"><strong>Make</strong></label><br>
								<input class="inp-text" name="make" id="make" type="text" size="15" required/></th>								
							</tr>
							<tr>
								<th><label for="model"><strong>Model</strong></label><br>
								<input class="inp-text" name="model" id="model" type="text" size="15" required/></th>								
								<th><label for="year"><strong>Year</strong></label><br>
								<input class="inp-text" name="year" id="year" type="text" size="15" required/></th>								
							</tr>
							<tr>
								<th><label for="damages"><strong>Damage Description</strong></label><br>
								<!--<input name="damages" id="damages" type="textarea" required/></th>-->
								<textarea rows="4" cols="50" class="inp-text" name="damages" id="damages" required></textarea>
								<th><label for="accidentNo"><strong>Accident Number</strong></label><br>
								<input class="inp-text" name="accidentNo" id="accidentNo" type="text" required/></th>
							</tr>
						</table>
						<div id = "centersave">
							<div style="color:red;"><?php echo $msg;?></div> <!-- Confirmation/Error Message -->
							<div><input type ="submit" value ="Save" name = "addVI_Save" id = "addVI_Save"></div>
							<div><a href="addOwnerInfo.php" class="button" id="addOwner">Add Owner</a></div>
						</div>
					</form>	
			</div>
		</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
