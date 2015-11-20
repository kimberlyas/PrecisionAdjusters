
<?php include "logon.php";

session_start(); // Start Session

?>

<!DOCTYPE HTML>
<!-- Menu Screen for Precision Adjusters Website (Field Investigator) -->
<html>
<head>
	<meta charset="UTF-8">
	<title>Precision Adjusters</title>
	<link rel="stylesheet" href="stylesheet-fi.css" type="text/css">
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
			
				<h1>Main Menu</h1>
		
			<div>
				<a href='#' class='button' id='button2'>Add Records</a> <!--Get link from the Shanz -->
				<a href='#' class='button' id='button3'>Seach and View Records</a> <!--Get link from the Boyz -->
			</div>
	<div>
	<div id="footer">
			<p>
				&copy; Copyright 2015 | Precision Adjusters | All rights reserved.
			</p>
	</div>
</body>
</html>