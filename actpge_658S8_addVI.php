<?php 
	include dbaccess.php;    

	if(isset($_POST['addVI_Save'])){
		$vin = $_POST['vin']; //Vehicle Identification Number <br> <input type = "text" name = "vin"> <br><br>
        $plateNo = $_POST['plateNo']; //Plate Number <br> <input type = "text" name = "plateNo"> <br><br>
       	$type = $_POST['type']; //Type <br> <input type = "text" name = "type"> <br><br>        
		$make = $_POST['make']; //Make <br> <input type = "text" name = "make"> <br><br>
		$model = $_POST['model']; //Model <br> <input type = "text" name = "model"> <br><br>        
        $year = $_POST['year']; //Year <br> <input type = "text" name = "year"> <br><br>
        $damages = $_POST['damages']; //Damage Description <br> <input type = "textarea" name = "damages"> <br><br>
        $accidentNo = $_POST['accidentNo']; //Accident Number <br> <input type = "text" name = "accidentNo"> <br><br>
        
		$sql1_VI = "INSERT INTO vehicle_accinfo VALUES ($vin,$plateNo,$type,$make,$model,$year,$damages,$accidentNo)";
		$q1VI = mysql_query($sql1_VI);

		if(!$q1VI){
		    echo "Could not successfully run query ($sql1_VI) from DB ($database): " . mysql_error();
            exit;
		}
    }
?>
