<?php include "logon.php";
    if($_POST['addVI_Save']){
        $plateNo = $_POST['plateNo']; //Plate Number <br> <input type = "text" name = "plateNo"> <br><br>
        $vin = $_POST['vin']; //Vehicle Identification Number <br> <input type = "text" name = "vin"> <br><br>
        $model = $_POST['model']; //Model <br> <input type = "text" name = "model"> <br><br>
        $make = $_POST['make']; //Make <br> <input type = "text" name = "make"> <br><br>
        $type = $_POST['type']; //Type <br> <input type = "text" name = "type"> <br><br>
        $year = $_POST['year']; //Year <br> <input type = "text" name = "year"> <br><br>
        $damages = $_POST['damages']; //Damage Description <br> <input type = "textarea" name = "damages"> <br><br>
        
        
    }
?>