<?php include "userdbConfig.php";

session_start(); // Start Session

$msg = "";
// Submit button
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST["username"]; // Get entered username
    $password = $_POST["password"]; // Get entered password
	 if ($username == '' || $password == '') {
        $msg = "You must enter all fields";
    } else {
        $sql = "SELECT * FROM  userAccount WHERE user = '$username' AND pass = '$password'";
        $query = mysql_query($sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($query) > 0) { //If they match
         	
         	// Start Session
         	session_start();

         	// Get user type
         	$query = mysql_fetch_array($query);
         	$userType = $query['userType'];

         	// Link to different menu page based on user type
         	if ($userType == 'Database Manager'){
         		$pageLink = 'adminMenu.php';
         	}
         	elseif ($userType == 'Field Investigator') {
         		$pageLink = 'FImenu.php';
         	}
         	elseif ($userType == 'Customer Service Agent') {
         		$pageLink = 'csAgentMenu.php';
         	}

         	// Assign session variables
         	$_SESSION["username"] = $username;
         	$_SESSION["password"] = $password;
         	$_SESSION["userType"] = $userType;
   

         	// Update database
         	$mysql = "UPDATE userAccount SET loggedIn=1 WHERE user = '$username' AND pass = '$password'";
         	$result = mysql_query($mysql,$link);

         	//Check that it was updated
         	if (!$result)
         	{
         		echo "Could not successfully run query ($sql) from DB: " . mysql_error();
         	}
            
            // Redirect to respective pages
            header('Location: '.$pageLink.'');
            exit;
        }
        // Error
        $msg = "Username and password do not match";
    }
}
?>

<!-- Logon Screen for Precision Adjusters Website -->

<!DOCTYPE html>
<html>
<head>
	<title>Precision Adjusters</title>
	<link rel="stylesheet" type="text/css" href="stylesheet-logon.css" />
</head>
<body>
	<div class="body"></div>
			<div class="grad"></div>
			<div class="header">
				<div>Precision<span>Adjusters</span></div>
			</div>
			<br>
	<div id="logon">
		<form name="userlogin" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
			<div class="login">
				<div style="color:red;"><?php echo "<b>".$msg."</b>";?></div> <!-- Error Message -->
				<input type="text" placeholder="username" name="username"><br>
				<input type="password" placeholder="password" name="password"><br>
				<input type="submit" value="Login">
			</div>
		</form>
		<!-- End of main wrap -->
		<div class="footer-wrap">
			<div class="container">
				<div class="footer">
					<span>Copyright &copy 2015. Precision Adjusters. All rights reserved.</span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
