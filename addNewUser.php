<?php  include "userdbConfig.php"; // Connection to useraccountdb and myPHPadmin login credentials

session_start(); // Start Session
//session_id('PrecisionAdjusters'); //SET id first before calling  session start

$msg = "";
$errors = array();
// Submit button
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get entered field data
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$password = $_POST["password"];
	$password2 = $_POST["password2"];
	$userType = $_POST["userType"];

	//Check passwords match
	if ($password != $password2) {
		$errors[] = "Entered passwords do not match";
	}

	/*Check first name
	if(empty($firstName)){
		$errors[] = "First name required";
	}

	//Check last name
	if(empty($lastName)){
		$errors[] = "Last name required";
	}

	//Check password
	if(empty($password)){
		$errors[] = "Password required";
	}

	//Check user type
	if(!isset($_POST["userTypeSelect"])){
		$errors[] = "User Type required";
	}*/

	//Create username for new user
	$username .= $firstName . $lastName;

	//Check to see if username has been used before
	$sql = "SELECT * FROM  userAccount WHERE user = '$username'";
    $query = mysql_query($sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($query) > 0) { //If they match
         	
         	//Append number
         	$username .= mysql_num_rows($query);
            
        }
        
    //If there are no errors, proceed with addition to database
    if (empty($errors)) {
    	// Encrypt password
    	$encPassword = md5($password);
    	// Add values
    	$mysql = "INSERT INTO userAccount (user,pass,userType) VALUES ('$username', '$encPassword','$userType')"; 
    	$querry = mysql_query($mysql);
    	// Check if values were indeed added
    	if (!$querry)
         {
         	echo "Could not successfully run query ($sql) from DB: " . mysql_error();
         }
         else
         {
         	$msg = "New user ".$username." successfully added";
         }

    }
   
}
    
?>

<!DOCTYPE HTML>

<!-- Add User Screen for Precision Adjusters Website (Database Manager) -->

<html>
<head>
	<meta charset="UTF-8">
	<title>Precision Adjusters</title>
	<link rel="stylesheet" type="text/css" href="page_basic.css" /> 
	<link rel="stylesheet" type="text/css" href="stylesheet-form.css" /> 
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
					<br><br><span>ADD NEW USER</span> <!--Title of Current Interface>-->
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

					<form name="addUser" action="<?= $_SERVER['PHP_SELF'] ?>" method="post"  style="margin: 0px auto; align:center; position: inline-block;">
					<div class="add" style="padding:10px;">
						<div style="color:red;">
						<?php // If there are errors, output them as list items
    						echo "<ul>";
    						foreach ($errors as $error){
    							echo "<li>".$error."</li>";}
    						echo "</ul>";
    					?>
    					</div> <!-- Error Message -->
    					
    					<label class="description" for="element_4">Name</label>
						<input type="text" placeholder="First Name" name="firstName" required ><br>
						<input type="text" placeholder="Last Name" name="lastName" required ><br>
						<label class="description" for="element_4">Password</label>
						<input type="password" placeholder="password" name="password" required><br>
						<input type="password" placeholder="re-type password" name="password2" required><br>
						<label class="description" for="element_4">User Type </label>
						<select class="dropdown" id="userType" name="userType"> 
								<option value="1" selected="selected">Please select one</option>
								<option value="2">Database Manager</option>
								<option value="3">Field Investigator</option>
								<option value="4">Customer Service Agent</option>
						</select>
						<input type="submit" value="Add user">
						<div style="color:blue;"><?php echo $msg;?></div> <!-- Confirmation Message -->
					
					</div>
				</form>

				</div>
			</div>
		</div><!-- End of main wrap -->
		<div class="footer"><span>&copy; Copyright 2015 | Precision Adjusters | All rights reserved.</span></div>
	</div>
</body>
</html>
