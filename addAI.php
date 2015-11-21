<?php
    $db = mysql_connect(“localhost”, “user”);
    Mysql_select_db(“PA_Database”);


    $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

    if (!$link) {
        die('Could not connect: ' . mysql_error());
     }

     $db_selected = mysql_select_db(DB_NAME, $link);

     if (!$db_selected) {
     die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
     }

    if (isset($_POST['Save'])) {
         $loc = $_POST['location'];
       	 $td = $_POST['t_date'];
         $wState = $_POST['wState'];
         $desc = $_POST['sDesc'];
         $sql = "INSERT into accinfo (accidentNo, location, datetime, eyeWitnessDetails, sceneDescription) values ($aInfo, $loc, $td, $wState, $desc)";
   		 
   		 $result = mysql_query($sql);
    }
?>