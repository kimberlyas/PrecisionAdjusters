<?php include "dbaccess.php"; // Connection to PA_Database

   //include "userdbConfig.php";

 session_start(); // Start Session

  $msg = "";

    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get entered fields
         $fname = $_POST['fname'];
       	 $trn = $_POST['trn'];
         $mStatus = $_POST['mStatus'];
         $mname = $_POST['mname'];
         $address1 = $_POST['address1'];
         $address2 = $_POST['address2'];
         $hnumber = $_POST['hnumber'];
         $lname = $_POST['lname'];
         $email = $_POST['email'];
         $wnumber = $_POST['wnumber'];
         $dob = $_POST['dob'];
         $occupation = $_POST['occupation'];
         $cnumber = $_POST['cnumber'];
         $accidentNo = $_POST['accidentNo'];
         
         // Check to see if accidentNo is linked to another table
         $linksql = "SELECT * FROM accinfo WHERE accidentNo = '$accidentNo'";
         $linked = mysql_query($linksql);
         
        if ($linked === false) {
            echo "Could not successfully run query ($linksql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($linked) > 0) { //If found
         	
            // Store to database
            $sql = "INSERT INTO victim_accinfo VALUES ('$trn', '$lname', '$fname', '$mname', '$address','$address2','$email', '$hnumber', '$cnumber', '$wnumber', '$dob', '$occupation', '$mStatus', '$accidentNo')";
   		    $result = mysql_query($sql);
   		    
   		    // Check if values were indeed added
    	    if (!$result)
            {
         	    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            }
            else
            {
         	    $msg = "Accident Victim record successfully added";
            }
   		    
        }   
   		else{
   		    //Error message
   		    $msg = "Accident No. ".$accidentNo." does not exist";
   		}
   		 
            
      }
         
 
?>



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
					<br><br><span>Victim Information</span> 
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
				<form name="addrecord" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
					<table class="form" border="0">
						<tr>
							<th><label for="fname"><strong>First Name</strong></label><br>
							<input class="inp-text" name="fname" id="fname" type="text" size="15" required/></th>								
							<th><label for="trn"><strong>TRN</strong></label><br>
							<input class="inp-text" name="trn" id="trn" type="text" size="15" placeholder="123456789"required/></th>
							<th><label>Mortal Status</label> <br>
             				<select name = "mStatus"> 
               				<option value = "Alive" size="15">Alive</option>
               				<option value = "Dead" size="15">Deceased</option>
             				</select> </th>
						</tr>
						<tr>
							<th><label for="mname"><strong>Middle Name</strong></label><br>
							<input class="inp-text" name="mname" id="mname" type="text" size="15" required/></th>								
							<th><label for="address"><strong>Address</strong></label><br>
							<input class="inp-text" name="address1" id="address1" type="text" size="15" placeholder="Apartment/Street Address" required/> <br>	
							<input class="inp-text" name="address2" id="address2" type="text" size="15" placeholder="City/Parish/State/Zipcode" required/></th>	
							<th><label for="hnumber"><strong>Home Number</strong></label><br>
							<input class="inp-text" name="hnumber" id="hnumber" type="text" size="15" placeholder="999-555-5555" required/></th>
						</tr>
						
						<tr>
							<th><label for="lname"><strong>Last Name</strong></label><br>
							<input class="inp-text" name="lname" id="lname" type="text" size="15" required/></th>								
							<th><label for="email"><strong>Email Address</strong></label><br>
							<input class="inp-text" name="email" id="email" type="text" size="15" required/> </th>
							<th><label for="wnumber"><strong>Work Number</strong></label><br>
							<input class="inp-text" name="wnumber" id="wnumber" type="text" size="15" placeholder="999-555-5555" required/></th>
						</tr>
						
						<tr>
							<th><label for="dob"><strong>Date Of Birth</strong></label><br>
							<input class="inp-text" name="dob" id="dob" type="text" size="15" placeholder="DD-MM-YY" required/></th>								
							<th><label for="occupation"><strong>Occupation</strong></label><br>
							<input class="inp-text" name="occupation" id="occupation" type="text" size="15" required/> </th>
							<th><label for="cnumber"><strong>Cell Number</strong></label><br>
							<input class="inp-text" name="cnumber" id="cnumber" type="text" size="15" placeholder="999-555-5555"required/></th>
							<th><label for="accidentNo"><strong>Accident Number</strong></label><br>
							<input class="inp-text" name="accidentNo" id="accidentNo" type="text" required/></th>
						</tr>
						
						<tr>
							<td><div style="color:red;"><?php echo $msg;?></div> <!-- Confirmation/Error Message --></td>
							<td>
								<div id = "save-button-center"><input type ="submit" value ="Submit" name = "addVI_Save" id = "addVI_Save"></div>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
