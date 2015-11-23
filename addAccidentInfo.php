<?php include "dbaccess.php"; // Connection to PA_Database

   //include "userdbConfig.php";

 session_start(); // Start Session

  $msg = "";

    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Get entered fields
         $loc = $_POST['location'];
       	 $date = $_POST['date'];
       	 $time = $_POST['time'];
         $wState = $_POST['wState'];
         $desc = $_POST['sDesc'];


		//Check to see how many accident record are before
		$sql = "SELECT accidentNo FROM  accinfo";
    	$query = mysql_query($sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

         	
         //Create accident no.
         $accidentNo = mysql_num_rows($query) + 1;
            
        

         // Add to database
         $sql = "INSERT INTO accinfo VALUES ('$accidentNo', '$loc', '$time', '$date', '$wState', '$desc')";
   		 $result = mysql_query($sql);
        
   		    
   		    // Check if values were indeed added
    	    if (!$result)
            {
         	    echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            }
            else
            {
         	    $msg = "Accident No. ".$accidentNo." successfully added";
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
					<br><br><span>Accident Information</span> 
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
				<form name="addaccident" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
						<table class="form" border="0">
	
							<tr>
								<td></td>
								<td style="color:red;">
								<?php echo $msg; ?></td>
							</tr> 
				
							<tr>
								<th><label for="location"><strong> Location </strong></label> <br>
								<input class="inp-text" name="location" id="location" type="text" size="15" required /></th>
								<th><label for="date"><strong> Date </strong></label> <br>
								<input class="inp-text" name="date" id="date" type="date" size="15" placeholder="DD-MM-YYYY" required/> <br> 
								<label for="time"><strong> Time </strong></label> <br>
								<input class="inp-text" name="time" id="time" type="time" size="15" placeholder="HR:MIN AM/PM" required /></th>
							</tr>

							<tr>
								<th><label for="wState"><strong> Witness Statement </strong></label> <br> 
								<!-- <input class="inp-text" name="wState" id="wState" type="text" size="50" required/> </th> -->
								<textarea rows="4" cols="50" class="inp-text" name="wState" id="wState" required></textarea>
								<th><label for="sDesc"><strong> Scene Description </strong></label> <br>
								<!-- <input class="inp-text" name="sDesc" id="sDesc" type="text" size="50" required/></th> -->
								<textarea rows="4" cols="50" class="inp-text" name="sDesc" id="sDesc" required></textarea>
						
							<tr>
								<th>
									<div><a href="addVictimInfo.php" class="button" id="addVictim">Add Victim</a></div>
								</th>
								<th>
									<div><a href="addVehInfo.php" class="button" id="addVehicle">Add Vehicle</a></div>
								</th>
							</tr>
							
							<tr>
							<td></td>
							<td>
								<div id="center-save"><input type ="submit" value ="Save" name = "addAI_Save" id = "addAI_Save"></div>
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
