<?php 
    include "logon.php";
	include dbaccess.php;    

	if(isset($_POST['addVI_Save'])){
		$vin = $_POST['vin']; //Vehicle Identification Number <br> <input type = "text" name = "vin"> <br><br>
        $plateNo = $_POST['plateNo']; //Plate Number <br> <input type = "text" name = "plateNo"> <br><br>
       	$type = $_POST['type']; //Type <br> <input type = "text" name = "type"> <br><br>        
		$make = $_POST['make']; //Make <br> <input type = "text" name = "make"> <br><br>
		$model = $_POST['model']; //Model <br> <input type = "text" name = "model"> <br><br>        
        $year = $_POST['year']; //Year <br> <input type = "text" name = "year"> <br><br>
        $damages = $_POST['damages']; //Damage Description <br> <input type = "textarea" name = "damages"> <br><br>
        
        //INSERT INTO table_name (column1, column2, column3) VALUES ('value1', 'value2', 'value3');
		$dbqVI = "INSERT INTO vehicle_accinfo (vin,plateNo,type,make,model,year,damages) VALUES ($vin,$plateNo,$type,$make,$model,$year,$damages)";
		$query = mysql_query($dbqVI);

		if ($query === false) {
            	echo "Could not successfully run query ($dbqVI) from DB ($database): " . mysql_error();
            	exit;
        }
    }
?>
