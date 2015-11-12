<?php include "dbConfig.php";

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $password = md5($_POST["password"]);
	 if ($name == '' || $password == '') {
        $msg = "You must enter all fields";
    } else {
        $sql = "SELECT * FROM members WHERE name = '$name' AND password = '$password'";
        $query = mysql_query($sql);

        if ($query === false) {
            echo "Could not successfully run query ($sql) from DB: " . mysql_error();
            exit;
        }

        if (mysql_num_rows($query) > 0) {
         
            header('Location: YOUR_LOCATION');
            exit;
        }

        $msg = "Username and password do not match";
    }
}
?>

<!-- Logon Screen for Precision Adjusters Website -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta charset="UTF-8">
	<title>Precision Adjusters Log-on</title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<link rel="stylesheet" href="stylesheet-logon.css" type="text/css">
</head>
<body>
	<div id="header">
		<div class="section">
			<div class="logo">
				<a href="index.php">Precision Adjusters</a>
			</div>
			<ul>
				<li>
					<a>User Type</a> <!--Add PHP code to determine --> 
				</li>
				<li>
					<a>User Name</a> <!--Add PHP code to determine --> 
				</li>
				<li>
					<a href="index.php">Logout</a> <!--Add PHP code to determine --> 
				</li>
			</ul>
		</div>
	</div>
	<div id="body">
		<h1>User Login</h1>
		<div id="logon">
				<form name="userlogin"action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
					<table class="form" border="0">

						<tr>
							<td></td>
							<td style="color:red;">
							<?php echo $msg; ?></td>
						</tr> 
			
						<tr>
							<th><label for="name"><strong>UserName:</strong></label></th>
							<td><input class="inp-text" name="name" id="name" type="text" size="30" /></td>
						</tr>

						<tr>
							<th><label for="name"><strong>Password:</strong></label></th>
							<td><input class="inp-text" name="password" id="password" type="password" size="30" /></td>
						</tr>

						<tr>
							<td></td>
							<td class="submit-button-right">
							<input class="send_btn" type="submit" value="Submit" alt="Submit" title="Submit" />
							<input class="send_btn" type="reset" value="Reset" alt="Reset" title="Reset" /></td>
						</tr>

					</table>
				</form>
		<div>
	<div>
	<div id="footer">
			<p>
				&copy; Copyright 2015 | Precision Adjusters | All rights reserved.
			</p>
	</div>
</body>
</html>
