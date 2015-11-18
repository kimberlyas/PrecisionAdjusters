
<?php include "logon.php";

session_start(); // Start Session

if ($_POST['newUserSubmit']) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$userType = $_POST['userType'];
	$errors = array();

	//Check passwords match
	if ($password != $password2) {
		$errors[] = "Entered passwords do not match";
	}

	//Check first name
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
	if(!isset($_POST['userTypeSelect'])){
		$errors[] = "User Type required";
	}

	//Create username for new user
	$username = $firstName + $lastName;

	//Check to see if username has been used before
	$sql = "SELECT * FROM  userAccount WHERE username = '$username'";
        $query = mysql_query($sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($query) > 0) { //If they match
         	
         	//Append number
         	$username = $username + mysql_num_rows($query);
            
        }
        
    }

    //If there are no errors, proceed with addition to database
    if (empty($errors)) {
    	// Encrypt password
    	$encPassword = md5($password);
    	// Add values
    	$mysql = "INSERT INTO userAccount (user,pass,userType) VALUES ('$username', '$encPassword','$userType')"; 
    	$querry = mysql_query($mysql);
    }
    else{// If there are erros, output them as list items
    	echo "<ul>";
    	foreach ($errors as $error){
    		echo "<li>".$error."</li>";
    	}
    	echo "</ul>";
    }
    
}

?>

<!DOCTYPE HTML>
<!-- Add New User Screen for Precision Adjusters Website (Database Manager)-->
<html>
<head>
	<meta charset="UTF-8">
	<title>Precision Adjusters</title>
	<link rel="stylesheet" href="stylesheet-adduser.css" type="text/css">
</head>
<body>
	<div id="header">
		<div class="section">
			<div class="logo">
				<a href="index.html">Precision Adjusters</a>
			</div>
			<ul>
				<li>
					<a><?php if ($_SESSION['userType']) : ?>
						<?php echo $_SESSION['userType']; ?>
						<?php endif; ?>
					</a> <!--UserType --> 
				</li>
				<li>
					<a><?php if ($_SESSION['username']) : ?>
						<?php echo $_SESSION['username']; ?>
						<?php endif; ?>
					</a> <!--UserName --> 
				</li>
				<li>
					<a href="logon.php?id=0">Logout
						<?php if ($_GET['id'] == 0) {
						if(isset($_SESSION['username']))
							unset($_SESSION['username']);
						if(isset($_SESSION['password']))
							unset($_SESSION['password']);
						if(isset($_SESSION['loggedIn']))
							unset($_SESSION['loggedIn']);
						session_destroy();
					}?> </a>  <!--Logout --> 
				</li>
			</ul>
		</div>
	</div>
	<div id="body">
			<div>
				<h1></h1>
			</div>
			<!--<img id="top" src="top.png" alt="">-->
			<div id="form_container">
	
				<h1><a>Add new user</a></h1>
				<form id="form_1072598" class="appnitro"  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					<div class="form_description">
							<h2>Add new user</h2>
							<p></p>
					</div>						
							<ul >
								<li id="li_1" >
									<label class="description" for="element_1">Name </label>
									<span>
										<input id="firstName" name= "element_1_1" class="element text" maxlength="255" size="8" 
										value="<?php if ($_POST['firstName']) {echo $_POST['firstName']}?>"/>
										<label>First</label>
									</span>
									<span>
										<input id="lastName" name= "element_1_2" class="element text" maxlength="255" size="14" 
										value="<?php if ($_POST['lastName']) {echo $_POST['lastName']}?>"/>
										<label>Last</label>
									</span> 
								</li>
								<li id="li_2" >
									<label class="description" for="element_2">Password </label>
									<div>
										<input id="password" name="element_2" class="element text medium" type="text" maxlength="255" value=""/> 
									</div> 
								</li>
								<li id="li_3" >
									<label class="description" for="element_3">Re-Type Password </label>
									<div>
										<input id="passsword2" name="element_3" class="element text medium" type="text" maxlength="255" value=""/> 
									</div> 
								</li>
								<li id="li_4" >
									<label class="description" for="element_4">User Type </label>
									<div>
										<select class="element select medium" id="userType" name="element_4"> 
											<option value="1" selected="selected">Please select one</option>
											<option value="2" >Database Manager</option>
											<option value="3" >Field Investigator</option>
											<option value="4" >Customer Service Agent</option>
										</select>
									</div> 
								</li>
								<li class="buttons">
			    					<input type="hidden" name="form_id" value="1072598" />
									<input id="newUserSubmit" class="button_text" type="submit" name="submit" value="Submit" />
								</li>
							</ul>
			</form>	
		<div>
	<div id="footer">
			<p>
				&copy; Copyright 2015 | Precision Adjusters | All rights reserved.
			</p>
	</div>
</body>
</html>
