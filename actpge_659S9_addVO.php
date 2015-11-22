<?php 
	include dbaccess.php;
	
	if(isset($_POST['addVO_Save'])){
		$policyNo = $_POST['policyNo'];//Policy Number <br> <input type = "text" name = "policyNo"> <br><br>
		$lname_ic = $_POST['lname_ic'];//Last Name <br> <input type = "text" name = "lname_ic"> <br><br>
		$fname_ic = $_POST['fname_ic'];//First Name <br> <input type = "text" name = "fname_ic"> <br><br>
		$mname_ic = $_POST['mname_ic'];//Middle Name <br> <input type = "text" name = "mname_ic"> <br><br>
		$dlicense = $_POST['dlicense'];//Driver's License Number <br> <input type = "text" name = "dlicense"> <br><br>
		$icname = $_POST['icname'];//Insurer <br> <input type = "text" name = "insurer"> <br><br>	
		$vin = $_POST['vin']; //Vehicle Identification Number <br> <input type = "text" name = "vin"> <br><br>
		
		$sql1_VO = "INSERT INTO vehicleowner_icinfo VALUES ($policyNo,$lname_ic,$fname_ic,$mname_ic,$dlicense,$icname,$vin)";
		$q1VO = mysql_query($sql1_VO);

		if (!$q1VO) {
            		echo "Could not successfully run query ($sql1_VO) from DB ($database): " . mysql_error();
            		exit;
        	}
    }
?>
