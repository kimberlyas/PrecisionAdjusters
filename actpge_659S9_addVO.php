<?php 
	include "logon.php";
	include dbaccess.php;
	
	if(isset($_POST['addVO_Save'])){
		$policyNo = $_POST['policyNo'];//Policy Number <br> <input type = "text" name = "policyNo"> <br><br>
		$lname_ic = $_POST['lname_ic'];//Last Name <br> <input type = "text" name = "lname_ic"> <br><br>
		$fname_ic = $_POST['fname_ic'];//First Name <br> <input type = "text" name = "fname_ic"> <br><br>
		$mname_ic = $_POST['mname_ic'];//Middle Name <br> <input type = "text" name = "mname_ic"> <br><br>
		$dlicense = $_POST['dlicense'];//Driver's License Number <br> <input type = "text" name = "dlicense"> <br><br>
		$insurer = $_POST['insurer'];//Insurer <br> <input type = "text" name = "insurer"> <br><br>				      
        
		//INSERT INTO table_name (column1, column2, column3) VALUES ('value1', 'value2', 'value3');
		$dbqVO = "INSERT INTO vehicleowner_icinfo (policyNo,lname_ic,fname_ic,mname_ic,dlicense,insurer) VALUES ($policyNo,$lname_ic,$fname_ic,$mname_ic,$dlicense,$insurer)";
		$query = mysql_query($dbqVO);

		if ($query === false) {
            		echo "Could not successfully run query ($dbqVO) from DB ($database): " . mysql_error();
            		exit;
        	}
    }
?>
